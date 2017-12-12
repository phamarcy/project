<?php
session_start();
if(!isset($_SESSION['level']) || !isset($_SESSION['fname']) || !isset($_SESSION['lname']) || !isset($_SESSION['id']))
{
    die('กรุณา Login ใหม่');
}
require_once(__DIR__."/../../application/class/report.php");
require_once(__DIR__."/../../application/class/person.php");
require_once(__DIR__."/../../application/class/course.php");
require_once(__DIR__.'/../../application/class/manage_deadline.php');

$report = new Report();
$deadline = new Deadline();
$person = new Person();
$course = new Course();
$current_dep=$person->Get_Staff_Dep($_SESSION['id']);
$head_id=$person->Get_Head_Department($current_dep['code'],null);
$head_name=$person->Get_Teacher_Name($head_id,"TH");

 ?>
<html>
<header>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src="../vendor/jquery/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
    <script type="text/javascript" src="../dist/js/bootstrap-filestyle.min.js"></script>
    <script type="text/javascript" src="../js/function.js"></script>
    <script type="text/javascript" src="../vendor/validator/validator.min.js"></script>
    <link rel="stylesheet" href="../dist/css/scrollbar.css">
    <style >
    i:hover {
      font-size: 30px;
      font-weight: bold;
      color: red;
    }
    </style>
</header>
<script type="text/javascript">
//search report data in first load
$(document).ready(function() {

});
$(function() {//<-- wrapped here
  $('.numonly').on('input', function() {
    this.value = this.value.replace(/[^0-9.]/g, ''); //<-- replace all other than given set of values
  });
  $('.charonly').on('input', function() {
    this.value = this.value.replace(/[^a-zA-Zก-ฮๅภถุึคตจขชๆไำพะัีรนยบลฃฟหกดเ้่าสวงผปแอิืทมใฝ๑๒๓๔ู฿๕๖๗๘๙๐ฎฑธํ๊ณฯญฐฅฤฆฏโฌ็๋ษศซฉฮฺ์ฒฬฦ. ]/g, ''); //<-- replace all other than given set of values
  });
});
</script>

<body>
        <form id="search-panel" method="post" action="#" data-toggle="validator" role="form">
            <h3 class="page-header"><center>บันทึกข้อความ แบบเชิญอาจารย์พิเศษ</center></h3>
            <div class="form-inline">
                <center>
                    <h style="font-size : 14px">ภาคการศึกษาที่
                        <div class="form-group">
                            <select class="form-control" name="semester" style="width: 100px;" required>
                                <option value="">--</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                          </div>

                        <div class="form-group">
                            ปีการศึกษา
                          <input type="text" class="form-control numonly" placeholder="e.g. 2560" style="width: 100px;" pattern=".{4,4}" name="year" required > &nbsp;
                        </div>

                        <button type="submit" class="btn btn-outline btn-primary">ค้นหา</button>
                    </h>
                </center>
            </div>
      </form>
      <?php
      if(isset($_POST['semester']) &&isset($_POST['year']) )
      {
        $semester   = $_POST['semester'];
        $year       = $_POST['year'];
        $semester_id = $deadline->Search_Semester_id($semester,$year); 

       $coverdata = $report->get_cover($semester_id,$current_dep['code']);
        if (empty($coverdata)) {
            echo '<div class="alert alert-danger"><center>ไม่พบข้อมูล</center></div>';
            die();
        }
       $thaimonth=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"); 
      
       $search_term=$deadline->Search_Semester_Term($semester_id);
       $count_sp=0;
       $count_cost=0;

      ?>
            <hr>
            <div class="container " style="font-size:18px;background-color: white;padding:50px;padding-bottom:100px">
                <center><h2>บันทึกข้อความ</h2></center>
                <div class="pull-left"><b>ส่วนงาน </b><?php echo $current_dep['name']; ?>  &nbsp;&nbsp;คณะเภสัชศาสตร์   โทร. 4351 </div><br>
                <div class="pull-left"><b>ที่</b></div><center> วันที่  <?php echo date(" j "),$thaimonth[date("m")-1], "  ",date("Y")+543; ?>  </center>
                <p><b>เรื่อง</b> ขออนุมัติเชิญอาจารย์พิเศษและค่าใช้จ่าย ประจำภาคการศึกษาที่ <?php echo $search_term['semester'] ?> ปีการศึกษา <?php echo $search_term['year']?> </p>
                <p>__________________________________________________________________________________________</p>
                <p><b>เรียน </b> คณบดี (ผ่านรองคณบดีฝ่ายวิชาการ) </p>
                <p> &nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;ด้วย<?php echo $current_dep['name']; ?> ขออนุมัติเชิญอาจารย์พิเศษและค่าใช้จ่าย เพื่อทำการสอนในภาค <br>การศึกษาที่ <?php echo $search_term['semester'] ?> ปีการศึกษา <?php echo $search_term['year']?>  โดยมีรายละเอียดดังต่อไปนี้:- </p><br>
                
                    <ul style="list-style-type:none">
                        <?php  foreach ($coverdata as $key => $value) {  ?> 
                        <li>
                            - กระบวนวิชา <?php echo  $value['course_id']." ".$course->Get_Course_Name_th($value['course_id']) ?><br>
                            จำนวนนักศึกษาภาคปกติ <?php echo $value[0][0]['student'] ?> คน<br>
                            เป็นกระบวนวิชา ( <?php if ($value[2][0]['type_course']=='require') {echo "/"; } ?>  )  บังคับ  ( <?php if ($value[2][0]['type_course']=='choose') {echo "/"; } ?>  ) เลือก<br>
                            อาจารย์พิเศษที่เชิญ จำนวน <?php echo count($value[1]);?> คน (<?php foreach ($value[1] as $keysp =>$person) {echo ($keysp+1).".".$person['firstname']." ".$person['lastname']."  "; $count_sp+=1;} ?>)<br>
                            ขอเบิกค่าใช้จ่าย <?php echo $count_sp ?> คน  จำนวนเงิน  <?php echo number_format($value[3][0]['cost']); $count_cost+=$value[3][0]['cost'] ?> บาท
                        </li>
                        <?php } ?>
                    </ul>
                <b>รวม <?php echo count($coverdata)?> กระบวนวิชา อาจารย์พิเศษที่เชิญ จำนวน <?php echo $count_sp; ?> คน ค่าใช้จ่ายทั้งหมด  <?php echo number_format($count_cost)?>.- บาท </b><br>
                จึงเรียนมาเพื่อโปรดพิจารณาอนุมัติ พร้อมนี้ได้แนบแบบฟอร์มขออนุมัติเชิญอาจารย์พิเศษมาด้วย แล้ว
                <br>
                <br>
                <br>
                <br>
                <br>
              
                <p style=" position: relative;left: 550px;">
                    (<?php echo $head_name?>)
                    <br>
                    หัวหน้า<?php echo $current_dep['name']; ?>
                </p>
                <p>__________________________________________________________________________________________</p><br>
                (&nbsp;&nbsp;) อนุมัติ 
            </div>
            <br>
            <br>
            
      <?php  }  ?>
</body>

</html>
