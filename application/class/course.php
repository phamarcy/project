<?php
require_once(__DIR__."/database.php");
require_once(__DIR__."/manage_deadline.php");
require_once(__DIR__."/person.php");
/**
 *
 */
class Course
{
  private $LOG;
  private $DB;
  private $FILE_PATH;


  function __construct()
  {
    global $FILE_PATH;
    $this->FILE_PATH = $FILE_PATH;
    $this->LOG = new Log();
    $this->DB = new Database();
    $this->DEADLINE = new Deadline();
    $this->PERSON = new Person();
  }

  //search teacher prefix and name
  public function Get_Course_Name($course_id)
  {

    $sql="SELECT `course_name_en` FROM `course` WHERE `course_id` ='".$course_id."'";

    $result = $this->DB->Query($sql);
    if($result)
    {
      $course_name = $result[0]['course_name_en'];
      return $course_name;
    }
    else
    {
      return '-';
    }
    //search teacher data
  }

  public function Get_All_Course()
  {
    $sql = "SELECT `course_id`as id,`course_name_en` as name_en,`course_name_th`as name_th FROM `course`";
    $result = $this->DB->Query($sql);
    if($result)
    {
      $data = array();
      for($i=0;$i<count($result);$i++)
      {
        $course['id'] = $result[$i]['id'];
        $course['name']['en'] = $result[$i]['name_en'];
        $course['name']['th'] = $result[$i]['name_th'];
        array_push($data,$course);
      }
      return $data;
    }
    else
    {
      $this->LOG->Write("Error course : search all course failed");
      return false;
    }
  }

  public function Get_Dept_Course($department_id,$semester_id)
  {
    $DATA = array();
    $sql = "SELECT c.`course_id`,c.`course_name_en` FROM `department_course_responsible` dc, `course` c
    WHERE c.`course_id` = dc.`course_id` AND dc.`department_id` = '".$department_id."' AND dc.`semester_id` = ".$semester_id;

    $result = $this->DB->Query($sql);
    if($result)
    {
      for($i=0;$i<count($result);$i++)
      {
        $course['id'] = $result[$i]['course_id'];
        $course['name'] = $result[$i]['course_name_en'];
        $staff = $this->Get_Responsible_Staff($course['id'],$semester_id);
        $course['teacher'] = $staff['teacher'];
        $course['assessor'] = $staff['assessor'];
        array_push($DATA,$course);
      }
      return $DATA;
    }
    else
    {
      $return['status'] = 'error';
      $return['msg'] = 'ไม่สามารถค้นหาข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ';
      return $return;
    }

  }

  public function Add_Dept_Course($course_id,$department_id,$semester_id)
  {
    $sql = "SELECT * FROM department_course_responsible
    WHERE `course_id` = '".$course_id."' AND `semester_id` ='".$semester_id."'";
    $result = $this->DB->Query($sql);
    if($result == null)
    {
      $sql = "INSERT INTO `department_course_responsible`(`course_id`, `department_id`, `semester_id`)
      VALUES ('".$course_id."','".$department_id."',".$semester_id.")";
      $result = $this->DB->Insert_Update_Delete($sql);
      if($result)
      {
        $return['status'] = 'success';
        $return['msg'] = 'เพิ่มกระบวนวิชาสำเร็จ';
      }
      else
      {
        $return['status'] = 'error';
        $return['msg'] = 'ไม่สามารถเพิ่มกระบวนวิชาได้ กรุณาติดต่อผู้ดูแลระบบ';
      }

    }
    else
    {
      $return['status'] = 'error';
      $return['msg'] = 'กระบวนวิชานี้มีอยู่แล้ว หรืออยู่ในภาควิชาอื่น';
    }
    return $return;
  }

  public function Remove_Dept_Course($course_id,$department_id,$semester_id)
  {
    $sql = "SELECT * FROM department_course_responsible
    WHERE `course_id` = '".$course_id."' AND `semester_id` ='".$semester_id."'";
    $result = $this->DB->Query($sql);
    if($result != null)
    {
      $sql = "DELETE FROM `department_course_responsible`
      WHERE `course_id` = '".$course_id."' AND `semester_id` ='".$semester_id."'";
      $result = $this->DB->Insert_Update_Delete($sql);
      if($result)
      {
        $return['status'] = 'success';
        $return['msg'] = 'ลบกระบวนวิชาสำเร็จ';
      }
      else
      {
        $return['status'] = 'error';
        $return['msg'] = 'ไม่สามารถลบกระบวนวิชาได้ กรุณาติดต่อผู้ดูแลระบบ';
      }
    }
    else
    {
      $return['status'] = 'error';
      $return['msg'] = 'ไม่มีกระบวนวิชานี้อยู่ในภาควิชา';
    }
    return $return;
  }

