<?php
require_once(__DIR__."/../config/configuration_variable.php");
require_once(__DIR__."/../lib/PHPExcel/Classes/PHPExcel.php");
require_once(__DIR__."/../class/database.php");
require_once(__DIR__."/../class/person.php");
require_once(__DIR__."/../class/manage_deadline.php");
$deadline = new Deadline();
$database = new Database();
$person = new Person();
$semester = $deadline->Get_Current_Semester();
$Excel = new PHPExcel();

$styleArray = array(
    'font'  => array(
        'color' => array('rgb' => '#000000'),
        'size'  => 15,
        'name'  => 'TH SarabunPSK'
    ),
    'alignment' => array(
         'wrap' => true,
         'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
         'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP
     ),'
     borders' => array(
  		'outline' => array(
  			'style' => PHPExcel_Style_Border::BORDER_THICK,
  			'color' => array('argb' => 'FFFF0000'),
  		)
    )
    );
$Excel->getDefaultStyle()
    ->applyFromArray($styleArray);

$Excel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'รายงานสรุปแบบวัดผลประเมินผล')
            ->setCellValue('A2', 'ภาคการศึกษาที่ 1')
            ->setCellValue('B2', 'ปีการศึกษา 2560')
            ->setCellValue('A3', 'กระบวนวิชา (รหัส)')
            ->setCellValue('B3', 'ผู้รับผิดชอบกระบวนวิชา 1')
            ->setCellValue('C3', 'ผู้รับผิดชอบกระบวนวิชา 2')
            ->setCellValue('D3', 'คะแนนสอบกลางภาคครั้งที่ 1 (บรรยาย)')
            ->setCellValue('E3', 'คะแนนสอบกลางภาคครั้งที่ 1 (lab)')
            ->setCellValue('F3', 'คะแนนสอบกลางภาคครั้งที่ 2 (บรรยาย)')
            ->setCellValue('G3', 'คะแนนสอบกลางภาคครั้งที่ 2 (lab)')
            ->setCellValue('H3', 'คะแนนสอบไล่ (บรรยาย)')
            ->setCellValue('I3', 'คะแนนสอบไล่ (lab)')
            ->setCellValue('J3', 'คะแนนงานมอบหมาย')
            ->setCellValue('K3', 'คะแนนอื่นๆ')
            ->setCellValue('L3', 'ชม.สอบกลางภาคครั้งที่ 1 (บรรยาย)')
            ->setCellValue('M3', 'ชม.สอบกลางภาคครั้งที่ 1 (lab)')
            ->setCellValue('N3', 'ชม.สอบกลางภาคครั้งที่ 2 (บรรยาย)')
            ->setCellValue('O3', 'ชม.สอบกลางภาคครั้งที่ 2 (lab)')
            ->setCellValue('P3', 'ชม.สอบไล่ (บรรยาย)')
            ->setCellValue('Q3', 'ชม.สอบไล่ (lab)')
            ->setCellValue('R3', 'วิธีการตัดเกรด')
            ->setCellValue('S3', 'การให้ลำดับขั้นถ้านักศึกษาขาดสอบ');

$Excel->getActiveSheet(0)
        ->setTitle('เกณฑ์การประเมินผล');
        foreach(range('A','Z') as $columnID)
        {
          $Excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }
$Excel->createSheet();
$Excel->getDefaultStyle()
    ->applyFromArray($styleArray);
        $Excel->setActiveSheetIndex(1)
                            ->setCellValue('A1', 'รายชื่อกรรมการคุมสอบ')
                            ->setCellValue('A2', 'ภาคการศึกษาที่ 1')
                            ->setCellValue('B2', 'ปีการศึกษา 2560')
                            ->setCellValue('A3', 'กระบวนวิชา (รหัส)')
                            ->setCellValue('B3', 'สอบกลางภาคครั้งที่ 1 (บรรยาย)')
                            ->setCellValue('C3', 'สอบกลางภาคครั้งที่ 1 (lab)')
                            ->setCellValue('D3', 'สอบกลางภาคครั้งที่ 2 (บรรยาย)')
                            ->setCellValue('E3', 'สอบกลางภาคครั้งที่ 2 (lab)')
                            ->setCellValue('F3', 'สอบไล่ (บรรยาย)')
                            ->setCellValue('G3', 'สอบไล่ (lab)');
