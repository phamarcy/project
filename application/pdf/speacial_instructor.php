<?php 
require_once('fpdf17/fpdf.php');
require_once('thai_date.php');
define('FPDF_FONTPATH','font/');

$pdf=new FPDF();

$pdf->AddPage();
$pdf->SetMargins(20,10,20,0);
$pdf->AddFont('angsa','','angsa.php');
$pdf->AddFont('angsab','','angsab.php');
$pdf->AddFont('cordia','','cordia.php');
$pdf->AddFont('ZapfDingbats','','zapfdingbats.php');

$pdf->SetFont('angsab','',14);
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','แบบขออนุมัติเชิญอาจารย์พิเศษ'),0,1,"C");

$pdf->SetX(75);
$pdf->Cell(10,7,iconv( 'UTF-8','TIS-620','ภาควิชา'),0,"C");
$pdf->SetFont('angsa','',14);
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','    '.'บริบาลเภสัชกรรม'.'     '),0,"C");
$pdf->Ln();

$pdf->SetX(60);
$pdf->SetFont('angsab','',14);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620','ภาคการศึกษาที่'),0,"C");
$pdf->SetFont('angsa','',14);
$pdf->Cell(15,7,iconv( 'UTF-8','TIS-620','        '.'2'.'         '),0,"C");
$pdf->SetFont('angsab','',14);
$pdf->Cell(15,7,iconv( 'UTF-8','TIS-620','ปีการศึกษา'),0,"C");
$pdf->SetFont('angsa','',14);
$pdf->Cell(10,7,iconv( 'UTF-8','TIS-620','        '.'2559'.'         '),0,"C");
$pdf->Ln();
#1
$pdf->SetFont('angsab','',14);
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','๑. รายละเอียดของอาจารพิเศษ'),0,1);

$pdf->SetX(25);
$pdf->SetFont('angsa','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','๑.๑ ชื่อ ')),7,iconv( 'UTF-8','TIS-620','๑.๑ ชื่อ '),0,"C");

$RANK = 'นาย';
$FIRSTNAME = 'เกรียงไกร';
$LASTNAME = 'ยังฉิม';
$space_firstname = '';
$space_lastname = '';
$count = 80 - strlen($RANK) - strlen($FIRSTNAME);
for($i=0;$i<$count;$i++)
{
	$space_firstname .= ' ';
}
$count = 80 - strlen($LASTNAME);
for($i=0;$i<$count;$i++)
{
	$space_lastname .= ' ';
}
$pdf->Cell(60,7,iconv( 'UTF-8','TIS-620','    '.$RANK.' '.$FIRSTNAME.'  '.$space_firstname),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','นามสกุล ')),7,iconv( 'UTF-8','TIS-620','นามสกุล '),0,"C");
$pdf->Cell(60,7,iconv( 'UTF-8','TIS-620','    '.$LASTNAME.'  '.$space_lastname),0,"C");

$pdf->Ln();

$pdf->SetX(25);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','๑.๒ ตำแหน่ง ')),7,iconv( 'UTF-8','TIS-620','๑.๒ ตำแหน่ง '),0,"C");
$POSITION = 'เภสัชกรชำนาญการ';
$count = 155 - strlen($POSITION);
$space_position = '';
for($i=0;$i<$count;$i++)
{
	$space_position .= ' ';
}
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','        '.$POSITION.$space_position),0,1);

$pdf->SetX(25);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','๑.๓ คุณวุฒิ/สาขาที่เชี่ยวชาญ ')),7,iconv( 'UTF-8','TIS-620','๑.๓ คุณวุฒิ/สาขาที่เชี่ยวชาญ '),0,"C");
$QUALIFICATION = 'เภสัชศาสตร์มหาบัณฑิต สาขาการจัดการเภสัชกรรม / การคุ้มครองผู้บริโภคด้านสาธารณสุข';
$count = 155 - strlen($QUALIFICATION);
$space_qualification = '';
for($i=0;$i<$count;$i++)
{
	$space_qualification .= ' ';
}
$pdf->Write(7,iconv( 'UTF-8','TIS-620','    '.$QUALIFICATION.$space_qualification),0,1);
$pdf->Ln();
$pdf->SetX(25);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','๑.๔ สถานที่ทำงาน    ')),7,iconv( 'UTF-8','TIS-620','๑.๔ สถานที่ทำงาน    '),0,"C");
$pdf->Write( 7 , iconv( 'UTF-8','TIS-620' , 'กลุ่มงานคุ้มครองผู้บริโภค' ) );
$pdf->Ln();

$pdf->SetX(25);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','๑.๔ สถานที่ติดต่อ    ')),7,iconv( 'UTF-8','TIS-620','๑.๔ สถานที่ติดต่อ    '),0,"C");
$pdf->Write( 7 , iconv( 'UTF-8','TIS-620' , '263 ต.เมืองง่า อ.เมือง จ.ลำพูน' ) );
$pdf->Ln();
$pdf->SetX(30);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','โทรศัพท์ '.'089-851-2480'.' ต่อ '.' - ')),7,iconv( 'UTF-8','TIS-620','โทรศัพท์ '.'089-851-2480'.' ต่อ '.' - '),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','โทรสาร '.'089-851-2480'))+3,7,iconv( 'UTF-8','TIS-620','โทรสาร '.'089-851-2480'),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','อีเมลล์ '.' adiluckyo@gmail.com')),7,iconv( 'UTF-8','TIS-620','อีเมลล์ '.' adiluckyo@gmail.com'),0,1,"C");
#2
$pdf->SetFont('angsab','',14);
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','๒ รายละเอียดกระบวนวิชา'),0,1);