  private function Get_Responsible_Staff($course_id,$semester_id)
  {
    $DATA = array();
    $DATA['teacher'] = '';
    $DATA['assessor'] = '';
    //get teacher
    $sql = "SELECT `teacher_id` FROM `course_responsible`
    WHERE `course_id` = '".$course_id."' AND `semester_id` = '".$semester_id."'";
    $result = $this->DB->Query($sql);
    if($result)
    {
      $teacher_id = $result[0]['teacher_id'];
      $name = $this->PERSON->Get_Teacher_Name($teacher_id);
      if($name)
      {
        $DATA['teacher'] = $name;
      }
      else
      {
        $DATA['teacher'] = null;
      }
    }
    //get assessor
    $sql = "SELECT `assessor_group_num` FROM `subject_assessor`
    WHERE `course_id` = '".$course_id."' AND `semester_id` = '".$semester_id."'";
    $result = $this->DB->Query($sql);
    if($result)
    {
      $group_num = $result[0]['assessor_group_num'];
      if($group_num != null)
      {
        $group_num = substr($group_num,-1);
        $DATA['assessor'] = $group_num;
      }
      else
      {
        $DATA['assessor'] = null;
      }
    }
    return $DATA;
  }

  public function Add_Responsible_Staff($course_id,$teacher_name,$semester_id)
  {
    $teacher_id = $this->PERSON->Get_Teacher_Id($teacher_name);
    $sql = "INSERT INTO `course_responsible`(`course_id`, `teacher_id`, `semester_id`)
    VALUES ('".$course_id."','".$teacher_id."',".$semester_id.") ON DUPLICATE KEY
    UPDATE `teacher_id` = '".$teacher_id."', `semester_id` = ".$semester_id;
    $result = $this->DB->Query($sql);
    if($result)
    {
      $return['status'] = 'success';
      $return['msg'] = 'เพิ่มอาจารย์ผู้รับผิดชอบกระบวนวิชาสำเร็จ';
    }
    else
    {
      $return['status'] = 'error';
      $return['msg'] = 'ไม่สามารถเพิ่มข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ';
    }
    return $return;
  }

  public function Remove_Responsible_Staff($teacher_name,$course_id,$semester_id)
  {
    $teacher_id = $this->PERSON->Get_Teacher_Id($teacher_name);

    $sql = "SELECT * FROM course_responsible
    WHERE `course_id` = '".$course_id."' AND `teacher_id` = '".$teacher_id."' AND `semester_id` = ".$semester_id;
    $result = $this->DB->Query($sql);
    if($result != null)
    {
      $sql = "DELETE FROM `course_responsible`
      WHERE `course_id` = '".$course_id."' AND `teacher_id` = '".$teacher_id."' AND `semester_id` = ".$semester_id;
      $result = $this->DB->Query($sql);
      if($result)
      {
        $return['status'] = 'success';
        $return['msg'] = 'ลบอาจารย์ผู้รับผิดชอบกระบวนวิชาสำเร็จ';
      }
      else
      {
        $return['status'] = 'error';
        $return['msg'] = 'ไม่สามารถลบข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ';
      }

    }
    else
    {
      $return['status'] = 'error';
      $return['msg'] = 'ไม่มีอาจารย์ท่านนี้อยู่ในรายชื่อผู้รับผิดชอบอยู่แล้ว';
    }
  }
  public function Add_Responsible_Assessor($course_id,$group_num,$semester_id,$department_id)
  {
    if($department_id == '1202')
    {
      $group_num = '1'.$group_num;
    }
    else if($department_id == '1203')
    {
      $group_num = '2'.$group_num;
    }
    $sql = "INSERT INTO `subject_assessor`(`course_id`, `assessor_group_num`, `semester_id`)
    VALUES ('".$course_id."','".$group_num."',".$semester_id.") ON DUPLICATE KEY
    UPDATE `assessor_group_num` = '".$group_num."', `semester_id` = ".$semester_id;
    $result = $this->DB->Query($sql);
    if($result)
    {
      $return['status'] = 'success';
      $return['msg'] = 'เพิ่มคณะกรรมการสำเร็จ';
    }
    else
    {
      $return['status'] = 'error';
      $return['msg'] = 'ไม่สามารถเพิ่มข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ';
    }
    return $return;
  }

  public function Remove_Responsible_Assessor($course_id,$semester_id)
  {
    $sql = "SELECT * FROM `subject_assessor`
    WHERE `course_id` = '".$course_id."' AND `semester_id` = ".$semester_id;
    $result = $this->DB->Query($sql);
    if($result != null)
    {
      $sql = "DELETE FROM `course_responsible`
      WHERE `course_id` = '".$course_id."' AND `semester_id` = ".$semester_id;
      $result = $this->DB->Query($sql);
      if($result)
      {
        $return['status'] = 'success';
        $return['msg'] = 'ลบคณะกรรมการสำเร็จ';
      }
      else
      {
        $return['status'] = 'error';
        $return['msg'] = 'ไม่สามารถลบข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ';
      }

    }
    else
    {
      $return['status'] = 'error';
      $return['msg'] = 'ไม่มีคณะกรรมการชุดนี้อยู่ในรายชื่อผู้รับผิดชอบอยู่แล้ว';
    }
    return $return;
  }

