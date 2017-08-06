<?php
require_once(__DIR__.'/../lib/thai_date.php');
session_start();
$DATA = array();
if(isset($_POST['type']))
{
  $type = $_POST['type'];
  $data[0]['department'] = 'วิทยาศาสตร์เภสัชกรรม';
  $data[0]['course'][0]['id'] = '463503';
  $data[0]['course'][0]['name'] = 'Principles in Phytochemistry';
  $data[0]['course'][1]['id'] = '463512';
  $data[0]['course'][1]['name'] = 'Pharmaceutical Biotechnology 2';
  $data[0]['course'][2]['id'] = '463543';
  $data[0]['course'][2]['name'] = 'Pharmaceutical Quality Assurance 3';
  $data[0]['course'][3]['id'] = '463544';
  $data[0]['course'][3]['name'] = 'Pharmaceutical Quality Assurance 4';
  $data[1]['department'] = 'บริบาลเภสัชกรรม';
  $data[1]['course'][0]['id'] = '463504';
  $data[1]['course'][0]['name'] = 'Natural Pharmaceutical Products';
  $data[1]['course'][1]['id'] = '463558';
  $data[1]['course'][1]['name'] = 'Pharmaceutical Compounding in Hospitals';
  $data[1]['course'][2]['id'] = '464541';
  $data[1]['course'][2]['name'] = 'Pharmacoepidemiology 2';
  $data[1]['course'][3]['id'] = '464504';
  $data[1]['course'][3]['name'] = 'Medication Risk Management and Drug Use Evaluation';
  $DATA['deadline']['edit']['day'] = '20';
  $DATA['deadline']['edit']['month'] = 'สิงหาคม';
  $DATA['deadline']['edit']['year'] = '2560';
  if($type == '4' || $type == '5')
  {
    $DATA['deadline']['con']['day'] = '22';
    $DATA['deadline']['con']['month'] = 'สิงหาคม';
    $DATA['deadline']['con']['year'] = '2560';
  }
  else if($type == '6')
  {
    $DATA['deadline']['approve']['day'] = '25';
    $DATA['deadline']['approve']['month'] = 'สิงหาคม';
    $DATA['deadline']['approve']['year'] = '2560';
  }
  $DATA['data'] = $data;
}
else
{

}
echo json_encode($DATA);
 ?>
