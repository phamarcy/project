<?php
session_start();
require_once(__DIR__.'/../class/approval.php');
require_once(__DIR__.'/../class/curl.php');
var_dump($_POST);
var_dump($_SESSION);
die;

echo json_encode($DATA);
 ?>
