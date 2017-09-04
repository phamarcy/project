<?php
require_once(__DIR__.'/database.php');
require_once(__DIR__."/../config/configuration_variable.php");

/**
 *
 */
class Authentication
{

  private $DB;
  private $LOG;

  function __construct()
  {
    global $DATABASE;
      $this->DB = new Database();
      $this->DB->Change_DB('person');
      $this->LOG = new Log();
      $this->DEFAULT_DB = $DATABASE['NAME'];
  }

  public function Authorize($username,$password)
  {
    $sql = "SELECT `code`,`fname`,`lname` FROM `staff` WHERE `username` = '".$username."'";
    // $sql = "SELECT `code`,`fname`,`lname` FROM `staff` WHERE `username` = '".$username."' AND `password` = '".$password."'";
    $this->DB->Change_DB('person');
    $result = $this->DB->Query($sql);
    $this->DB->Change_DB($this->DEFAULT_DB);
    if($result)
    {
      $level = $this->Check_level($result[0]['code']);
      if($level == '0')
      {
        return false;
      }
      else
      {
        $user['id'] = $result[0]['code'];
        $user['level'] = $level;
        $user['fname'] = $result[0]['fname'];
        $user['lname'] = $result[0]['lname'];
        return $user;
      }
    }
    else
    {
      return false;
    }
  }

  private function Check_level($code)
  {
    $sql = "SELECT `education` as level FROM `staff_mis` WHERE `code`='".$code."'";
    $this->DB->Change_DB('person');
    $result = $this->DB->Query($sql);
    $this->DB->Change_DB($this->DEFAULT_DB);
    if($result)
    {
      return $result[0]['level'];
    }
    else
    {
      return false;
    }
  }
}



 ?>
