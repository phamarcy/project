<?php
/**
* This class serves approval such as update,append,check status
*
* @author  Adiluck Chooprateep
* @since   4/10/2017
*/

require_once(__DIR__."/database.php");
require_once(__DIR__."/manage_deadline.php");
require_once(__DIR__.'/curl.php');
require_once(__DIR__."/course.php");
require_once(__DIR__."/person.php");
require_once(__DIR__."/report.php");
/**
 *
 */
class approval
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
  private $REPORT;

  function __construct($level)
  {
    $this->LOG = new Log();
    $deadline = new Deadline();
    $data = $deadline->Get_Current_Semester();
    $this->SEMESTER_ID = $data['id'];
    $this->SEMESTER = $data['semester'];
    $this->YEAR = $data['year'];
    $this->USER_LEVEL = $level;
    $this->CURL = new CURL();
    $this->COURSE = new Course();
    if (class_exists('Database'))
    {
    $this->DB = new Database();
    }
    $this->PERSON = new Person();
    $this->REPORT = new Report();
  }

  //update course evaluate status
  public function Update_Status_Evaluate($course_id,$status,$teacher_id,$comment)
  {
    if($teacher_id != 'all')
    {
      if($comment == null || $comment == '')
      {
        $comment = '-';
      }
      $sql = "INSERT INTO `comment_course`(`teacher_id`, `comment`, `semester_id`,`course_id`)
      VALUES ('".$teacher_id."','".$comment."','".$this->SEMESTER_ID."','".$course_id."')";
      $result = $this->DB->Insert_Update_Delete($sql);
      if(!$result)
      {
        $this->LOG->Write("Insert comment history error");
      }
    }
    $status_before = $this->Get_Doc_Status($course_id);
    if($this->USER_LEVEL < 6)
    {
      $level_approve = '1';
    }
    else
    {
      $level_approve = '2';
    }
    if($teacher_id == 'all') //update all status with course_id
    {
      $sql = "UPDATE `approval_course` SET `status`= '".$status."'";
      if((int)$status != 1)
      {
        if($comment != null)
        {
          $sql .= ",`comment`= '".$comment."'";
        }
      }
      else
      {
          $sql .= ",`comment`= null";
      }

      $sql .= " WHERE `course_id` = '".$course_id."'";
    }
    else //update specific teacher_id,course_id
    {
      $updated_date = date("Y-m-d H:i:s");
      $sql = "UPDATE `approval_course` SET `status`= '".$status."', `date` = '".$updated_date."'";
      if($comment != null)
      {
        $sql .= ",`comment`= '".$comment."'";
      }
      $sql .= " WHERE `course_id` = '".$course_id."' AND `teacher_id` = '".$teacher_id."'";
    }
    $sql .= " AND `semester_id` = ".$this->SEMESTER_ID;
    $result = $this->DB->Insert_Update_Delete($sql);
    if($result)
    {
      if((int)$status == 1)
      {
        $sql = " DELETE FROM `approval_course` WHERE `course_id` = '".$course_id."' AND `level_approve` = '2' AND `semester_id` = ".$this->SEMESTER_ID;
        $result_delete = $this->DB->Insert_Update_Delete($sql);
        if(!$result_delete)
        {
          return false;
        }
      }
      $status_after = $this->Get_Doc_Status($course_id);
      if($status_before != $status_after)
      {
        $noti['COURSE_ID'] = $course_id;
        $noti['STATUS'] = (string)$status_after;
        $noti['DATE_USER'] = date("d-m-Y");
        $noti['TIME_USER'] = date("h:i:sa");
        $noti['TYPE'] = '1'; //1 evaluate , 2, special instructor
        if($status_after != '1' && $status_after != '5')
        {
          $this->Sendemail($course_id,$noti);
        }
        $this->Send_Noti($course_id,json_encode($noti,JSON_UNESCAPED_UNICODE));
      }
      if((int)$status_after == 4)
      {
        $sql = "UPDATE `course_evaluate` SET `status`= '1' WHERE `course_id` = '".$course_id."' AND `semester_id` = ".$this->SEMESTER_ID;
        $result = $this->DB->Insert_Update_Delete($sql);
        if(!$result)
        {
          $this->LOG->Write("course approve error : cannot update course evaluate status ");
        }
        $pdf_complete = $this->Send_Complete_Evaluate($course_id,'3');
        $pdf_result = json_decode($pdf_complete,true);
        if($pdf_result != null)
        {
          return true;
        }
        else
        {
            $this->LOG->Write("Completing agree file error : ");
            return false;
        }
      }
      else if((int)$status_after == 7)
      {
        $pdf_complete = $this->Send_Complete_Evaluate($course_id,'4');
        $pdf_result = json_decode($pdf_complete,true);
        if($pdf_result != null)
        {
          return true;
        }
        else
        {
            $this->LOG->Write("Completing approve file error  ");
            return false;
        }
      }
      else
      {
        return true;
      }
    }
    else
    {
      return false;
    }

  }

  //update complete version of course evaluate to generate new pdf
  private function Send_Complete_Evaluate($course_id,$type)
  {
    $data['SUBMIT_TYPE'] = $type;
    $data['COURSE_ID'] = $course_id;
    $DATA['DATA'] = json_encode($data);
    $url = "application/pdf/generate_evaluate.php";
    $result = $this->CURL->Request($DATA,$url);
    return $result;
  }

  //update complete version of special instructor to generate new pdf
  private function Send_Complete_Special($course_id,$instructor_id,$type)
  {
    $data['SUBMIT_TYPE'] = $type;
    $data['COURSEDATA_COURSE_ID'] = $course_id;
    $data['TEACHERDATA_ID'] = $instructor_id;
    $DATA['DATA'] = json_encode($data);
    $url = "application/pdf/generate_special_instructor.php";
    $result = $this->CURL->Request($DATA,$url);
    return $result;
  }
