<?php

require_once(__DIR__."/class/Log.php");
require_once(__DIR__."/class/Database.php");
require_once(__DIR__."/class/person.php");
// $log = new Log();
// $log->Write("test");
// $db = new Database();
// $data = $db->Query('select * from data');
// var_dump($data);
// $db->Close_connection();

$p = new Person();
echo json_encode($p->Get_All_Teacher());
