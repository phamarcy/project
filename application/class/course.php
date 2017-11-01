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
  private $SEMESTER;
  private $DEADLINE;
  private $PERSON;

  function __construct()
  {
    global $FILE_PATH,$DATABASE;
    $this->FILE_PATH = $FILE_PATH;
    $this->LOG = new Log();
    $this->DB = new Database();
    $this->DEFAULT_DB = $DATABASE['NAME'];
    $this->DEADLINE = new Deadline();
    $this->PERSON = new Person();
    $this->SEMESTER  = $this->DEADLINE->Get_Current_Semester();
  }

  public function Add_Course($data)
  {
      $sql = "INSERT INTO `course`( `course_id`, `course_name_en`, `course_name_th`, `credit`, `hr_lec`, `hr_lab`, `hr_self`)
      VALUES ('".$data["COURSE_ID"]."','".$data["NAMEENG"]."','".$data["NAMETH"]."','".$data["CREDIT"]["TOTAL"]."','".$data["CREDIT"]["LEC"]."','".$data["CREDIT"]["LAB"]."','".$data["CREDIT"]["SELF"]."')";
      $sql .= "  ON DUPLICATE KEY UPDATE `course_name_en`= '".$data["NAMEENG"]."',course_name_th = '".$data["NAMETH"]."',`credit` = '".$data["CREDIT"]["TOTAL"]."',`hr_lec` = '".$data["CREDIT"]["LEC"]."'
        ,`hr_lab` = '".$data["CREDIT"]["LAB"]."' , `hr_self` = '".$data["CREDIT"]["SELF"]."'";
      $result = $this->DB->Insert_Update_Delete($sql);
      if($result)
      {
        $return['status'] = 'success';
        $return['msg'] = 'บันทึกข้อมูลสำเร็จ';
      }
      else
      {
        $return['status'] = 'error';
        $return['msg'] = 'ไม่สามารถบันทึกข้อมูล กรุณาติดต่อผู้ดูแลระบบ';
      }
    return $return;
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

//get all course in department
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
        $staff = $this->Get_Responsible_Teacher($course['id'],$semester_id);
        $course['teacher'] = $staff['teacher'];
        $course['assessor'] = $staff['assessor'];
        array_push($DATA,$course);
      }
      return $DATA;
    }
    else if ($result == null)
    {
      return null;
    }
    else
    {
      $return['status'] = 'error';
      $return['msg'] = 'ไม่สามารถค้นหาข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ';
      return $return;
    }

  }

  public function Search_Course_Dept($course_id,$semester_id)
  {
    $sql = "SELECT `department_id` FROM `department_course_responsible` WHERE `course_id` = '".$course_id."' AND `semester_id` = ".$semester_id;
    $result = $this->DB->Query($sql);
    if($result)
    {
      $sql = "SELECT `name` FROM `department` WHERE `code` = '".$result[0]['department_id']."'";
      $this->DB->Change_DB('person');
      $result = $this->DB->Query($sql);
      $this->DB->Change_DB($this->DEFAULT_DB);
      if($result)
      {
        $dept_name = $result[0]['name'];
        return $dept_name;
      }
      else
      {
        return '-';
      }
    }
    else
    {
      return '-';
    }
  }

  public function Get_History($department_id)
  {
    $DATA = array();
    $curr_semester = $this->DEADLINE->Get_Current_Semester();
    for($i=1;$i<=3;$i++)
    {
      $history = $this->DEADLINE->Search_Semester_id($curr_semester['semester'],$curr_semester['year'] - $i );
      if($history != false)
      {
        $data['id'] = $history;
        $data['semester'] = $curr_semester['semester'];
        $data['year'] = $curr_semester['year'] - $i;
        if($this->Get_Dept_Course($department_id,$data['id']) != null)
        {
          array_push($DATA,$data);
        }
      }
    }
    return $DATA;
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
        $result = $this->Remove_Responsible_Assessor($course_id,$semester_id);
        if($result)
        {
          $result = $this->Remove_Responsible_Teacher('all',$course_id,$semester_id);
          if($result)
          {
            $return['status'] = 'success';
            $return['msg'] = 'ลบกระบวนวิชาสำเร็จ';
          }
          else
          {
            $return = $result;
          }
        }
        else
        {
          $return = $result;
        }
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

  public function Get_Responsible_Teacher($course_id,$semester_id)
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
        $group_num = substr($group_num,1);
        $DATA['assessor'] = $group_num;
      }
      else
      {
        $DATA['assessor'] = null;
      }
    }
    return $DATA;
  }

  public function Add_Responsible_Teacher($course_id,$teacher_name,$semester_id)
  {
    $teacher_id = $this->PERSON->Get_Teacher_Id($teacher_name);
    if($teacher_id != false)
    {
      $sql = "INSERT INTO `course_responsible`(`course_id`, `teacher_id`, `semester_id`)
      VALUES ('".$course_id."','".$teacher_id."',".$semester_id.") ON DUPLICATE KEY
      UPDATE `teacher_id` = '".$teacher_id."', `semester_id` = ".$semester_id;
      $result = $this->DB->Insert_Update_Delete($sql);
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
    else
    {
      $return['status'] = 'error';
      $return['msg'] = 'ไม่พบข้อมูลอาจารย์ท่านนี้ในฐานข้อมูล กรุณาติดต่อผู้ดูแลระบบ';
      return $return;
    }
  }

  public function Remove_Responsible_Teacher($teacher_name,$course_id,$semester_id)
  {
    if($teacher_name != 'all')
    {
      $teacher_id = $this->PERSON->Get_Teacher_Id($teacher_name);
      $sql = "SELECT * FROM course_responsible
      WHERE `course_id` = '".$course_id."' AND `teacher_id` = '".$teacher_id."' AND `semester_id` = ".$semester_id;
      $result = $this->DB->Query($sql);
    }
    else
    {
      $result = '1';
    }
    if($result != null)
    {
      $sql = "DELETE FROM `course_responsible` ";
      if($teacher_name != 'all')
      {
        $sql .= "  WHERE `course_id` = '".$course_id."' AND `teacher_id` = '".$teacher_id."' AND `semester_id` = ".$semester_id;
      }
      else
      {
          $sql .= "  WHERE `course_id` = '".$course_id."' AND `semester_id` = ".$semester_id;
      }

      $result = $this->DB->Insert_Update_Delete($sql);
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
    return $return;
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
    $result = $this->DB->Insert_Update_Delete($sql);
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
    $sql = "SELECT `assessor_group_num` FROM `subject_assessor`
    WHERE `course_id` = '".$course_id."' AND `semester_id` = ".$semester_id;
    $result = $this->DB->Query($sql);
    if($result != null)
    {
      $sql = "DELETE FROM `subject_assessor`
      WHERE `course_id` = '".$course_id."' AND `semester_id` = ".$semester_id;
      $result_delete_subject_assessor = $this->DB->Insert_Update_Delete($sql);
      if($result_delete_subject_assessor)
      {
        $sql = "SELECT `teacher_id` FROM `group_assessor` WHERE `group_num` = '".$result[0]['assessor_group_num']."'";
        $result_teacher_id = $this->DB->Query($sql);
        if($result_teacher_id)
        {
          $count = count($result_teacher_id);
          for($i=0;$i<$count;$i++)
          {
            $sql = "DELETE FROM `approval_course` WHERE `teacher_id` = '".$result_teacher_id[$i]['teacher_id']."'
            AND `course_id` = '".$course_id."' AND `semester_id` = '".$semester_id."'";
            $result_delete = $this->DB->Insert_Update_Delete($sql);
            if(!$result_delete)
            {
              $this->LOG->Write("Error sql :".$sql);
            }
          }
        }
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

// search course evaluate, special instructor data
  public function Search_Document($type,$course_id,$teacher_id)
  {
    if($type =='special')
    {
      $sql = "SELECT DISTINCT si.`instructor_id`,`firstname`,`lastname`,s.`semester_num`,s.`year` FROM `special_instructor` si,`course_hire_special_instructor` ci, `semester` s
      WHERE ci.`course_id` = '".$course_id."' AND ci.`instructor_id` = si.`instructor_id` AND ci.`semester_id` = s.`semester_id` ORDER BY `ci`.`updated_date` DESC" ;
    }
    else if ($type == 'evaluate')
    {
      $sql = "SELECT `semester_num`,`year` FROM `evaluate` e,`semester` s
      WHERE e.`course_id` = '".$course_id."' AND e.`semester_id` = s.`semester_id`" ;
    }
    $data = array();
    if($teacher_id != null)
    {
      $check_access = $this->Check_Access($teacher_id,$course_id);
    }
    else
    {
      $check_access = null;
    }
    $result = $this->DB->Query($sql);
    if($result)
    {
      for($i=0;$i<count($result);$i++)
      {
        if($type == 'special')
        {
          $data['DATA'][$i]['id'] = $result[$i]['instructor_id'];
          $data['DATA'][$i]['name'] = $result[$i]['firstname'].' '.$result[$i]['lastname'];
        }
          $data['DATA'][$i]['semester'] = $result[$i]['semester_num'];
          $data['DATA'][$i]['year'] = $result[$i]['year'];
      }
    }
    else
    {
      $data['DATA'] = false;
    }
    $data['ACCESS'] = $check_access;
    $data['INFO'] = $this->Get_Course_Info($course_id);
    //id,name,semester,year
      return $data;
  }



  // get course evaluate, special instructor data
  public function Get_Document($type,$course_id,$instructor_id,$teacher_id,$semester,$year)
  {
    $semester_id = $this->DEADLINE->Search_Semester_id($semester,$year);
    //check responsible
    if($teacher_id != null)
    {
      $check_access = $this->Check_Access($teacher_id,$course_id);
    }
    else
    {
      $check_access = null;
    }
    if($type == 'evaluate')
    {
      $sql = "SELECT * FROM `evaluate` WHERE `course_id` =  '".$course_id."' AND `semester_id` = ".$semester_id;
    }
    else if($type == 'special')
    {
      $lecture_detail = array();
      $sql = "SELECT st.* FROM `special_lecture_teach` st, `course_hire_special_instructor` ci ";
      $sql .= "WHERE ci.`instructor_id` = ".$instructor_id." AND ci.`course_id` = '".$course_id."' AND st.`hire_id` = ci.`hire_id` AND ci.`semester_id` = ".$semester_id;
      $result = $this->DB->Query($sql);
      if($result)
      {
        $numtable = count($result);
        for ($i=0; $i < count($result); $i++)
        {
          $lecture_detail[$i] = $result[$i];
        }
      }
      else
      {
        $numtable = 0;
        $data['lecture_detail'] = null;
      }
      $sql = "SELECT si.`instructor_id`,si.`prefix`,si.`firstname`,si.`lastname`,si.`position`,si.`qualification`,si.`work_place`,si.`phone`,si.`phone_sub`,si.`phone_mobile`,si.`email`,si.`invited`,ei.`level_teacher`,ei.`level_descript`,ei.`expense_lec_choice`,ei.`expense_lec_number`,ei.`expense_lec_hour`,ei.`expense_lec_cost`,ei.`expense_plane_check`,ei.`expense_plane_depart`,ei.`expense_plane_arrive`,ei.`expense_plane_cost`,ei.`expense_taxi_check`,ei.`expense_taxi_depart`,ei.`expense_taxi_arrive`,ei.`expense_taxi_cost`,ei.`expense_car_check`,ei.`expense_car_distance`,ei.`expense_car_unit`,ei.`expense_car_cost`,ei.`expense_hotel_choice`,ei.`expense_hotel_per_night`,ei.`expense_hotel_number`,ei.`expense_hotel_cost`,ei.`cost_total`, ci.*";
      $sql .= " FROM `special_instructor` si,`expense_special_instructor` ei, `course_hire_special_instructor` ci  ";
      $sql .= "WHERE ci.`instructor_id` = ".$instructor_id." AND ci.`course_id` = '".$course_id."' AND ci.`instructor_id` = si.`instructor_id` AND ci.`expense_id` = ei.`expense_id` AND ci.`semester_id` = ".$semester_id;
    }
    else
    {
      die("รูปแบบข้อมูลผิดพลาด กรุณาติดต่อผู้ดูแลระบบ");
    }

    $result = $this->DB->Query($sql);
    if($result)
    {
      $data = $result[0];
      $data['num_table'] = $numtable;
      if($type == 'special')
      {
        $data['lecture_detail'] = $lecture_detail;
      }
      $data['ACCESS'] = $check_access;
    }
    else
    {
      $data = false;
    }
    return $data;
  }

  public function Get_Course_Syllabus($course_id)
  {
    $syllabus_file = $this->FILE_PATH."/syllabus/".$course_id."_".$this->SEMESTER['semester']."_".$this->SEMESTER['year'].".doc";
    if (file_exists(realpath($syllabus_file)))
    {
        $path = "/syllabus/".$course_id."_".$this->SEMESTER['semester']."_".$this->SEMESTER['year'].".doc";
    }
    else
    {
      $syllabus_file = $this->FILE_PATH."/syllabus/".$course_id."_".$this->SEMESTER['semester']."_".$this->SEMESTER['year'].".docx";
      if (file_exists(realpath($syllabus_file)))
      {

          $path = "/syllabus/".$course_id."_".$this->SEMESTER['semester']."_".$this->SEMESTER['year'].".docx";
      }
      else
      {
        $path = null;
      }
    }
    return $path;
  }

  private function Check_Access($teacher_id,$course_id)
  {
    $sql = "SELECT `respon_id` FROM `course_responsible`
    WHERE `course_id` = '".$course_id."' AND `teacher_id` = '".$teacher_id."' AND `semester_id` = ".$this->SEMESTER['id'];
    $result = $this->DB->Query($sql);
    if($result != null)
    {
      return true;
    }
    else
    {
      return false;
    }
  }

  public function Get_Grade($teacher_id)
  {
    $sql = "SELECT c.`course_id`,`course_name_en` as name FROM `course_responsible` cr,`course` c
    WHERE cr.`teacher_id` = '".$teacher_id."' AND c.`course_id` = cr.`course_id` AND cr.`semester_id` = ".$this->SEMESTER['id'];
    $result = $this->DB->Query($sql);
    if($result)
    {
      $data = array();
      for($i=0;$i<count($result);$i++)
      {
        $temp['course_id'] = $result[$i]['course_id'];
        $temp['course_name'] = $result[$i]['name'];
        $grade_file = $this->FILE_PATH."/grade/".$temp['course_id']."_grade_".$this->SEMESTER['semester']."_".$this->SEMESTER['year'].".xls";
        if (file_exists(realpath($grade_file)))
        {
            $temp['status'] = 1;
            $temp['url'] = "/grade/".$temp['course_id']."_grade_".$this->SEMESTER['semester']."_".$this->SEMESTER['year'].".xls";
        }
        else
        {
          $grade_file = $this->FILE_PATH."/grade/".$temp['course_id']."_grade_".$this->SEMESTER['semester']."_".$this->SEMESTER['year'].".xlsx";
          if (file_exists(realpath($grade_file)))
          {
              $temp['status'] = 1;
              $temp['url'] = "/grade/".$temp['course_id']."_grade_".$this->SEMESTER['semester']."_".$this->SEMESTER['year'].".xlsx";
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
  public function Get_Course_Info($course_id)
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

  public function Remove_Course($course_id)
  {
    $sql = "DELETE FROM `course` WHERE `course_id` = '".$course_id."'";
    $result = $this->DB->Insert_Update_Delete($sql);
    if(!$result)
    {
      $this->LOG->Write("Error sql :".$sql);
      $return['status'] = 'error';
      $return['msg'] = 'ไม่สามารถลบข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ';
    }
    else
    {
      $return['status'] = 'success';
      $return['msg'] = 'ลบข้อมูลสำเร็จ';
    }
    return $return;
  }
  public function Close_connection()
  {
    $this->DB->Close_connection();
  }

}
 ?>