//update special instructor status
  public function Update_Status_Special($instructor_id,$teacher_id,$course_id,$status,$comment)
  {
    if($comment != null && $comment != '' && $teacher_id != 'all')
    {
      $sql = "INSERT INTO `comment_special`(`teacher_id`, `instructor_id`, `comment`, `semester_id`, `course_id`)
      VALUES ('".$teacher_id."','".$instructor_id."','".$comment."','".$this->SEMESTER_ID."','".$course_id."')";
      $result = $this->DB->Insert_Update_Delete($sql);
      if(!$result)
      {
        $this->LOG->Write("Insert comment history error");
      }
    }
    $status_before = $this->Get_Instructor_Status($instructor_id,$course_id);
    if($this->USER_LEVEL < 6)
    {
      $level_approve = '1';
    }
    else
    {
      $level_approve = '2';
    }

    if($teacher_id == 'all') //update all status with course_id
    {
      $sql = "UPDATE `approval_special` SET `status`= '".$status."'";
      if((int)$status != 1)
      {
        if($comment != null)
        {
          $sql .= ",`comment`= '".$comment."'";
        }
      }
      else
      {
          $sql .= ",`comment`= null";
      }
      $sql .= " WHERE `course_id` = '".$course_id."' AND `instructor_id` = '".$instructor_id."'";

    }
    else //update specific teacher_id,course_id
    {
      $updated_date = date("Y-m-d H:i:s");
      $sql = "UPDATE `approval_special` SET `status`= '".$status."',`updated_date` = '".$updated_date."'";
      if($comment != null)
      {
        $sql .= ",`comment`= '".$comment."'";
      }
      $sql .= " WHERE `course_id` = '".$course_id."' AND `instructor_id` = '".$instructor_id."' AND `teacher_id` = '".$teacher_id."'";
    }
      $sql .= " AND `semester_id` = ".$this->SEMESTER_ID;
    $result = $this->DB->Insert_Update_Delete($sql);
    if($result)
    {
      if((int)$status == 1)
      {
        $sql = " DELETE FROM `approval_special`
         WHERE `course_id` = '".$course_id."' AND `instructor_id` = '".$instructor_id."'
         AND `level_approve` = '2' AND `semester_id` = ".$this->SEMESTER_ID;
        $result_delete = $this->DB->Insert_Update_Delete($sql);
        if(!$result_delete)
        {
          return false;
        }
      }
      $status_after = $this->Get_Instructor_Status($instructor_id,$course_id);
      if($status_before != $status_after)
      {
        $noti['COURSE_ID'] = $course_id;
        $noti['STATUS'] = (string)$status_after;
        $noti['NAME'] = $this->PERSON->Get_Special_Instructor_Name($instructor_id);
        $noti['DATE_USER'] = date("d-m-Y");
        $noti['TIME_USER'] = date("h:i:sa");
        $noti['TYPE'] = '2'; //1 evaluate , 2, special instructor
        if($status_after != '1' && $status_after != '5')
        {
          $this->Sendemail($course_id,$noti);
        }
        $this->Send_Noti($course_id,json_encode($noti,JSON_UNESCAPED_UNICODE));
      }
      if((int)$status_after == 4)
      {
        $sql = "UPDATE `course_hire_special_instructor` SET `status`= '1' WHERE `course_id` = '".$course_id."' AND `instructor_id` = ".$instructor_id." AND `semester_id` = ".$this->SEMESTER_ID;
        $result = $this->DB->Insert_Update_Delete($sql);
        if(!$result)
        {
          $this->LOG->Write("course hire error : cannot update special instructor status");
        }
        $pdf_complete = $this->Send_Complete_Special($course_id,$instructor_id,'3');
        $pdf_result = json_decode($pdf_complete,true);
        if($pdf_result != null)
        {
          return true;
        }
        else
        {
            $this->LOG->Write("Completing agree special instructor file error ");
            return false;
        }
      }
      else if((int)$status_after == 7)
      {
        $sql = "UPDATE `special_instructor` SET `invited` = '1' WHERE `instructor_id` = ".$instructor_id;
        $result = $this->DB->Insert_Update_Delete($sql);
        //starting generate pdf
        $pdf_complete = $this->Send_Complete_Special($course_id,$instructor_id,'4');
        $pdf_result = json_decode($pdf_complete,true);
        if($pdf_result != null)
        {
          return true;
        }
        else
        {
          $this->LOG->Write("Completing approval special instructor file error ");
            return false;
        }
      }
      else
      {
        return true;
      }
    }
    else
    {
      return false;
    }
  }

