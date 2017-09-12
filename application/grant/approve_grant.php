<?php
/*var_dump($_POST);exit();*/
session_start();
require_once(__DIR__."/../class/database.php");
require_once(__DIR__."/../class/person.php");

if (isset($_POST["type"]) && isset($_POST["teacher"]) && isset($_POST["date"])) {
  $type           = $_POST["type"];
  $teacher        = $_POST["teacher"];
  $date           = $_POST["date"];

  if ($type=="add") {
    $datesplit    = explode('-',$date);
    $datesplit[1] = strtotime("+1 day");
    $dayfinish    = date('d/m/Y',$datesplit[1]);
    $result = new Person();
    $result       = $result->Get_Grant($sql);
    $teacher_id   = $teacher_id->Get_Teacher_Id($teacher);
    print_r($result,$teacher_id);
  /*  $sql          = "INSERT INTO grant_approve(user_id, status, date_start, date_end) ";
    $result       = $this->DB->Insert_Update_Delete($sql);
    if ($result) {
      print_r($result);
    }*/
  }
  if($type=="remove"){

  }
}



?>
