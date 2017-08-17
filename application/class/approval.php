<?php
require_once(__DIR__."/Database.php");
require_once(__DIR__."/manage_deadline.php");
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

  function __construct()
  {
    $this->LOG = new Log();
    $deadline = new Deadline();
    $data = $deadline->Get_Current_Semester();
    $this->SEMESTER_ID = $data['id'];
    $this->SEMESTER = $data['semester'];
    $this->YEAR = $data['year'];
  }

  public function Check_Status($course_id)
  {
    $DATA= array();
    $this->DB = new Database();
    $sql = "SELECT `teacher_id`,`data_type`,`course_id`,`status`,`level_approve`,`comment`
    FROM `approval_course` a,`semester` s
    WHERE a.`semester_id` = s.`semester_id` and s.`semester_num` = 1 and s.`year` = '2560' and `course_id`='".$course_id."'";
    $result = $this->DB->Query($sql);

    if($result != false)
    {
      $all_status = 5;
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
          $comment_data['name'] = $result[$i]['teacher_id'];
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
    $this->DB->Close_connection();
  }
  //type = evaluate,syllabus,special
  private function Get_Doc_Status($course_id,$type)
  {
      $status = 4;
      $this->DB = new Database();
      $sql = "SELECT `status` FROM `approval_course`
      WHERE `course_id` = '".$course_id."' AND `semester_id` = ".$this->SEMESTER_ID." AND `data_type` = '".$type."'";
      $result = $this->DB->Query($sql);
      $this->DB->Close_connection();
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
  public function Get_Approval_data($teacher_id)
  {

  }
}

 ?>
