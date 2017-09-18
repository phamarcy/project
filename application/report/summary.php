<?php
require_once(__DIR__."/../config/configuration_variable.php");
require_once(__DIR__."/../lib/PHPExcel/Classes/PHPExcel.php");
require_once(__DIR__."/../class/database.php");
require_once(__DIR__."/../class/person.php");
require_once(__DIR__."/../class/manage_deadline.php");
$deadline = new Deadline();
$database = new Database();
$person = new Person();
$Excel = new PHPExcel();

if(isset($_GET['semester']) && isset($_GET['year']))
{
  $semester['semester'] = $_GET['semester'];
  $semester['year'] = $_GET['year'];
  $semester['id'] = $deadline->Search_Semester_id($semester['semester'],$semester['year']);
}
else
{
  die("ข้อมูลไม่ถูกต้อง");
}

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
     ),
    );
$border = array(
      'borders' => array(
          'allborders' => array(
              'style' => PHPExcel_Style_Border::BORDER_THIN
          )
      )
  );
$Excel->getDefaultStyle()
    ->applyFromArray($styleArray);
$sheet1 = $Excel->setActiveSheetIndex(0);


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

//bold heading
$Excel->getActiveSheet(0)->getStyle("A1:S3")->getFont()->setBold(true);
//cell border
$sheet1->getStyle('A1')->applyFromArray($border);
$sheet1->getStyle('A2:B2')->applyFromArray($border);
$sheet1->getStyle('A3:S3')->applyFromArray($border);
$Excel->getActiveSheet(0)
        ->setTitle('เกณฑ์การประเมินผล');
        foreach(range('A','Z') as $columnID)
        {
          $Excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }
$Excel->createSheet();
$sheet2 = $Excel->setActiveSheetIndex(1);
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
//bold heading
$sheet2->getStyle("A1:G3")->getFont()->setBold(true);
//border
$sheet2->getStyle('A1')->applyFromArray($border);
$sheet2->getStyle('A2:B2')->applyFromArray($border);
$sheet2->getStyle('A3:G3')->applyFromArray($border);
$Excel->getActiveSheet(1)
    ->setTitle('กรรมการคุมสอบ');
    foreach(range('A','Z') as $columnID)
    {
      $Excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
    }



$file_path = $FILE_PATH.'/temp';

$sql = "SELECT DISTINCT `course_id` FROM `approval_course` WHERE `status` = '7' AND `semester_id` = ".$semester['id'];
$result = $database->Query($sql);
if($result)
{
  $count = count($result);
  $Excel->setActiveSheetIndex(0);
  $row = 4;
  for($i=0;$i<$count;$i++)
  {
    $course_id = $result[$i]['course_id'];
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
        $committee .= $data['EXAM']['FINAL']['COMMITTEE']['LEC'][$j]."\n";
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
  $row--;
  $sheet1->getStyle('A4:S'.$row)->applyFromArray($border);
  $sheet2->getStyle('A4:G'.$row)->applyFromArray($border);
}

$Excel->createSheet();
$sheet3 = $Excel->setActiveSheetIndex(2);
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
            ->setCellValue('H3', 'ค่าสอน')
            ->setCellValue('I3', 'ค่าเดินทาง')
            ->setCellValue('J3', 'ค่าที่พัก')
            ->setCellValue('K3', 'รวมค่าใช้จ่าย');
//bold heading
$Excel->getActiveSheet(2)->getStyle("A1:K3")->getFont()->setBold(true);
//cell border
$sheet3->getStyle('A1')->applyFromArray($border); 
$sheet3->getStyle('A2:B2')->applyFromArray($border);
$sheet3->getStyle('A3:K3')->applyFromArray($border);
$Excel->getActiveSheet(2)
        ->setTitle('อาจารย์พิเศษ');

$file_path = $FILE_PATH.'/temp';


  $sql = "SELECT DISTINCT `course_id`,`instructor_id` FROM `course_hire`
  WHERE `semester_id` = ".$semester['id']." ORDER BY `course_id`";
  $result = $database->Query($sql);
  if($result)
  {
    $count = count($result);
    $row = 4;
    for($i=0;$i<$count;$i++)
    {
      $instructor_id = $result[$i]['instructor_id'];
      $course_id = $result[$i]['course_id'];
      $temp_file = $file_path.'/'.$course_id."/special_instructor/".$course_id."_".$instructor_id."_".$semester['semester']."_".$semester['year'].".txt";

      if(file_exists($temp_file))
      {
        $data = file_get_contents($temp_file);
        $data = json_decode($data,true);
        $instructor_name = $data["TEACHERDATA"]['PREFIX']." ".$data["TEACHERDATA"]['FNAME']." ".$data["TEACHERDATA"]["LNAME"];
        $Excel->setActiveSheetIndex(2)->setCellValue('A'.$row, $data["COURSEDATA"]["COURSE_ID"]);
        $Excel->setActiveSheetIndex(2)->setCellValue('B'.$row, $instructor_name);
        $Excel->setActiveSheetIndex(2)->setCellValue('C'.$row, $data["TEACHERDATA"]['POSITION']);
        $Excel->setActiveSheetIndex(2)->setCellValue('D'.$row, $data["TEACHERDATA"]['WORKPLACE']);
        $yet = '';
        $already = '';
        switch ($data["TEACHERDATA"]["HISTORY"]) {
          case 'yet':
            $yet = '/';
            break;
          case 'already':
            $already = '/';
            break;
          default:
            # code...
            break;
        }
        $Excel->setActiveSheetIndex(2)->setCellValue('E'.$row, $already);
        $Excel->setActiveSheetIndex(2)->setCellValue('F'.$row, $yet);
        $topic = '';
        $count_topic = count($data["COURSEDATA"]["DETAIL"]["TOPICLEC"]);
        for($j=0;$j<$count_topic;$j++)
        {
          $topic .= $data["COURSEDATA"]["DETAIL"]["TOPICLEC"][$j]."\n";
        }
        $Excel->setActiveSheetIndex(2)->setCellValue('G'.$row, $topic);

        $cost_trans = (float)$data["PAYMENT"]["COSTTRANS"]["TRANSPLANE"]["COST"] + (float)$data["PAYMENT"]["COSTTRANS"]["TRANSTAXI"]["COST"] + (float)$data["PAYMENT"]["COSTTRANS"]["TRANSSELFCAR"]["COST"];
        $Excel->setActiveSheetIndex(2)->setCellValue('H'.$row, $cost_trans);


        $Excel->setActiveSheetIndex(2)->setCellValue('I'.$row, $data["PAYMENT"]["COSTHOTEL"]["PERNIGHT"]);
        $Excel->setActiveSheetIndex(2)->setCellValue('J'.$row, $data["PAYMENT"]["TOTALCOST"]);
        $row++;
      }
    }
    $row--;
    $sheet3->getStyle('A4:K'.$row)->applyFromArray($border);
  }


foreach(range('A','Z') as $columnID)
  {
    $Excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
  }

$summary_file = __DIR__.'/../../files/summary/summary_'.$semester['semester'].'_'.$semester['year'].'.xlsx';


//save file
$objWriter = PHPExcel_IOFactory::createWriter($Excel, 'Excel2007');
$objWriter->save($summary_file);
die;
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.basename($summary_file).'"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($summary_file));
readfile($summary_file);

 ?>
