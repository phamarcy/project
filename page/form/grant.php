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

 <link rel="stylesheet" href="../dist/css/scrollbar.css">

 <scrip>

 </script>

 </header>
 <body class="mybox">
 <div id="wrapper" style="padding-left: 30px; padding-right: 30px;">
   <div class="row">
     <center>
       <h2 class="page-header">มอบอำนาจการอนุมัติ</h2>
       <div class="form-inline">
                <h style="width: 100px;">ภาคการศึกษาที่ </h>
                <div class="form-group">
                    <select class="form-control" id="semester" style="width: 70px; ">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                    </select>
                </div>
                ปีการศึกษา
                <input class="form-control" id="year" placeholder="Ex. 2560" style="width: 100px;">
                <button type="button" class="btn btn-primary">ค้นหา</button>
        </div>
     </center>
   </div>
   <br>
   <div class="panel panel-default">
     <div class="panel-heading">
       <h3>ภาคการศึกษาที่ 2 ปีการศึกษา 2560</h3>
     </div>
     <div class="panel-body">
       <div class="panel panel-primary">
         <div class="panel-heading">
           <h4>สถานะการมอบอำนาจล่าสุด</h4>
         </div>
         <div class="panel-body">
           <table class="table table-hover">
             <tr>
               <th>ชื่อ</th>
               <th>นามสกุล</th>
               <th>สถานะผู้ใช้งาน</th>
               <th>สถานะการมอบอำนาจ</th>
               <th></th>
             </tr>
             <tr>
               <td>วิชัย</td>
               <td>ใจดี</td>
               <td>คณะกรรมการคณะ</td>
               <td>ได้รับมอบอำนาจการอนุมัติ</td>
               <td><input type="button" class="btn btn-danger" id="cancelgrantbtn" value="ยกเลิกการมอบอำนาจ"></td>
             </tr>
           </table>
         </div>
       </div>
         <div class="panel panel-yellow">
           <div class="panel-heading">
             <h4>ค้นหาชื่อผู้ใช้เพื่อมอบอำนาจ</h4>
           </div>
           <div class="panel-body" style="font-size: 16px;">
            <div class="form-inline">
             ชื่อ&nbsp;&nbsp;<input type="text" class="form-control" id="fname">&nbsp;&nbsp;นามสกุล&nbsp;&nbsp;<input type="text" class="form-control" id="lname">
             <input type="button" class="btn btn-warning" id="ค้นหา" value="ค้นหา">
           </div>
         </div>
       </div>
       <div class="panel panel-green">
         <div class="panel-heading">
           <h4>รายชื่อที่พบ</h4>
         </div>
         <div class="panel-body">
           <table class="table table-hover">
             <tr>
               <th>ชื่อ</th>
               <th>นามสกุล</th>
               <th>สถานะผู้ใช้งาน</th>
               <th>สถานะการมอบอำนาจ</th>
               <th></th>
             </tr>
             <tr>
               <td>วิเชียร</td>
               <td>คำอุ๊</td>
               <td>คณะกรรมการคณะ</td>
               <td>ยังไม่ได้รับมอบอำนาจ</td>
               <td><input type="button" class="btn btn-danger" id="grantbtn" value="มอบอำนาจ" disabled></td>
             </tr>
           </table>
         </div>
       </div>
     </div>
   </div>
 </div>
 </body>
 </html>
