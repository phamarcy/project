<?php
require_once(__DIR__."/database.php");
require_once(__DIR__."/manage_deadline.php");
require_once(__DIR__.'/curl.php');
require_once(__DIR__."/course.php");
require_once(__DIR__."/person.php");
require_once(__DIR__."/../config/configuration_variable.php");
require_once(__DIR__."/../../page/vendor/PHPMailer/PHPMailerAutoload.php");
require_once(__DIR__."/../../page/vendor/autoload.php");

use Mailgun\Mailgun;
/**
 *
 */
class Report
{
  private $LOG;
  private $DB;
  private $SEMESTER;
  private $YEAR;
  private $SEMESTER_ID;
  private $USER_LEVEL;
  private $CURL;
  private $COURSE;
  private $PERSON;
  private $DEADLINE;
  private $FILE_PATH;
  private $DOWNLOAD_URL;
  private $VIEW_URL;

  function __construct()
  {
    global $FILE_PATH;
    $this->FILE_PATH = $FILE_PATH."/complete";
    $this->LOG = new Log();
    $this->DEADLINE = new Deadline();
    $data = $this->DEADLINE->Get_Current_Semester();
    $this->SEMESTER_ID = $data['id'];
    $this->SEMESTER = $data['semester'];
    $this->YEAR = $data['year'];
    $this->CURL = new CURL();
    $this->COURSE = new Course();
    $this->DB = new Database();
    $this->PERSON = new Person();
    $this->Get_URL();
  }

  private function Get_URL()
  {
    $url = $this->CURL->GET_SERVER_URL();
    $download_url = $url."/application/download/download.php";
    $view_url = $url."/application/pdf/view.php";
    $this->DOWNLOAD_URL = $download_url;
    $this->VIEW_URL = $view_url;
  }

  public function Get_Evaluate_Report($semester,$year)
  {
    global $FILE_PATH;
    $semester_id = $this->DEADLINE->Search_Semester_id($semester,$year);
    if($semester_id)
    {
      $dept_id = $this->PERSON->Get_Staff_Dep($_SESSION['id']);
      $temp_course = $this->COURSE->Get_Dept_Course($dept_id['code'],$semester_id);
      $dept_course = array();
      if(!isset($temp_course['status']))
      {
        for($i=0;$i<count($temp_course);$i++)
        {
          array_push($dept_course,$temp_course[$i]['id']);
        }
      }
      $DATA = array();
      $course = scandir($this->FILE_PATH);
      for($i=2;$i<count($course);$i++)
      {
        if($_SESSION['level'] == 2 && !in_array($course[$i],$dept_course))
        {
          continue;
        }
        if(is_dir($this->FILE_PATH."/".$course[$i]))
        {
            $data['id'] = $course[$i];
            $data['name'] = $this->COURSE->Get_Course_Name($data['id']);
            $syllabus_file = $FILE_PATH."/syllabus/".$data['id']."_".$semester."_".$year.".doc";
            if (file_exists(realpath($syllabus_file)))
            {
                $syllabus_path = "/syllabus/".$data['id']."_".$semester."_".$year.".doc";
            }
            else
            {
              $syllabus_file = $FILE_PATH."/syllabus/".$data['id']."_".$semester."_".$year.".docx";
              if (file_exists(realpath($syllabus_file)))
              {

                  $syllabus_path = "/syllabus/".$data['id']."_".$semester."_".$year.".docx";
              }
              else
              {
                $syllabus_path = null;
              }
            }
            $data['syllabus'] = $syllabus_path;
            $data['pdf'] = $this->DOWNLOAD_URL."?course=".$data['id']."&info=evaluate&semester=".$semester."&year=".$year;
            $grade_file = $FILE_PATH."/grade/".$data['id']."_grade_".$semester."_".$year.".xls";
            if (file_exists(realpath($grade_file)))
            {
                $data['grade'] = "/grade/".$data['id']."_grade_".$semester."_".$year.".xls";
            }
            else
            {
              $grade_file = $FILE_PATH."/grade/".$data['id']."_grade_".$semester."_".$year.".xlsx";
              if (file_exists(realpath($grade_file)))
              {
                  $data['grade'] = "/grade/".$data['id']."_grade_".$semester."_".$year.".xlsx";
              }
              else
              {
                $data['grade'] = null;

              }
            }
            if(is_dir($this->FILE_PATH."/".$data['id']."/evaluate"))
            {
              $file_name = scandir($this->FILE_PATH."/".$data['id']."/evaluate");
              for($j=2;$j<count($file_name);$j++)
              {
                if($this->Check_File_Semester($semester,$year,$file_name[$j]))
                {
                  array_push($DATA,$data);
                  break;
                }
              }
            }
        }
      }
      if(count($DATA) == 0)
      {
        $return['status'] = 'error';
        $return['msg'] = 'ไม่พบข้อมูล';
        return $return;
      }
      else
      {
        return $DATA;
      }

    }
    else
    {
      $return['status'] = 'error';
      $return['msg'] = 'ไม่พบข้อมูล';
      return $return;
    }

  }