$pdf->SetX(25);
$pdf->SetFont('angsa','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','๒.๑ กระบวนวิชาที่สอน    ')),9,iconv( 'UTF-8','TIS-620','๒.๑ กระบวนวิชาที่สอน    '),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','462452')),9,iconv( 'UTF-8','TIS-620',' 462452 '),0,1,'C');

$pdf->SetX(25);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','๒.๒ กระบวนวิชานี้เป็นวิชา'))+5,7,iconv( 'UTF-8','TIS-620','๒.๒ กระบวนวิชานี้เป็นวิชา'),0);
$pdf->SetFont('ZapfDingbats','',14);
$pdf->Cell(4,4, 3, 1,"C");
$pdf->SetFont('angsa','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','อารจารย์พิเศษยังไม่เคยสอน'))+5,7,iconv( 'UTF-8','TIS-620',' บังคับ'),0,"C");
$pdf->SetFont('ZapfDingbats','',14);
$pdf->Cell(4,4, '', 1,"C");
$pdf->SetFont('angsa','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','อารจารย์พิเศษยังไม่เคยสอน'))+5,7,iconv( 'UTF-8','TIS-620',' เลือก'),0,"C");
$pdf->Ln();
$pdf->SetX($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','๒.๒ กระบวนวิชานี้เป็นวิชา'))+30);

$pdf->SetFont('ZapfDingbats','',14);
$pdf->Cell(4,4, '', 1,"C");
$pdf->SetFont('angsa','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','อารจารย์พิเศษยังไม่เคยสอน'))+5,7,iconv( 'UTF-8','TIS-620',' เปิดใหม่'),0,"C");

$pdf->SetFont('ZapfDingbats','',14);
$pdf->Cell(4,4, '', 1,"C");
$pdf->SetFont('angsa','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','อารจารย์พิเศษยังไม่เคยสอน'))+5,7,iconv( 'UTF-8','TIS-620',' เปิดอยู่แล้ว'),0,"C");
$pdf->Ln();

$pdf->SetX(32);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','กระบวนวิชานี้เป็นวิชา'))+5,7,iconv( 'UTF-8','TIS-620','หัวข้อที่เชิญมาสอน      '),0,"C");
$pdf->SetFont('ZapfDingbats','',14);
$pdf->Cell(4,4, '', 1,"C");
$pdf->SetFont('angsa','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','อารจารย์พิเศษยังไม่เคยสอน'))+5,7,iconv( 'UTF-8','TIS-620',' อารจารย์พิเศษยังไม่เคยสอน'),0);
$pdf->SetFont('ZapfDingbats','',14);
$pdf->Cell(4,4, '', 1,"C");
$pdf->SetFont('angsa','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','อารจารย์พิเศษเคยสอนมาแล้ว'))+5,7,iconv( 'UTF-8','TIS-620',' อารจารย์พิเศษเคยสอนมาแล้ว'),0);
$pdf->Ln();

