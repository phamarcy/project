<?php
session_start();
require_once(__DIR__."/../class/database.php");
if(isset($_SESSION['id']))
{
  $db = new Database();
  $sql = "UPDATE `notification` SET `status` = '1'
  WHERE `user_id` = '".$_SESSION['id']."' AND `status` = '0'";
  $result = $db->Insert_Update_Delete($sql);
  if($result)
  {
    echo true;
  }
  else
  {
    echo false;
  }
}
 ?>
