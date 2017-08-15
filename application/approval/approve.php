<?php
require_once(__DIR__.'/../class/curl.php');
$curl = new CURL(null);
$url = $curl->GET_SERVER_URL();

$semester = '2';
$year = '2560';

$data['waiting'][0]['id'] = '462452';
$data['waiting'][0]['name'] = 'FORENSIC AND ETHICS IN PHARM';
$data['waiting'][0]['evaluate'] = $url.'/application/pdf/view.php?course=462452&type=draft&info=evaluate' ;
$data['waiting'][0]['syllabus'] = $url.'/application/pdf/view.php?course=462452&type=draft&info=evaluate' ;
$data['waiting'][0]['special'] = $url.'/application/pdf/view.php?id=0000001&type=draft&info=special' ;
$data['waiting'][0]['comment'][0]['name'] = 'ขุ้น ธรรมฉันธะ';
$data['waiting'][0]['comment'][0]['comment'] = 'หัวข้อการบรรยายยังไม่ชัดเจน';
$data['waiting'][0]['comment'][1]['name'] = 'ชูศักดิ์ ธรรมฉันธะ';
$data['waiting'][0]['comment'][1]['comment'] = 'ควรเพิ่มอาจารย์ปฏิบัติการ';

$data['approve'][0]['id'] = '463311';
$data['approve'][0]['name'] = 'PHARMACEUTICAL BIOTECHNOLOGY 1';
$data['approve'][0]['evaluate'] = $url.'/application/pdf/view.php?course=462452&type=draft&info=evaluate' ;
$data['approve'][0]['syllabus'] = $url.'/application/pdf/view.php?course=462452&type=draft&info=evaluate' ;
$data['approve'][0]['special'] =  $url.'/application/pdf/view.php?id=0000001&type=draft&info=special' ;
$data['approve'][0]['comment'] = array();


$data['disapprove'][0]['id'] = '463332';
$data['disapprove'][0]['name'] = 'ORGANIC MEDICINAL CHEMISTRY 2';
$data['disapprove'][0]['evaluate'] = $url.'/application/pdf/view.php?course=462452&type=draft&info=evaluate' ;
$data['disapprove'][0]['syllabus'] = $url.'/application/pdf/view.php?course=462452&type=draft&info=evaluate' ;
$data['disapprove'][0]['special'] =  $url.'/application/pdf/view.php?id=0000001&type=draft&info=special' ;
$data['disapprove'][0]['comment'] = array();
$data['disapprove'][0]['comment'][0]['name'] = 'ขุ้น ธรรมฉันธะ';
$data['disapprove'][0]['comment'][0]['comment'] = 'กระบวนวิชา463332 ยังขาดรายชื่ออาจารย์ผู้ปฏิบัติการ';
$data['disapprove'][0]['comment'][1]['name'] = 'ชูศักดิ์ ธรรมฉันธะ';
$data['disapprove'][0]['comment'][1]['comment'] = 'การวัดผลการศึกษานั้นยังไม่ชัดเจน';

$DATA['semester'] = $semester;
$DATA['year'] = $year;
$DATA['data'] = $data;

echo json_encode($DATA);
 ?>
