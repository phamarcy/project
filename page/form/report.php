<?php
session_start();
if(!isset($_SESSION['level']) || !isset($_SESSION['fname']) || !isset($_SESSION['lname']) || !isset($_SESSION['id']))
{
    die('กรุณา Login ใหม่');
}
require_once(__DIR__."/../../application/class/report.php");
require_once(__DIR__."/../../application/class/person.php");
require_once(__DIR__."/../../application/class/course.php");
$person = new Person();
$course = new Course();
$dept = $course->Get_Dept_All();
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
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
            <h3 class="page-header"><center>รายงาน</center></h3>
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
                        <?php  if($_SESSION['level'] == '3' || $_SESSION['level'] == '6'){ ?>
                          ภาควิชา
                          <select class="form-control" name="department">
                            <?php
                             for ($i=0; $i <count($dept) ; $i++) {
                               echo "<option value=".$dept[$i]['code'].">".$dept[$i]['name']."</option>";
                             }
                             ?>
                          </select>
                        <?php  } ?>
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
        if(isset($_POST['department']))
        {
          $dept_id = $_POST['department'];
          $dept_name = '';
          for ($i=0; $i <count($dept) ; $i++) {
            if($dept[$i]['code'] == $dept_id)
            {
              $dept_name = $dept[$i]['name'];
              break;
            }
          }
        }
        else
        {
          $dept = $person->Get_Staff_Dep($_SESSION['id']);
          $dept_id = $dept['code'];
          $dept_name = $dept['name'];
        }
        //start Search
        $report = new Report();
        $data_eva = $report->Get_Evaluate_Report($semester,$year,$dept_id);
        $data_special = $report->Get_Special_Report($semester,$year,$dept_id);
        //end search
      ?>
            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#course" data-toggle="tab" aria-expanded="true">แบบแจ้งวิธีการวัดผลและประเมินผล</a>
                    </li>
                    <li class=""><a href="#special" data-toggle="tab" aria-expanded="false">แบบเชิญอาจารย์พิเศษ</a>
                    </li>
                    <li class=""><a href="#summary" data-toggle="tab" aria-expanded="false">สรุปข้อมูล</a>
                    </li>
                </ul>
                <br>
                <!-- Tab panes -->
                <div class="container">
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="course">
                        <div class="panel panel-info">
                            <div class="panel-heading clearfix" style="font-size:14px;padding-top: 7.5px">
                              <h5 class="pull-left"><b>
                              <?php
                              echo "แบบแจ้งวิธีการวัดผลและประเมินผล ".$dept_name. " ภาคการศึกษาที่ ".$semester." ปีการศึกษา ".$year;
                              ?>
                              </b></h5>
                            <div class="pull-right">
                              <?php
                            if(isset($data_eva['download']))
                              {
                                $download_all = $data_eva['download'];
                              ?>
                              <a target="_blank" href="<?php echo $download_all; ?>"><button style="float: right;" type="button" class="btn btn-success">ดาวน์โหลดไฟล์ Evaluation Form ทั้งหมด</button></a>
                            <?php } ?>
                            </div>
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
                                          <th>Grade</th>
                                          <th>Syllabus</th>
                                          <th>Evaluation Form</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                    for($i=0;$i<count($data_eva['info']);$i++)
                                    {
                                      $num = $i+1;
                                      echo '<tr>';
                                      echo '<td>'.$num.'</td>';
                                      echo '<td>'.$data_eva['info'][$i]['id'].'</td>';
                                      echo '<td>'.$data_eva['info'][$i]['name'].'</td>';
                                      if($data_eva['info'][$i]['grade'] != '' && $data_eva['info'][$i]['grade'] != null)
                                        echo '<td><a target="_blank" href="../../files/grade/'.$data_eva['info'][$i]['grade'].'"><i class="fa fa-file-excel-o fa-2x" aria-hidden="true"></i></a></td>';
                                      else
                                        echo '<td></td>';
                                      if($data_eva['info'][$i]['syllabus'] != '' && $data_eva['info'][$i]['syllabus'] != null)
                                        echo '<td><a target="_blank" href="../../files'.$data_eva['info'][$i]['syllabus'].'"><i class="fa fa-file-word-o fa-2x" aria-hidden="true"></i></a></td>';
                                      else
                                        echo '<td></td>';
                                      echo '<td><a target="_blank" href="'.$data_eva['info'][$i]['pdf'].'"><i class="fa fa-file-archive-o fa-2x" aria-hidden="true"></i></a></td>';
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
                          <div class="panel-heading clearfix" style="font-size:14px;padding-top: 7.5px">
                            <h5 class="pull-left"><b>
                            <?php echo "แบบเชิญอาจารย์พิเศษ ".$dept_name." ภาคการศึกษาที่ ".$semester." ปีการศึกษา ".$year;
                            ?>
                          </b></h5>
                          <div class="pull-right">
                            <?php
                          if(isset($data_special['download']))
                            {
                            $download_all_special =  $data_special['download'];
                            ?>
                            <a target="_blank" href="<?php echo $download_all_special; ?>"><button style="float: right;" type="button" class="btn btn-success">ดาวน์โหลดไฟล์ Instructor Form ทั้งหมด</button></a>
                            <?php } ?>
                          </div>
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
                                <?php for($i=0;$i<count($data_special['info']);$i++) {
                                  $num = $i +1;
                                echo '<div class="panel panel-default">
                                    <div class="panel-heading">
                                        <div class="panel-title" style="font-size:14px">
                                        <a data-toggle="collapse" href="#'.$data_special['info'][$i]['id'].'">'.$data_special['info'][$i]['id'].' '.$data_special['info'][$i]['name'].'</a>
                                      </div>
                                    </div>
                                    <div id="'.$data_special['info'][$i]['id'].'" class="panel-collapse collapse in">
                                      <div class="panel-body">
                                        <table class="table table-hover" style="font-size:14px">
                                            <thead>
                                                <tr>
                                                    <th width="10%">#</th>
                                                    <th width="70%">ชื่อ - สกุล</th>
                                                    <th width="10%">CV</th>
                                                    <th width="10%">Instructor Form</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
                                            for($j=0;$j<count($data_special['info'][$i]['special']);$j++)
                                            {
                                              $num_special = $j+1;
                                              echo '<tr>
                                                  <td width="10%">'.$num_special.'</td>
                                                  <td width="70%">'.$data_special['info'][$i]['special'][$j]['name'].'</td>
                                                  <td width="10%"><a target="_blank" href="../../files'.$data_special['info'][$i]['special'][$j]['cv'].'"><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></a></td>
                                                  <td width="10%"><a target="_blank" href="'.$data_special['info'][$i]['special'][$j]['pdf'].'"><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></a></td>
                                                  </tr>';
                                            }
                                            echo '</tbody>
                                          </table>
                                        </div>
                                      </div>
                                    </div>
                                '; } ?>
                                </div>
                              <?php } ?>
                            </div>
                          </div>
                      </div>
                    <div class="tab-pane fade" id="summary">
                      <div class="container">
                        <div class="panel panel-info">
                          <div class="panel-heading" >
                            <h5><b><?php echo "สรุปข้อมูล ".$dept_name." ภาคการศึกษาที่ ".$semester." ปีการศึกษา ".$year;?></b></h5>
                          </div>
                          <div class="panel-body">
                              <center><a target="_blank" href="<?php echo "../../application/download/summary.php?dept=".$dept_id."&semester=".$semester."&year=".$year?>"><button type="button" class="btn btn-success">ดาวน์โหลด ที่นี่</button></center>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
          </div>
      <?php } ?>
</body>

</html>