$Excel->getActiveSheet(1)
    ->setTitle('กรรมการคุมสอบ');
    foreach(range('A','Z') as $columnID)
    {
      $Excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
    }
$file_path = $FILE_PATH.'/temp';

$sql = "SELECT DISTINCT `course_id` FROM `approval_course` WHERE `status` = '7'";
$result = $database->Query($sql);
if($result)
{
  $count = count($result);
  for($i=0;$i<$count;$i++)
  {
    $course_id = $result[$i]['course_id'];
    $row = 4;
    $temp_file = $file_path.'/'.$course_id."/evaluate/".$course_id."_evaluate_".$semester['semester']."_".$semester['year'].".txt";
    if(file_exists($temp_file))
    {
      $data = file_get_contents($temp_file);
      $data = json_decode($data,true);
      $Excel->setActiveSheetIndex(0)->setCellValue('A'.$row, $data['COURSE_ID']);

      $teacher_name = $person->Get_Teacher_Name($data['USERID']);
      $Excel->setActiveSheetIndex(0)->setCellValue('B'.$row, $teacher_name);
      $Excel->setActiveSheetIndex(0)->setCellValue('C'.$row, '');
      $Excel->setActiveSheetIndex(0)->setCellValue('D'.$row, $data['MEASURE']['MID1']['LEC']);
      $Excel->setActiveSheetIndex(0)->setCellValue('E'.$row, $data['MEASURE']['MID1']['LAB']);
      $Excel->setActiveSheetIndex(0)->setCellValue('F'.$row, $data['MEASURE']['MID2']['LEC']);
      $Excel->setActiveSheetIndex(0)->setCellValue('G'.$row, $data['MEASURE']['MID2']['LAB']);
      $Excel->setActiveSheetIndex(0)->setCellValue('H'.$row, $data['MEASURE']['FINAL']['LEC']);
      $Excel->setActiveSheetIndex(0)->setCellValue('I'.$row, $data['MEASURE']['FINAL']['LAB']);
      $Excel->setActiveSheetIndex(0)->setCellValue('J'.$row, $data['MEASURE']['WORK']['LEC'] + $data['MEASURE']['WORK']['LAB']);
      $Excel->setActiveSheetIndex(0)->setCellValue('K'.$row, $data['MEASURE']['OTHER']['LEC'] + $data['MEASURE']['OTHER']['LAB']);
      $Excel->setActiveSheetIndex(0)->setCellValue('L'.$row, $data['EXAM']['MID1']['HOUR']['LEC']);
      $Excel->setActiveSheetIndex(0)->setCellValue('M'.$row, $data['EXAM']['MID1']['HOUR']['LAB']);
      $Excel->setActiveSheetIndex(0)->setCellValue('N'.$row, $data['EXAM']['MID2']['HOUR']['LEC']);
      $Excel->setActiveSheetIndex(0)->setCellValue('O'.$row, $data['EXAM']['MID2']['HOUR']['LAB']);
      $Excel->setActiveSheetIndex(0)->setCellValue('P'.$row, $data['EXAM']['FINAL']['HOUR']['LEC']);
      $Excel->setActiveSheetIndex(0)->setCellValue('Q'.$row, $data['EXAM']['FINAL']['HOUR']['LAB']);
      $calculate = '';
      if($data['CALCULATE']['TYPE'] == "GROUP")
      {
        $calculate = $data['CALCULATE']['EXPLAINATION'];
      }
      else if($data['CALCULATE']['TYPE'] == 'CRITERIA')
      {
      	$calculate = 'อิงเกณฑ์';
      }
      else if ($data['CALCULATE']['TYPE'] == 'SU')
      {
      	$calculate = 'ให้อักษร S U';
      }
      $Excel->setActiveSheetIndex(0)->setCellValue('R'.$row, $calculate);

      $absent = '';
      if($data['ABSENT'] == 'F')
      {
      	$absent = 'ให้ลำดับขั้น F';
      }
      else if($data['ABSENT'] == 'U')
      {
      	$absent = 'ให้อักษร U';
      }
      else if($data['ABSENT'] == 'CAL')
      {
      	$absent = 'นำคะแนนทั้งหมดมาประเมิน';
      }
      $Excel->setActiveSheetIndex(0)->setCellValue('S'.$row,$absent);
      $Excel->setActiveSheetIndex(1)->setCellValue('A'.$row,$data['COURSE_ID']);
      $count_committee = count($data['EXAM']['MID1']['COMMITTEE']['LEC']);
      $committee = '';
      for($j=0;$j<$count_committee;$j++)
      {
        $committee .= $data['EXAM']['MID1']['COMMITTEE']['LEC'][$j]."\n";

      }
      $Excel->setActiveSheetIndex(1)->setCellValue('B'.$row,$committee);

      $count_committee = count($data['EXAM']['MID1']['COMMITTEE']['LAB']);
      $committee = '';
      for($j=0;$j<$count_committee;$j++)
      {
        $committee .= $data['EXAM']['MID1']['COMMITTEE']['LAB'][$j]."\n";

      }
      $Excel->setActiveSheetIndex(1)->setCellValue('C'.$row,$committee);

      $count_committee = count($data['EXAM']['MID2']['COMMITTEE']['LEC']);
      $committee = '';
      for($j=0;$j<$count_committee;$j++)
      {
        $committee .= $data['EXAM']['MID2']['COMMITTEE']['LEC'][$j]."\n";
      }
      $Excel->setActiveSheetIndex(1)->setCellValue('D'.$row,$committee);

      $count_committee = count($data['EXAM']['MID2']['COMMITTEE']['LAB']);
      $committee = '';
      for($j=0;$j<$count_committee;$j++)
      {
        $committee .= $data['EXAM']['MID2']['COMMITTEE']['LAB'][$j]."\n";
      }
      $Excel->setActiveSheetIndex(1)->setCellValue('E'.$row,$committee);

      $count_committee = count($data['EXAM']['FINAL']['COMMITTEE']['LEC']);
      $committee = '';
      for($j=0;$j<$count_committee;$j++)
      {
        $committee .= $data['EXAM']['FINAL']['COMMITTEE']['LAB'][$j]."\n";
      }
      $Excel->setActiveSheetIndex(1)->setCellValue('F'.$row,$committee);

      $count_committee = count($data['EXAM']['FINAL']['COMMITTEE']['LAB']);
      $committee = '';
      for($j=0;$j<$count_committee;$j++)
      {
        $committee .= $data['EXAM']['FINAL']['COMMITTEE']['LAB'][$j]."\n";
      }
      $Excel->setActiveSheetIndex(1)->setCellValue('G'.$row,$committee);

      $row++;
    }
    else
    {
      echo "not found ".$temp_file;
    }
  }
}

