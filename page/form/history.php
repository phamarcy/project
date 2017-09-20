<?php
session_start();
if(!isset($_SESSION['level']) || !isset($_SESSION['fname']) || !isset($_SESSION['lname']) || !isset($_SESSION['id']))
{
    die('กรุณา Login ใหม่');
}
require_once(__DIR__."/../../application/class/report.php");
if (isset($_POST['subject'])) {
  $report = new Report();
  $history=$report->Get_Comment_History($_POST['subject']);
  $status="";
  $msg="";
  if (isset($history["status"])) {
    $status =json_encode($history["status"]);
    $msg =json_encode($history["msg"]);
  }
  echo  "<pre>";
  var_dump($history);
  echo  "</pre>";
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
    <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../dist/css/scrollbar.css">

    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="../js/function.js"></script>
    <script src="../dist/js/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="../dist/css/sweetalert2.min.css">
    <!--ใช้ตัวนี้-->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
    <script>
    var status = <?php echo $status; ?>; 
    var msg = <?php echo $msg; ?>; 
    console.log(status );
    if (status=="error") {
      swal({
          type:"error",
          text: msg,
          timer: 2000,
          confirmButtonText: "Ok!",
        });

    }
    
  </script>
  </header>


  <body class="mybox">
    <div id="wrapper" style="padding-left: 30px; padding-right: 30px;">
      <div class="container">
        <div class="row">
          <center>
            <h3 class="page-header">ประวัติข้อเสนอแนะ</h3>

          <form name="history" method="post" action"" data-toggle="validator" role="form">
            <div class="form-inline" style="font-size:16px;">
              <div class="form-group ">
                ค้นหาวิชา
                <input type="text" name="subject" class="form-control numonly" id="id" name="id" size="7" placeholder="e.g. 204111" maxlength="6" pattern=".{6,6}" required>
              </div>
              <input type="hidden" name="type" value="1">
              <button type="submit" class="btn btn-outline btn-primary" >ค้นหา</button>
            </div>
          </form>
          </center>
        </div>
      <?php 

      $i =1;if (isset($history['comment'])):
        if (is_array($history['comment']) || is_object($history['comment'])) {

        
        ?>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h5 class="panel-title">
              <b>ผลการค้นหา</b>
            </h5>
          </div>
          <!-- .panel-heading -->
          <div class="panel-body">

                    <div class="table-responsive">
                      <table class="table " style="font-size:14px;">
                        <thead>
                          <tr>
                            <th>ลำดับ</th>
                            <th>รหัสวิชา</th>
                            <th>ชื่อวิชา</th>
                            <th  style="text-align:center;">ปีการศึกษา</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                     
                            <?php 
                             $year = 0;
                            foreach ($history['comment'] as $key => $value):?>
                                  
                              <tr>
                                <td><?php  echo $i++; ?></td>
                                <td ><?php echo $history['id'] ?></td>
                                <td><?php echo $history['name'] ?></td>
                                <td style="text-align:center;"><?php $x = array_keys($history['comment']); echo $x[$year];?></td>
                                <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#course<?php echo $year;?>" class="accordion-toggle">ดูข้อมูล</button></td>
                              </tr>
                          <tr class="hiddenRow">
                            <td colspan="12">
                              <div class="accordian-body collapse" id="course<?php echo $year;?>">
                                <div class="panel panel-success">
                                  <div class="panel-heading">
                                    <b>ข้อเสนอแนะคณะกรรมการ</b>
                                  </div>
                                  <div class="panel-body">
                                    <div class="panel-group" id="comment<?php echo $x[$year] ?> ">
                                      <div class="panel panel-default">
                                        <div class="panel-heading">
                                          <div class="panel-title" style="font-size:14px">
                                            <a data-toggle="collapse" href="#comment<?php echo $x[$year] ?>-2"><b>แบบแจ้งวิธีการวัดผลและประเมินผลการศึกษา</b></a>
                                          </div>
                                        </div>
                                        <div id="comment<?php echo $x[$year] ?>-2" class="panel-collapse collapse in">
                                          <div class="panel-body">
                                            <table class="table " style="font-size:14px">
                                              <thead>
                                                <?php if ($_SESSION['level'] > 1 ): ?>
                                                <th style="width:230px">คณะกรรมการ</th>
                                                <?php endif; ?>
                                                <th>ข้อเสนอแนะ</th>
                                                <th>วัน/เวลา</th>
                                              </thead>
                                              <tbody>
                                                <?php foreach ($value['evaluate'] as $key => $valueeva): ?>
                                                  <tr>
                                                    <?php if ($_SESSION['level'] > 1 ): ?>
                                                    <td style="width:230px"><?php echo $valueeva['name'] ?></td>
                                                    <?php endif; ?>
                                                    <td><?php echo $valueeva['comment'] ?></td>
                                                    <td><?php echo $valueeva['date'] ?></td>
                                                  </tr>
                                                <?php endforeach; ?>

                                              </tbody>
                                            </table>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="panel panel-default">
                                        <div class="panel-heading ">
                                          <div class="panel-title" style="font-size:14px">
                                                  <a data-toggle="collapse" href="#commentsp<?php echo $x[$year] ?>"><b>แบบเชิญอาจารย์พิเศษ</b></a>
                                              </div>
                                        </div>
                                        <div id="commentsp<?php echo $x[$year] ?>" class="panel-collapse collapse in">
                                          <div class="panel-body">
                                            <div class="panel-group" id="teachersp<?php echo $x[$year] ?>">
                                              <?php foreach ($value['special'] as $keysp => $valuesp): ?>
                                                <div class="panel panel-default">
                                                  <div class="panel-heading">
                                                    <div class="panel-title" style="font-size:14px">
                                                        <a data-toggle="collapse" data-parent="#teachersp<?php echo $keysp.$year ?>" href="#teachersp<?php echo $keysp.$year ?>"><?php echo $valuesp['name'] ?></a>
                                                    </div>
                                                  </div>
                                                  <div id="teachersp<?php echo $keysp.$year ?>" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                      <table class="table " style="font-size:14px">
                                                        <thead>
                                                          <th style="width:230px">คณะกรรมการ</th>
                                                          <th>ข้อเสนอแนะ</th>
                                                          <th>วัน/เวลา</th>
                                                        </thead>
                                                        <tbody>
                                                          <?php foreach ($valuesp['comment'] as  $valuespcomment):
                                                            ?>
                                                            <tr>
                                                                <td style="width:230px"><?php echo $valuespcomment['name'] ?></td>
                                                                <td><?php echo $valuespcomment['comment'] ?></td>
                                                                <td><?php echo $valuespcomment['date'] ?></td>  
                                                            </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                      </table>
                                                    </div>
                                                  </div>
                                                </div>
                                              <?php  endforeach; ?>


                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </td>
                          </tr>

                          <?php $year++;  endforeach; ?>
                        </tbody>
                      </table>
                    </div>

          <!-- .panel-body -->
        </div>
      </div>
        <?php } endif; ?>
    </div>
    </div>

  </body>


  </html>
