<?php

// this class is use for manage deadline data
// adiluck chooprateep adiluckyo@gmail.com
require_once(__DIR__.'/../config/configuration_variable.php');
require_once(__DIR__.'/database.php');
//require_once('Log.php');
Class Deadline
{
  private $DB;
  private $LOG;

  function __construct()
  {
      $this->LOG = new Log();
  }
//Search all data from database
//require string type : course,approve
  public function Search_all($type)
  {
      if($type == 'course')
      {
        $type = 1;
      }
      else if($type =='approve')
      {
        $type = 2;
      }
      else if($type == 'evaluate')
      {
        $type = 3;
      }
      $this->DB = new Database();
      $sql = "SELECT s.`semester_num`,s.`year`,d.`last_date`,d.`open_date`
        FROM `deadline` d,`semester` s
       WHERE d.`semester_id` = s.`semester_id` and d.`deadline_type` = ".$type;
      $result = $this->DB->Query($sql);
      $this->Close_connection();
      if($result != null)
      {
        return $result;
      }
      else
      {
        return false;
      }
  }

//update data in Database
//require array : data, string : type
  public function Update($data,$type)
  {

    if($type == 'course')
    {
      $type = 1;
    }
    else if($type == 'approve')
    {
      $type = 2;
    }
    else if($type == 'evaluate')
    {
      $type = 3;
    }
    else {
      $return['error'] = 'Update failed, Invalid type';
      return $return;
    }
    $semester_id = $this->Get_Semester_id($data['semester'],$data['year']);
    $this->DB = new Database();
    $sql = "INSERT INTO `deadline`(`semester_id`, `deadline_type`, `open_date`, `last_date`)
    VALUES (".$semester_id.",'".$type."','".$data['opendate']."','".$data['lastdate']."')
    ON DUPLICATE KEY UPDATE `open_date` = '".$data['opendate']."', last_date = '".$data['lastdate']."'";
    $result = $this->DB->Insert_Update_Delete($sql);
    $this->Close_connection();
    if($result == true)
    {
      $return['success'] = 'บันทึกเรียบร้อยแล้ว';
      return $return;
    }
    else
    {
      $return['error'] = 'Update failed, please contact admin';
      return $return;
    }

  }

  public function Get_Semester_id($semester,$year)
  {
    $this->DB = new Database();
    //Search semester id form semester table
    $sql = "SELECT `semester_id` FROM `semester` WHERE `semester_num` = ".$semester." AND `year` = '".$year."'";
    $semester_id = $this->DB->Query($sql);


    if($semester_id == null) //if not exist, insert new semester
    {
      $sql = "INSERT INTO `semester` (`semester_num`, `year`) VALUES (".$semester.",'".$year."');";
      $result = $this->DB->Insert_Update_Delete($sql);
      if($result)
      {
        $sql = "SELECT LAST_INSERT_ID();";
        $result = $this->DB->Query($sql);
        $this->Close_connection();
        if($result)
        {
          $semester_id = $result[0]['LAST_INSERT_ID()'];
          return $semester_id;
        }
        else
        {
          $this->LOG->Write("Error : Get semester id failed");
          return $false;
        }
      }
      else {
        $this->LOG->Write("Error : insert new semester failed");
        return $false;
      }
    }
    else //if exist search semester id
    {
        $sql = "SELECT `semester_id` FROM `semester` WHERE `semester_num` = ".$semester." AND `year` = '".$year."'";
        $result = $this->DB->Query($sql);
        $this->Close_connection();
        if($result)
        {
          $semester_id = $result[0]['semester_id'];
          return $semester_id;
        }
        else
        {
          $this->LOG->Write("Error : search semester id failed");
          return false;
        }
    }

  }
  public function Get_Current_Semester()
  {
    global $CONFIG_PATH;
    $system_path = $CONFIG_PATH."/system/";
    $current_semester_path = $system_path."current_semester.txt";
    $file = fopen($current_semester_path,"r");
    $file_data = fread($file,filesize($current_semester_path));
    $file_data = explode("/",$file_data);


    $data['semester'] = $file_data[0];
    $data['year'] = $file_data[1];
    $data['id'] = $this->Get_Semester_id($data['semester'],$data['year']);
    return $data;
  }

  public function Close_connection()
  {
    $this->DB->Close_connection();
  }

}

 ?>
