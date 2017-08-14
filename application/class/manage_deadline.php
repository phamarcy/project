<?php

// this class is use for manage deadline data
// adiluck chooprateep adiluckyo@gmail.com

require_once('Database.php');
//require_once('Log.php');
Class Deadline
{
  private $DB;
  private $LOG;

  function __construct()
  {
      $this->DB = new Database();
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
      $sql = "SELECT * FROM `semester` WHERE `deadline_type` = ".$type;
      $result = $this->DB->Query($sql);
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
    $sql = "INSERT INTO `semester` ( `semester_num`, `year`, `deadline_type`, `open_date`, `last_date`)
    VALUES ( '".$data['semester']."', '".$data['year']."', '".$type."', '".$data['opendate']."', '".$data['lastdate']."')
    ON DUPLICATE KEY UPDATE `open_date` = '".$data['opendate']."', last_date = '".$data['lastdate']."'";
    $result = $this->DB->Insert_Update_Delete($sql);
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

  public function Close_connection()
  {
    $this->DB->Close_connection();
  }

}

 ?>
