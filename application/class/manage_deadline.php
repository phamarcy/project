<?php

// this class is use for manage deadline data
// adiluck chooprateep adiluckyo@gmail.com
require_once(__DIR__.'/../config/configuration_variable.php');
require_once(__DIR__.'/database.php');
require_once(__DIR__.'/../lib/thai_date.php');
//require_once('Log.php');
Class Deadline
{
  private $DB;
  private $LOG;

  function __construct()
  {
      $this->LOG = new Log();
      $this->DB = new Database();
  }
//Search all data from database
//require string type : 1 = course evaluate,2 = course syllabus  ,3 = special instructor,4 = evaluate,5 = approval
  public function Search_all($type)
  {
      $sql = "SELECT s.`semester_num`,s.`year`,d.`last_date`,d.`open_date`
        FROM `deadline` d,`semester` s
       WHERE d.`semester_id` = s.`semester_id` and d.`deadline_type` = ".$type."
       ORDER BY s.`year` DESC,s.`semester_num` DESC LIMIT 0,10";
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

  //Search all data from database in current semester
  //require string type : 1 = course evaluate,2 = course syllabus  ,3 = special instructor,4 = evaluate,5 = approval
  public  function Search_all_current($type)
  {
    $semester = $this->Get_Current_Semester();

    $sql = "SELECT s.`semester_num`,s.`year`,d.`last_date`,d.`open_date`
    FROM `deadline` d,`semester` s
   WHERE d.`semester_id` = s.`semester_id` and  s.`year`='".$semester['year']."' and s.`semester_num`='".$semester['semester']."' and d.`deadline_type` = ".$type;

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
    $semester_id = $this->Search_Semester_id($data['semester'],$data['year']);
    if(!$semester_id)
    {
      $this->Add_Semester($data['semester'],$data['year']);
      $semester_id = $this->Search_Semester_id($data['semester'],$data['year']);
    }
    $sql = "INSERT INTO `deadline`(`semester_id`, `deadline_type`, `open_date`, `last_date`)
    VALUES (".$semester_id.",'".$type."','".$data['opendate']."','".$data['lastdate']."')
    ON DUPLICATE KEY UPDATE `open_date` = '".$data['opendate']."', last_date = '".$data['lastdate']."'";
    $result = $this->DB->Insert_Update_Delete($sql);
    if($result == true)
    {
      $return['success'] = 'บันทึกเรียบร้อยแล้ว';
      return $return;
    }
    else
    {
      $return['error'] = 'ข้อมูลไม่ถูกต้อง กรุณากรอกใหม่ ';
      return $return;
    }

  }
  //get semester id
  public function Search_Semester_id($semester,$year)
  {
    $sql = "SELECT `semester_id` FROM `semester` WHERE `semester_num` = ".$semester." AND `year` = '".$year."'";
    $result = $this->DB->Query($sql);
    if($result)
    {
      $semester_id = $result[0]['semester_id'];
      return $semester_id;
    }
    else
    {
      return false;
    }
  }

  public function Search_Semester_Term($semester_id)
  {
    $sql = "SELECT `semester_num`,`year` FROM `semester` WHERE `semester_id` = ".$semester_id;
    $result = $this->DB->Query($sql);
    if($result)
    {
      $semester['semester'] = $result[0]['semester_num'];
      $semester['year'] = $result[0]['year'];
      return $semester;
    }
    else
    {
      return false;
    }
  }

// add new semester
  public function Add_Semester($semester,$year)
  {
    $sql = "SELECT `semester_id` FROM `semester` WHERE `semester_num` = ".$semester." AND `year` = '".$year."'";
    $semester_id = $this->DB->Query($sql);
    if($semester_id == null)
    {
      $sql = "INSERT INTO `semester` (`semester_num`, `year`) VALUES (".$semester.",'".$year."');";
      $result = $this->DB->Insert_Update_Delete($sql);
      if($result)
      {
        return true;
      }
      else
      {
        $this->LOG->Write("Error : insert new semester failed");
        return false;
      }
    }
    else
    {
      return true;
    }
  }

//get specific current deadline from role
  public function Get_Current_Deadline($level)
  {
    global $THAI_MONTH,$BUDDHA_YEAR ;
    $data = array();
    $semester = $this->Get_Current_Semester();
    $sql = "SELECT `deadline_type`,`open_date`,`last_date` FROM `deadline`
    WHERE `semester_id` = ".$semester['id'];
    if($level == 4 || $level == 5 )
    {
      $sql .= " AND `deadline_type` = '4'";
    }
    else if($level == 1 || $_SESSION['admission'] == 1 )
    {
      $sql .= " AND (`deadline_type` = '1' OR `deadline_type` = '2' OR `deadline_type` = '3' OR `deadline_type` = '6')";
    }
    else if($level == 6 && $_SESSION['admission']==0)
    {
        $sql .= " AND `deadline_type` = '5'";
    }
    $result = $this->DB->Query($sql);
    if($result)
    {
      for($i=0;$i<count($result);$i++)
      {
        $open_date = explode("-",$result[$i]['last_date']);
        $day = $open_date[2];
        $month = $THAI_MONTH[$open_date[1] - 1];
        $year = $open_date[0] + 543;
        $type = $result[$i]['deadline_type'];
        if($type == '1')
        {
          $data['measure']['day'] = $day;
          $data['measure']['month'] = $month;
          $data['measure']['year'] = $year;
          $data['measure']['format'] = $result[$i]['last_date'];
        }
        else if ($type == 2)
        {
          $data['syllabus']['day'] = $day;
          $data['syllabus']['month'] = $month;
          $data['syllabus']['year'] = $year;
          $data['syllabus']['format'] = $result[$i]['last_date'];
        }
        else if ($type == 3)
        {
          $data['special']['day'] = $day;
          $data['special']['month'] = $month;
          $data['special']['year'] = $year;
          $data['special']['format'] = $result[$i]['last_date'];
        }
        else if ($type == 4)
        {
          $data['evaluate']['day'] = $day;
          $data['evaluate']['month'] = $month;
          $data['evaluate']['year'] = $year;
          $data['evaluate']['format'] = $result[$i]['last_date'];
        }
        else if($type == 5)
        {
          $data['approve']['day'] = $day;
          $data['approve']['month'] = $month;
          $data['approve']['year'] = $year;
          $data['approve']['format'] = $result[$i]['last_date'];
        }
        else if($type == 6)
        {
          $data['grade']['day'] = $day;
          $data['grade']['month'] = $month;
          $data['grade']['year'] = $year;
          $data['grade']['format'] = $result[$i]['last_date'];
        }
        // array_push($DATA,$data);
      }
    }
    return $data;
  }

  //get current semester data in system file
  public function Get_Current_Semester()
  {
    global $CONFIG_PATH;
    $sql = "SELECT `config_value` FROM `system_configuration` WHERE `config_name` = 'CURRENT_SEMESTER_NUM'";
    $result = $this->DB->Query($sql);
    if($result)
    {
      $data['semester'] = $result[0]['config_value'];
      $sql = "SELECT `config_value` FROM `system_configuration` WHERE `config_name` = 'CURRENT_SEMESTER_YEAR'";
      $result = $this->DB->Query($sql);
      if($result)
      {
        $data['year'] = $result[0]['config_value'];
        $data['id'] = $this->Search_Semester_id($data['semester'],$data['year']);
        return $data;
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

  public function Add_Current_Semester($semester,$year)
  {
    $sql = "INSERT INTO `system_configuration` (`config_name`, `config_value`) VALUES ('CURRENT_SEMESTER_NUM', '".$semester."'), ('CURRENT_SEMESTER_YEAR', '".$year."')";
    $sql .= "ON DUPLICATE KEY UPDATE `config_name` = VALUES(`config_name`), `config_value` = VALUES(`config_value`)";
      $result = $this->DB->Insert_Update_Delete($sql);
      if($result)
      {
        return true;
      }

    return false;
  }
//close database connection
  public function Close_connection()
  {
    $this->DB->Close_connection();
  }

}

 ?>
