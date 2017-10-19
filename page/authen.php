<?php
require_once(__DIR__.'/../application/class/authen.php');
session_start();
if(isset($_POST['r_username']) && isset($_POST['r_password']))
{
  $authen = new Authentication();
  $result = $authen->Authorize(trim($_POST['r_username']),trim($_POST['r_password']));
  if($result)
  {

    $_SESSION['id'] = $result['id'];
    $_SESSION['fname'] = $result['fname'];
    $_SESSION['lname'] = $result['lname'];
    $_SESSION['level'] = $result['level'];
    header('Location: index.php');
  }
  else
  {
    die("ไม่พบข้อมูลในระบบ กรุณาตรวจสอบ username และ password อีกครั้ง");
  }
}
else
{
  die("กรุณา Login ใหม่");
}
// trim($words);
 ?>
