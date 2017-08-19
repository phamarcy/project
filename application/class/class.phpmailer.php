<?php
 session_start();
 require_once(__DIR__."/../../application/class/approval.php");
 if (isset($_POST['subject'])) {
   $approve = new approval($_SESSION['level']);
   $var=$approve->Check_Status('204411');
 }
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
 <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />


 <script src="../vendor/jquery/jquery.min.js"></script>

 <!-- Bootstrap Core JavaScript -->
 <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

 <!-- Metis Menu Plugin JavaScript -->
 <script src="../vendor/metisMenu/metisMenu.min.js"></script>

 <!-- Custom Theme JavaScript -->
 <script src="../dist/js/sb-admin-2.js"></script>

 <script type="text/javascript" src="../dist/js/bootstrap-filestyle.min.js"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<style>

a[disabled="disabled"] {
 <?php if ($_SESSION['level'] == 2 or $_SESSION['level'] == 3) { ?>
   pointer-events: none;
 <?php  } ?>
}
#statcf {
 color : #0e9d14;
}

#statn {
 color : #ec2c2c;
}

#statwt {
 color : #acb500;
}

#statal {
 color : #da9001;
}
</style>
</header>
<body class="mybox">
 <div id="wrapper" style="padding-left: 30px; padding-right: 30px;">
   <div class="row">
     <center>
       <h3 class="page-header">ตรวจสอบสถานะการอนุมัติกระบวนวิชา</h3>
     </center>
     <div class="form-inline">
       <form class="" action="" method="post">
         <center>
             <h5 style="font-size : 16px">วิชา
             <div class="form-group" >
               <select class="form-control" name="subject">
                 <option value="462533">462533	HEALTH BEHAVIORS AND PHARMACEUTICAL CARE</option>
                 <option value="461525">461525	BASIC KNOWLEDGE OF THAI TRADITIONAL MEDICINEE</option>
                 <option value="461532">461532	DRUG SYNTHESIS</option>
                 <option value="461575">461575	DELIVERY SYSTEMS IN COSMETICS</option>
                 <option value="463522">463522	EVIDENCE-BASED DIETARY SUPPLEMENTS</option>
                 <option value="463571">463571	QUALITY CONTROL FOR FOOD AND COSMETICS</option>
               </select>
               </div>
               &nbsp;<button type="submit" class="btn btn-success btn-outline"   >ค้นหา</button>
               <div id="searchstatus" style="display:inline;"></div>
             </h5>
         </center>
         </form>
         </div>
   </div>
