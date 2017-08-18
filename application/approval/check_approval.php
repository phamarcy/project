<?php
session_start();
require_once(__DIR__."/../class/approval.php");
$approve = new approval($_SESSION['level']);
echo $approve->Check_Status('204411');

 ?>
