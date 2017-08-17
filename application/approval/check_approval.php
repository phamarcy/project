<?php
require_once(__DIR__."/../class/approval.php");
$approve = new approval();
echo $approve->Check_Status('204411');

 ?>
