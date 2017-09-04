<?php
session_start();
require_once(__DIR__."/../../application/class/report.php");
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
        //start Search
        $report = new Report();
        $data_eva = $report->Get_Evaluate_Report($semester,$year);
        $data_special = $report->Get_Special_Report($semester,$year);
        //end search
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
                              <h5><b>
                              <?php echo "แบบแจ้งวิธีการวัดผลและประเมินผล ภาคการศึกษาที่ ".$semester." ปีการศึกษา ".$year;?>
                            </b></h5>
                            </div>
                            <div class="panel-body">
                              <?php
                              if(isset($data_eva['status']))
                              {
                                echo '<div class="alert alert-danger">
                                '.$data_eva['msg'].'
                                </div>';
                              }
                              else
                              {
                              ?>
                              <div class="table-responsive">
                              <table class="table table-hover" style="font-size:14px">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>รหัสวิชา</th>
                                          <th>ชื่อวิชา</th>
                                          <th><center>Syllabus</center></th>
                                          <th>PDF</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                    for($i=0;$i<count($data_eva);$i++)
                                    {
                                      $num = $i+1;
                                      echo '<tr>';
                                      echo '<td>'.$num.'</td>';
                                      echo '<td>'.$data_eva[$i]['id'].'</td>';
                                      echo '<td>'.$data_eva[$i]['name'].'</td>';
                                      echo '<td><center><a target="_blank" href="'.$data_eva[$i]['syllabus'].'"><i class="fa fa-file-word-o fa-2x" aria-hidden="true"></i></a></center></td>';
                                      echo '<td><a target="_blank" href="'.$data_eva[$i]['pdf'].'"><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></a></td>';
                                      echo '</tr>';
                                    }
                                    ?>
                                  </tbody>
                              </table>
                          </div>
                        <?php }?>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="special">
                      <div class="panel panel-info">
                          <div class="panel-heading">
                            <h5><b>
                            <?php echo "แบบเชิญอาจารย์พิเศษ ภาคการศึกษาที่ ".$semester." ปีการศึกษา ".$year;?>
                          </b></h5>
                          </div>
                          <div class="panel-body">
                            <?php
                            if(isset($data_special['status']))
                            {
                              echo '<div class="alert alert-danger">
                              '.$data_special['msg'].'
                              </div>';
                            }
                            else
                            {
                            ?>
                              <div class="panel-group" id="accordion">
                                <?php for($i=0;$i<count($data_special);$i++) {
                                  $num = $i +1;
                                echo '<div class="panel panel-default">
                                    <div class="panel-heading">
                                        <div class="panel-title" style="font-size:14px">
                                        <a data-toggle="collapse" href="#460100">'.$data_special[$i]['id'].' '.$data_special[$i]['name'].'</a>
                                      </div>
                                    </div>
                                    <div id="'.$data_special[$i]['id'].'" class="panel-collapse collapse in">
                                      <div class="panel-body">
                                        <table class="table table-hover" style="font-size:14px">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>ชื่อ - สกุล</th>
                                                    <th>CV</th>
                                                    <th>PDF</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
                                            for($j=0;$j<count($data_special[$i]['special']);$j++)
                                            {
                                              $num_special = $j+1;
                                              echo '<tr>
                                                  <td>'.$num_special.'</td>
                                                  <td>'.$data_special[$i]['special'][$j]['name'].'</td>
                                                  <td><a target="_blank" href="'.$data_special[$i]['special'][$j]['cv'].'"><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></a></td>
                                                  <td><a target="_blank" href="'.$data_special[$i]['special'][$j]['pdf'].'"><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></a></td>
                                                  </tr>';
                                            }
                                            echo '</tbody>
                                          </table>
                                        </div>
                                      </div>
                                    </div>
                                </div>'; } ?>
                                </div>
                              <?php } ?>
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