<br>
<div class="container">
 <?php if (isset($_POST['subject'])) {
  $data= json_decode($var, true);
  ?>
  <?php data_course('semester'); ?>

 <div class="panel-group" id="accordion0">
   <div class="panel panel-info">
     <div class="panel-heading">
       <h5 class="panel-title">
         <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
         <i class="fa fa-search fa-fw"></i><b> รายชื่อกระบวนวิชา</b> ภาคการศึกษาที่ <?php echo  $data['data']['semester']; ?> ปีการศึกษา <?php echo  $data['data']['year']; ?></a>
       </h5>
     </div>
     <div id="collapse1" class="panel-collapse collapse in">
       <div class="panel-body" style="font-size:14px;">
         <!-- 1 -->
         <div class="panel-group" id="accordion1">
         <div class="panel panel-success">
           <div class="panel-heading">
             <h3 class="panel-title">
               <a data-toggle="collapse" href="#collapse2" >
               <li><b><u>รหัสกระบวนวิชา</u></b> : 204111 <b>ตอนที่</b> 1 <b>ภาคปกติ</b></a></li>
               <br>&nbsp;&nbsp;&nbsp; สถานะการอนุมัติ : <b id="statcf">อนุมัติ <i class="fa fa-check fa-fw"></i></b>
             </h3>
           </div>
           <div id="collapse2" class="panel-collapse collapse">
             <div class="panel-body" style="font-size:14px;">

               <div class="panel-group">
               <div class="panel panel-default">
                 <div class="panel-heading">
                   <h3 class="panel-title">
                     <a data-toggle="collapse" href="#collapse3" disabled="disabled">
                      <i class="fa fa-file-o fa-fw"></i><b> แบบแจ้งวิธีการวัดผลและประเมินผลการศึกษา </b><i class="fa fa-long-arrow-right fa-fw"></i> สถานะการอนุมัติ : <b id="statcf">อนุมัติ <i class="fa fa-check fa-fw"></i></b></a>
                   </h3>
                 </div>
                 <?php if ($_SESSION['level'] != 2 && $_SESSION['level'] != 3) { ?>
                   <div id="collapse3" class="panel-collapse collapse">
                     <div class="panel-body" style="font-size:14px;">
                       <table class="table ">
                         <thead>
                           <?php if ($_SESSION['level'] > 4 ): ?>
                               <th style="width:170px">คณะกรรมการ</th>
                           <?php endif; ?>
                           <th>คอมเม้นท์</th>
                         </thead>
                         <tbody>
                           <tr>
                             <?php if ($_SESSION['level'] > 4 ): ?>
                                 <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                             <?php endif; ?>
                             <td>เอกสารครบถ้วนสมบูรณ์</td>
                           </tr>
                           <tr>
                             <?php if ($_SESSION['level'] > 4 ): ?>
                                 <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                             <?php endif; ?>
                             <td>แก้ไขคำผิดเล็กน้อย</td>
                           </tr>
                         </tbody>
                       </table>
                     </div>
                   </div>
                <?php  } ?>

               </div>
             </div>

             <div class="panel-group">
             <div class="panel panel-default">
               <div class="panel-heading">
                 <h3 class="panel-title">
                   <a data-toggle="collapse" href="#collapse4" disabled="disabled">
                   <i class="fa fa-file-o fa-fw"></i><b>  แบบขออนุมัติเชิญอาจารย์พิเศษ </b><i class="fa fa-long-arrow-right fa-fw"></i> สถานะการอนุมัติ : <b id="statcf">อนุมัติ <i class="fa fa-check fa-fw"></i></b></a>
                 </h3>
               </div>
               <?php if ($_SESSION['level'] != 2 && $_SESSION['level'] != 3) { ?>
               <div id="collapse4" class="panel-collapse collapse">
                 <div class="panel-body" style="font-size:14px;">
                   <table class="table ">
                     <thead>
                       <?php if ($_SESSION['level'] > 4 ): ?>
                           <th style="width:170px">คณะกรรมการ</th>
                       <?php endif; ?>
                       <th>คอมเม้นท์</th>
                     </thead>
                     <tbody>
                       <tr>
                         <?php if ($_SESSION['level'] > 4 ): ?>
                             <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                         <?php endif; ?>
                         <td>เอกสารครบถ้วนสมบูรณ์</td>
                       </tr>
                       <tr>
                         <?php if ($_SESSION['level'] > 4 ): ?>
                             <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                         <?php endif; ?>
                         <td>แก้ไขวันที่</td>
                       </tr>
                     </tbody>
                   </table>
                 </div>
               </div>
              <?php  } ?>
             </div>
           </div>

               <div class="panel-group">
               <div class="panel panel-default">
                 <div class="panel-heading">
                   <h3 class="panel-title">
                     <a data-toggle="collapse" href="#collapse5" disabled="disabled">
                       <i class="fa fa-file-o fa-fw"></i><b> Course Syllabus </b><i class="fa fa-long-arrow-right fa-fw"></i> สถานะการอนุมัติ : <b id="statcf">อนุมัติ <i class="fa fa-check fa-fw"></i></b></a>
                   </h3>
                 </div>
                 <?php if ($_SESSION['level'] != 2 && $_SESSION['level'] != 3) { ?>
                 <div id="collapse5" class="panel-collapse collapse">
                   <div class="panel-body" style="font-size:14px;">
                     <table class="table ">
                       <thead>
                         <?php if ($_SESSION['level'] > 4 ): ?>
                             <th style="width:170px">คณะกรรมการ</th>
                         <?php endif; ?>
                         <th>คอมเม้นท์</th>
                       </thead>
                       <tbody>
                         <tr>
                           <?php if ($_SESSION['level'] > 4 ): ?>
                               <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                           <?php endif; ?>
                           <td>ควรเพิ่มกิจกรรมในส่วนของกระบวนวิชาสัมนา</td>
                         </tr>
                         <tr>
                           <?php if ($_SESSION['level'] > 4 ): ?>
                               <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                           <?php endif; ?>
                           <td>จำนวนหน่วยกิตยังไม่ถูกต้อง ทั้งนี้เนื้อหาครบถ้วนสมบูรณ์แล้วสามารถให้อนุมัติได้ และขอให้แก้ไขให้เรียบร้อย</td>
                         </tr>
                       </tbody>
                     </table>
                   </div>
                 </div>
                 <?php  } ?>
               </div>
             </div>
             </div>
           </div>
         </div>
       </div>
       </div>
     </div>
   </div>
 </div>

<?php } ?>
</div>
</div>
</body>
<script type="text/javascript">
 $('select').select2();
</script>
</html>
