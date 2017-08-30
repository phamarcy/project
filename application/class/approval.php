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
    $this->DB = new Database();
    $this->PERSON = new Person();
  }

  //evaluate course evaluate document
  public function Approve_Evaluate($teacher_id,$course_id,$level,$status,$comment)
  {

  }

//evaluate special instructor
  public function Approve_Special($instructor_id,$teacher_id,$course_id,$level,$status,$comment)
  {

  }

//add new approval status
public function Append_Status_Evaluate($course_id,$teacher_id,$level)
{
    $status = '1'; //default status = waiting for create
}
//check status in homt page
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
      $sql = "SELECT `course_id` FROM `course_responsible`
      WHERE `department_id` = '1202' AND `semester_id` = '".$this->SEMESTER_ID."'";
    }
    else if ($this->USER_LEVEL == 3)
    {
      $sql = "SELECT `course_id` FROM `course_responsible`
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
      $status = 4;
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
        return "1";
      }
  }
  private function Get_Instructor_Data($course_id)
  {
    $DATA = array();
    $sql = "SELECT firstname,lastname,sa.instructor_id FROM `approval_special` sa,`special_instructor` si
     WHERE `course_id` = '".$course_id."' AND sa.instructor_id = si.instructor_id";
     $result = $this->DB->Query($sql);
     if($result)
     {
       for($i=0;$i<count($result);$i++)
       {
         $instructor['name'] = $result[$i]['firstname'].' '.$result[$i]['lastname'];
         $instructor['status'] = $this->Get_Instructor_Status($result[$i]['instructor_id']);
         $sql = "SELECT teacher_id,comment FROM `approval_special`
         WHERE instructor_id = ".$result[$i]['instructor_id'];
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

  public function Update_Status_Evaluate($course_id,$status,$teacher_id,$comment)
  {
    if($teacher_id == 'all') //update all status with course_id
    {
      $sql = "UPDATE `approval_course` SET `status`= '".$status."',`comment`= '".$comment."'
      WHERE `course_id` = '".$course_id."'";
    }
    else //update specific teacher_id,course_id
    {
      $sql = "UPDATE `approval_course` SET `status`= '".$status."',`comment`= '".$comment."'
      WHERE `course_id` = '".$course_id."' AND `teacher_id` = '".$teacher_id."'";
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

  public function Append_Special_Instructor($course_id,$instructor_id)
  {
    $sql = "SELECT ga.`teacher_id` FROM `subject_assessor` sa, `group_assessor` ga
    WHERE sa.course_id = '".$course_id."' AND sa.assessor_group_num = ga.group_num";
    $result = $this->DB->Query($sql);
    if($result)
    {
      for($i=0;$i<count($result);$i++)
      {
        $sql = "INSERT INTO `approval_special`(`instructor_id`,`teacher_id`,`course_id`,`level_approve`,`status`)
        VALUES ('".$instructor_id."','".$result[$i]['teacher_id']."','".$course_id."',1,'1')";
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
    //init data
    $data['pending'] = array();
    $data['approve'] = array();
    $data['disapprove'] = array();
    $data['revised'] = array();
    //search data of document to approve
    $sql = "SELECT DISTINCT `course_id` FROM `approval_course` WHERE `teacher_id` = '".$teacher_id."'";
    $result = $this->DB->Query($sql);
    if($result)
    {
      for($i=0;$i<count($result);$i++)
      {
        $course = array();
        $course['id'] = $result[$i]['course_id'];
        $course['name'] = $this->COURSE->Get_Course_Name($course['id']);
        $url = $this->Get_Doc_Url($course['id'],'draft');
        $course['evaluate'] = $url['evaluate'];
        $course['comment'] = array();
        $sql = "SELECT `teacher_id`,`comment` FROM `approval_course` WHERE `course_id` = '".$course['id']."'";
        $result_comment = $this->DB->Query($sql);
        if($result_comment)
        {
          for($j=0;$j<count($result_comment);$j++)
          {
            $comment['name'] = $this->PERSON->Get_Teacher_Name($result_comment[$j]['teacher_id']);
            $comment['text'] = $result_comment[$j]['comment'];
            array_push($course['comment'],$comment);
          }

        }
        else
        {
          //query error return error
          $this->LOG->Write("Query Error : on sql command ".$sql);
        }
          //check status in course
          $status = $this->Get_Doc_Status($course['id']);
          if($status == 4)
          {
            array_push($data['approve'],$course);
          }
          else if($status == 3)
          {
            array_push($data['revised'],$course);
          }
          else if($status == 1)
          {
            array_push($data['pending'],$course);
          }

      }
    }
    else
    {
      //query error return error
      $this->LOG->Write("Query Error : on sql command ".$sql);
    }
    $DATA['data'] = $data;
    return json_encode($DATA);
  }

  private function Get_Doc_Url($course_id,$type)
  {
    $course_id = '462452';
    $url = $this->CURL->GET_SERVER_URL();
    $view_url = $url."/application/pdf/view.php";
    $return_url['evaluate'] = $view_url."?course=".$course_id."&type=".$type."&info=evaluate";
    $return_url['syllabus'] = $view_url."?course=".$course_id."&info=syllabus";
    return $return_url;
  }

  public function Close_connection()
  {
    $this->DB->Close_connection();
  }
}

 ?>
