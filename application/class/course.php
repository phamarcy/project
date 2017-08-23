<?php
require_once(__DIR__."/database.php");
require_once(__DIR__."/manage_deadline.php");
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

  public function Search_Document($type,$id)
  {

    $doc_path = realpath($this->FILE_PATH."/temp/".$id."/".$type);
    $data = array();
    $data['info'] = $this->Get_Course_Info($id);
    if(is_dir($doc_path))
    {
        $file_name = scandir($doc_path);
        for($i=2;$i<count($file_name);$i++)
        {
            $files = explode("_",$file_name[$i]);
            $temp['semester'] = $files[2];
            $temp['year'] = $files[3];
            $temp['year'] = str_replace(".txt","",$temp['year']);
            array_push($data,$temp);
        }
    }
      return $data;
  }

  public function Get_Document($type,$id,$semester,$year)
  {
    $file_name = $id."_".$type."_".$semester."_".$year.".txt";
    $doc_path = realpath($this->FILE_PATH."/temp/".$id."/".$type);
    $file_path = $doc_path."/".$file_name;
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