  public function Search_Document($type,$id)
  {
    if($type =='special')
    {
      $type = "special_instructor";
    }
    $doc_path = realpath($this->FILE_PATH."/temp/".$id."/".$type);
    $data = array();
    $data['info'] = $this->Get_Course_Info($id);
    if(is_dir($doc_path))
    {
        $file_name = scandir($doc_path);
        for($i=2;$i<count($file_name);$i++)
        {
            $files = explode("_",$file_name[$i]);
            if($type == 'special_instructor')
            {
              $temp['id'] = $files[0];
              $temp['name'] = $this->PERSON->Get_Special_Instructor_Name($temp['id']);
              $temp['semester'] = $files[1];
              $temp['year'] = $files[2];
            }
            else
            {
              $temp['semester'] = $files[2];
              $temp['year'] = $files[3];
            }
              $temp['year'] = str_replace(".txt","",$temp['year']);

            array_push($data,$temp);
        }
    }
      return $data;
  }
  private function Search_Special_Instructor($course_id)
  {
    $doc_path = realpath($this->FILE_PATH."/temp/".$course_id."/special_instructor");
    $data = array();
    if(is_dir($doc_path))
    {
        $file_name = scandir($doc_path);
        for($i=2;$i<count($file_name);$i++)
        {
            $files = explode("_",$file_name[$i]);
            $id = $files[1];
            $temp['id'] = $files[0];
            $temp['name'] = $this->PERSON->Get_Special_Instructor_Name($id);
            $temp['semester'] = $files[1];
            $temp['year'] = $files[2];
            $temp['year'] = str_replace(".txt","",$temp['year']);
            array_push($data,$temp);
        }
    }
    return $data;
  }
  public function Get_Document($type,$course_id,$instructor_id,$semester,$year)
  {

    if($type == 'evaluate')
    {
      $file_name = $course_id."_".$type."_".$semester."_".$year.".txt";
    }
    else if ($type == 'special')
    {
      $type = "special_instructor";
      $file_name = $instructor_id."_".$semester."_".$year.".txt";

    }
    else
    {
      die("รูปแบบข้อมูลผิดพลาด กรุณาติดต่อผู้ดูแลระบบ");
    }

    $doc_path = realpath($this->FILE_PATH."/temp/".$course_id."/".$type);
    $file_path = $doc_path."/".$file_name;
    // return $this->FILE_PATH."/temp/".$course_id."/".$type;
    if (file_exists($file_path))
    {
      $data = file_get_contents($file_path);
    } else
    {
      $data = false;
    }
    return $data;
  }

  public function Get_Grade($teacher_id)
  {
    $curr_semester = $this->DEADLINE->Get_Current_Semester();
    $sql = "SELECT c.`course_id`,`course_name_en` as name FROM `course_responsible` cr,`course` c
    WHERE cr.`teacher_id` = '".$teacher_id."' AND c.`course_id` = cr.`course_id` AND cr.`semester_id` = ".$curr_semester['id'];
    $result = $this->DB->Query($sql);
    if($result)
    {
      $data = array();
      for($i=0;$i<count($result);$i++)
      {
        $temp['course_id'] = $result[$i]['course_id'];
        $temp['course_name'] = $result[$i]['name'];
        $grade_file = $this->FILE_PATH."/grade/".$temp['course_id']."_grade_".$curr_semester['semester']."_".$curr_semester['year'].".xls";
        if (file_exists(realpath($grade_file)))
        {
            $temp['status'] = 1;
            $temp['url'] = "/grade/".$temp['course_id']."_grade_".$curr_semester['semester']."_".$curr_semester['year'].".xls";
        }
        else
        {
          $grade_file = $this->FILE_PATH."/grade/".$temp['course_id']."_grade_".$curr_semester['semester']."_".$curr_semester['year'].".xlsx";
          if (file_exists(realpath($grade_file)))
          {
              $temp['status'] = 1;
              $temp['url'] = "/grade/".$temp['course_id']."_grade_".$curr_semester['semester']."_".$curr_semester['year'].".xlsx";
          }
          else
          {
            $temp['status'] = 0;
            unset($temp['url']);
          }
        }

        array_push($data,$temp);
      }
      return $data;
    }
    else
    {
      return false;
    }

  }
  private function Get_Course_Info($course_id)
  {
    $sql = "SELECT `course_id`,`course_name_en`,`course_name_th`,`credit`,`hr_lec`,`hr_lab`,`hr_self`
    FROM `course` WHERE `course_id` ='".$course_id."'";
    $result = $this->DB->Query($sql);
    if($result)
    {
      $return = $result[0];
      return $return;
    }
    else
    {
      return false;
    }

  }
  public function Close_connection()
  {
    $this->DB->Close_connection();
  }

}
 ?>
