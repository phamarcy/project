<?php
require_once(__DIR__."/database.php");

/**
 *
 */
class Person
{

  private $LOG;
  private $DB;

  function __construct()
  {
    # code...
    $this->LOG = new Log();
    $this->DB = new Database();
    $this->DB->Change_DB('person');
  }

  public function Get_Person_Name()
  {

  }

  public function Get_All_Teacher()
  {
    $sql = "SELECT s.`code` as code,p.`name` as prefix,s.`fname`,s.`lname`
    FROM `staff` s,`prefix` p,`position` po
    WHERE s.`position_code` = po.`code` and s.`prefix_code` = p.`code` AND s.`position_code` = '100000'";

    $result = $this->DB->Query($sql);
    if($result)
    {
      $teacher = array();
      for($i=0;$i<count($result);$i++)
      {
        $name['id'] = $result[$i]['code'];
        $name['prefix'] = $result[$i]['prefix'];
        $name['name'] = $result[$i]['fname'].' '.$result[$i]['lname'];
        array_push($teacher,$name);
      }
      return $teacher;
    }
    else
    {
      $this->LOG->Write("Error person : Search Teacher failed");
      return false;
    }
  }

  //search teacher prefix and name
  public function Get_Teacher_Name($teacher_id)
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

  public function Get_Special_Instructor_Name($id)
  {
    $sql = "SELECT * FROM `special_instructor` WHERE `instructor_id` =".$id;
    $result = $this->DB->Query($sql);
    if($result)
    {
      $name['fname'] = $result[0]['firstname'];
      $name['lname'] = $result[0]['lastname'];
      return $name;
    }
    else
    {
      return false;
    }
  }

  public function Get_All_Prefix()
  {
    $this->DB->Change_DB('person');
    $sql = "SELECT `code`,`name` FROM `prefix`";
    $result = $this->DB->Query($sql);
    $this->DB->Change_DB('pharmacy');
    if($result)
    {
      $prefix = array();
      for($i=0;$i<count($result);$i++)
      {
        $temp['id'] = $result[$i]['code'];
        $temp['prefix'] = $result[$i]['name'];
        array_push($prefix,$temp);
      }
      return $prefix;
    }
    else
    {
      return false;
    }

  }


}



 ?>