  private function Check_File_Semester($semester,$year,$file_name)
  {
    $file_name = substr($file_name, 0, -4);
    $file_name = explode("_",$file_name);
    $prefix = count($file_name);
    if($file_name[$prefix -1 ] == $year && $file_name[$prefix - 2 ] == $semester )
    {
      return true;
    }
    else
    {
      return false;
    }
  }
  public function Get_Special_Report($semester,$year)
  {
    global $FILE_PATH;
    $semester_id = $this->DEADLINE->Search_Semester_id($semester,$year);
    if($semester_id)
    {
      $dept_id = $this->PERSON->Get_Staff_Dep($_SESSION['id']);
      $temp_course = $this->COURSE->Get_Dept_Course($dept_id['code'],$semester_id);
      $dept_course = array();
      if(!isset($temp_course['status']))
      {
        for($i=0;$i<count($temp_course);$i++)
        {
          array_push($dept_course,$temp_course[$i]['id']);
        }
      }
      $DATA = array();
      $course = scandir($this->FILE_PATH);
      if(count($course)<= 2)
      {
        $return['status'] = 'error';
        $return['msg'] = 'ไม่พบข้อมูล';
        return $return;
      }

      for($i=2;$i<count($course);$i++)
      {
        if($_SESSION['level'] == 2 && !in_array($course[$i],$dept_course))
        {
          continue;
        }
        $data['id'] = $course[$i];
        $data['name'] = $this->COURSE->Get_Course_Name($data['id']);
        $data['special'] = array();
        if(is_dir($this->FILE_PATH."/".$data['id']))
        {
          if(is_dir($this->FILE_PATH."/".$data['id']."/special_instructor"))
          {
            $file_name = scandir($this->FILE_PATH."/".$data['id']."/special_instructor");

            for($j=2;$j<count($file_name);$j++)
            {
              if($this->Check_File_Semester($semester,$year,$file_name[$j]))
              {
                $instructor_id = explode("_",$file_name[$j]);
                $instructor['id'] = $instructor_id[1];
                $instructor['name'] = $this->PERSON->Get_Special_Instructor_Name($instructor['id']);
                $CV_file = $FILE_PATH."/cv/".$data['id']."_".$instructor['id']."_".$semester."_".$year.".doc";
                if (file_exists(realpath($CV_file)))
                {
                    $path = "/cv/".$data['id']."_".$instructor['id']."_".$semester."_".$year.".doc";
                }
                else
                {
                  $CV_file = $FILE_PATH."/cv/".$data['id']."_".$instructor['id']."_".$semester."_".$year.".docx";
                  if (file_exists(realpath($CV_file)))
                  {
                      $path = "/cv/".$data['id']."_".$instructor['id']."_".$semester."_".$year.".docx";
                  }
                  else
                  {
                    $CV_file = $FILE_PATH."/cv/".$data['id']."_".$instructor['id']."_".$semester."_".$year.".pdf";
                    if (file_exists(realpath($CV_file)))
                    {
                      $path = "/cv/".$data['id']."_".$instructor['id']."_".$semester."_".$year.".pdf";
                    }
                    else
                    {
                        $path = null;
                    }
                  }
                }
                $instructor['cv'] = $this->PERSON->Get_CV($instructor['id'],$data['id']);
                $instructor['pdf'] =  $this->VIEW_URL."?course=".$data['id']."&id=".$instructor['id']."&type=complete&info=special&semester=".$semester."&year=".$year;
                array_push($data['special'],$instructor);
              }
            }
          }
        }
        if(count($data['special']) != 0)
        {
          array_push($DATA,$data);
        }
      }
      if(count($DATA) == 0)
      {
        $return['status'] = 'error';
        $return['msg'] = 'ไม่พบข้อมูล';
        return $return;
      }
      else
      {
        return $DATA;
      }
    }
    else
    {
      $return['status'] = 'error';
      $return['msg'] = 'ไม่พบข้อมูล';
      return $return;
    }
  }

