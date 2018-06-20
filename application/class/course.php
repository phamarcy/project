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
  private $PERSON_DB;
  private $DEFAULT_DB;


  function __construct()
  {
    global $FILE_PATH,$DATABASE,$PERSON_DATABASE;
    $this->FILE_PATH = $FILE_PATH;
    $this->LOG = new Log();
    $this->DB = new Database();
    $this->DEFAULT_DB = $DATABASE['NAME'];
    $this->PERSON_DB = $PERSON_DATABASE['NAME'];
    $this->DEADLINE = new Deadline();
    $this->PERSON = new Person();
    $this->SEMESTER  = $this->DEADLINE->Get_Current_Semester();
  }

  public function Add_Course($data)
  {
      $sql = "INSERT INTO `course`( `course_id`, `course_name_en`, `course_name_th`, `credit`,`department_id`)
        VALUES ('".$data["COURSE_ID"]."','".$data["NAMEENG"]."','".$data["NAMETH"]."','".$data["CREDIT"]."',".($data['DEPARTMENT'] == '0' ? "''" : "'".$data['DEPARTMENT']."'")." )";
      $sql .= "  ON DUPLICATE KEY UPDATE `course_name_en`= '".$data["NAMEENG"]."',course_name_th = '".$data["NAMETH"]."',`credit` = '".$data["CREDIT"]."',`department_id` = ".($data['DEPARTMENT'] == '0' ? "''" : "'".$data['DEPARTMENT']."'");
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
  public function Get_Course_Name_th($course_id)
  {

    $sql="SELECT `course_name_th` FROM `course` WHERE `course_id` ='".$course_id."'";

    $result = $this->DB->Query($sql);
    if($result)
    {
      $course_name = $result[0]['course_name_th'];
      return $course_name;
    }
    else
    {
      return '-';
    }
    //search teacher data
  }
//get all course in department
  public function Get_All_Course($dept_id)
  {
    $sql = "SELECT `course_id`as id,`course_name_en` as name_en,`course_name_th`as name_th,`credit` FROM `course`";
    if($dept_id != 'all')
    {
      $sql .=" WHERE `department_id` = '".$dept_id."'";
    }
    $sql.=" ORDER BY `course_id` ASC";
    $result = $this->DB->Query($sql);
    if($result)
    {
      $data = array();
      for($i=0;$i<count($result);$i++)
      {
        $course['id'] = $result[$i]['id'];
        $course['name']['en'] = $result[$i]['name_en'];
        $course['name']['th'] = $result[$i]['name_th'];
        $course['credit'] = $result[$i]['credit'];
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
    $sql = "SELECT DISTINCT c.`course_id`,c.`course_name_en`,c.`course_name_th`,c.`credit` FROM `department_course_responsible` dc, `course` c
    WHERE c.`course_id` = dc.`course_id` AND dc.`department_id` = '".$department_id."'";
    if($semester_id != 'all')
    {
      $sql .= " AND dc.`semester_id` = ".$semester_id;
    }
    $sql .= " ORDER BY c.`course_id` ASC";
    $result = $this->DB->Query($sql);

    if($result)
    {
      for($i=0;$i<count($result);$i++)
      {
        $course['id'] = $result[$i]['course_id'];
        $course['name'] = $result[$i]['course_name_en'];
        $course['name_th'] = $result[$i]['course_name_th'];
        $course['credit'] = $result[$i]['credit'];
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
  public function Get_Dept_All()
  {
    $sql = "SELECT `code`,`name` FROM `department`";
    $this->DB->Change_DB($this->PERSON_DB);
    $result = $this->DB->Query($sql);
    $this->DB->Change_DB($this->DEFAULT_DB);
    $dept = array();
    if($result)
    {
      for($i = 0;$i<count($result);$i++)
      {
        $dept[$i]['code'] = $result[$i]['code'];
        $dept[$i]['name'] = $result[$i]['name'];
      }
    }
    else
    {
      $dept = false;
    }
    return $dept;
  }
  public function Search_Course_Dept($course_id,$semester_id)
  {
    $sql = "SELECT `department_id` FROM `department_course_responsible` WHERE `course_id` = '".$course_id."' AND `semester_id` = ".$semester_id;
    $result = $this->DB->Query($sql);
    if($result)
    {
      $sql = "SELECT `code`,`name` FROM `department` WHERE `code` = '".$result[0]['department_id']."'";
      $this->DB->Change_DB($this->PERSON_DB);
      $result = $this->DB->Query($sql);
      $this->DB->Change_DB($this->DEFAULT_DB);
      if($result)
      {
        $dept['id'] = $result[0]['code'];
        $dept['name'] = $result[0]['name'];
        return $dept;
      }
      else
      {
        return false;
      }
    }
    else
    {
      return false;
    }
  }

  public function Get_History($department_id)
  {
    $DATA = array();
    $curr_semester = $this->DEADLINE->Get_Current_Semester();
    if($curr_semester != false)
    {
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
      $name = $this->PERSON->Get_Teacher_Name($teacher_id,'TH');
      if($name)
      {
        $DATA['id'] = $teacher_id;
        $DATA['teacher'] = $name;
      }
      else
      {
        $DATA['id'] = null;
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
    if($teacher_id != null)
    {
      $check_access = $this->Check_Access($teacher_id,$course_id);
    }
    else
    {
      $check_access = null;
    }
    if($type =='special')
    {
      $check_access = true;
      $sql = "SELECT DISTINCT si.`instructor_id`,`firstname`,`lastname`,s.`semester_num`,s.`year` FROM `special_instructor` si,`course_hire_special_instructor` ci, `semester` s
      WHERE ci.`course_id` = '".$course_id."' AND ci.`instructor_id` = si.`instructor_id` AND ci.`semester_id` = s.`semester_id` ORDER BY `ci`.`updated_date` DESC" ;
    }
    else if ($type == 'evaluate')
    {
      $sql = "SELECT `semester_num`,`year` FROM `course_evaluate` e,`semester` s
      WHERE e.`course_id` = '".$course_id."' AND e.`semester_id` = s.`semester_id` ORDER BY e.`updated_date` DESC" ;
    }
    $data = array();
    
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
    $dept = $this->Search_Course_Dept($course_id,$this->SEMESTER['id']);
    if($dept)
    {
      $data['INFO']['department'] = $dept['id'];

    }
    $sql = "SELECT sum(se.`student`) as num_student FROM `course_evaluate` ce, `student_evaluate` se ";
    $sql .= "WHERE ce.`course_evaluate_id` = se.`course_evaluate_id` AND ce.`course_id` = '".$course_id."' AND ce.`semester_id` = '".$this->SEMESTER['id']."'";
    $result = $this->DB->Query($sql);
    if($result)
    {

      if(is_null($result[0]['num_student']))
      {
          $data['INFO']['num_student'] = '0';
      }
      else
      {
          $data['INFO']['num_student'] = $result[0]['num_student'];
      }
    }
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
      $sql = "SELECT ce.`course_evaluate_id`,ce.`exam_evaluate_id`,ce.`num_section`,ce.`credit_total`,ce.`course_id`,ce.`noorspe`,ce.`type`,ce.`type_other`,ce.`teacher_co`,ce.`absent`,ce.`syllabus`,ce.`submit_user_id`,ce.`submit_date`,cg.*,me.*,ee.* ";
      $sql .=" FROM `course_evaluate` ce, `criterion_grade` cg, `measure_evaluate` me, `exam_evaluate` ee ";
      $sql .=" WHERE ce.`criterion_grade_id` = cg.`criterion_grade_id` AND ce.`measure_evaluate_id` = me.`measure_evaluate_id` AND ce.`exam_evaluate_id` = ee.`exam_evaluate_id` AND ce.`course_id` = '".$course_id."' AND `semester_id` = '".$semester_id."'";
      $result = $this->DB->Query($sql);
      if($result)
      {
        $data = $result[0];
        if($data['syllabus'] == null)
        {
          $data['syllabus'] = false;
        }
      }
      else
      {
        $data = false;
      }
      $data['student'] = array();
      if(isset($data['course_evaluate_id']))
      {
        $sql = "SELECT `section`,`student` FROM `student_evaluate` WHERE `course_evaluate_id` = ".$data['course_evaluate_id'];
        $result = $this->DB->Query($sql);
        if($result)
        {
          for($i=0;$i<count($result);$i++)
          {
            $data['student'][$result[$i]['section'] -1] = $result[$i]['student'];
          }
        }
      }

      $data['exam_mid1_committee_lec'] = array();
      $sql = "SELECT `teacher_id`,`name_type` FROM `exam_commitee` WHERE `exam_evaluate_id` = '".$data['exam_evaluate_id']."' AND `type` = 'MID1' AND `type_commitee` = 'LEC' ORDER BY `updated_date` ASC";
      $result = $this->DB->Query($sql);
      if($result)
      {
        for($i=0;$i<count($result);$i++)
        {
          $teacher_name = $this->PERSON->Get_Teacher_Name($result[$i]['teacher_id'],$result[$i]['name_type']);
          if($teacher_name != false)
          {
            $temp = explode(" ",$teacher_name);
            $teacher_name = '';
            for($j=1;$j<count($temp);$j++)
            {
              $teacher_name .= $temp[$j]." ";
            }
            $teacher_name = trim($teacher_name," ");
          }
          array_push($data['exam_mid1_committee_lec'],$teacher_name);
        }
      }

      $data['exam_mid1_committee_lab'] = array();
      $sql = "SELECT `teacher_id`,`name_type` FROM `exam_commitee` WHERE `exam_evaluate_id` = '".$data['exam_evaluate_id']."' AND `type` = 'MID1' AND `type_commitee` = 'LAB' ORDER BY `updated_date` ASC";
      $result = $this->DB->Query($sql);
      if($result)
      {
        for($i=0;$i<count($result);$i++)
        {
          $teacher_name = $this->PERSON->Get_Teacher_Name($result[$i]['teacher_id'],$result[$i]['name_type']);
          if($teacher_name != false)
          {
            $temp = explode(" ",$teacher_name);
            $teacher_name = '';
            for($j=1;$j<count($temp);$j++)
            {
              $teacher_name .= $temp[$j]." ";
            }
            $teacher_name = trim($teacher_name," ");
          }
          array_push($data['exam_mid1_committee_lab'],$teacher_name);
        }
      }

      $data['exam_mid2_committee_lec'] = array();
      $sql = "SELECT `teacher_id`,`name_type` FROM `exam_commitee` WHERE `exam_evaluate_id` = '".$data['exam_evaluate_id']."' AND `type` = 'MID2' AND `type_commitee` = 'LEC' ORDER BY `updated_date` ASC";
      $result = $this->DB->Query($sql);
      if($result)
      {
        for($i=0;$i<count($result);$i++)
        {
          $teacher_name = $this->PERSON->Get_Teacher_Name($result[$i]['teacher_id'],$result[$i]['name_type']);
          if($teacher_name != false)
          {
            $temp = explode(" ",$teacher_name);
            $teacher_name = '';
            for($j=1;$j<count($temp);$j++)
            {
              $teacher_name .= $temp[$j]." ";
            }
            $teacher_name = trim($teacher_name," ");
          }
          array_push($data['exam_mid2_committee_lec'],$teacher_name);
        }
      }

      $data['exam_mid2_committee_lab'] = array();
      $sql = "SELECT `teacher_id`,`name_type` FROM `exam_commitee` WHERE `exam_evaluate_id` = '".$data['exam_evaluate_id']."' AND `type` = 'MID2' AND `type_commitee` = 'LAB' ORDER BY `updated_date` ASC";
      $result = $this->DB->Query($sql);
      if($result)
      {
        for($i=0;$i<count($result);$i++)
        {
          $teacher_name = $this->PERSON->Get_Teacher_Name($result[$i]['teacher_id'],$result[$i]['name_type']);
          if($teacher_name != false)
          {
            $temp = explode(" ",$teacher_name);
            $teacher_name = '';
            for($j=1;$j<count($temp);$j++)
            {
              $teacher_name .= $temp[$j]." ";
            }
            $teacher_name = trim($teacher_name," ");
          }
          array_push($data['exam_mid2_committee_lab'],$teacher_name);
        }
      }

      $data['exam_final_committee_lec'] = array();
      $sql = "SELECT `teacher_id`,`name_type` FROM `exam_commitee` WHERE `exam_evaluate_id` = '".$data['exam_evaluate_id']."' AND `type` = 'FINAL' AND `type_commitee` = 'LEC' ORDER BY `updated_date` ASC";
      $result = $this->DB->Query($sql);
      if($result)
      {
        for($i=0;$i<count($result);$i++)
        {
          $teacher_name = $this->PERSON->Get_Teacher_Name($result[$i]['teacher_id'],$result[$i]['name_type']);
          if($teacher_name != false)
          {
            $temp = explode(" ",$teacher_name);
            $teacher_name = '';
            for($j=1;$j<count($temp);$j++)
            {
              $teacher_name .= $temp[$j]." ";
            }
            $teacher_name = trim($teacher_name," ");
          }
          array_push($data['exam_final_committee_lec'],$teacher_name);
        }
      }

        $data['exam_final_committee_lab'] = array();
      $sql = "SELECT `teacher_id`,`name_type` FROM `exam_commitee` WHERE `exam_evaluate_id` = '".$data['exam_evaluate_id']."' AND `type` = 'FINAL' AND `type_commitee` = 'LAB' ORDER BY `updated_date` ASC";
      $result = $this->DB->Query($sql);
      if($result)
      {
        for($i=0;$i<count($result);$i++)
        {
          $teacher_name = $this->PERSON->Get_Teacher_Name($result[$i]['teacher_id'],$result[$i]['name_type']);
          if($teacher_name != false)
          {
            $temp = explode(" ",$teacher_name);
            $teacher_name = '';
            for($j=1;$j<count($temp);$j++)
            {
              $teacher_name .= $temp[$j]." ";
            }
            $teacher_name = trim($teacher_name," ");
          }
          array_push($data['exam_final_committee_lab'],$teacher_name);
        }
      }
      $data['teacher'] = array();
      $sql = "SELECT `teacher_id`,`name_type` FROM `teacher_exam_evaluate` WHERE `course_eveluate_id` = ".$data['course_evaluate_id']." ORDER BY `updated_date` ASC";
      $result = $this->DB->Query($sql);
      if($result)
      {
        for($i=0;$i<count($result);$i++)
        {
          $teacher_name = $this->PERSON->Get_Teacher_Name($result[$i]['teacher_id'],$result[$i]['name_type']);
          if($teacher_name != false)
          {
            $temp = explode(" ",$teacher_name);
            $teacher_name = '';
            for($j=1;$j<count($temp);$j++)
            {
              $teacher_name .= $temp[$j]." ";
            }
            $teacher_name = trim($teacher_name," ");
          }
          array_push($data['teacher'],$teacher_name);
        }
      }
    }
    else if($type == 'special')
    {
      $check_access = true;
      $lecture_detail = array();
      $sql = "SELECT st.`topic_name`,st.`teaching_date`,st.`teaching_time_start`,st.`teaching_time_end`,st.`teaching_room` FROM `special_lecture_teach` st, `course_hire_special_instructor` ci ";
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
      $sql = "SELECT si.`instructor_id`,si.`prefix`,si.`firstname`,si.`lastname`,si.`position`,si.`qualification`,si.`work_place`,si.`phone`,si.`phone_sub`,si.`phone_mobile`,si.`cv`,si.`email`,si.`invited`,ei.`level_teacher`,ei.`level_descript`,ei.`payment_method`,ei.`expense_lec_checked`,ei.`expense_lec_number`,ei.`expense_lec_hour`,ei.`expense_lec_cost`,ei.`expense_lab_checked`,ei.`expense_lab_number`,ei.`expense_lab_hour`,ei.`expense_lab_cost`,ei.`expense_plane_check`,ei.`expense_plane_depart`,ei.`expense_plane_arrive`,ei.`expense_plane_cost`,ei.`expense_taxi_check`,ei.`expense_taxi_depart`,ei.`expense_taxi_arrive`,ei.`expense_taxi_cost`,ei.`expense_car_check`,ei.`expense_car_distance`,ei.`expense_car_unit`,ei.`expense_car_cost`,ei.`expense_hotel_choice`,ei.`expense_hotel_per_night`,ei.`expense_hotel_number`,ei.`expense_hotel_cost`,ei.`cost_total`, ci.*";
      $sql .= " FROM `special_instructor` si,`expense_special_instructor` ei, `course_hire_special_instructor` ci  ";
      $sql .= "WHERE ci.`instructor_id` = ".$instructor_id." AND ci.`course_id` = '".$course_id."' AND ci.`instructor_id` = si.`instructor_id` AND ci.`expense_id` = ei.`expense_id` AND ci.`semester_id` = ".$semester_id;
      $result = $this->DB->Query($sql);
      if($result)
      {
        $data = $result[0];
        if($data['cv'] == null)
        {
          $data['cv'] = false;
        }
        $data['num_table'] = $numtable;
        $data['lecture_detail'] = $lecture_detail;
      }
      else
      {
        $data = false;
      }
    }
    else
    {
      die("รูปแบบข้อมูลผิดพลาด กรุณาติดต่อผู้ดูแลระบบ");
    }
    $data['ACCESS'] = $check_access;
    return $data;
  }

  public function Get_Course_Syllabus($course_id,$semester_id)
  {
    $syllabus_file = "/syllabus/";
    $sql = "SELECT `syllabus` FROM `course_evaluate` WHERE `course_id` = '".$course_id."' AND `semester_id` = ".$semester_id;
    $result = $this->DB->Query($sql);
    if($result)
    {
      $path =  $syllabus_file.$result[0]['syllabus'];
      return $path;
    }
    else
    {
      return false;
    }

  }

  private function Check_Access($teacher_id,$course_id)
  {
    if($_SESSION['level'] == '2')
    {
      return true;
    }
    else
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
  }

  public function Get_Grade($teacher_id,$semester_id)
  {
    if($_SESSION['level'] == '2')
    {
      $dept = $this->PERSON->Get_Staff_Dep($_SESSION['id']);
      if($dept)
      {
        $sql = "SELECT c.`course_id`,c.`course_name_en`as name FROM `department_course_responsible` dr , `course` c ";
        $sql .= " WHERE dr.`course_id` = c.`course_id` AND  dr.`department_id` = '".$dept['code']."' AND dr.`semester_id` = ".$semester_id;
        $sql .= " ORDER BY c.`course_id`";
      }
      else
      {
        $sql = '';
      }
    }
    else
    {
      $sql = "SELECT c.`course_id`,`course_name_en` as name FROM `course_responsible` cr,`course` c
      WHERE cr.`teacher_id` = '".$teacher_id."' AND c.`course_id` = cr.`course_id` AND cr.`semester_id` = ".$semester_id;
      $sql .= " ORDER BY c.`course_id`";
    }

    $result = $this->DB->Query($sql);
    if($result)
    {
      $grade_path = "/grade";
      $data = array();
      for($i=0;$i<count($result);$i++)
      {
        $temp['course_id'] = $result[$i]['course_id'];
        $temp['course_name'] = $result[$i]['name'];
        $sql = "SELECT `file_name` FROM `couse_grade` WHERE `course_id` = '".$temp['course_id']."' AND `semester_id` = ".$semester_id;
        $result_filename = $this->DB->Query($sql);
        if($result_filename)
        {
          $temp['url'] = $grade_path."/".$result_filename[0]['file_name'];
          $temp['status'] = 1;
        }
        else
        {
          $temp['status'] = 0;
          unset($temp['url']);
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
    $sql = "SELECT `course_id`,`course_name_en`,`course_name_th`,`credit`,`department_id`
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
      $return['status'] = 'error';
      $return['msg'] = 'ไม่สามารถลบข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ';
    }
    else
    {
      $sql = "DELETE FROM `department_course_responsible` WHERE `course_id` = '".$course_id."'";
      $result = $this->DB->Insert_Update_Delete($sql);
      if($result)
      {
        $sql = "DELETE FROM `approval_course` WHERE `course_id` = '".$course_id."'";
        $this->DB->Insert_Update_Delete($sql);
        $sql = "DELETE FROM `approval_special` WHERE `course_id` = '".$course_id."'";
        $this->DB->Insert_Update_Delete($sql);
        $sql = "DELETE FROM `comment_course` WHERE `course_id` = '".$course_id."'";
        $this->DB->Insert_Update_Delete($sql);
        $sql = "DELETE FROM `comment_special` WHERE `course_id` = '".$course_id."'";
        $this->DB->Insert_Update_Delete($sql);
        $sql = "DELETE FROM `course_evaluate` WHERE `course_id` = '".$course_id."'";
        $this->DB->Insert_Update_Delete($sql);
        $sql = "DELETE FROM `course_hire_special_instructor` WHERE `course_id` = '".$course_id."'";
        $this->DB->Insert_Update_Delete($sql);
        $sql = "DELETE FROM `couse_grade` WHERE `course_id` = '".$course_id."'";
        $this->DB->Insert_Update_Delete($sql);
        $sql = "DELETE FROM `subject_assessor` WHERE `course_id` = '".$course_id."'";
        $this->DB->Insert_Update_Delete($sql);
        $return['status'] = 'success';
        $return['msg'] = 'ลบข้อมูลสำเร็จ';
      }
      else
      {
        $return['status'] = 'error';
        $return['msg'] = 'ไม่สามารถลบข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ';
      }

    }
    return $return;
  }

  public function Get_Status_Text()
  {
    $status = array();
    $sql = "SELECT `status_code`,`status_name`,`icon`,`color` FROM `status`";
    $result = $this->DB->Query($sql);
    if($result)
    {
      for($i=0;$i<count($result);$i++)
      {
        $status = $result;
      }
    }
    else
    {
      $status = false;
    }
    return $status;
  }
  public function Close_connection()
  {
    $this->DB->Close_connection();
  }

}
 ?>
