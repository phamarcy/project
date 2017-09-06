<?php
session_start();
require_once(__DIR__."/../class/database.php");
if(isset($_SESSION['id']))
{
  $db = new Database();
  $sql = "SELECT `message` FROM `notification`
  WHERE `user_id` = '".$_SESSION['id']."' AND `status` = '0'";
  $result = $db->Query($sql);
  if($result)
  {
      $count = count($result);
      $data = array();
      for($i=0;$i<$count;$i++)
      {
        array_push($data,$result[$i]['message']);
      }
      echo json_encode($data);
  }
}


 ?>
