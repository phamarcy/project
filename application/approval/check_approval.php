<?php
$DATA = array();
$semester = '1';
$year = '2560';
$data[0]['id'] = '462533';
$data[0]['status'] = 5;
$data[0]['course']['status'] = 5;
$data[0]['evaluate']['status'] = 5;
$data[0]['evaluate']['comment'][0]['name'] = 'ศ.อรรคพล ธรรมฉันธะ';
$data[0]['evaluate']['comment'][0]['text'] = 'เอกสารครบถ้วนสมบูรณ์';
$data[0]['evaluate']['comment'][1]['name'] = 'ดร.ชูศักดิ์ ธรรมฉันธะ';
$data[0]['evaluate']['comment'][1]['text'] = 'ผ่าน';
$data[0]['special']['status'] = 5;
$data[0]['special']['comment'][0]['name'] = 'ศ.อรรคพล ธรรมฉันธะ';
$data[0]['special']['comment'][0]['text'] = 'เอกสารครบถ้วนสมบูรณ์';
$data[0]['special']['comment'][1]['name'] = 'ดร.ชูศักดิ์ ธรรมฉันธะ';
$data[0]['special']['comment'][1]['text'] = 'ยืนยันการประเมิณ';
$data[0]['syllabus']['status'] = 5;
$data[0]['syllabus']['comment'][0]['name'] = 'ศ.อรรคพล ธรรมฉันธะ';
$data[0]['syllabus']['comment'][0]['text'] = 'เอกสารครบถ้วนสมบูรณ์';
$data[0]['syllabus']['comment'][1]['name'] = 'ดร.ชูศักดิ์ ธรรมฉันธะ';
$data[0]['syllabus']['comment'][1]['text'] = 'สมบูรณ์';

$DATA['semester'] = $semester;
$DATA['year'] = $year;
$DATA['data'] = $data;

echo json_encode($DATA);
 ?>
