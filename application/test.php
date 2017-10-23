<?php
require_once(__DIR__.'/class/approval.php');
session_start();
$a = new approval($_SESSION['level']);
echo json_encode($a->Get_Approval_Special($_SESSION['id']));
?>