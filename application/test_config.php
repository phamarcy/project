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

// $p = new Course();
// echo json_encode($p->Get_Document('evaluate','204111ss','2','2559'));

$a = new approval('6');
echo json_encode($a->Get_Approval_Special('011'));