  //search comment history
  public function Get_Comment_History($course_id)
  {
    $course = array();
    $course['comment'] = array();
    $course['id'] = $course_id;
    $course['name'] = $this->COURSE->Get_Course_Name($course_id);
    $sql = "SELECT `teacher_id`,`comment`,`semester_num`,`year`,ac.`updated_date` FROM `comment_course` ac, `semester` s
    WHERE ac.`semester_id` = s.`semester_id` AND ac.`course_id` = '".$course_id."' ORDER BY ac.`semester_id`,ac.`updated_date`";
    $result = $this->DB->Query($sql);
    if($result)
    {
      $count = count($result);
      for($i=0;$i<$count;$i++)
      {
        $semester = $result[$i]['semester_num']."/".$result[$i]['year'];
        if(!array_key_exists($semester,$course['comment']))
        {
          $course['comment'][$semester]['special'] = array();
          $course['comment'][$semester]['evaluate'] = array();
        }
          $data['name'] = $this->PERSON->Get_Teacher_Name($result[$i]['teacher_id']);
          $data['comment'] = $result[$i]['comment'];
          $data['date'] = $result[$i]['updated_date'];
          array_push($course['comment'][$semester]['evaluate'],$data);
      }
    }
    $sql = "SELECT `teacher_id`,`comment`,`instructor_id`,`semester_num`,`year`,`updated_date` FROM `comment_special` sa, `semester` s
    WHERE sa.`semester_id` = s.`semester_id` AND sa.`course_id` = '".$course_id."' ORDER BY sa.`semester_id`,sa.`updated_date`";
    $result = $this->DB->Query($sql);
    if($result)
    {
      $count = count($result);
      for($i=0;$i<$count;$i++)
      {
        $semester = $result[$i]['semester_num']."/".$result[$i]['year'];
        if(!array_key_exists($semester,$course['comment']))
        {
          $course['comment'][$semester]['special'] = array();
          $course['comment'][$semester]['evaluate'] = array();
        }
        $instructor_id = $result[$i]['instructor_id'];
        $instructor_name = $this->PERSON->Get_Special_Instructor_Name($instructor_id);
        if(!array_key_exists($instructor_id,$course['comment'][$semester]['special']))
        {
          $course['comment'][$semester]['special'][$instructor_id] = array();
          $course['comment'][$semester]['special'][$instructor_id]['name'] = $instructor_name;
          $course['comment'][$semester]['special'][$instructor_id]['comment'] =array();
        }
        $data['name'] = $this->PERSON->Get_Teacher_Name($result[$i]['teacher_id']);
        $data['comment'] = $result[$i]['comment'];
        $data['date'] = $result[$i]['updated_date'];
        array_push($course['comment'][$semester]['special'][$instructor_id]['comment'],$data);
      }
    }

    return $course;
  }

  public function Append_Notification($user_id,$msg)
  {
    $status = '0';
    $sql = "INSERT INTO `notification`(`user_id`, `message`, `status`)
     VALUES ('".$user_id."','".$msg."','".$status."')";
    $this->DB->Insert_Update_Delete($sql);
  }
  public function Close_connection()
  {
    $this->DB->Close_connection();
  }