//add new approval status
  public function Append_Status_Evaluate($course_id)
  {
    $sql = " DELETE FROM `approval_course` WHERE `course_id` = '".$course_id."' AND `level_approve` = '2' AND `semester_id` = ".$this->SEMESTER_ID;
    $result_delete = $this->DB->Insert_Update_Delete($sql);
   //default status 0 = waiting for create
      $sql = "SELECT ga.`teacher_id` FROM `subject_assessor` sa, `group_assessor` ga
      WHERE sa.`course_id` = '".$course_id."' AND sa.`assessor_group_num` = ga.`group_num` AND `semester_id` = '".$this->SEMESTER_ID."'";
      $result = $this->DB->Query($sql);
      if($result)
      {
        for($i=0;$i<count($result);$i++)
        {
          $updated_date = date("Y-m-d H:i:s");
          $sql = "INSERT INTO `approval_course`(`teacher_id`,`course_id`,`level_approve`,`status`,`semester_id`,`date`)
          VALUES ('".$result[$i]['teacher_id']."','".$course_id."',1,'0',".$this->SEMESTER_ID.",'".$updated_date."')";
          $sql .= "ON DUPLICATE KEY UPDATE `comment` = NULL,`status` = '0',`date` = '".$updated_date."'";
          $approve_result = $this->DB->Insert_Update_Delete($sql);
          if($approve_result == false)
          {
            $return['status'] = 'error';
            $return['msg'] = 'ไม่สามารถเพิ่มข้อมูลได้';
            break;
          }
          else
          {
            $return['status'] = 'success';
            $return['msg'] = 'เพิ่มข้อมูลสำเร็จ';
          }

        }
      }
      else
      {
        $return['status'] = 'error';
        $return['msg'] = 'กรุณาเพิ่มรายชื่อในชุดคณะกรรมการก่อน';
      }

      return $return;

  }

// add new board's evaluate status
  public function Append_Board_Status_Evaluate($course_id,$status,$teacher_id,$comment)
  {
    if($comment != null && $comment != '' && $teacher_id != 'all')
    {
      $sql = "INSERT INTO `comment_course`(`teacher_id`, `comment`, `semester_id`,`course_id`)
      VALUES ('".$teacher_id."','".$comment."','".$this->SEMESTER_ID."','".$course_id."')";
      $sql .= "ON DUPLICATE KEY UPDATE `teacher_id` = '".$teacher_id."', `comment` = '".$comment."'";
      $result = $this->DB->Insert_Update_Delete($sql);
      if(!$result)
      {
        $this->LOG->Write("Insert comment history error");
      }
    }
    $updated_date = date("Y-m-d H:i:s");
    $level_approve = '2';
    $sql = "INSERT INTO `approval_course`(`teacher_id`, `course_id`, `status`,`level_approve`, `comment`,`semester_id`,`date`)
    VALUES ('".$teacher_id."','".$course_id."','".$status."','".$level_approve."','".$comment."','".$this->SEMESTER_ID."','".$updated_date."')";
    $sql .= " ON DUPLICATE KEY UPDATE `teacher_id` = '".$teacher_id."', `comment` = '".$comment."'";
    $result = $this->DB->Insert_Update_Delete($sql);
    if($result)
    {
      return true;
    }
    else
    {
      return false;
    }
  }

// add new board's evaluate special instructor status
  public function Append_Board_Status_Special($course_id,$instructor_id,$status,$teacher_id,$comment)
  {
    if($comment != null && $comment != '' && $teacher_id != 'all')
    {
      $sql = "INSERT INTO `comment_special`(`teacher_id`, `instructor_id`, `comment`, `semester_id`, `course_id`)
      VALUES ('".$teacher_id."','".$instructor_id."','".$comment."','".$this->SEMESTER_ID."','".$course_id."')";
      $result = $this->DB->Insert_Update_Delete($sql);
      if(!$result)
      {
        $this->LOG->Write("Insert comment history error");
      }
    }
    $updated_date = date("Y-m-d H:i:s");
    $level_approve = '2';
    $sql = "INSERT INTO `approval_special`(`instructor_id`,`teacher_id`, `course_id`, `status`,`level_approve`, `comment`,`semester_id`,`updated_date`)
    VALUES ('".$instructor_id."','".$teacher_id."','".$course_id."','".$status."','".$level_approve."','".$comment."','".$this->SEMESTER_ID."','".$updated_date."')
    ON DUPLICATE KEY UPDATE `status` = '".$status."'";
    $result = $this->DB->Insert_Update_Delete($sql);
    if($result)
    {
      return true;
    }
    else
    {
      return false;
    }
  }