$Excel->createSheet();
$Excel->getDefaultStyle()
    ->applyFromArray($styleArray);
$Excel->setActiveSheetIndex(2)
            ->setCellValue('A1', 'รายงานสรุปการเชิญอาจารย์พิเศษ')
            ->setCellValue('A2', 'ภาคการศึกษาที่ 1')
            ->setCellValue('B2', 'ปีการศึกษา 2560')
            ->setCellValue('A3', 'กระบวนวิชา (รหัส)')
            ->setCellValue('B3', 'ชื่อ-สกุลอาจารย์พิเศษ')
            ->setCellValue('C3', 'ตำแหน่ง')
            ->setCellValue('D3', 'สถานที่ติดต่อ')
            ->setCellValue('E3', 'เคยเชิญมาสอนแล้ว')
            ->setCellValue('F3', 'ยังไม่เคยเชิญมาสอน')
            ->setCellValue('G3', 'หัวข้อที่สอน')
            ->setCellValue('H3', 'คะแนนอื่นๆ')
            ->setCellValue('I3', 'ค่าสอน')
            ->setCellValue('J3', 'ค่าเดินทาง')
            ->setCellValue('K3', 'ค่าที่พัก')
            ->setCellValue('L3', 'รวมค่าใช้จ่าย');
$Excel->getActiveSheet(2)
        ->setTitle('อาจารย์พิเศษ');

foreach(range('A','Z') as $columnID)
  {
    $Excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
  }




//save file
$objWriter = PHPExcel_IOFactory::createWriter($Excel, 'Excel2007');
$objWriter->save(__DIR__.'/../../files/summary/test_summary_data.xlsx');

 ?>