  public function Sendemail($teacher_id,$data)
  {
    global $EMAIL;
    $idobj = new Person;
    $type = $data['TYPE'];
    if($type=='2')
    {
      $name = $data['NAME'];
    }

    $this->LOG->Write("Send email to ".$teacher_id);
    $course_id = $data['COURSE_ID'];
    $status = $data['STATUS'];
    $date = $data['DATE_USER'];
    $time = $data['TIME_USER'];

    $mail = new PHPMailer();
    $mail->IsSMTP();
    //$mail->SMTPDebug = $EMAIL['SMTPDebug'];
    $mail->SMTPAuth = $EMAIL['SMTPAuth'];
    $mail->SMTPSecure = $EMAIL['SMTPSecure'];
    $mail->Host = $EMAIL['Host'];
    $mail->Port = $EMAIL['Port'];
    $mail->IsHTML(true);
    $mail->Username = $EMAIL['Username'];
    $mail->Password = $EMAIL['Password'];
    $mail->SetFrom($EMAIL['SETFROM']);
    $sendsubject = "=?utf-8?b?".base64_encode('ระบบงานข้อมูลของงานบริการการศึกษา คณะเภสัชศาสตร์ มหาวิทยาลัยเชียงใหม่')."?=";
    $mail->Subject = $sendsubject;
    $mail->CharSet = "utf-8";

      if($type=='1')
        {
          switch ($status) {
              case '0':
                  $bodystring = "รหัสกระบวนวิชา ".$course_id."<br>"."แบบวัดประเมินผลอยู่ระหว่างการกรอกข้อมูล";
                  break;
              case '1':
                  $bodystring = "รหัสกระบวนวิชา ".$course_id."<br>"."แบบวัดประเมินผลอยู่ระหว่างการรอพิจารณา";
                  break;
              case '2':
                  $bodystring = "รหัสกระบวนวิชา ".$course_id."<br>"."คณะกรรมการไม่เห็นชอบกับแบบวัดประเมินผล";
                  break;
              case '3':
                  $bodystring = "รหัสกระบวนวิชา ".$course_id."<br>"."แบบวัดประเมินผลต้องมีการแก้ไข";
                  break;
              case '4':
                  $bodystring = "รหัสกระบวนวิชา ".$course_id."<br>"."แบบวัดประเมินผลเห็นชอบจากคณะกรรมการระดับภาคแล้ว";
                  break;
              case '5':
                  $bodystring = "รหัสกระบวนวิชา ".$course_id."<br>"."แบบวัดประเมินผลอยู่ระหว่างการรอคณะกรรมการอนุมัติ";
                  break;
              case '6':
                  $bodystring = "รหัสกระบวนวิชา ".$course_id."<br>"."แบบวัดประเมินผลต้องมีการแก้ไข";
                  break;
              case '7':
                  $bodystring = "รหัสกระบวนวิชา ".$course_id."<br>"."แบบวัดประเมินผลได้รับการเห็นชอบจากคณะกรรมการแล้ว";
                  break;
                default:
                  return 'error';
                  break;
          }

        }
        elseif ($type=='2')
        {
          switch ($status) {
              case '0':
                  $bodystring = "รหัสกระบวนวิชา ".$course_id." อาจารย์รับเชิญพิเศษ คุณ".$name."<br>"."แบบขออนุมัติเชิญอาจารย์พิเศษอยู่ระหว่างการกรอกข้อมูล";
                  break;
              case '1':
                  $bodystring = "รหัสกระบวนวิชา ".$course_id." อาจารย์รับเชิญพิเศษ คุณ".$name."<br>"."แบบขออนุมัติเชิญอาจารย์พิเศษอยู่ระหว่างการรอพิจารณา";
                  break;
              case '2':
                  $bodystring = "รหัสกระบวนวิชา ".$course_id." อาจารย์รับเชิญพิเศษ คุณ".$name."<br>"."คณะกรรมการไม่เห็นชอบกับแบบขออนุมัติเชิญอาจารย์พิเศษ";
                  break;
              case '3':
                  $bodystring = "รหัสกระบวนวิชา ".$course_id." อาจารย์รับเชิญพิเศษ คุณ".$name."<br>"."แบบขออนุมัติเชิญอาจารย์พิเศษต้องมีการแก้ไข";
                  break;
              case '4':
                  $bodystring = "รหัสกระบวนวิชา ".$course_id." อาจารย์รับเชิญพิเศษ คุณ".$name."<br>"."แบบขออนุมัติเชิญอาจารย์พิเศษเห็นชอบจากคณะกรรมการระดับภาคแล้ว";
                  break;
              case '5':
                  $bodystring = "รหัสกระบวนวิชา ".$course_id." อาจารย์รับเชิญพิเศษ คุณ".$name."<br>"."แบบขออนุมัติเชิญอาจารย์พิเศษอยู่ระหว่างการรอคณะกรรมการอนุมัติ";
                  break;
              case '6':
                  $bodystring = "รหัสกระบวนวิชา ".$course_id." อาจารย์รับเชิญพิเศษ คุณ".$name."<br>"."แบบขออนุมัติเชิญอาจารย์พิเศษต้องมีการแก้ไข";
                  break;
              case '7':
                  $bodystring = "รหัสกระบวนวิชา ".$course_id." อาจารย์รับเชิญพิเศษ คุณ".$name."<br>"."แบบขออนุมัติเชิญอาจารย์พิเศษได้รับการเห็นชอบจากคณะกรรมการแล้ว";
                  break;
                default:
                  return 'error';
                  break;
          }
        }

        $bodystring = $bodystring." เมื่อวันที่ ".$date." เวลา ".$time;
        $bodystring = $bodystring."<br><br>----อีเมล์นี้ส่งจากระบบงานข้อมูลของงานบริการการศึกษา คณะเภสัชศาสตร์ มหาวิทยาลัยเชียงใหม่----";
        $mail->Body = $bodystring;

        $debug = '';
        $mail->Debugoutput = function($str, $level) {
            $debug .= $level.": ".$str."\n";
        };

        if($mail->AddAddress($idobj->Get_Teacher_Email($teacher_id)) == false)
        {
          $this->LOG->Write($debug);
        }
        else {
          $mail->AddAddress($idobj->Get_Teacher_Email($teacher_id));
        }

         if(!$mail->Send()) {
            $this->LOG->Write($debug." Error: incomplete");
         } else {
            $this->LOG->Write($debug." Complete");
         }

  } //end email

}



 ?>