//check status in home page
  public function Check_Status($user_id)
  {
    $DATA= array();
    if($this->USER_LEVEL == 1)
    {
      $sql = "SELECT `course_id` FROM `course_responsible`
      WHERE `teacher_id` = '".$user_id."' AND `semester_id` = '".$this->SEMESTER_ID."'";
    }
    else if ($this->USER_LEVEL == 2)
    {
      $dept_id = $this->PERSON->Get_Staff_Dep($user_id);
      $sql = "SELECT `course_id` FROM `department_course_responsible`
      WHERE `department_id` = '".$dept_id['code']."' AND `semester_id` = '".$this->SEMESTER_ID."'";
    }
    else if ($this->USER_LEVEL == 3)
    {
      $sql = "SELECT `course_id` FROM `department_course_responsible`
      WHERE  `semester_id` = '".$this->SEMESTER_ID."'";
    }
    else if ($this->USER_LEVEL == 4 || $this->USER_LEVEL == 5)
    {
      $sql = "SELECT DISTINCT `course_id` FROM `approval_course`
      WHERE `teacher_id` = '".$user_id."' AND `semester_id` = '".$this->SEMESTER_ID."'";
    }
    else if ($this->USER_LEVEL == 6)
    {
      $sql = "SELECT DISTINCT `course_id` FROM `approval_course`
      WHERE `semester_id` = '".$this->SEMESTER_ID."'";
    }
      $sql .= "ORDER BY `course_id";
      $result = $this->DB->Query($sql);
      if($result)
      {
        for($i=0;$i<count($result);$i++)
        {
            $course['id'] = $result[$i]['course_id'];
            $course['name'] = $this->COURSE->Get_Course_Name($course['id']);
            $pdf = $this->Get_Doc_Url($course['id'],'draft');
            $course['pdf'] = $pdf['evaluate'];
            $course['document'] = $pdf['document'];
            //search evaluate form
            $course['evaluate']['status'] = $this->Get_Doc_Status($course['id']);
            $course['evaluate']['edit'] = $this->Is_Edit('evaluate',$course['id'],null);
            $sql_course = "SELECT `teacher_id`,`comment`,`date` FROM `approval_course` WHERE `course_id` ='".$course['id']."'
            AND `semester_id` =".$this->SEMESTER_ID;
            $comment_temp = $this->DB->Query($sql_course);
            if($comment_temp)
            {
              $course['evaluate']['comment'] = array();
              for($j=0;$j<count($comment_temp);$j++)
              {
                $comment['name'] = $this->PERSON->Get_Teacher_Name($comment_temp[$j]['teacher_id'],'TH');
                $comment['comment'] = $comment_temp[$j]['comment'];
                $comment['date'] = $comment_temp[$j]['date'];
                array_push($course['evaluate']['comment'],$comment);
              }
            }
            //end search evaluate form
            //search special instructor form
            $course['special'] = $this->Get_Instructor_Data($course['id']);
            //end search special instructor
            array_push($DATA,$course);
        }
        return json_encode($DATA);
      }
      else if($result == null)
      {
        return null;
      }
      else
      {
        $error['error'] = "Error, Please Contact Admin";
        return json_encode($error);
      }


  }

  public function Reset_Data_Evaluate($course_id)
  {
    $status = $this->Get_Doc_Status($course_id);
    if((int)$status != 0)
    {
      $return['status'] = 'error';
      $return['msg'] = 'ข้อมูลถูกบันทึกเรียบร้อยแล้ว ไม่สามารถลบได้';
      return $return;
    }
    $sql = "SELECT `course_evaluate_id`,`criterion_grade_id`,`exam_evaluate_id`,`measure_evaluate_id`";
    $sql .= " FROM `course_evaluate` WHERE `course_id` = '".$course_id."' AND `semester_id` = ".$this->SEMESTER_ID;
    $result = $this->DB->Query($sql);
    if($result)
    {
      $sql = "DELETE FROM `teacher_exam_evaluate` WHERE `course_eveluate_id` = ".$result[0]['course_evaluate_id'];
      $this->DB->Insert_Update_Delete($sql);
      $sql = "DELETE FROM `student_evaluate` WHERE `course_evaluate_id` = ".$result[0]['course_evaluate_id'];
      $this->DB->Insert_Update_Delete($sql);
      $sql = "DELETE FROM `criterion_grade` WHERE `criterion_grade_id` = ".$result[0]['criterion_grade_id'];
      $this->DB->Insert_Update_Delete($sql);
      $sql = "DELETE FROM `exam_evaluate` WHERE `exam_evaluate_id` = ".$result[0]['exam_evaluate_id'];
      $this->DB->Insert_Update_Delete($sql);
      $sql = "DELETE FROM `exam_commitee` WHERE `exam_evaluate_id` = ".$result[0]['exam_evaluate_id'];
      $this->DB->Insert_Update_Delete($sql);
      $sql = "DELETE FROM `measure_evaluate` WHERE `measure_evaluate_id` = ".$result[0]['measure_evaluate_id'];
      $this->DB->Insert_Update_Delete($sql);
      $sql = $sql = "DELETE FROM `course_evaluate` WHERE `course_id` = '".$course_id."' AND `semester_id` = ".$this->SEMESTER_ID;
      $this->DB->Insert_Update_Delete($sql);
      $return['status'] = 'success';
      $return['msg'] = 'ลบข้อมูลสำเร็จ';
      return $return;
    }
    else
    {
      $return['status'] = 'error';
      $return['msg'] = 'ไม่สามารถลบข้อมูลได้้';
      return $return;
    }

  }
  public function Reset_Data_Special($course_id,$instructor_id)
  {
    $status = $this->Get_Instructor_Status($instructor_id,$course_id);
    if((int)$status != 0)
    {
      $return['status'] = 'error';
      $return['msg'] = 'ข้อมูลถูกบันทึกเรียบร้อยแล้ว ไม่สามารถลบได้';
      return $return;
    }
    $sql = "SELECT `hire_id`,`expense_id` FROM `course_hire_special_instructor` WHERE `course_id` = '".$course_id."' AND `instructor_id` = ".$instructor_id." AND `semester_id` = ".$this->SEMESTER_ID;
    $result = $this->DB->Query($sql);
    if($result)
    {
      $expense_id = $result[0]['expense_id'];
      $hire_id = $result[0]['hire_id'];
      $sql = "DELETE FROM `course_hire_special_instructor` WHERE `course_id` = '".$course_id."' AND `instructor_id` = ".$instructor_id." AND `semester_id` = ".$this->SEMESTER_ID;
      $this->DB->Insert_Update_Delete($sql);
      $sql = "DELETE FROM `expense_special_instructor` WHERE `expense_id` = ".$expense_id;
      $this->DB->Insert_Update_Delete($sql);
      $sql = "DELETE FROM `special_lecture_teach` WHERE `hire_id` = ".$hire_id;
      $this->DB->Insert_Update_Delete($sql);
      $return['status'] = 'success';
      $return['msg'] = 'ลบข้อมูลสำเร็จ';
      return $return;
    }
    else
    {
      $return['status'] = 'error';
      $return['msg'] = 'ไม่สามารถลบข้อมูลได้้';
      return $return;
    }


  }

  private function Is_Edit($type,$course_id,$instructor_id)
  {
    if($type == "evaluate")
    {
      $sql = "SELECT `approval_id` FROM `approval_course` WHERE `course_id` = '".$course_id."' AND `status` > '1' AND `semester_id` = ".$this->SEMESTER_ID;
      $result = $this->DB->Query($sql);
      if($result)
      {
        return false;
      }
      else
      {
        return true;
      }
    }
    else if($type == 'special')
    {
      $sql = "SELECT `approval_id` FROM `approval_special` ";
      $sql .=" WHERE `course_id` = '".$course_id."' AND `instructor_id` = '".$instructor_id."' AND `status` > '1' AND `semester_id` = ".$this->SEMESTER_ID;
      $result = $this->DB->Query($sql);
      if($result)
      {
        return false;
      }
      else
      {
        return true;
      }
    }

  }

  //get document approval status
  private function Get_Doc_Status($course_id)
  {
      $status = 7;
      $sql = "SELECT `status` FROM `approval_course`
      WHERE `course_id` = '".$course_id."' AND `semester_id` = ".$this->SEMESTER_ID;
      $result = $this->DB->Query($sql);
      if($result)
      {
        for($i=0;$i<count($result);$i++)
        {
          $temp_status = $result[$i]['status'];
          if($temp_status < $status)
          {
            $status = $temp_status;
          }
        }
        return $status;
      }
      else
      {
        //not found on database, assume not creating
        return "0";
      }
  }

  //get special instructor data and approval status
  private function Get_Instructor_Data($course_id)
  {
    $DATA = array();
    $sql = "SELECT `firstname`,`lastname`,`instructor_id` FROM `special_instructor` WHERE `instructor_id`
    IN (SELECT DISTINCT `instructor_id` FROM `approval_special` WHERE `course_id` = '".$course_id."' AND `semester_id` = ".$this->SEMESTER_ID.")";
     $result = $this->DB->Query($sql);
     if($result)
     {
       for($i=0;$i<count($result);$i++)
       {
         $instructor['id'] = $result[$i]['instructor_id'];
         $instructor['name'] = $result[$i]['firstname'].' '.$result[$i]['lastname'];
         $instructor['status'] = $this->Get_Instructor_Status($result[$i]['instructor_id'],$course_id);
         $pdf = $this->Get_Special_Doc_Url($instructor['id'],$course_id);
         $instructor['pdf'] = $pdf['pdf'];
         $instructor['cv'] = $pdf['cv'];
         $instructor['edit'] = $this->Is_Edit('special',$course_id,$instructor['id']);
         $sql = "SELECT teacher_id,comment,`updated_date` FROM `approval_special`
         WHERE `course_id` = '".$course_id."' AND `instructor_id` = ".$result[$i]['instructor_id']." AND `semester_id` =".$this->SEMESTER_ID;
         $result_comment = $this->DB->Query($sql);
         $instructor['comment'] = array();
         if($result_comment)
         {
           for($j=0;$j<count($result_comment);$j++)
           {
                $comment['name'] = $this->PERSON->Get_Teacher_Name($result_comment[$j]['teacher_id'],'TH');
                $comment['comment'] = $result_comment[$j]['comment'];
                $comment['date'] = $result_comment[$j]['updated_date'];
               array_push($instructor['comment'],$comment);
           }
         }
         array_push($DATA,$instructor);
       }
     }
     return $DATA;

  }

  //search special instructor approval status and comment
  private function Get_Instructor_Status($instructor_id,$course_id)
  {
    $sql = "SELECT status FROM `approval_special`
    WHERE instructor_id = ".$instructor_id." AND `course_id` = '".$course_id."' AND `semester_id` = ".$this->SEMESTER_ID;
    $status = 7;
    $result = $this->DB->Query($sql);
        if($result)
        {
          for($i=0;$i<count($result);$i++)
          {
            $temp_status = $result[$i]['status'];
            if($temp_status < $status)
            {
              $status = $temp_status;
            }
          }
          return $status;
        }
        else
        {
          return false;
        }

  }


