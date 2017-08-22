<?php

require_once(__DIR__."/class/Log.php");
require_once(__DIR__."/class/Database.php");
require_once(__DIR__."/class/person.php");
require_once(__DIR__."/class/course.php");
// $log = new Log();
// $log->Write("test");
// $db = new Database();
// $data = $db->Query('select * from data');
// var_dump($data);
// $db->Close_connection();

$p = new Course();
echo json_encode($p->Search_Document('evaluate','204111'));
