<?php
require_once(__DIR__."/database.php");
require_once(__DIR__."/../config/configuration_variable.php");
/**
 *
 */
class Person
{

  private $LOG;
  private $DB;

  function __construct()
  {
    global $DATABASE;
    # code...
    $this->LOG = new Log();
    $this->DB = new Database();
    $this->DB->Change_DB('person');
    $this->DEFAULT_DB = $DATABASE['NAME'];
  }

  public function Get_Person_Name()
  {

  }

  public function Get_All_Teacher()
  {
    $sql = "SELECT s.`code` as code,p.`name` as prefix,s.`fname`,s.`lname`
    FROM `staff` s,`prefix` p,`position` po
    WHERE s.`position_code` = po.`code` and s.`prefix_code` = p.`code` AND s.`position_code` = '100000'";
    $this->DB->Change_DB('person');
    $result = $this->DB->Query($sql);
    $this->DB->Change_DB($this->DEFAULT_DB);
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
    $this->DB->Change_DB($this->DEFAULT_DB);
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
    $this->DB->Change_DB($this->DEFAULT_DB);
    $sql = "SELECT * FROM `special_instructor` WHERE `instructor_id` = ".$id;
    $result = $this->DB->Query($sql);
    if($result)
    {
      $name = $result[0]['firstname'].' '.$result[0]['lastname'];
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
    $this->DB->Change_DB($this->DEFAULT_DB);
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
  private function Get_Teacher_Id($teacher_name)
  {
    $name = explode(" ",$teacher_name);
    $name_space = count($name);
    if($name_space >= 2)
    {
      $lname = $name[$name_space-1];
      $fname = $name[$name_space-2];
      $sql = "SELECT code FROM `staff` WHERE fname = '".$fname."' AND lname ='".$lname."'";
      $this->DB->Change_DB('person');
      $result = $this->DB->Query($sql);
      $this->DB->Change_DB($this->DEFAULT_DB);
      if($result)
      {
        $id = $result[0]['code'];
        return $id;
      }
      else
      {
        return false;
      }
    }
    else
    {
      return false;
    }
  }
  public function Get_Staff_Dep($staff_id)
  {
    $sql = "SELECT s.`dep_code`,dep.`name` FROM `staff`s,`department` dep
    WHERE s.`code` = '".$staff_id."' AND s.`dep_code` = dep.`code`";
    $this->DB->Change_DB('person');
    $result = $this->DB->Query($sql);
    $this->DB->Change_DB($this->DEFAULT_DB);
    if($result)
    {
      $department_id['code'] = $result[0]['dep_code'];
      $department_id['name'] = $result[0]['name'];
      return $department_id;
    }
    else
    {
      return false;
    }
  }
  public function Add_Assessor($group_num,$teacher_name,$department_id)
  {
    $teacher_id = $this->Get_Teacher_Id($teacher_name);
    if($teacher_id != false)
    {
      if($department_id != false)
      {
        if($department_id == '1202')
        {
          $group_num = '1'.$group_num;
        }
        else if($department_id == '1203')
        {
          $group_num = '2'.$group_num;
        }
        $sql = "INSERT INTO `group_assessor`(`teacher_id`, `group_num`)
        VALUES ('".$teacher_id."','".$group_num."')";
        $this->DB->Change_DB($this->DEFAULT_DB);
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
      else
      {
        return false;
      }
    }
    else
    {
      return false;
    }
  }
  public function Delete_Assessor($group_num,$teacher_name)
  {

  }

  public function Search_Assessor($group_num)
  {

  }

}



 ?>