//add new special instructor status to approve
  public function Append_Special_Instructor($course_id,$instructor_id)
  {
      $sql = " DELETE FROM `approval_special`
       WHERE `course_id` = '".$course_id."' AND `instructor_id` = '".$instructor_id."'
       AND `level_approve` = '2' AND `semester_id` = ".$this->SEMESTER_ID;
      $result_delete = $this->DB->Insert_Update_Delete($sql);
      if(!$result_delete)
      {
        return false;
      }
      if($instructor_id == null)
      {
        $sql = "SELECT `instructor_id` FROM `course_hire_special_instructor` WHERE `course_id` = '".$course_id."' AND `semester_id` = ".$this->SEMESTER_ID;
        $result = $this->DB->Query($sql);
        if($result)
        {
          $instructor_id = $result;
          $sql = "SELECT ga.`teacher_id` FROM `subject_assessor` sa, `group_assessor` ga
          WHERE sa.`course_id` = '".$course_id."' AND sa.assessor_group_num = ga.group_num AND sa.`semester_id` = ".$this->SEMESTER_ID;
          $result = $this->DB->Query($sql);
          if($result)
          {
            $updated_date = date("Y-m-d H:i:s");
            for($i=0;$i<count($result);$i++)
            {
              for($j=0;$j<count($instructor_id);$j++)
              {
                $sql = "INSERT INTO `approval_special`(`instructor_id`,`teacher_id`,`course_id`,`level_approve`,`status`,`semester_id`,`updated_date`)
                VALUES ('".$instructor_id[$j]['instructor_id']."','".$result[$i]['teacher_id']."','".$course_id."',1,'1',".$this->SEMESTER_ID.",'".$updated_date."')
                ON DUPLICATE KEY UPDATE `status` = '1',`comment` = null";
                $approve_result = $this->DB->Insert_Update_Delete($sql);
                if($approve_result == false)
                {
                  $return['error'] = 'ไม่สามารถเพิ่มข้อมูลได้';
                }
              }
            }
          }
        }
      }
      else
      {
        $sql = "SELECT ga.`teacher_id` FROM `subject_assessor` sa, `group_assessor` ga
        WHERE sa.course_id = '".$course_id."' AND sa.assessor_group_num = ga.group_num AND sa.`semester_id` = ".$this->SEMESTER_ID;
        $result = $this->DB->Query($sql);
        if($result)
        {
          $updated_date = date("Y-m-d H:i:s");
          for($i=0;$i<count($result);$i++)
          {
            $sql = "INSERT INTO `approval_special`(`instructor_id`,`teacher_id`,`course_id`,`level_approve`,`status`,`semester_id`,`updated_date`)
            VALUES ('".$instructor_id."','".$result[$i]['teacher_id']."','".$course_id."',1,'1',".$this->SEMESTER_ID.",'".$updated_date."')
            ON DUPLICATE KEY UPDATE `status` = '1',`comment` = null";
            $approve_result = $this->DB->Insert_Update_Delete($sql);
            if($approve_result == false)
            {
              $return['error'] = 'ไม่สามารถเพิ่มข้อมูลได้';
            }
          }
      }
      $noti['COURSE_ID'] = $course_id;
      $noti['STATUS'] = '1';
      $noti['NAME'] = $this->PERSON->Get_Special_Instructor_Name($instructor_id);
      $noti['DATE_USER'] = date("d-m-Y");
      $noti['TIME_USER'] = date("h:i:sa");
      $noti['TYPE'] = '2'; //1 evaluate , 2, special instructor
      $this->Send_Noti($course_id,json_encode($noti,JSON_UNESCAPED_UNICODE));
    }
    return true;
  }


  //get approval data to approval page
  public function Get_Approval_Evaluate($teacher_id)
  {
    $DATA = array();
    //search data of document to approve
    if($this->USER_LEVEL == 6)
    {
      $sql = "SELECT DISTINCT `course_id` FROM `approval_course`
      WHERE `status` = '5' AND `semester_id` =".$this->SEMESTER_ID;
      $sql .= " ORDER BY `course_id";
    }
    else if($this->USER_LEVEL < 6)
    {
      $sql = "SELECT DISTINCT sa.`course_id` FROM `subject_assessor` sa,`group_assessor` ga,`approval_course` ac
       WHERE sa.`assessor_group_num` = ga.`group_num` AND ga.`teacher_id` = '".$teacher_id."'
       AND ac.`status` >= '1' AND ac.`course_id` = sa.`course_id` AND ac.`semester_id` =".$this->SEMESTER_ID;
       $sql .= " ORDER BY sa.`course_id";
    }

    $result = $this->DB->Query($sql);
    if($result)
    {
      for($i=0;$i<count($result);$i++)
      {
        $course = array();
        $course['id'] = $result[$i]['course_id'];
        $course['name'] = $this->COURSE->Get_Course_Name($course['id']);
        $course['status'] = '0'; //0 = ยังไม่ได้ลงความเห็น , 1 ลงความเห็นแล้ว
        $url = $this->Get_Doc_Url($course['id'],'draft');
        $course['evaluate'] = $url['evaluate'];
        $course['syllabus'] = $url['syllabus'];
        $course['comment'] = array();
        $sql = "SELECT `teacher_id`,`comment`,`status`,`date` FROM `approval_course` WHERE `course_id` = '".$course['id']."'
        AND `semester_id` =".$this->SEMESTER_ID;
        $result_comment = $this->DB->Query($sql);
        if($result_comment)
        {
          $count = count($result_comment);
          for($j=0;$j<$count;$j++)
          {
            if($result_comment[$j]['teacher_id'] == $teacher_id)
            {
              if($this->USER_LEVEL < 6)
              {
                if($result_comment[$j]['status'] != 1)
                {
                  $course['status'] = '1';
                }
              }
              else
              {
                if($result_comment[$j]['status'] != 5 )
                {
                  $course['status'] = '1';
                }
              }
            }
            $comment['name'] = $this->PERSON->Get_Teacher_Name($result_comment[$j]['teacher_id'],'TH');
            $comment['comment'] = $result_comment[$j]['comment'];
            $comment['date'] = $result_comment[$j]['date'];
            array_push($course['comment'],$comment);
          }
        }
        array_push($DATA,$course);

      }
    }
      //end search
    return $DATA;
  }

