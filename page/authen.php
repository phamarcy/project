<?php
require_once(__DIR__.'/../application/class/authen.php');
if(isset($_POST['username']) && isset($_POST['password']))
{
  $authen = new Authentication();
  $result = $authen->Authorize(trim($_POST['username']),trim($_POST['password']));
  if($result)
  {
    session_start();
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
// trim($words);
 ?>
