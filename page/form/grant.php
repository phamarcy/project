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
       <h3 class="page-header">มอบอำนาจการอนุมัติกระบวนวิชา</h3>
           <form data-toggle="validator" role="form">
             <div class="form-inline" style="font-size:16px;">
                      <div class="form-group">
                         <label id="semester" class="control-label">ปีการศึกษา</label>
                          <select class="form-control required" id="semester" style="width: 70px;" required>
                             <option value="">--</option>
                             <option value="1">1</option>
                             <option value="2">2</option>
                             <option value="3">3</option>
                          </select>
                      </div>
                      <div class="form-group">
                        <label for="inputyear" class="control-label">ปีการศึกษา</label>
                        <input type="number" class="form-control"  style="width: 150px;" placeholder="e.g. 2560"   max="9999" required>
                      </div>
                     <button type="submit" class="btn btn-outline btn-primary">ค้นหา</button>
              </div>
           </form>
     </center>
   </div>
   <br>
   <div class="panel panel-default" style="font-size: 14px;">
     <div class="panel-heading"  style="padding: 0px 0px; padding-left: 10px;">
       ภาคการศึกษาที่ 2 ปีการศึกษา 2560
     </div>
     <div class="panel-body">
       <div class="panel panel-info">
         <div class="panel-heading"  style="padding: 0px 0px; padding-left: 10px;">
           สถานะการมอบอำนาจล่าสุด
         </div>
         <div class="panel-body">
           <table class="table table-hover" style="font-size: 14px;">
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
               <td><input type="button" class="btn btn-outline btn-danger" id="cancelgrantbtn" value="ยกเลิกการมอบอำนาจ"></td>
             </tr>
           </table>
         </div>
       </div>
         <div class="panel panel-warning">
           <div class="panel-heading" style="padding: 0px 0px; padding-left: 10px;">
            ค้นหาชื่อผู้ใช้เพื่อมอบอำนาจ
           </div>
           <div class="panel-body" style="font-size: 16px;">
            <div class="form-inline" style="font-size: 14px;">
              <form class="" action="" method="post">
                ชื่อ&nbsp;&nbsp;<input type="text" class="form-control" id="fname">&nbsp;&nbsp;นามสกุล&nbsp;&nbsp;<input type="text" class="form-control" id="lname" >
                <input type="submit" class="btn btn-outline btn-warning" id="ค้นหา" value="ค้นหา">
              </form>
           </div>
         </div>
       </div>
       <div class="panel panel-success">
         <div class="panel-heading" style="padding: 0px 0px; padding-left: 10px;">
           รายชื่อที่พบ
         </div>
         <div class="panel-body">
           <table class="table table-hover" style="font-size: 14px;">
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
               <td><input type="button" class="btn btn-outline btn-danger" id="grantbtn" value="มอบอำนาจ" disabled></td>
             </tr>
           </table>
         </div>
       </div>
     </div>
   </div>
 </div>
 </body>
 </html>
