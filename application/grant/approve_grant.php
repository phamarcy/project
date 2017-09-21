<?php
//var_dump($_POST);exit();
session_start();
require_once(__DIR__."/../class/database.php");
require_once(__DIR__."/../class/person.php");
$person              = new Person();
$DB                  = new Database();
if (isset($_POST["type"]) && isset($_POST["teacher"])) {

  $type              = $_POST["type"];
  $teacher           = $_POST["teacher"];
  if (isset($_POST["date"])) {
    $date            = $_POST["date"];
  }

  if ($type=="add") {

    $checkperson     = "SELECT count(*) as item FROM grant_approve WHERE status = '1'";
    $number          = $DB->Query($checkperson);

    if ($number[0]['item']>0) {
      $DATA          = array('status'=>'error','msg' => "มีผู้ได้รับมอบอำนาจอยู่ในระบบแล้ว");
      echo json_encode($DATA);
      return $DATA;
    }
    else {

      $datesplit     = explode('-',$date);
      $datebase      = date('Y-m-d',strtotime($datesplit[0]));
      $dateplus      = date('Y-m-d',strtotime($datesplit[1]));
      $teacher_id    = $person->Get_Teacher_Id($teacher);
      if (!$teacher_id) {
        $DATA          = array('status'=>'error','msg' => "ไม่มีรายชื่อนี้ในระบบ");
        echo json_encode($DATA);
        return $DATA;
      }
      $sqlcheck      = "SELECT count(*) as item FROM grant_approve WHERE user_id = ".$teacher_id."";
      $check_teacher = $DB->Query($sqlcheck);
      
      if (($check_teacher[0]['item'])==0) {
        $sql         = "INSERT INTO grant_approve(user_id, status, date_start, date_end) VALUES ('".$teacher_id."','1','".$datebase."','".$dateplus."') ";
        $result      = $DB->Insert_Update_Delete($sql);
          if ($result==1) {
            $DATA    = array('status'=>'success','msg' => "มอบอำนาจสำเร็จ");
            echo json_encode($DATA);
          }else {
            $DATA    = array('status'=>'error','msg' => "กรุณาติดต่อผู้ดูแลระบบ");
            echo json_encode($DATA);
          }
      }
      else {
        $DATA        = array('status'=>'error','msg' => "มีผู้ใช้งานนี้อยู่ในระบบแล้ว");
        echo json_encode($DATA);
      }

    }

  }
    if($type=="remove"){
      $sql           = "DELETE FROM grant_approve WHERE user_id = '".$teacher."'";
      $result        = $DB->Insert_Update_Delete($sql);
      if ($result) {
        $DATA        = array('status'=>'success','msg' => "ยกเลิกการมอบอำนาจสำเร็จ");
        echo json_encode($DATA);
      }else {
        $DATA        = array('status'=>'error','msg' => "กรุณาติดต่อผู้ดูแลระบบ");
        echo json_encode($DATA);
      }
    }

}



?>