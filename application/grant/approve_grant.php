<?php
//var_dump($_POST);exit();
session_start();
require_once(__DIR__."/../class/database.php");
require_once(__DIR__."/../class/person.php");
$person= new Course();
if (isset($_POST["type"]) && isset($_POST["teacher"]) && isset($_POST["date"])) {
  $type           = $_POST["type"];
  $teacher        = $_POST["teacher"];
  $date           = $_POST["date"];

  if ($type=="add") {

    $datesplit    = explode('-',$date);
    $dateend = str_replace('-', '/',   $datesplit[1]);

    $datebase = date('Y-m-d',strtotime($datesplit[0]));
    $dateplus = date('Y-m-d',strtotime($dateend . "+1 days"));

    //$result       = $result->Get_Grant($sql);
    $teacher_id   = $person->Get_Teacher_Id($teacher);
    print_r($teacher_id);
  /*  $sql          = "INSERT INTO grant_approve(user_id, status, date_start, date_end) VALUES (".$teacher.",1,".$datebase.",".$dateplus.") ";
    $result       = $this->DB->Insert_Update_Delete($sql);
    if ($result) {
      print_r($result);
    }*/
  }
  if($type=="remove"){
    $sql          = "DELETE FROM grant_approve WHERE user_id = ".$teacher_id." ";
    $result       = $this->DB->Insert_Update_Delete($sql);
    if ($result) {
      print_r($result);
    }
  }
}



?>