$pdf->SetX(32);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','จำนวนชั่วโมงของหัวข้อที่เชิญมาสอนคิดเป็นร้อยละ'))+5,7,iconv( 'UTF-8','TIS-620','จำนวนชั่วโมงของหัวข้อที่เชิญมาสอนคิดเป็นร้อยละ'),0,"C");
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',' ๖.๗ '),0);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','ของทั้งกระบวนวิชา'))+5,7,iconv( 'UTF-8','TIS-620','ของทั้งกระบวนวิชา'),0,"C");
$pdf->Ln();

$pdf->SetX(25);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','๒.๓ เหตุผลและความจำเป็นในการเชิญอาจารย์พิเศษ   ')),7,iconv( 'UTF-8','TIS-620','๒.๓ เหตุผลและความจำเป็นในการเชิญอาจารย์พิเศษ'),0,1,"C");
$pdf->SetX(35);
$pdf->Write(7,iconv( 'UTF-8','TIS-620','เป็นผู้ที่มีประสบการณ์และความเชี่ยวชาญด้านการคุ้มครองผู้บริโภคด้านสุขภาพ'));
$pdf->Ln();
$pdf->SetX(25);
$pdf->Cell(0,7,iconv('UTF-8','TIS-620','๒.๔ รายละเอียดในการสอน'),0,1);
$pdf->SetX(35);
$pdf->Cell(70,7,iconv( 'UTF-8','TIS-620','หัวข้อบรรยาย ปฏิบัติการ '));
$pdf->Cell(30,7,iconv( 'UTF-8','TIS-620','ว/ด/ป ที่สอน '));
$pdf->Cell(30,7,iconv( 'UTF-8','TIS-620','เวลา '));
$pdf->Cell(30,7,iconv( 'UTF-8','TIS-620','ห้องเรียน'));
$pdf->Ln();
$TOPIC[0] = 'ปัญหาด้านยาและผลิตภัณฑ์สุขภาพในเชงกฏหม';
$TOPIC[1] = 'ปัญหาด้านยาและผลิตภัณฑ์สุขภาพในเชงกฏหมายและการคุ้มครองผู้บริโภค';
for($i=0;$i<count($TOPIC);$i++)
{
	$num = $i+1;
	$pdf->SetX(30);
	$pdf->Cell(5,7,iconv('UTF-8','TIS-620',$num.'.'));
	$pdf->SetX(35);
	$before_y = $pdf->GetY();
	$before_x = $pdf->GetX();
	$pdf->MultiCell( 70, 7, iconv( 'UTF-8','TIS-620',$TOPIC[$i]), 0,1);
	//$pdf->Ln();
	$current_y = $pdf->GetY();
	$current_x = $pdf->GetX();

	$pdf->SetXY($before_x + 70, $before_y);
	$pdf->Cell(30,7,iconv('UTF-8','TIS-620','๑๔ ก.พ. ๒๕๖๐'));

	$current_x += 30;
	$pdf->SetXY($before_x + 100, $before_y);
	$pdf->Cell(30,7,iconv('UTF-8','TIS-620','๑๐.๓๐ - ๑๒.๐๐'));

	$current_x += 30;
	$pdf->SetXY($before_x + 130 , $before_y);
	$pdf->Cell(30,7,iconv('UTF-8','TIS-620','๓๐๖'),0,1);

	$pdf->SetXY($current_x, $current_y);


}
$pdf->SetX(20);
$pdf->SetFont('angsab','',14);
$pdf->Cell(0,7,iconv( 'UTF-8','TIS-620','๓ ค่าใช้จ่าย'),0,1);

