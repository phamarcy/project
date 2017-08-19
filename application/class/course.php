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
}
 ?>
