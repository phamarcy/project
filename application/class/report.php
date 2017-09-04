<?php
require_once(__DIR__."/database.php");
require_once(__DIR__."/manage_deadline.php");
require_once(__DIR__.'/curl.php');
require_once(__DIR__."/course.php");
require_once(__DIR__."/person.php");
require_once(__DIR__."/../config/configuration_variable.php");
/**
 *
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

  private function Get_URL()
  {
    $url = $this->CURL->GET_SERVER_URL();
    $url .= "/application/pdf/view.php";
    $this->VIEW_URL = $url;
  }

  public function Get_Evaluate_Report($semester,$year)
  {
    $semester_id = $this->DEADLINE->Search_Semester_id($semester,$year);
    if($semester_id)
    {
      $DATA = array();
      $course = scandir($this->FILE_PATH);
      for($i=2;$i<count($course);$i++)
      {
        $data['id'] = $course[$i];
        $data['name'] = $this->COURSE->Get_Course_Name($data['id']);
        $url = '';
        $data['syllabus'] = $url;
        $data['pdf'] = $this->VIEW_URL."?course=".$data['id']."&type=draft&info=evaluate&semester=".$semester."&year=".$year;
        $file_name = scandir($this->FILE_PATH."/".$data['id']."/evaluate");
        for($j=2;$j<count($file_name);$j++)
        {
          if($this->Check_File_Semester($semester,$year,$file_name[$j]))
          {
            array_push($DATA,$data);
            break;
          }
        }
      }
      if(count($DATA) == 0)
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
  public function Get_Special_Report($semester,$year)
  {
    $semester_id = $this->DEADLINE->Search_Semester_id($semester,$year);
    if($semester_id)
    {
      $DATA = array();
      $course = scandir($this->FILE_PATH);
      for($i=2;$i<count($course);$i++)
      {
        $data['id'] = $course[$i];
        $data['name'] = $this->COURSE->Get_Course_Name($data['id']);
        $data['special'] = array();
        $file_name = scandir($this->FILE_PATH."/".$data['id']."/special_instructor");
        for($j=2;$j<count($file_name);$j++)
        {
          if($this->Check_File_Semester($semester,$year,$file_name[$j]))
          {
            $instructor_id = explode("_",$file_name[$j]);
            $instructor['id'] = $instructor_id[1];
            $instructor['name'] = $this->PERSON->Get_Special_Instructor_Name($instructor['id']);
            $instructor['cv'] = '-';
            $instructor['pdf'] =  $this->VIEW_URL."?course=".$data['id']."&id=".$instructor['id']."&type=complete&info=special&semester=".$semester."&year=".$year;
            array_push($data['special'],$instructor);
          }
        }
        if(count($data['special']) != 0)
        {
          array_push($DATA,$data);
          return $DATA;
        }
        else
        {
            $return['status'] = 'error';
            $return['msg'] = 'ไม่พบข้อมูล';
            return $return;
        }
      }
      return $DATA;
    }
    else
    {
      $return['status'] = 'error';
      $return['msg'] = 'ไม่พบข้อมูล';
      return $return;
    }

  }

}



 ?>
