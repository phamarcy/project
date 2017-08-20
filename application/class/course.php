<?php
require_once(__DIR__."/Database.php");
/**
 *
 */
class Course
{
  private $LOG;
  private $DB;

  function __construct()
  {
    $this->LOG = new Log();
    $this->DB = new Database();
  }

  //search teacher prefix and name
  public function Get_Course_Name($course_id)
  {

    $sql="SELECT `course_name_en` FROM `course_name` WHERE `course_id` ='".$course_id."'";

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
    $sql = "SELECT `course_id`as id,`course_name_en` as name_en,`course_name_th`as name_th FROM `course_name`";
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
}
 ?>
