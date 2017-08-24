<?php
session_start();
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
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
    <link rel="stylesheet" href="../dist/css/scrollbar.css">
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
            <h3 class="page-header"><center>รายงาน</center></h3>
            <div class="form-inline">
                <center>
                    <h style="font-size : 14px">ภาคการศึกษาที่
                        <div class="form-group">
                            <select class="form-control" name="semester" required>
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
      if(isset($_POST['semester']) && isset($_POST['year']))
      {
        $semester = $_POST['semester'];
        $year = $_POST['year'];
      ?>
            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#course" data-toggle="tab" aria-expanded="true">แบบแจ้งวิธีการวัดผลและประเมินผล</a>
                    </li>
                    <li class=""><a href="#special" data-toggle="tab" aria-expanded="false">แบบเชิญอาจารย์พิเศษ</a>
                    </li>
                </ul>
                <br>
                <!-- Tab panes -->
                <div class="container">
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="course">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                              <h5>
                              <?php echo "แบบแจ้งวิธีการวัดผลและประเมินผล ภาคการศึกษาที่ ".$semester." ปีการศึกษา ".$year;?>
                              </h5>
                            </div>
                            <div class="panel-body">
                              <div class="table-responsive">
                              <table class="table table-hover" style="font-size:14px">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>รหัสวิชา</th>
                                          <th>ชื่อวิชา</th>
                                          <th>PDF</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr>
                                          <td>1</td>
                                          <td>460100</td>
                                          <td>LEARNING THROUGH ACTIVITIES 1</td>
                                          <td><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></td>
                                      </tr>
                                      <tr>
                                          <td>2</td>
                                          <td>460201</td>
                                          <td>LEARNING THROUGH ACTIVITIES 2</td>
                                          <td><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></td>
                                      </tr>
                                      <tr>
                                          <td>3</td>
                                          <td>460202</td>
                                          <td>LEARNING THROUGH ACTIVITIES 3</td>
                                          <td><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></td>
                                      </tr>
                                  </tbody>
                              </table>
                          </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="special">
                      <div class="panel panel-info">
                          <div class="panel-heading">
                            <h5>
                            <?php echo "แบบเชิญอาจารย์พิเศษ ภาคการศึกษาที่ ".$semester." ปีการศึกษา ".$year;?>
                            </h5>
                          </div>
                          <div class="panel-body">
                              <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <div class="panel-title" style="font-size:14px">
                                        <a data-toggle="collapse" href="#460100">460100 LEARNING THROUGH ACTIVITIES 1</a>
                                      </div>
                                    </div>
                                    <div id="460100" class="panel-collapse collapse in">
                                      <div class="panel-body">
                                        <table class="table table-hover" style="font-size:14px">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>ชื่อ - สกุล</th>
                                                    <th>PDF</th>
                                                    <th>CV</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>ใจเริง มนต์ประสิทธิ์</td>
                                                    <td><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></td>
                                                    <td><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></td>
                                                </tr>
                                            </tbody>
                                            <tbody>
                                                <tr>
                                                    <td>2</td>
                                                    <td>ฤกษ์ พินิจพันธ์</td>
                                                    <td><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></td>
                                                    <td><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></td>
                                                </tr>
                                            </tbody>
                                          </table>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                      <div class="panel-title" style="font-size:14px">
                                        <a data-toggle="collapse" href="#460201">460201 LEARNING THROUGH ACTIVITIES 2</a>
                                      </div>
                                    </div>
                                    <div id="460201" class="panel-collapse collapse in">
                                      <div class="panel-body">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>ชื่อ - สกุล</th>
                                                    <th>PDF</th>
                                                    <th>CV</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>เกษราภรณ์ คำมิธรรม</td>
                                                    <td><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></td>
                                                    <td><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>รัชนก อินทนนท์</td>
                                                    <td><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></td>
                                                    <td><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>ณเดช คูกิมิยะ</td>
                                                    <td><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></td>
                                                    <td><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></td>
                                                </tr>
                                            </tbody>
                                          </table>
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
          </div>
      <?php } ?>
</body>

</html>