$pdf->SetX(30);
$pdf->SetFont('angsa','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','อาจารย์พิเศษเป็น '))+3,7,iconv('UTF-8','TIS-620','อาจารย์พิเศษเป็น'),0);

$pdf->SetFont('ZapfDingbats','',14);
$pdf->Cell(4,4, 3, 1,"C");
$pdf->SetFont('angsa','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','ข้าราชการ'))+1,7,iconv( 'UTF-8','TIS-620',' ข้าราชการ'),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','ระดับ '))+2,7,iconv( 'UTF-8','TIS-620',' ระดับ '),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','ชำนาญการ '))+5,7,iconv( 'UTF-8','TIS-620',' ชำนาญการ '),0,"C");

$pdf->SetFont('ZapfDingbats','',14);
$pdf->Cell(4,4, '', 1,"C");
$pdf->SetFont('angsa','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','บุคคลเอกชนเทียบตำแหน่ง'))+1,7,iconv( 'UTF-8','TIS-620',' บุคคลเอกชนเทียบตำแหน่ง'),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','ระดับ '))+2,7,iconv( 'UTF-8','TIS-620',' ระดับ '),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','ชำนาญการ '))+2,7,iconv( 'UTF-8','TIS-620','  '),0,"C");
$pdf->Ln();
$pdf->SetX(25);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','๓.๑ ค่าสอนพิเศษ '))+3,10,iconv('UTF-8','TIS-620','๓.๑ ค่าสอนพิเศษ'),0,1);

$pdf->SetX(40);
$pdf->SetFont('ZapfDingbats','',14);
$pdf->Cell(4,4, 3, 1,"C");
$pdf->SetFont('angsa','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','ปริญญาตรีปฏิบัติการ ๔๐๐/ชม.'))+1,7,iconv( 'UTF-8','TIS-620',' ปริญญาตรีบรรยาย ๔๐๐/ชม.'),0);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620',' จำนวน   '))+2,7,iconv( 'UTF-8','TIS-620','  จำนวน   '),0);
$pdf->Cell(13,7,iconv( 'UTF-8','TIS-620','๓๐๐'),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620',' ชั่วโมง'))+2,7,iconv( 'UTF-8','TIS-620','  ชั่วโมง'),0);
$pdf->SetX($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','รถยนต์ส่วนตัว ระยะทางไป-กลับ ระยะทาง ๖๐ กม.ๆ ละ ๔ บาท'))+50);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','เป็นเงิน'))+5,7,iconv( 'UTF-8','TIS-620',' เป็นเงิน'),0);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620','๑,๒๐๐'),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','บาท'))+2,7,iconv( 'UTF-8','TIS-620','บาท'),0);
$pdf->Ln();

$pdf->SetX(40);
$pdf->SetFont('ZapfDingbats','',14);
$pdf->Cell(4,4, '', 1,"C");
$pdf->SetFont('angsa','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','ปริญญาตรีปฏิบัติการ ๒๐๐/ชม.'))+1,7,iconv( 'UTF-8','TIS-620',' ปริญญาตรีปฏิบัติการ ๒๐๐/ชม.'),0);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620',' จำนวน   '))+2,7,iconv( 'UTF-8','TIS-620','  จำนวน   '),0);
$pdf->Cell(13,7,iconv( 'UTF-8','TIS-620','๓๐๐'),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620',' ชั่วโมง'))+2,7,iconv( 'UTF-8','TIS-620','  ชั่วโมง'),0);
$pdf->SetX($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','รถยนต์ส่วนตัว ระยะทางไป-กลับ ระยะทาง ๖๐ กม.ๆ ละ ๔ บาท'))+50);
$money_position = $pdf->GetX();
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','เป็นเงิน'))+5,7,iconv( 'UTF-8','TIS-620',' เป็นเงิน'),0);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',''),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','บาท'))+2,7,iconv( 'UTF-8','TIS-620','บาท'),0);
$pdf->Ln();

$pdf->SetX(25);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','๓.๑ ค่าพาหนะเดินทาง '))+3,10,iconv('UTF-8','TIS-620','๓.๑ ค่าพาหนะเดินทาง'),0,1);
$pdf->SetX(40);
$pdf->SetFont('ZapfDingbats','',14);
$pdf->Cell(4,4, 3, 1,"C");
$pdf->SetFont('angsa','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','เครื่องบิน  ระหว่าง'))+1,7,iconv( 'UTF-8','TIS-620','เครื่องบิน ระหว่าง'),0);
$pdf->Cell(50,7,iconv( 'UTF-8','TIS-620','เชียงใหม่-กรุงเทพ'),0);
$pdf->SetX($money_position);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','เป็นเงิน'))+5,7,iconv( 'UTF-8','TIS-620',' เป็นเงิน'),0);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620','๒,๕๐๐'),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','บาท'))+2,7,iconv( 'UTF-8','TIS-620','บาท'),0);
$pdf->Ln();

