<?php
require_once(__DIR__."/Database.php");
require_once(__DIR__."/manage_deadline.php");
require_once(__DIR__.'/curl.php');
require_once(__DIR__."/course.php");
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
  }

  public function Check_Status($course_id)
  {
    $DATA= array();
    $sql = "SELECT `teacher_id`,`data_type`,`course_id`,`status`,`level_approve`,`comment`
    FROM `approval_course` a,`semester` s
    WHERE a.`semester_id` = s.`semester_id` and s.`semester_num` = 1 and s.`year` = '2560' and `course_id`='".$course_id."'";
    $result = $this->DB->Query($sql);

    if($result != false)
    {
      $all_status = 5;
      $data['course'] = $course_id;
      $data['semester'] = $this->SEMESTER;
      $data['year'] = $this->YEAR;
      $data['evaluate'] = array();
      $data['special'] = array();
      $data['syllabus'] = array();
      for($i=0;$i<count($result);$i++)
      {
        $data_type = $result[$i]['data_type'];
        if(array_key_exists($data_type,$data))
        {

          //apend document status to sending data
          $status = $this->Get_Doc_Status($course_id,$data_type);

          if($status < $all_status)
          {
            $all_status = $status;
          }

          $data[$data_type]['status'] = $status;
          //append comment to sending data
          if(!array_key_exists('comment',$data[$data_type]))
          {
            $data[$data_type]['comment'] = array();
          }
          $teacher_name = $this->Get_Teacher_Name($result[$i]['teacher_id']);
          if($teacher_name != false)
          {
              $comment_data['name'] = $teacher_name;
          }
          else
          {
              $comment_data['name'] = '-';
              $this->LOG->Write('Note found teacher name in teacher id '.$result[$i]['teacher_id']);
          }

          $comment_data['text'] = $result[$i]['comment'];
          array_push($data[$data_type]['comment'],$comment_data);
        }
        if(count($data['evaluate']) == 0)
        {
            $data['evaluate']['status'] = 1;
            $all_status = 1;
        }
        if(count($data['special']) == 0)
        {
            $data['special']['status'] = 1;
            $all_status = 1;
        }
        if(count($data['syllabus']) == 0)
        {
            $data['syllabus']['status'] = 1;
            $all_status = 1;
        }
      }
      $data['status'] = $all_status;
      $DATA['data'] = $data;
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
  //type = evaluate,syllabus,special
  private function Get_Doc_Status($course_id,$type)
  {
      $status = 4;
      $sql = "SELECT `status` FROM `approval_course`
      WHERE `course_id` = '".$course_id."' AND `semester_id` = ".$this->SEMESTER_ID." AND `data_type` = '".$type."'";
      $result = $this->DB->Query($sql);
      if($result)
      {
        for($i=0;$i<count($result);$i++)
        {
          switch ($result[$i]['status'])
          {
            case 'A':
              $temp_status = 4;
              break;
            case 'D':
              $temp_status = 3;
              break;
            case 'P':
              $temp_status = 2;
            default:
              break;
          }
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

  //search teacher prefix and name
  private function Get_Teacher_Name($teacher_id)
  {
    //search teacher data
    $this->DB->Change_DB('person');
    $sql = "SELECT p.`name` as prefix ,s.`fname`,s.`lname` FROM `staff` s,`prefix` p WHERE s.`code` = '".$teacher_id."' AND s.`prefix_code` = p.`code` ";
    $result = $this->DB->Query($sql);
    $this->DB->Change_DB('pharmacy');
    if($result)
    {
      $full_name = $result[0]['prefix']." ".$result[0]['fname']." ".$result[0]['lname'];
      return $full_name;
    }
    else
    {
      return false;
    }
  }
  //get approval data to approval page
  public function Get_Approval_data($teacher_id)
  {
    //init data
    $data['pending'] = array();
    $data['approve'] = array();
    $data['disapprove'] = array();
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
        $course['syllabus'] = $url['syllabus'];
        $course['comment'] = array();
        $sql = "SELECT `teacher_id`,`comment` FROM `approval_course` WHERE `course_id` = '".$course['id']."'";
        $result_comment = $this->DB->Query($sql);
        if($result_comment)
        {
          for($j=0;$j<count($result_comment);$j++)
          {
            $comment['name'] = $this->Get_Teacher_Name($result_comment[$j]['teacher_id']);
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
          $status = $this->Get_Course_Status($course['id']);
          if($status == 4)
          {
            array_push($data['approve'],$course);
          }
          else if($status == 3)
          {
            array_push($data['disapprove'],$course);
          }
          else
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

  private function Get_Course_Status($course_id)
  {
    $status = 4;
    $syllabus_status =  $this->Get_Doc_Status($course_id,'syllabus');
    if($syllabus_status < $status)
    {
      $status = $syllabus_status;
    }
    $evaluate_status = $this->Get_Doc_Status($course_id,'evaluate');
    if($evaluate_status < $status)
    {
      $status = $evaluate_status;
    }
    return $status;
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
