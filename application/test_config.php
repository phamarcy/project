<?php

require_once(__DIR__."/class/Log.php");
require_once(__DIR__."/class/Database.php");
// $log = new Log();
// $log->Write("test");
$db = new Database();
$data = $db->Query('select * from data');
var_dump($data);
$db->Close_connection();