$pdf->SetX(40);
$pdf->SetFont('ZapfDingbats','',14);
$pdf->Cell(4,4, 3, 1,"C");
$pdf->SetFont('angsa','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','ค่า taxi'))+1,7,iconv( 'UTF-8','TIS-620','ค่า taxi'),0);
$pdf->Cell(50,7,iconv( 'UTF-8','TIS-620','ดอนเมือง-ลาดพร้าว'),0);
$pdf->SetX($money_position);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','เป็นเงิน'))+5,7,iconv( 'UTF-8','TIS-620',' เป็นเงิน'),0);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620','๒๐๐'),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','บาท'))+2,7,iconv( 'UTF-8','TIS-620','บาท'),0);
$pdf->Ln();

$pdf->SetX(40);
$pdf->SetFont('ZapfDingbats','',14);
$pdf->SetFont('angsa','',14);
$pdf->Cell(4,4, '', 1,"C");
$pdf->SetXY($pdf->GetX(),$pdf->GetY()-1);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','รถยนต์ส่วนตัว ระยะทางไป-กลับ ระยะทาง ๖๐ กม.ๆ ละ ๔ บาท')),7,iconv( 'UTF-8','TIS-620','รถยนต์ส่วนตัว ระยะทางไป-กลับ ระยะทาง ๖๐ กม.ๆ ละ ๔ บาท'),0);
$pdf->SetX($money_position);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','เป็นเงิน'))+5,7,iconv( 'UTF-8','TIS-620',' เป็นเงิน'),0);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',''),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','บาท'))+2,7,iconv( 'UTF-8','TIS-620','บาท'),0,1);

$pdf->AddPage();
$pdf->SetX(25);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','๓.๑ ค่าที่พัก '))+3,7,iconv('UTF-8','TIS-620','๓.๑ ค่าที่พัก'),0);
$pdf->SetXY($pdf->GetX(),$pdf->GetY()+1);
$pdf->SetFont('ZapfDingbats','',14);
$pdf->Cell(4,4, '', 1,"C");
$pdf->SetFont('angsa','',14);
$pdf->SetXY($pdf->GetX(),$pdf->GetY()-1);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620',' เบิกได้เท่าจ่ายจริงไม่เกิน ๑,๕๐๐ บาท/คน/คืน'))+10,7,iconv( 'UTF-8','TIS-620',' เบิกได้เท่าจ่ายจริงไม่เกิน ๑,๕๐๐ บาท/คน/คืน'),0);
$pdf->SetXY($pdf->GetX(),$pdf->GetY()+1);
$pdf->SetFont('ZapfDingbats','',14);
$pdf->Cell(4,4, '', 1,"C");
$pdf->SetFont('angsa','',14);
$pdf->SetXY($pdf->GetX(),$pdf->GetY()-1);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620',' เบิกในลักษณะเหมาจ่ายไม่เกิน ๘๐๐ บาท/คน/คืน'))+1,7,iconv( 'UTF-8','TIS-620',' เบิกในลักษณะเหมาจ่ายไม่เกิน ๘๐๐ บาท/คน/คืน'),0);
$pdf->Ln();
$pdf->SetX(50);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','จำนวน ')),7,iconv('UTF-8','TIS-620','จำนวน'),0);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',''),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','คืน ')),7,iconv('UTF-8','TIS-620','คืน'),0);
$pdf->SetX($money_position);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','เป็นเงิน'))+5,7,iconv( 'UTF-8','TIS-620',' เป็นเงิน'),0);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',''),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','บาท'))+2,7,iconv( 'UTF-8','TIS-620','บาท'),0,1);
$pdf->SetX($money_position-17);
$pdf->SetFont('angsab','',14);
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','สรุปค่าใช้จ่ายทั้งหมด'))+5,7,iconv( 'UTF-8','TIS-620',' สรุปค่าใช้จ่ายทั้งหมด'),0);
$pdf->Cell(20,7,iconv( 'UTF-8','TIS-620',''),0,"C");
$pdf->Cell($pdf->GetStringWidth(iconv( 'UTF-8','TIS-620','บาท'))+2,7,iconv( 'UTF-8','TIS-620','บาท'),0,1);

