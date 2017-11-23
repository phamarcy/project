<?php
require_once(__DIR__."/../config/configuration_variable.php");
require_once(__DIR__."/../lib/PHPExcel/Classes/PHPExcel.php");
require_once(__DIR__."/../class/database.php");
require_once(__DIR__."/../class/person.php");
require_once(__DIR__."/../class/course.php");
require_once(__DIR__."/../class/log.php");
require_once(__DIR__."/../class/manage_deadline.php");
$deadline = new Deadline();
$database = new Database();
$person = new Person();
$course = new Course();
$Excel = new PHPExcel();
$log = new Log();
if(isset($_GET['semester']) && isset($_GET['year']) && isset($_GET['dept']))
{
  $semester['semester'] = $_GET['semester'];
  $semester['year'] = $_GET['year'];
  $dept_id = $_GET['dept'];
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
            ->setCellValue('A2', 'ภาคการศึกษาที่ '.$semester['semester'])
            ->setCellValue('B2', 'ปีการศึกษา '.$semester['year'])
            ->setCellValue('A3', 'กระบวนวิชา (รหัส)')
            ->setCellValue('B3', 'ผู้รับผิดชอบกระบวนวิชา 1')
            ->setCellValue('C3', 'ผู้รับผิดชอบกระบวนวิชา 2')
            ->setCellValue('D3', 'ผู้รับผิดชอบกระบวนวิชา 3')
            ->setCellValue('E3', 'ผู้รับผิดชอบกระบวนวิชา 4')
            ->setCellValue('F3', 'ผู้รับผิดชอบกระบวนวิชา 5')
            ->setCellValue('G3', 'อาจารย์ผู้ร่วมสอน')
            ->setCellValue('H3', 'คะแนนสอบกลางภาคครั้งที่ 1 (บรรยาย)')
            ->setCellValue('I3', 'คะแนนสอบกลางภาคครั้งที่ 1 (lab)')
            ->setCellValue('J3', 'คะแนนสอบกลางภาคครั้งที่ 2 (บรรยาย)')
            ->setCellValue('K3', 'คะแนนสอบกลางภาคครั้งที่ 2 (lab)')
            ->setCellValue('L3', 'คะแนนสอบไล่ (บรรยาย)')
            ->setCellValue('M3', 'คะแนนสอบไล่ (lab)')
            ->setCellValue('N3', 'คะแนนงานมอบหมาย')
            ->setCellValue('O3', 'คะแนนอื่นๆ')
            ->setCellValue('P3', 'ชม.สอบกลางภาคครั้งที่ 1 (บรรยาย)')
            ->setCellValue('Q3', 'ชม.สอบกลางภาคครั้งที่ 1 (lab)')
            ->setCellValue('R3', 'ชม.สอบกลางภาคครั้งที่ 2 (บรรยาย)')
            ->setCellValue('S3', 'ชม.สอบกลางภาคครั้งที่ 2 (lab)')
            ->setCellValue('T3', 'ชม.สอบไล่ (บรรยาย)')
            ->setCellValue('U3', 'ชม.สอบไล่ (lab)')
            ->setCellValue('V3', 'วิธีการตัดเกรด')
            ->setCellValue('W3', 'การให้ลำดับขั้นถ้านักศึกษาขาดสอบ');

//bold heading
$Excel->getActiveSheet(0)->getStyle("A1:W3")->getFont()->setBold(true);
//cell border
$sheet1->getStyle('A1')->applyFromArray($border);
$sheet1->getStyle('A2:B2')->applyFromArray($border);
$sheet1->getStyle('A3:T3')->applyFromArray($border);
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
                            ->setCellValue('A2', 'ภาคการศึกษาที่ '.$semester['semester'])
                            ->setCellValue('B2', 'ปีการศึกษา '.$semester['year'])
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
    $temp_course = $course->Get_Dept_Course($dept_id,$semester['id']);
    $dept_course = array();
    if(!isset($temp_course['status']))
    {
      for($i=0;$i<count($temp_course);$i++)
      {
        array_push($dept_course,$temp_course[$i]['id']);
      }
    }

$sql = "SELECT DISTINCT `course_id` FROM `course_evaluate` WHERE `status` = '1' AND `semester_id` = ".$semester['id'];
$result = $database->Query($sql);
if($result)
{
  $count = count($result);
  $Excel->setActiveSheetIndex(0);
  $row = 4;
  for($i=0;$i<$count;$i++)
  {
    $course_id = $result[$i]['course_id'];
    if(!in_array($course_id,$dept_course))
    {
      continue;
    }
    $data = $course->Get_Document('evaluate',$course_id,null,null,$semester['semester'],$semester['year']);
    if($data)
    {
      $Excel->setActiveSheetIndex(0)->setCellValue('A'.$row, $data['course_id']);
      $teacher = $course->Get_Responsible_Teacher($data['course_id'],$semester['id']);
      $Excel->setActiveSheetIndex(0)->setCellValue('B'.$row, (isset($data['teacher'][0]))? $data['teacher'][0] : '');
      $Excel->setActiveSheetIndex(0)->setCellValue('C'.$row, (isset($data['teacher'][1]))? $data['teacher'][1] : '');
      $Excel->setActiveSheetIndex(0)->setCellValue('D'.$row, (isset($data['teacher'][2]))? $data['teacher'][2] : '');
      $Excel->setActiveSheetIndex(0)->setCellValue('E'.$row, (isset($data['teacher'][3]))? $data['teacher'][3] : '');
      $Excel->setActiveSheetIndex(0)->setCellValue('F'.$row, (isset($data['teacher'][4]))? $data['teacher'][4] : '');
      $Excel->setActiveSheetIndex(0)->setCellValue('G'.$row, $data['teacher_co']);
      $Excel->setActiveSheetIndex(0)->setCellValue('H'.$row, $data['mid1_lec']);
      $Excel->setActiveSheetIndex(0)->setCellValue('I'.$row, $data['mid1_lab']);
      $Excel->setActiveSheetIndex(0)->setCellValue('J'.$row, $data['mid2_lec']);
      $Excel->setActiveSheetIndex(0)->setCellValue('K'.$row, $data['mid2_lab']);
      $Excel->setActiveSheetIndex(0)->setCellValue('L'.$row, $data['final_lec']);
      $Excel->setActiveSheetIndex(0)->setCellValue('M'.$row, $data['final_lab']);
      $Excel->setActiveSheetIndex(0)->setCellValue('N'.$row, $data['work_lec'] + $data['work_lab']);
      $Excel->setActiveSheetIndex(0)->setCellValue('O'.$row, $data['other_lec'] + $data['other_lab']);
      $Excel->setActiveSheetIndex(0)->setCellValue('P'.$row, $data['mid1_hour_lec']);
      $Excel->setActiveSheetIndex(0)->setCellValue('Q'.$row, $data['mid1_hour_lab']);
      $Excel->setActiveSheetIndex(0)->setCellValue('R'.$row, $data['mid2_hour_lec']);
      $Excel->setActiveSheetIndex(0)->setCellValue('S'.$row, $data['mid2_hour_lab']);
      $Excel->setActiveSheetIndex(0)->setCellValue('T'.$row, $data['final_hour_lec']);
      $Excel->setActiveSheetIndex(0)->setCellValue('U'.$row, $data['final_hour_lab']);
      $calculate = '';
      if($data['criterion_type'] == "GROUP")
      {
        $calculate = $data['explaination'];
      }
      else if($data['criterion_type'] == 'CRITERIA')
      {
      	$calculate = 'อิงเกณฑ์';
      }
      else if ($data['criterion_type'] == 'SU')
      {
      	$calculate = 'ให้อักษร S U';
      }
      $Excel->setActiveSheetIndex(0)->setCellValue('V'.$row, $calculate);

      $absent = '';
      if($data['absent'] == 'F')
      {
      	$absent = 'ให้ลำดับขั้น F';
      }
      else if($data['absent'] == 'U')
      {
      	$absent = 'ให้อักษร U';
      }
      else if($data['absent'] == 'CAL')
      {
      	$absent = 'นำคะแนนทั้งหมดมาประเมิน';
      }
      $Excel->setActiveSheetIndex(0)->setCellValue('W'.$row,$absent);
      $Excel->setActiveSheetIndex(1)->setCellValue('A'.$row,$data['course_id']);
      $count_committee = count($data['exam_mid1_committee_lec']);
      $committee = '';
      for($j=0;$j<$count_committee;$j++)
      {
        $committee .= $data['exam_mid1_committee_lec'][$j]."\n";

      }
      $Excel->setActiveSheetIndex(1)->setCellValue('B'.$row,$committee);

      $count_committee = count($data['exam_mid1_committee_lab']);
      $committee = '';
      for($j=0;$j<$count_committee;$j++)
      {
        $committee .= $data['exam_mid1_committee_lab'][$j]."\n";

      }
      $Excel->setActiveSheetIndex(1)->setCellValue('C'.$row,$committee);

      $count_committee = count($data['exam_mid2_committee_lec']);
      $committee = '';
      for($j=0;$j<$count_committee;$j++)
      {
        $committee .= $data['exam_mid2_committee_lec'][$j]."\n";
      }
      $Excel->setActiveSheetIndex(1)->setCellValue('D'.$row,$committee);

      $count_committee = count($data['exam_mid2_committee_lab']);
      $committee = '';
      for($j=0;$j<$count_committee;$j++)
      {
        $committee .= $data['exam_mid2_committee_lab'][$j]."\n";
      }
      $Excel->setActiveSheetIndex(1)->setCellValue('E'.$row,$committee);

      $count_committee = count($data['exam_final_committee_lec']);
      $committee = '';
      for($j=0;$j<$count_committee;$j++)
      {
        $committee .= $data['exam_final_committee_lec'][$j]."\n";
      }
      $Excel->setActiveSheetIndex(1)->setCellValue('F'.$row,$committee);
      $count_committee = count($data['exam_final_committee_lab']);
      $committee = '';
      for($j=0;$j<$count_committee;$j++)
      {
        $committee .= $data['exam_final_committee_lab'][$j]."\n";
      }
      $Excel->setActiveSheetIndex(1)->setCellValue('G'.$row,$committee);

      $row++;
    }
    else
    {
      $log->Write("not found ".$temp_file);
    }
  }
  $row--;
  $sheet1->getStyle('A4:W'.$row)->applyFromArray($border);
  $sheet2->getStyle('A4:G'.$row)->applyFromArray($border);
}

$Excel->createSheet();
$sheet3 = $Excel->setActiveSheetIndex(2);
$Excel->getDefaultStyle()
    ->applyFromArray($styleArray);
$Excel->setActiveSheetIndex(2)
            ->setCellValue('A1', 'รายงานสรุปการเชิญอาจารย์พิเศษ')
            ->setCellValue('A2', 'ภาคการศึกษาที่ '.$semester['semester'])
            ->setCellValue('B2', 'ปีการศึกษา '.$semester['year'])
            ->setCellValue('A3', 'กระบวนวิชา (รหัส)')
            ->setCellValue('B3', 'ชื่อ-สกุลอาจารย์พิเศษ')
            ->setCellValue('C3', 'ตำแหน่ง')
            ->setCellValue('D3', 'สถานที่ติดต่อ')
            ->setCellValue('E3', 'เคยเชิญมาสอนแล้ว')
            ->setCellValue('F3', 'ยังไม่เคยเชิญมาสอน')
            ->setCellValue('G3', 'หัวข้อที่สอน')
            ->setCellValue('H3', 'วันที่สอน')
            ->setCellValue('I3', 'เวลาที่สอน')
            ->setCellValue('J3', 'สถานที่')
            ->setCellValue('K3', 'ค่าสอน')
            ->setCellValue('L3', 'ค่าเดินทาง')
            ->setCellValue('M3', 'ค่าที่พัก')
            ->setCellValue('N3', 'รวมค่าใช้จ่าย');
//bold heading
$Excel->getActiveSheet(2)->getStyle("A1:N3")->getFont()->setBold(true);
//cell border
$sheet3->getStyle('A1')->applyFromArray($border);
$sheet3->getStyle('A2:B2')->applyFromArray($border);
$sheet3->getStyle('A3:N3')->applyFromArray($border);
$Excel->getActiveSheet(2)
        ->setTitle('อาจารย์พิเศษ');
  $sql = "SELECT DISTINCT `course_id`,`instructor_id` FROM `course_hire_special_instructor`
  WHERE `semester_id` = ".$semester['id']." AND `status` = '1' ORDER BY `course_id`";
  $result = $database->Query($sql);
  if($result)
  {
    $count = count($result);
    $row = 4;
    for($i=0;$i<$count;$i++)
    {
      $instructor_id = $result[$i]['instructor_id'];
      $course_id = $result[$i]['course_id'];
      if(!in_array($course_id,$dept_course))
      {
        continue;
      }
      $data = $course->Get_Document('special',$course_id,$instructor_id,null,$semester['semester'],$semester['year']);
      if($data)
      {
        $instructor_name = $data["prefix"]." ".$data["firstname"]." ".$data["lastname"];
        $Excel->setActiveSheetIndex(2)->setCellValue('A'.$row, $course_id);
        $Excel->setActiveSheetIndex(2)->setCellValue('B'.$row, $instructor_name);
        $Excel->setActiveSheetIndex(2)->setCellValue('C'.$row, $data["position"]);
        $Excel->setActiveSheetIndex(2)->setCellValue('D'.$row, $data["work_place"]);
        $yet = '';
        $already = '';
        switch ($data["invited"]) {
          case '0':
            $yet = '/';
            break;
          case '1':
            $already = '/';
            break;
          default:
            # code...
            break;
        }
        $Excel->setActiveSheetIndex(2)->setCellValue('E'.$row, $already);
        $Excel->setActiveSheetIndex(2)->setCellValue('F'.$row, $yet);
        $topic = '';
        $teach_date = '';
        $teach_time = '';
        $teach_room = '';
        $count_topic = $data["num_table"];
        for($j=0;$j<$count_topic;$j++)
        {
          $topic .= $data["lecture_detail"][$j]["topic_name"]."\n";
          $teach_date .= $data["lecture_detail"][$j]["teaching_date"]."\n";

          $time_start = strtotime($data["lecture_detail"][$j]["teaching_time_start"]);
          $time_end = strtotime($data["lecture_detail"][$j]["teaching_time_end"]);

          $time_start_format = date('H:i',$time_start);
          $time_end_format = date('H:i',$time_end);

          $teach_time .= $time_start_format.' น. - '.$time_end_format.' น.'."\n";

          $teach_room .= $data["lecture_detail"][$j]["teaching_room"]."\n";
        }
        $Excel->setActiveSheetIndex(2)->setCellValue('G'.$row, $topic);

        $Excel->setActiveSheetIndex(2)->setCellValue('H'.$row, $teach_date);

        $Excel->setActiveSheetIndex(2)->setCellValue('I'.$row, $teach_time);

        $Excel->setActiveSheetIndex(2)->setCellValue('J'.$row, $teach_room);

        $Excel->setActiveSheetIndex(2)->setCellValue('K'.$row, $data["expense_lec_cost"]);

        $cost_trans = (float)$data["expense_plane_cost"] + (float)$data["expense_taxi_cost"] + (float)$data["expense_car_cost"];
        $Excel->setActiveSheetIndex(2)->setCellValue('L'.$row, $cost_trans);


        $Excel->setActiveSheetIndex(2)->setCellValue('M'.$row, $data["expense_hotel_cost"]);
        $Excel->setActiveSheetIndex(2)->setCellValue('N'.$row, $data["cost_total"]);
        $row++;
      }
    }
    $row--;
    $sheet3->getStyle('A4:N'.$row)->applyFromArray($border);
  }


foreach(range('A','Z') as $columnID)
  {
    $Excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
  }
$SUMMARY_PATH = $FILE_PATH."/summary";
if (!is_dir($SUMMARY_PATH))
{
    mkdir($SUMMARY_PATH);
}
$summary_file = $SUMMARY_PATH.'/summary_'.$dept_id.'_'.$semester['semester'].'_'.$semester['year'].'.xlsx';


//save file
$objWriter = PHPExcel_IOFactory::createWriter($Excel, 'Excel2007');
$objWriter->save($summary_file);
// ob_end_clean();
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.basename($summary_file).'"');
header('Content-Length: ' . filesize($summary_file));
readfile($summary_file);

 ?>
