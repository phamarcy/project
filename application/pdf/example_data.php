<?php 
$DATA['COURSE_ID'] = '462452';
$DATA['SECTION'] = '3';
$DATA['CREDIT']['TOTAL'] = 3;
$DATA['CREDIT']['LEC'] = 3;
$DATA['CREDIT']['LAB'] = 0;
$DATA['CREDIT']['SELF'] = 6;

$DATA['STUDENT'] = 50;

$DATA['TYPE_TEACHING'] = 'LEC'; #LEC LECLAB SPE TRA SEM LAB OTH;

$DATA['TEACHER']['LEC'][0] = 'adiluck';
$DATA['TEACHER']['LEC'][1] = 'somchai';
$DATA['TEACHER']['LAB'][0] = 'ketsaraporn';
$DATA['TEACHER']['LAB'][1] = 'teerasill';

$DATA['EXAM']['MID']['HOUR']['LEC'] = '3';
$DATA['EXAM']['MID']['HOUR']['LAB'] = '1.5';
$DATA['EXAM']['MID']['COMMITTEE']['LEC'][0] = 'adiluck';
$DATA['EXAM']['MID']['COMMITTEE']['LEC'][1] = 'somchai';
$DATA['EXAM']['MID']['COMMITTEE']['LAB'][0] = 'ketsaraporn';
$DATA['EXAM']['MID']['COMMITTEE']['LAB'][1] = 'teerasill';

$DATA['EXAM']['FINAL']['HOUR']['LEC'] = '3';
$DATA['EXAM']['FINAL']['HOUR']['LAB'] = '1.5';
$DATA['EXAM']['FINAL']['COMMITTEE']['LEC'][0] = 'adiluck';
$DATA['EXAM']['FINAL']['COMMITTEE']['LEC'][1] = 'somchai';
$DATA['EXAM']['FINAL']['COMMITTEE']['LAB'][0] = 'ketsaraporn';
$DATA['EXAM']['FINAL']['COMMITTEE']['LAB'][1] = 'teerasill';


$DATA['MEASURE']['MID']['LEC'] = "35.5";
$DATA['MEASURE']['MID']['LAB'] = "35.0";
$DATA['MEASURE']['FINAL']['LEC'] = "35.0";
$DATA['MEASURE']['FINAL']['LAB'] = "35.0";
$DATA['MEASURE']['OTHER'][0]['NAME'] = "งานมอบหมาย";
$DATA['MEASURE']['OTHER'][0]['LEC'] = "10.0";
$DATA['MEASURE']['OTHER'][0]['LAB'] = "0.0";
$DATA['MEASURE']['OTHER'][1]['NAME'] = "ควิซ";
$DATA['MEASURE']['OTHER'][1]['LEC'] = "10.0";
$DATA['MEASURE']['OTHER'][1]['LAB'] = "0.0";



$DATA['MEASURE']['COMMENT'] = 'ขอความกรุณาจัดสอบภายในอาทิตย์แรก-ต้นอาทิตย์ วันธรรมดาของการสอบ เนื่องจากข้อสอบเป็นข้อเขียนค่ะ';

$DATA['SEMINAR'][0]['NAME'] = 'asdsadasd';
$DATA['SEMINAR'][0]['SCORE'] = "15.0";
$DATA['SEMINAR'][1]['NAME'] = 'asdsadasd';
$DATA['SEMINAR'][1]['SCORE'] = "15.0";
$DATA['TRAIN'][0]['NAME'] = 'asdasdad';
$DATA['TRAIN'][0]['SCORE'] = "10.0";

$DATA['EVALUATE'] = 'AF'; # SU, AF
$DATA['CALCULATE']['TYPE'] = 'CRITERIA'; #GROUP CRITERIA
$DATA['CALCULATE']['A']['MIN'] = 80.0;
$DATA['CALCULATE']['B+']['MIN'] = 75.0;
$DATA['CALCULATE']['B+']['MAX'] = 79.9;
$DATA['CALCULATE']['B']['MIN'] = 70.0;
$DATA['CALCULATE']['B']['MAX'] = 74.9;
$DATA['CALCULATE']['C+']['MIN'] = 65.0;
$DATA['CALCULATE']['C+']['MAX'] = 69.9;
$DATA['CALCULATE']['C']['MIN'] = 60.0;
$DATA['CALCULATE']['C']['MAX'] = 64.9;
$DATA['CALCULATE']['D+']['MIN'] = 55.0;
$DATA['CALCULATE']['D+']['MAX'] = 59.9;
$DATA['CALCULATE']['D']['MIN'] = 50.0;
$DATA['CALCULATE']['D']['MAX'] = 54.9;
$DATA['CALCULATE']['F']['MAX'] = 50;
$DATA['CALCULATE']['S']['MIN'] = 50;
$DATA['CALCULATE']['U']['MAX'] = 0;

$DATA['ABSENT'] = 'F'; #F, U, CAL

//echo json_encode($DATA);
 ?>