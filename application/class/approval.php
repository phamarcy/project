<?php
require_once(__DIR__."/database.php");
require_once(__DIR__."/manage_deadline.php");
require_once(__DIR__.'/curl.php');
require_once(__DIR__."/course.php");
require_once(__DIR__."/person.php");
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
  }

  //evaluate course evaluate document
  public function Update_Status_Evaluate($course_id,$status,$teacher_id,$comment)
  {
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
      $sql = "UPDATE `approval_course` SET `status`= '".$status."',`comment`= '".$comment."'";
      if($comment != null)
      {
        $sql .= ",`comment`= '".$comment."'";
      }
      $sql .= " WHERE `course_id` = '".$course_id."'";
    }
    else //update specific teacher_id,course_id
    {
      $sql = "UPDATE `approval_course` SET `status`= '".$status."',`level_approve` = '".$level_approve."'";
      if($comment != null)
      {
        $sql .= ",`comment`= '".$comment."'";
      }
      $sql .= " WHERE `course_id` = '".$course_id."' AND `teacher_id` = '".$teacher_id."'";
    }
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

//evaluate special instructor
  public function Update_Status_Special($instructor_id,$teacher_id,$course_id,$status,$comment)
  {
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
      if($comment != null)
      {
        $sql .= ",`comment`= '".$comment."'";
      }
      $sql .= " WHERE `course_id` = '".$course_id."' AND `instructor_id` = '".$instructor_id."'";

    }
    else //update specific teacher_id,course_id
    {
      $sql = "UPDATE `approval_special` SET `status`= '".$status."'";
      if($comment != null)
      {
        $sql .= ",`comment`= '".$comment."'";
      }
      $sql .= " WHERE `course_id` = '".$course_id."' AND `instructor_id` = '".$instructor_id."' AND `teacher_id` = '".$teacher_id."'";
    }
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


