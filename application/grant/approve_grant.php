<?php
//var_dump($_POST);exit();
session_start();
require_once(__DIR__."/../class/database.php");
require_once(__DIR__."/../class/person.php");
$person         = new Person();
$DB             = new Database();
if (isset($_POST["type"]) && isset($_POST["teacher"]) && isset($_POST["date"])) {

  $type         = $_POST["type"];
  $teacher      = $_POST["teacher"];
  $date         = $_POST["date"];

  if ($type=="add") {

    $datesplit  = explode('-',$date);
    $dateend    = str_replace('-', '/',   $datesplit[1]);

    $datebase   = date('Y-m-d',strtotime($datesplit[0]));
    $dateplus   = date('Y-m-d',strtotime($dateend . "+1 days"));
    $teacher_id = $person->Get_Teacher_Id($teacher);
    $sql = "SELECT user_id "
      $check_teacher=$DB->Query($sql);
    if (condition) {
      # code...
    }
    $sql        = "INSERT INTO grant_approve(user_id, status, type_before, date_start, date_end) VALUES (".$teacher_id.",1,".$_SESSION['id'].",".$datebase.",".$dateplus.") ";
    $result     = $DB->Insert_Update_Delete($sql);
      if ($result==1) {
        $DATA = array('status'=>'success','msg' => ,"มอบสำอำนาจสำเร็จ");
        return $DATA
      }else {
        $DATA = array('status'=>'error','msg' => ,"กรุณาติดต่อผู้ดูแลระบบ");
        return $DATA
      }
  }
  if($type=="remove"){
    $sql        = "DELETE FROM grant_approve WHERE user_id = ".$teacher_id." ";
    $result     = $this->DB->Insert_Update_Delete($sql);
    if ($result) {
      print_r($result);
    }
  }
}



?>
