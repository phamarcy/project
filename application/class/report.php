<?php
require_once(__DIR__."/database.php");
require_once(__DIR__."/manage_deadline.php");
require_once(__DIR__.'/curl.php');
require_once(__DIR__."/course.php");
require_once(__DIR__."/person.php");
require_once(__DIR__."/../config/configuration_variable.php");
require_once(__DIR__."/../../page/vendor/autoload.php");

/** This class serves report all new changing status,document
*
* @author  Adiluck Chooprateep
* @since   4/10/2017
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

//get download and view url to use in this class
  private function Get_URL()
  {
    $url = $this->CURL->GET_SERVER_URL();
    $download_url = $url."/application/download/download.php";
    $view_url = $url."/application/pdf/view.php";
    $this->DOWNLOAD_URL = $download_url;
    $this->VIEW_URL = $view_url;
  }

//get course evaluate,course syllabus, course grade url
  public function Get_Evaluate_Report($semester,$year,$dept_id)
  {
    global $FILE_PATH;
    $semester_id = $this->DEADLINE->Search_Semester_id($semester,$year);
    if($semester_id)
    {
      $temp_course = $this->COURSE->Get_Dept_Course($dept_id,$semester_id);
      $dept_course = array();
      if(!isset($temp_course['status']))
      {
        for($i=0;$i<count($temp_course);$i++)
        {
          array_push($dept_course,$temp_course[$i]['id']);
        }
      }
      $DATA = array();
      $DATA['info'] = array();
      $DATA['download'] = $this->DOWNLOAD_URL."?course=all&type=report&info=evaluate&semester=".$semester."&year=".$year;
      $sql ="SELECT `course_id` FROM `course_evaluate` WHERE `status` = '1' AND `semester_id` = ".$semester_id;
      $result = $this->DB->Query($sql);
      if($result)
      {
      	$count = count($result);
        for($i=0;$i<$count;$i++)
        {
          if(!in_array($result[$i]['course_id'],$dept_course))
           {
             continue;
           }
          $data['id'] = $result[$i]['course_id'];
          $data['name'] = $this->COURSE->Get_Course_Name($data['id']);
          $data['syllabus'] = $this->COURSE->Get_Course_Syllabus($data['id'],$semester_id);
          $data['pdf'] = $this->DOWNLOAD_URL."?course=".$data['id']."&type=report&info=evaluate&semester=".$semester."&year=".$year;
          $sql = "SELECT `file_name` FROM `couse_grade` WHERE `course_id` = '".$data['id']."' AND `semester_id` = ".$semester_id;
          $result_filename = $this->DB->Query($sql);
          if($result_filename)
          {
            $data['grade'] = $result_filename[0]['file_name'];
          }
          else
          {
            $data['grade'] = null;
          }
          array_push($DATA['info'],$data);
        }
      }
      if(count($DATA['info']) == 0)
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
//check if file is in current semester
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

  //get special instructor CV and pdf
  public function Get_Special_Report($semester,$year,$dept_id)
  {
    global $FILE_PATH;
    $semester_id = $this->DEADLINE->Search_Semester_id($semester,$year);
    if($semester_id)
    {
      $temp_course = $this->COURSE->Get_Dept_Course($dept_id,$semester_id);
      $dept_course = array();
      if(!isset($temp_course['status']))
      {
        for($i=0;$i<count($temp_course);$i++)
        {
          array_push($dept_course,$temp_course[$i]['id']);
        }
      }
      $DATA = array();
      $DATA['info'] = array();
      $DATA['download'] = $this->DOWNLOAD_URL."?course=all&type=report&info=special&semester=".$semester."&year=".$year;
      $sql = "SELECT DISTINCT `course_id` FROM `course_hire_special_instructor` WHERE `status` = '1'";
      $result_course = $this->DB->Query($sql);
      if($result_course)
      {
        for($i=0;$i<count($result_course);$i++)
        {
          if(!in_array($result_course[$i]['course_id'],$dept_course))
           {
             continue;
           }
          $sql = "SELECT si.`instructor_id`,si.`prefix`,si.`firstname`,si.`lastname`,si.`cv` FROM `course_hire_special_instructor` ci ,`special_instructor` si ";
          $sql.= "WHERE ci.`instructor_id` = si.`instructor_id` AND ci.`course_id` = '".$result_course[$i]['course_id']."' AND ci.`status` = '1'";
          $result_instructor =  $this->DB->Query($sql);
          $data = array();
          $data['id'] = $result_course[$i]['course_id'];
          $data['name'] = $this->COURSE->Get_Course_Name($data['id']);
          $data['special'] = array();
          if($result_instructor)
          {
            for($j=0;$j<count($result_instructor);$j++)
            {
              $instructor['id'] = $result_instructor[$j]['instructor_id'];
              $instructor['name'] = $result_instructor[$j]['prefix'].' '.$result_instructor[$j]['firstname'].' '.$result_instructor[$j]['lastname'];
              $instructor['cv'] = $this->PERSON->Get_CV($instructor['id']);
              $instructor['pdf'] = $this->VIEW_URL."?course=".$data['id']."&id=".$instructor['id']."&type=complete&info=special&semester=".$semester."&year=".$year;
              array_push($data['special'],$instructor);
            }
          }
          array_push($DATA['info'],$data);
        }
      }
      if(count($DATA['info']) == 0)
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
    if($_SESSION['level'] == 4)
    {
      $teacher_id = $_SESSION['id'];
      $this->PERSON->Get_Staff_Dep($teacher_id);
      $sql = "SELECT `respon_id` FROM `department_course_responsible` WHERE `course_id` = '".$course_id."' AND `semester_id` = ".$this->SEMESTER_ID;
      $result = $this->DB->Query($sql);
      if($result == null)
      {
        $return['status'] = 'error';
        $return['msg'] = 'ไม่พบกระบวนวิชานี้ในภาควิชา';
        return $return;
      }
    }
    //search comment in course evaluate
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
          $originalDate = $result[$i]['updated_date'];
          $update_date = date("d-m-Y H:i:s", strtotime($originalDate));
          $data['date'] = $update_date;
          array_push($course['comment'][$semester]['evaluate'],$data);
      }
    }
    //search comment in special instructor
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
        $originalDate = $result[$i]['updated_date'];
        $update_date = date("d-m-Y H:i:s", strtotime($originalDate));
        $data['date'] = $update_date;
        array_push($course['comment'][$semester]['special'][$instructor_id]['comment'],$data);
      }
    }
    return $course;
  }


//add new notification to database to show in index page
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

//send email
  public function Sendemail($teacher_id,$data)
  {
    $idobj = new Person;
    $type = $data['TYPE'];
    if($type=='2')
    {
      $name = $data['NAME'];
    }

    $course_id = $data['COURSE_ID'];
    $status = $data['STATUS'];
    $date = $data['DATE_USER'];
    $time = $data['TIME_USER'];


    $sendsubject = "=?utf-8?b?".base64_encode('ระบบงานข้อมูลของงานบริการการศึกษา คณะเภสัชศาสตร์ มหาวิทยาลัยเชียงใหม่')."?=";


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



        $to = $idobj->Get_Teacher_Email($teacher_id);
        if (!$to) {
          $this->LOG->Write("Can't Get Teacher Email");
          return false;
        }
        $headerFields = array(
          "From: noreply@pharmacy.cmu.ac.th",
          "Content-Type: text/html;charset=utf-8"
        );
        $headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: noreply@pharmacy.cmu.ac.th' . "\r\n";

        $mail_sent = mail( $to, $sendsubject, $bodystring, $headers );
        if ((!$mail_sent) || $mail_sent==false) {
          $this->LOG->Write("MAIL FUNCTION : Failed to send E-mail");
        }
  } //end email

}



 ?>
