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
    //search teacher data
    return "course name";
  }
}
 ?>
