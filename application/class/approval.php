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
    if($comment != null && $comment != '' && $teacher_id != 'all')
    {
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
      if((int)$status <= 4 )
      {
        $sql .= " AND `level_approve` = '".$level_approve."'";
      }
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
      if($status_after == 5)
      {
        $pdf_complete = $this->Send_Complete_Evaluate($course_id,'3');
        $pdf_result = json_decode($pdf_complete,true);
        if($pdf_result != null)
        {
          return true;
        }
        else
        {
            $this->LOG->Write("Completing agree file error : ".$pdf_complete);
            return false;
        }
      }
      else if($status_after == 7)
      {
        $pdf_complete = $this->Send_Complete_Evaluate($course_id,'4');
        $pdf_result = json_decode($pdf_complete,true);
        if($pdf_result != null)
        {
          return true;
        }
        else
        {
            $this->LOG->Write("Completing approve file error : ".$pdf_complete);
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
  private function Send_Complete_Special($course_id,$instructor_id)
  {
    $data['SUBMIT_TYPE'] = '4';
    $data['COURSEDATA']['COURSE_ID'] = $course_id;
    $data['TEACHERDATA']['ID'] = $instructor_id;
    $DATA['DATA'] = json_encode($data);
    $DATA['APPROVER_ID'] = $_SESSION['id'];
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
    $status_before = $this->Get_Instructor_Status($instructor_id);
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
      $status_after = $this->Get_Instructor_Status($instructor_id);
      if($status_before != $status_after)
      {
        $noti['COURSE_ID'] = $course_id;
        $noti['STATUS'] = (string)$status_after;
        $noti['NAME'] = $this->PERSON->Get_Special_Instructor_Name($instructor_id);
        $noti['DATE_USER'] = date("d-m-Y");
        $noti['TIME_USER'] = date("h:i:sa");
        $noti['TYPE'] = '2'; //1 evaluate , 2, special instructor
        $this->Sendemail($course_id,$noti);
        $this->Send_Noti($course_id,json_encode($noti,JSON_UNESCAPED_UNICODE));
      }
      if($status_after == 7)
      {
        //save instructor to database
        $sql = "INSERT INTO `course_hire`(`course_id`, `instructor_id`, `semester_id`)
        VALUES ('".$course_id."','".$instructor_id."','".$this->SEMESTER_ID."')";
        $result = $this->DB->Insert_Update_Delete($sql);
        if(!$result)
        {
          $this->LOG->Write("course hire error ");
        }

        //starting generate pdf
        $pdf_complete = $this->Send_Complete_Special($course_id,$instructor_id);
        $pdf_result = json_decode($pdf_complete,true);
        if($pdf_result != null)
        {
          return true;
        }
        else
        {
            $this->LOG->Write($pdf_complete);
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
   //default status 0 = waiting for create
      $sql = "SELECT ga.`teacher_id` FROM `subject_assessor` sa, `group_assessor` ga
      WHERE sa.course_id = '".$course_id."' AND sa.assessor_group_num = ga.group_num AND `semester_id` = '".$this->SEMESTER_ID."'";
      $result = $this->DB->Query($sql);
      if($result)
      {
        for($i=0;$i<count($result);$i++)
        {
          $updated_date = date("Y-m-d H:i:s");
          $sql = "INSERT INTO `approval_course`(`teacher_id`,`course_id`,`level_approve`,`status`,`semester_id`,`date`)
          VALUES ('".$result[$i]['teacher_id']."','".$course_id."',1,'0',".$this->SEMESTER_ID.",'".$updated_date."')";
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
      $result = $this->DB->Query($sql);
      if($result)
      {
        for($i=0;$i<count($result);$i++)
        {
            $course['id'] = $result[$i]['course_id'];
            $course['name'] = $this->COURSE->Get_Course_Name($course['id']);
            $pdf = $this->Get_Doc_Url($course['id'],'draft');
            $course['pdf'] = $pdf['evaluate'];
            //search evaluate form
            $course['evaluate']['status'] = $this->Get_Doc_Status($course['id']);
            $sql_course = "SELECT `teacher_id`,`comment`,`date` FROM `approval_course` WHERE `course_id` ='".$course['id']."'
            AND `semester_id` =".$this->SEMESTER_ID;
            $comment_temp = $this->DB->Query($sql_course);
            if($comment_temp)
            {
              $course['evaluate']['comment'] = array();
              for($j=0;$j<count($comment_temp);$j++)
              {
                $comment['name'] = $this->PERSON->Get_Teacher_Name($comment_temp[$j]['teacher_id']);
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
         $instructor['status'] = $this->Get_Instructor_Status($result[$i]['instructor_id']);
         $pdf = $this->Get_Special_Doc_Url($instructor['id'],$course_id,'draft');
         $instructor['pdf'] = $pdf['pdf'];
         $sql = "SELECT teacher_id,comment,`updated_date` FROM `approval_special`
         WHERE instructor_id = ".$result[$i]['instructor_id']." AND `semester_id` =".$this->SEMESTER_ID;
         $result_comment = $this->DB->Query($sql);
         $instructor['comment'] = array();
         if($result_comment)
         {
           for($j=0;$j<count($result_comment);$j++)
           {
                $comment['name'] = $this->PERSON->Get_Teacher_Name($result_comment[$j]['teacher_id']);
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
  private function Get_Instructor_Status($instructor_id)
  {
    $sql = "SELECT status FROM `approval_special`
    WHERE instructor_id = ".$instructor_id;
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
      $noti['COURSE_ID'] = $course_id;
      $noti['STATUS'] = '1';
      $noti['NAME'] = $this->PERSON->Get_Special_Instructor_Name($instructor_id);
      $noti['DATE_USER'] = date("d-m-Y");
      $noti['TIME_USER'] = date("h:i:sa");
      $noti['TYPE'] = '2'; //1 evaluate , 2, special instructor
      $this->Sendemail($course_id,$noti);
      $this->Send_Noti($course_id,json_encode($noti,JSON_UNESCAPED_UNICODE));
    }
    return true;
  }


  //get approval data to approval page
  public function Get_Approval_data($teacher_id)
  {
    $DATA = array();
    //search data of document to approve
    if($this->USER_LEVEL < 6)
    {
      $sql = "SELECT DISTINCT sa.`course_id` FROM `subject_assessor` sa,`group_assessor` ga,`approval_course` ac
       WHERE sa.`assessor_group_num` = ga.`group_num` AND ga.`teacher_id` = '".$teacher_id."'
       AND ac.`status` >= '1' AND ac.`course_id` = sa.`course_id` AND ac.`semester_id` =".$this->SEMESTER_ID;
    }
    else
    {
      $sql = "SELECT DISTINCT `course_id` FROM `approval_course`
      WHERE `status` = '5' AND `semester_id` =".$this->SEMESTER_ID;
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
        $course['special'] = array();
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
            $comment['name'] = $this->PERSON->Get_Teacher_Name($result_comment[$j]['teacher_id']);
            $comment['comment'] = $result_comment[$j]['comment'];
            $comment['date'] = $result_comment[$j]['date'];
            array_push($course['comment'],$comment);
          }
        }
        array_push($DATA,$course);

      }
    }
      //search special instructor data
      if($this->USER_LEVEL < 6)
      {
        $sql = "SELECT DISTINCT spe.`course_id` FROM `subject_assessor` sa,`group_assessor` ga,`approval_special` spe
         WHERE sa.`assessor_group_num` = ga.`group_num` AND ga.`teacher_id` = '".$teacher_id."'
         AND spe.`status` >= '1' AND spe.`course_id` = sa.`course_id` AND spe.`semester_id` =".$this->SEMESTER_ID;
      }
      else
      {
        $sql = "SELECT DISTINCT `course_id` FROM `approval_special`
        WHERE `status` = '5' AND `semester_id` =".$this->SEMESTER_ID;
      }
      $result = $this->DB->Query($sql);
      if($result)
      {
        $count = count($result);
        for($i=0;$i<$count;$i++)
        {
          $course_id = $result[$i]['course_id'];
          $sql = "SELECT `instructor_id`,`teacher_id`,`status`,`comment`,`updated_date`
          FROM `approval_special` WHERE `course_id` = '".$course_id."' AND `semester_id` =".$this->SEMESTER_ID;
          $result_special = $this->DB->Query($sql);
          if($result_special)
          {
            $count_special = count($result_special);
            $special = array();
            for($j=0;$j<$count_special;$j++)
            {
              $check = 0;
              for($k=0;$k<count($special);$k++)
              {
                if($result_special[$j]['teacher_id'] == $teacher_id && $result_special[$j]['instructor_id'] == $special[$k]['id'])
                {
                  if($this->USER_LEVEL < 6)
                  {
                    if($result_special[$j]['status'] != 1)
                    {
                      $special[$k]['status'] = '1';
                    }
                  }
                  else
                  {
                    if($result_special[$j]['status'] != 5)
                    {
                      $special[$k]['status'] = '1';
                    }
                  }
                }
                if($special[$k]['id'] == $result_special[$j]['instructor_id'])
                {
                  $comment['name'] = $this->PERSON->Get_Teacher_Name($result_special[$j]['teacher_id']);
                  $comment['comment'] = $result_special[$j]['comment'];
                  $comment['date'] = $result_special[$j]['updated_date'];
                  array_push($special[$k]['comment'],$comment);
                  $check = 1;
                }
              }
              if($check == 0)
              {
                $instructor['id'] = $result_special[$j]['instructor_id'];
                $instructor['name'] = $this->PERSON->Get_Special_Instructor_Name($instructor['id']);
                $file = $this->Get_Special_Doc_Url($instructor['id'],$course_id,'draft');
                $instructor['cv'] = $file['cv'];
                $instructor['pdf'] = $file['pdf'];
                $instructor['status'] = '0';
                $instructor['comment'] = array();
                $comment['name'] = $this->PERSON->Get_Teacher_Name($result_special[$j]['teacher_id']);
                $comment['comment'] = $result_special[$j]['comment'];
                $comment['date'] = $result_special[$j]['updated_date'];
                if($result_special[$j]['teacher_id'] == $teacher_id)
                {
                  if($this->USER_LEVEL < 6)
                  {
                    if($result_special[$j]['status'] != 1)
                    {
                      $instructor['status'] = '1';
                    }
                  }
                  else
                  {
                    if($result_special[$j]['status'] != 5)
                    {
                      $instructor['status'] = '1';
                    }
                  }
                }
                array_push($instructor['comment'],$comment);
                array_push($special,$instructor);
              }
            }
            $check_special = 0;
            for($j=0;$j<count($DATA);$j++)
            {
              if($DATA[$j]['id'] == $course_id)
              {
                $check_special = 1;
                $DATA[$j]['special'] = $special;
              }
            }
            if($check_special == 0)
            {
              $course = array();
              $course['id'] = $course_id;
              $course['name'] = $this->COURSE->Get_Course_Name($course['id']);
              $status = $this->Get_Doc_Status($course_id);
              if($status == 0 )
              {
                  $course['status'] = '-1';
              }
              else if($status != 5 && $status != 1)
              {
                $course['status'] = '1'; //0 = ยังไม่ได้ลงความเห็น , 1 ลงความเห็นแล้ว
              }
              else
              {
                $course['status'] = '0';
              }
              $url = $this->Get_Doc_Url($course['id'],'draft');
              $course['evaluate'] = $url['evaluate'];
              $course['syllabus'] = $url['syllabus'];
              $course['comment'] = array();
              $course['special'] = $special;
              array_push($DATA,$course);
            }
          }
          else
          {

          }
        }
      }
      //end search
    return $DATA;
  }

  //get document pdf url include course evaluate, special instructor
  private function Get_Doc_Url($course_id,$type)
  {
    $url = $this->CURL->GET_SERVER_URL();
    $view_url = $url."/application/pdf/view.php";
    $return_url['evaluate'] = $view_url."?course=".$course_id."&type=".$type."&info=evaluate&semester=".$this->SEMESTER."&year=".$this->YEAR;
    $return_url['syllabus'] = $this->COURSE->Get_Course_Syllabus($course_id);
    return $return_url;
  }

  //get special instructor pdf url
  private function Get_Special_Doc_Url($instructor_id,$course_id,$type)
  {
    $url = $this->CURL->GET_SERVER_URL();
    $view_url = $url."/application/pdf/view.php";
    $return_url['pdf'] = $view_url."?course=".$course_id."&id=".$instructor_id."&type=".$type."&info=special&semester=".$this->SEMESTER."&year=".$this->YEAR;
    $return_url['cv'] = $this->PERSON->Get_CV($instructor_id,$course_id);
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
