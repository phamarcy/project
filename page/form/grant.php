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
 <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />


 <!-- Bootstrap Core JavaScript -->
 <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

 <!-- Metis Menu Plugin JavaScript -->
 <script src="../vendor/metisMenu/metisMenu.min.js"></script>

 <!-- Custom Theme JavaScript -->
 <script src="../dist/js/sb-admin-2.js"></script>

 <script type="text/javascript" src="../dist/js/bootstrap-filestyle.min.js"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>



 </header>
 <body class="mybox">
 <div id="wrapper" style="padding-left: 30px; padding-right: 30px;">

   <div class="row">
     <center>
       <h3 class="page-header">มอบอำนาจการอนุมัติกระบวนวิชา</h3>
     </center>
   </div>
   <div class="panel panel-default">
       <div class="panel-heading">
         <h5 class="panel-title">
             <b>ภาคการศึกษาที่ 2 ปีการศึกษา 2560</b>
         </h5>
       </div>
       <!-- .panel-heading -->
       <div class="panel-body">
         <div class="panel panel-info">
           <div class="panel-heading"  >
             สถานะการมอบอำนาจล่าสุด
           </div>
           <div class="panel-body">
             <table class="table table-hover" style="font-size: 14px;">
               <thead>
                 <th>ชื่อ</th>
                 <th>นามสกุล</th>
                 <th>สถานะผู้ใช้งาน</th>
                 <th>สถานะการมอบอำนาจ</th>
                 <th></th>
               </thead>
               <tbody>
                 <tr>
                   <td>วิชัย</td>
                   <td>ใจดี</td>
                   <td>คณะกรรมการคณะ</td>
                   <td>ได้รับมอบอำนาจการอนุมัติ</td>
                   <td><input type="button" class="btn btn-outline btn-danger" id="cancelgrantbtn" value="ยกเลิกการมอบอำนาจ"></td>
                 </tr>
               </tbody>
             </table>
           </div>
         </div>
         <div class="panel panel-warning">
           <div class="panel-heading" >
            ค้นหาชื่อผู้ใช้เพื่อมอบอำนาจ
           </div>
           <div class="panel-body" style="font-size: 16px;">
            <div class="form-inline" style="font-size: 14px;">
              <form class="" action="" method="post">
                <div class="form-group">
                  <select class="form-control" name="">
                    <option value="">รศ.ดร. ภก.วิรัตน์   นิวัฒนนันท์</option>
                    <option value="">รศ.ดร. ภญ.ศิริวิภา   ปิยะมงคล</option>
                    <option value="">ผศ.ดร. ภก.ทรงวุฒิ   ยศวิมลวัฒน์</option>
                    <option value="">ผศ.ดร. ภญ.รัตนาภรณ์   อาวิพันธ์</option>
                    <option value="">รศ.ดร. ภญ.หทัยกาญจน์   เชาวนพูนผล</option>
                    <option value="">ผศ.ดร. ภก.สกนธ์   สุภากุล</option>
                    <option value="">ผศ.ดร. ภญ.อำไพ   พฤติวรพงศ์กุล</option>
                    <option value="">อ.ดร. ภก.สมจริง   รุ่งแจ้ง</option>
                  </select>
                </div>
                <input type="submit" class="btn btn-outline btn-warning" id="ค้นหา" value="มอบอำนาจ">
              </form>
           </div>
         </div>
       </div>
       </div>
   </div>

 </div>
 </body>
 <script type="text/javascript">
   $('select').select2();
 </script>
 </html>