$pdf->SetX(35);
$pdf->SetFont('angsa','',14);
$pdf->Cell(10,7,iconv('UTF-8','TIS-620','ลงชื่อ'),0);
$image1 = "image1.jpg"; # signature
$pdf->Cell( 40, 7, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 30,10), 0, 0, 'L', false );
$pdf->SetX($money_position-10);
$pdf->Cell(10,7,iconv('UTF-8','TIS-620','ลงชื่อ'),0);
$image1 = "image1.jpg"; # signature
$pdf->Cell( 40, 7, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 30,10), 0, 0, 'L', false );
$pdf->Ln();

$pdf->SetXY(40,$pdf->GetY()+3);
$pdf->Cell(0,7,iconv('UTF-8','TIS-620','(ผศ.ภก.ยงยุทธ เรือนทา)'),0);
$pdf->SetX($money_position-5);
$pdf->Cell(0,7,iconv('UTF-8','TIS-620','(ผศ.ภก.ยงยุทธ เรือนทา)'),0,1);
$pdf->SetX(45);
$pdf->Cell(0,7,iconv('UTF-8','TIS-620','ผู้เชิญอาจารย์พิเศษ'),0);
$pdf->SetX($money_position-5);
$pdf->Cell(0,7,iconv('UTF-8','TIS-620','ผู้รับผิดชอบกระบวนวิชา'),0,1);

$pdf->SetX(35);
$pdf->Cell(0,7,iconv('UTF-8','TIS-620','วันที่  '.date(" j ").'   เดือน   '.$THAI_MONTH[date(" m ")-1].'   พ.ศ.   '.$BUDDHA_YEAR),0);
$pdf->SetX($money_position-17);
$pdf->Cell(0,7,iconv('UTF-8','TIS-620','วันที่  '.date(" j ").'   เดือน   '.$THAI_MONTH[date(" m ")-1].'   พ.ศ.   '.$BUDDHA_YEAR),0);

$pdf->Ln();
$pdf->SetX(20);
$pdf->Cell(0+5,7,iconv( 'UTF-8','TIS-620',' การขอเชิญอาจารย์พิเศษนี้ได้ผ่านความเห็นชอบของกรรมการวิชาการประจำภาควิชาแล้ว ในคราวประชุมครั้งที่  '. '1'.'  เมื่อ  '.'1/1/2560'),0,1);

$pdf->SetX($money_position-25);
$pdf->SetFont('angsa','',14);
$pdf->Cell(10,7,iconv('UTF-8','TIS-620','ลงชื่อ'),0);
$image1 = "image1.jpg"; # signature
$pdf->Cell( 40, 7, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 30,10), 0, 0, 'L', false );
$pdf->Ln();

$pdf->SetXY($money_position-15,$pdf->GetY()+3);
$pdf->Cell(0,7,iconv('UTF-8','TIS-620','หัวหน้าภาควิชา'),0,1);

$pdf->SetX($money_position-20);
$pdf->Cell(0,7,iconv('UTF-8','TIS-620','วันที่  '.'10'.'   เดือน   '.'1'.'   พ.ศ.   '.'2560'),0);

$pdf->Output("speacial_instructor.pdf","F");

 ?>
 PDF Created Click <a href="speacial_instructor.pdf">here</a> to Download