//get special instructor approval data to approval page
  public function Get_Approval_Special($teacher_id)
  {
    $DATA = array();
    //search data of document to special instructor
    if($this->USER_LEVEL == 6)
    {
      $sql = "SELECT DISTINCT `course_id` FROM `approval_special`
      WHERE `status` = '5' AND `semester_id` =".$this->SEMESTER_ID;
      $sql .= " ORDER BY `course_id";
    }
    else if($this->USER_LEVEL < 6)
    {
      $sql = "SELECT DISTINCT sa.`course_id` FROM `subject_assessor` sa,`group_assessor` ga,`approval_special` ac
       WHERE sa.`assessor_group_num` = ga.`group_num` AND ga.`teacher_id` = '".$teacher_id."'
       AND ac.`status` >= '1' AND ac.`course_id` = sa.`course_id` AND ac.`semester_id` = ".$this->SEMESTER_ID;
       $sql .= " ORDER BY sa.`course_id";

    }
    $result = $this->DB->Query($sql);
    if($result)
    {
      for($i=0;$i<count($result);$i++)
      {
        $course['id'] = $result[$i]['course_id'];
        $course['name'] = $this->COURSE->Get_Course_Name($course['id']);
        $temp_instructor = $this->Get_Instructor_Data($course['id']);
        $course['instructor'] = array();
        $count = count($temp_instructor);
        for($j=0;$j<$count;$j++)
        {
          if($this->USER_LEVEL < 6)
          {
            array_push($course['instructor'],$temp_instructor[$j]);
          }
          else
          {
            if((int)$temp_instructor[$j]['status'] == 5)
            {
              array_push($course['instructor'],$temp_instructor[$j]);
            }
          }
        }
        for($j=0;$j<count($course['instructor']);$j++)
        {
          if((int)$course['instructor'][$j]['status'] < 5 && ($this->USER_LEVEL == 6))
          {
            unset($course['instructor'][$j]);
            continue;
          }
          $instructor_id = $course['instructor'][$j]['id'];
          $course['instructor'][$j]['status'] = '0';
          $sql = "SELECT `teacher_id`,`comment`,`status`,`updated_date` FROM `approval_special` WHERE `course_id` = '".$course['id']."' AND `instructor_id` = '".$instructor_id."'
          AND `semester_id` = ".$this->SEMESTER_ID;
          $result_comment = $this->DB->Query($sql);
          if($result_comment)
          {
            $count = count($result_comment);
            for($k=0;$k<$count;$k++)
            {
              if($result_comment[$k]['teacher_id'] == $teacher_id)
              {
                if($this->USER_LEVEL == 6)
                {
                  if($result_comment[$k]['status'] != 5 )
                  {
                    $course['instructor'][$j]['status'] = '1';
                  }
                }
                else if($this->USER_LEVEL < 6)
                {
                  if($result_comment[$k]['status'] != 1)
                  {
                    $course['instructor'][$j]['status'] = '1';
                  }
                }
              }
            }
          }
        }
        if (!empty($course['instructor']))
        {
          array_push($DATA,$course);
        }
      }
    }
    return $DATA;
  }

  //get document pdf url include course evaluate, special instructor
  private function Get_Doc_Url($course_id,$type)
  {
    $url = $this->CURL->GET_SERVER_URL();
    $view_url = $url."/application/pdf/view.php";
    $download_url = $url."/application/download/download.php";
    $return_url['document']['all'] = $download_url."?course=".$course_id."&type=draft&info=all&semester=".$this->SEMESTER."&year=".$this->YEAR;
    $return_url['document']['instructor'] = $download_url."?course=".$course_id."&type=draft&info=instructor&semester=".$this->SEMESTER."&year=".$this->YEAR;
    $return_url['evaluate'] = $view_url."?course=".$course_id."&type=".$type."&info=evaluate&semester=".$this->SEMESTER."&year=".$this->YEAR;
    $return_url['syllabus'] = $this->COURSE->Get_Course_Syllabus($course_id,$this->SEMESTER_ID);
    return $return_url;
  }

  //get special instructor pdf url
  private function Get_Special_Doc_Url($instructor_id,$course_id)
  {
    $url = $this->CURL->GET_SERVER_URL();
    $view_url = $url."/application/pdf/view.php";
    $return_url['pdf'] = $view_url."?course=".$course_id."&id=".$instructor_id."&info=special&semester=".$this->SEMESTER."&year=".$this->YEAR;
    $return_url['cv'] = $this->PERSON->Get_CV($instructor_id);
    return $return_url;
  }


  //send email to involve assessor and teacher
  private function Sendemail($course_id,$data)
  {
    //get all involved staff
    //send notification to resiponsible teacher
    $sql = "SELECT DISTINCT `teacher_id` FROM `course_responsible` WHERE `course_id` = '".$course_id."' AND `semester_id` = ".$this->SEMESTER_ID;
    $result = $this->DB->Query($sql);
    if($result)
    {
      $count = count($result);
      for($i=0;$i<$count;$i++)
      {
        $teacher_id = $result[$i]['teacher_id'];
        $this->REPORT->Sendemail($teacher_id,$data);
      }
    }

    //send email to course assessor
    $sql = "SELECT DISTINCT `teacher_id` FROM `group_assessor` ga, `subject_assessor` sa
    WHERE ga.`group_num` = sa.`assessor_group_num` AND sa.`course_id` = '".$course_id."' AND sa.`semester_id` = ".$this->SEMESTER_ID;
    $result = $this->DB->Query($sql);
    if($result)
    {
      $count = count($result);
      for($i=0;$i<$count;$i++)
      {
        $teacher_id = $result[$i]['teacher_id'];
        $this->REPORT->Sendemail($teacher_id,$data);
      }
    }
  }

  // send notification to involve assessor and teacher
  private function Send_Noti($course_id,$msg)
  {
    //get all involved staff
    //send notification to resiponsible teacher
    $sql = "SELECT `teacher_id` FROM `course_responsible` WHERE `course_id` = '".$course_id."' AND `semester_id` = ".$this->SEMESTER_ID;
    $result = $this->DB->Query($sql);
    if($result)
    {
      $count = count($result);
      for($i=0;$i<$count;$i++)
      {
        $teacher_id = $result[$i]['teacher_id'];
        $this->REPORT->Append_Notification($teacher_id,$msg);
      }
    }
    //send notification to course assessor
    $sql = "SELECT `teacher_id` FROM `group_assessor` ga, `subject_assessor` sa
    WHERE ga.`group_num` = sa.`assessor_group_num` AND sa.`course_id` = '".$course_id."' AND sa.`semester_id` = ".$this->SEMESTER_ID;
    $result = $this->DB->Query($sql);
    if($result)
    {
      $count = count($result);
      for($i=0;$i<$count;$i++)
      {
        $teacher_id = $result[$i]['teacher_id'];
        $this->REPORT->Append_Notification($teacher_id,$msg);
      }
    }
  }

//close database connection
  public function Close_connection()
  {
    $this->DB->Close_connection();
  }
}

 ?>