//add new approval status
  public function Append_Status_Evaluate($course_id)
  {
   //default status 1 = waiting for create
      $sql = "SELECT ga.`teacher_id` FROM `subject_assessor` sa, `group_assessor` ga
      WHERE sa.course_id = '".$course_id."' AND sa.assessor_group_num = ga.group_num";
      $result = $this->DB->Query($sql);
      if($result)
      {
        for($i=0;$i<count($result);$i++)
        {
          $sql = "INSERT INTO `approval_course`(`teacher_id`,`course_id`,`level_approve`,`status`,`semester_id`)
          VALUES ('".$result[$i]['teacher_id']."','".$course_id."',1,'0',".$this->SEMESTER_ID.")";
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
      $sql = "SELECT `course_id` FROM `department_course_responsible`
      WHERE `department_id` = '1202' AND `semester_id` = '".$this->SEMESTER_ID."'";
    }
    else if ($this->USER_LEVEL == 3)
    {
      $sql = "SELECT `course_id` FROM `department_course_responsible`
      WHERE  `semester_id` = '".$this->SEMESTER_ID."'";
    }
    else if ($this->USER_LEVEL == 4 || $this->USER_LEVEL == 5)
    {
      $sql = "SELECT `course_id` FROM `approval_course`
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
            //search evaluate form
            $course['evaluate']['status'] = $this->Get_Doc_Status($course['id']);
            $sql_course = "SELECT `teacher_id`,`comment` FROM `approval_course` WHERE `course_id` ='".$course['id']."'
            AND `semester_id` =".$this->SEMESTER_ID;
            $comment_temp = $this->DB->Query($sql_course);
            if($comment_temp)
            {
              $course['evaluate']['comment'] = array();
              for($j=0;$j<count($comment_temp);$j++)
              {
                $comment['name'] = $this->PERSON->Get_Teacher_Name($comment_temp[$j]['teacher_id']);
                $comment['comment'] = $comment_temp[$j]['comment'];
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
  //type = evaluate
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
  private function Get_Instructor_Data($course_id)
  {
    $DATA = array();
    $sql = "SELECT DISTINCT firstname,lastname,sa.instructor_id FROM `approval_special` sa,`special_instructor` si
     WHERE `course_id` = '".$course_id."' AND sa.instructor_id = si.instructor_id  AND `semester_id` =".$this->SEMESTER_ID;
     $result = $this->DB->Query($sql);
     if($result)
     {
       for($i=0;$i<count($result);$i++)
       {
         $instructor['id'] = $result[$i]['instructor_id'];
         $instructor['name'] = $result[$i]['firstname'].' '.$result[$i]['lastname'];
         $instructor['status'] = $this->Get_Instructor_Status($result[$i]['instructor_id']);
         $sql = "SELECT teacher_id,comment FROM `approval_special`
         WHERE instructor_id = ".$result[$i]['instructor_id']." AND `semester_id` =".$this->SEMESTER_ID;
         $result_comment = $this->DB->Query($sql);
         $instructor['comment'] = array();
         if($result_comment)
         {
           for($j=0;$j<count($result_comment);$j++)
           {
             if($result_comment[$j]['comment'] != null)
             {
                $comment['name'] = $this->PERSON->Get_Teacher_Name($comment_temp[$j]['teacher_id']);
                $comment['comment'] = $comment_temp[$j]['comment'];
               array_push($instructor['comment'],$comment);
             }
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
    $status = 4;
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



  public function Append_Special_Instructor($course_id,$instructor_id)
  {
    $sql = "SELECT ga.`teacher_id` FROM `subject_assessor` sa, `group_assessor` ga
    WHERE sa.course_id = '".$course_id."' AND sa.assessor_group_num = ga.group_num";
    $result = $this->DB->Query($sql);
    if($result)
    {
      for($i=0;$i<count($result);$i++)
      {
        $sql = "INSERT INTO `approval_special`(`instructor_id`,`teacher_id`,`course_id`,`level_approve`,`status`,`semester_id`)
        VALUES ('".$instructor_id."','".$result[$i]['teacher_id']."','".$course_id."',1,'1',".$this->SEMESTER_ID.")";
        $approve_result = $this->DB->Insert_Update_Delete($sql);
        if($approve_result == false)
        {
          $return['error'] = 'ไม่สามารถเพิ่มข้อมูลได้';
        }
      }
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
      $sql = "SELECT `course_id` FROM `subject_assessor` sa,`group_assessor` ga
       WHERE sa.`assessor_group_num` = ga.`group_num` AND ga.`teacher_id` = '".$teacher_id."'
       AND `semester_id` =".$this->SEMESTER_ID;
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
        $course['status'] = '0'; //0 = ยังไม่ได้ลองความเห็น , 1 ลงความเห็นแล้ว
        $url = $this->Get_Doc_Url($course['id'],'draft');
        $course['evaluate'] = $url['evaluate'];
        $course['syllabus'] = $url['syllabus'];
        $course['comment'] = array();
        $sql = "SELECT `teacher_id`,`comment`,`status` FROM `approval_course` WHERE `course_id` = '".$course['id']."'
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
                if($result_comment[$j]['status'] != 5)
                {
                  $course['status'] = '1';
                }
              }
            }
            $comment['name'] = $this->PERSON->Get_Teacher_Name($result_comment[$j]['teacher_id']);
            $comment['comment'] = $result_comment[$j]['comment'];
            array_push($course['comment'],$comment);
          }

        }
        //search special instructor data
        $course['special'] = array();
        $instructor = $this->Get_Instructor_Data($course['id']);
        $count_instructor = count($instructor);
        for($j=0;$j<$count_instructor;$j++)
        {
          $special = array();
          $special['id'] = $instructor[$j]['id'];
          $special['comment'] = array();
          $special['name'] = $instructor[$j]['name'];
          $special['status'] = '0';
          $sql = "SELECT `teacher_id`,`comment`,`status` FROM `approval_special` WHERE `course_id` = '".$course['id']."'
          AND `semester_id` =".$this->SEMESTER_ID;
          $result_comment = $this->DB->Query($sql);
          if($result_comment)
          {
            $count = count($result_comment);
            for($k=0;$k<$count;$k++)
            {
              $comment = array();
              if($result_comment[$k]['teacher_id'] == $teacher_id)
              {
                if($this->USER_LEVEL < 6)
                {
                  if($result_comment[$k]['status'] != 1)
                  {
                    $course['status'] = '1';
                  }
                }
                else
                {
                  if($result_comment[$k]['status'] != 5)
                  {
                    $course['status'] = '1';
                  }
                }
              }
              $comment['name'] = $this->PERSON->Get_Teacher_Name($result_comment[$k]['teacher_id']);
              $comment['comment'] = $result_comment[$k]['comment'];
              array_push($special['comment'],$comment);
            }
          }
          array_push($course['special'],$special);
        }
          //check status in course
          array_push($DATA,$course);
      }
    }
    return $DATA;
  }

  private function Get_Doc_Url($course_id,$type)
  {
    $url = $this->CURL->GET_SERVER_URL();
    $view_url = $url."/application/pdf/view.php";
    $return_url['evaluate'] = $view_url."?course=".$course_id."&type=".$type."&info=evaluate&semester=".$this->SEMESTER."&year=".$this->YEAR;
    $return_url['syllabus'] = $this->COURSE->Get_Course_Syllabus($course_id);
    return $return_url;
  }

  public function Close_connection()
  {
    $this->DB->Close_connection();
  }
}

 ?>
