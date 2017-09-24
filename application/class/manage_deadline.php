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
//require string type : course,approve
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


  public function Get_Current_Deadline($level)
  {
    global $THAI_MONTH,$BUDDHA_YEAR ;
    $data = array();
    $semester = $this->Get_Current_Semester();
    $sql = "SELECT `deadline_type`,`open_date`,`last_date` FROM `deadline`
    WHERE `semester_id` = ".$semester['id'];
    if($level == 4 || $level == 5)
    {
      $sql .= " AND `deadline_type` = '4'";
    }
    else if($level == 1)
    {
      $sql .= " AND (`deadline_type` = '1' OR `deadline_type` = '2' OR `deadline_type` = '3')";
    }
    else if($level == 6)
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
        // array_push($DATA,$data);
      }
    }
    return $data;
  }
  public function Get_Current_Semester()
  {
    global $CONFIG_PATH;
    $system_path = $CONFIG_PATH."/system/";
    $current_semester_path = $system_path."current_semester.txt";
    if(!file_exists($current_semester_path))
    {
      $return['status'] = "error";
      $return['msg'] = "ไม่พบไฟล์ system";
    }
    $file = fopen($current_semester_path,"r");
    $file_data = fread($file,filesize($current_semester_path));
    $file_data = explode("/",$file_data);


    $data['semester'] = $file_data[0];
    $data['year'] = $file_data[1];
    $data['id'] = $this->Search_Semester_id($data['semester'],$data['year']);
    return $data;
  }

  public function Close_connection()
  {
    $this->DB->Close_connection();
  }

}

 ?>
