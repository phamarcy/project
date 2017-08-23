<?php
require_once(__DIR__.'/../../application/class/curl.php');
require_once(__DIR__.'/../../application/class/manage_deadline.php');
session_start();
$information_url = "application/information/index.php";
$curl = new CURL();
$deadline = new Deadline;
$data['level'] = $_SESSION['level'];
$result = $curl->Request($data,$information_url);
$semeter= $deadline->Get_Current_Semester();

if($result == false)
{
	die("ไม่สามารถเชื่อมต่อเซิร์ฟเวอร์ได้ กรุณาติดต่อผู้ดูแลระบบ");
}
else
{
	$result = json_decode($result,true);
	$deadline = $result['deadline'];
	$data = $result['data'];
}

?>
<html>
	<head>
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
		<title></title>

	</head>
	<body class="mybox">
	    <div id="wrapper" style="padding-left: 30px; padding-right: 30px;">
	      <div class="container">
	        <div class="row">
	            <center>
								<h3 class="page-header"><b>ภาคเรียนที่ <?php echo $semeter['semester'];?> &nbsp;ปีการศึกษา <?php echo $semeter['year'];?></b></h3>
	              </center>
	        </div>
	      <br>

	      <div class="panel panel-default">
	                        <div class="panel-heading">
	                          <h5 class="panel-title">
	                              <b>ภาคการศึกษาที่ 2 ปีการศึกษา 2560</b>
	                          </h5>
	                        </div>
	                        <!-- .panel-heading -->
	                        <div class="panel-body">
	                            <div class="panel-group" id="accordion">
	                                <div class="panel panel-warning">
	                                  <div class="panel-heading">
	                                      <div class="panel-title">
	                                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">รอการประเมิน</a>
	                                      </div >
	                                  </div>

	                                    <div id="collapseOne" class="panel-collapse collapse in">
	                                        <div class="panel-body">
	                                          <div class="table-responsive">
	                                              <table class="table " style="font-size:14px;">
	                                                  <thead>
	                                                      <tr >
	                                                          <th>ลำดับ</th>
	                                                          <th>รหัสวิชา</th>
	                                                          <th>ชื่อวิชา</th>
	                                                          <th  style="text-align:center;">Course</th>
	                                                          <th  style="text-align:center;">Evaluate</th>
	                                                          <th  style="text-align:center;">Instructor</th>
	                                                          <th></th>
	                                                          <th></th>
	                                                          <th></th>
	                                                      </tr>
	                                                  </thead>
	                                                  <tbody>
	                                                      <tr >
	                                                          <td>1</td>
	                                                          <td>202141</td>
	                                                          <td>BIOLOGY FOR PHARMACY STUDENTS</td>
	                                                          <td  style="text-align:center;">
	                                                            <a href="../../application/pdf/view.php?course=462452&info=syllabus" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
	                                                          </td>
	                                                          <td  style="text-align:center;">
	                                                            <a href="../../application/pdf/view.php?course=462452&type=draft&info=evaluate" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
	                                                          </td>
	                                                          <td  style="text-align:center;">
	                                                            <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
	                                                          </td>
	                                                          <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#demo1" class="accordion-toggle">comment</button></td>
	                                                          <td><a type="button" class="btn btn-outline btn-success" data-toggle="modal" data-target="#myModal11">เห็นชอบ</a></td>
	                                                          <td><button type="button" class="btn btn-outline btn-danger" data-toggle="modal" data-target="#myModal12">ไม่เห็นชอบ</button></td>
	                                                          <div id="myModal11" class="modal fade" role="dialog">
	                                                            <div class="modal-dialog">
	                                                              <!-- Modal content-->
	                                                              <div class="modal-content">
	                                                                <div class="modal-header">
	                                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
	                                                                  <h5 class="modal-title"><b>คอมเม้นท์</b></h5>
	                                                                </div>
	                                                                <div class="modal-body">
	                                                                  <div class="row">
	                                                                    <div class="col-md-12">
	                                                                      <form>
	                                                                        <div class="form-group">
	                                                                          <textarea name="comment" rows="8" cols="70" class="form-control"></textarea>
	                                                                        </div>
	                                                                        <button class="btn btn-outline btn-primary"  type="submit" name="button">ยืนยัน</button>
	                                                                      </form>
	                                                                    </div>
	                                                                  </div>
	                                                                </div>
	                                                                <div class="modal-footer">
	                                                                  <button type="button" class="btn btn-danger btn-outline" data-dismiss="modal">ปิด</button>
	                                                                </div>
	                                                              </div>

	                                                            </div>
	                                                          </div>
	                                                          <div id="myModal12" class="modal fade" role="dialog">
	                                                            <div class="modal-dialog">
	                                                              <!-- Modal content-->
	                                                              <div class="modal-content">
	                                                                <div class="modal-header">
	                                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
	                                                                  <h5 class="modal-title"><b>คอมเม้นท์</b></h5>
	                                                                </div>
	                                                                <div class="modal-body">
	                                                                  <div class="row">
	                                                                    <div class="col-md-12">
	                                                                      <form>
	                                                                        <div class="form-group">
	                                                                          <textarea name="comment" rows="8" cols="70" class="form-control"></textarea>
	                                                                        </div>
	                                                                        <button class="btn btn-outline btn-primary"  type="submit" name="button">ยืนยัน</button>
	                                                                      </form>
	                                                                    </div>
	                                                                  </div>
	                                                                </div>
	                                                                <div class="modal-footer">
	                                                                  <button type="button" class="btn btn-danger btn-outline" data-dismiss="modal">ปิด</button>
	                                                                </div>
	                                                              </div>

	                                                            </div>
	                                                          </div>
	                                                      </tr>
	                                                      <tr class="hiddenRow">
	                                                          <td colspan="12">
	                                                            <div class="accordian-body collapse" id="demo1">
	                                                              <div class="panel panel-success">
	                                                                <div class="panel-heading">
	                                                                  <b>คอมเม้นท์คณะกรรมการ</b>
	                                                                </div>
	                                                                <div class="panel-body">
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
	                                                                        <td>วิธีตัดเกรดในส่วนของการอิงเกณฑ์นั้นยังไม่ชัดเจน</td>
	                                                                      </tr>
	                                                                      <tr>
	                                                                        <?php if ($_SESSION['level'] > 4 ): ?>
	                                                                            <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
	                                                                        <?php endif; ?>
	                                                                        <td>ควรเพิ่มอาจารย์ปฏิบัติการ</td>
	                                                                      </tr>
	                                                                    </tbody>
	                                                                  </table>
	                                                                </div>
	                                                              </div>
	                                                            </div>
	                                                          </td>
	                                                      </tr>
	                                                      <tr >
	                                                          <td>2</td>
	                                                          <td>203151</td>
	                                                          <td>GENERAL CHEMISTRY FOR THE HEALTH SCIENCES</td>
	                                                          <td  style="text-align:center;">
	                                                            <a href="../../application/pdf/view.php?course=462452&info=syllabus" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
	                                                          </td>
	                                                          <td  style="text-align:center;">
	                                                            <a href="../../application/pdf/view.php?course=462452&type=draft&info=evaluate" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
	                                                          </td>
	                                                          <td  style="text-align:center;">
	                                                            <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
	                                                          </td>
	                                                          <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#demo2" class="accordion-toggle">comment</button></td>
	                                                          <td><button type="button" class="btn btn-outline btn-success" data-toggle="modal" data-target="#myModal21">เห็นชอบ</button></td>
	                                                          <td><button type="button" class="btn btn-outline btn-danger" data-toggle="modal" data-target="#myModal22">ไม่เห็นชอบ</button></td>
	                                                          <div id="myModal21" class="modal fade" role="dialog">
	                                                            <div class="modal-dialog">
	                                                              <!-- Modal content-->
	                                                              <div class="modal-content">
	                                                                <div class="modal-header">
	                                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
	                                                                  <h5 class="modal-title"><b>คอมเม้นท์</b></h5>
	                                                                </div>
	                                                                <div class="modal-body">
	                                                                  <div class="row">
	                                                                    <div class="col-md-12">
	                                                                      <form>
	                                                                        <div class="form-group">
	                                                                          <textarea name="comment" rows="8" cols="70" class="form-control"></textarea>
	                                                                        </div>
	                                                                        <button class="btn btn-outline btn-primary"  type="submit" name="button">ยืนยัน</button>
	                                                                      </form>
	                                                                    </div>
	                                                                  </div>
	                                                                </div>
	                                                                <div class="modal-footer">
	                                                                  <button type="button" class="btn btn-danger btn-outline" data-dismiss="modal">ปิด</button>
	                                                                </div>
	                                                              </div>

	                                                            </div>
	                                                          </div>
	                                                          <div id="myModal22" class="modal fade" role="dialog">
	                                                            <div class="modal-dialog">
	                                                              <!-- Modal content-->
	                                                              <div class="modal-content">
	                                                                <div class="modal-header">
	                                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
	                                                                  <h5 class="modal-title"><b>คอมเม้นท์</b></h5>
	                                                                </div>
	                                                                <div class="modal-body">
	                                                                  <div class="row">
	                                                                    <div class="col-md-12">
	                                                                      <form>
	                                                                        <div class="form-group">
	                                                                          <textarea name="comment" rows="8" cols="70" class="form-control"></textarea>
	                                                                        </div>
	                                                                        <button class="btn btn-outline btn-primary"  type="submit" name="button">ยืนยัน</button>
	                                                                      </form>
	                                                                    </div>
	                                                                  </div>
	                                                                </div>
	                                                                <div class="modal-footer">
	                                                                  <button type="button" class="btn btn-danger btn-outline" data-dismiss="modal">ปิด</button>
	                                                                </div>
	                                                              </div>

	                                                            </div>
	                                                          </div>
	                                                      </tr>
	                                                      <tr class="hiddenRow">
	                                                          <td colspan="12" class="hiddenRow">
	                                                            <div class="accordian-body collapse" id="demo2">
	                                                              <div class="panel panel-success">
	                                                                <div class="panel-heading">
	                                                                  <b>คอมเม้นท์คณะกรรมการ</b>
	                                                                </div>
	                                                                <div class="panel-body">

	                                                                  <table class="table ">
	                                                                    <thead>
	                                                                      <th style="width:170px">คณะกรรมการ</th>
	                                                                      <th>คอมเม้นท์</th>
	                                                                    </thead>
	                                                                    <tbody>
	                                                                      <tr>
	                                                                        <td style="width:170px">อ.จาริณี ธรรมฉันธะ</td>
	                                                                        <td>ควรเพิ่มกิรกรรมในส่วนของกระบวนวิชาสัมนา</td>
	                                                                      </tr>
	                                                                      <tr>
	                                                                        <td style="width:170px">ดร.ชญานุช เตชะปัญญารักษ์</td>
	                                                                        <td>จำนวนหน่วยกิตยังไม่ถูกต้อง ทั้งนี้เนื้อหาครบถ้วนสมบูรณ์แล้วสามารถให้อนุมัติได้ และขอให้แก้ไขให้เรียบร้อย</td>
	                                                                      </tr>
	                                                                    </tbody>
	                                                                  </table>
	                                                                </div>
	                                                              </div>
	                                                            </div>
	                                                          </td>
	                                                      </tr>
	                                                      <tr >
	                                                          <td>3</td>
	                                                          <td>463592</td>
	                                                          <td>RESEARCH AND DEVELOPMENT OF NEW DRUGS</td>
	                                                          <td  style="text-align:center;">
	                                                            <a href="../../application/pdf/view.php?course=462452&info=syllabus" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
	                                                          </td>
	                                                          <td  style="text-align:center;">
	                                                            <a href="../../application/pdf/view.php?course=462452&type=draft&info=evaluate" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
	                                                          </td>
	                                                          <td  style="text-align:center;">
	                                                            <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
	                                                          </td>
	                                                          <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#demo3" class="accordion-toggle">comment</button></td>
	                                                          <td><button type="button" class="btn btn-outline btn-success" data-toggle="modal" data-target="#myModal31">เห็นชอบ</button></td>
	                                                          <td><button type="button" class="btn btn-outline btn-danger" data-toggle="modal" data-target="#myModal32">ไม่เห็นชอบ</button></td>
	                                                          <div id="myModal31" class="modal fade" role="dialog">
	                                                            <div class="modal-dialog">
	                                                              <!-- Modal content-->
	                                                              <div class="modal-content">
	                                                                <div class="modal-header">
	                                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
	                                                                  <h5 class="modal-title"><b>คอมเม้นท์</b></h5>
	                                                                </div>
	                                                                <div class="modal-body">
	                                                                  <div class="row">
	                                                                    <div class="col-md-12">
	                                                                      <form>
	                                                                        <div class="form-group">
	                                                                          <textarea name="comment" rows="8" cols="70" class="form-control"></textarea>
	                                                                        </div>
	                                                                        <button class="btn btn-outline btn-primary"  type="submit" name="button">ยืนยัน</button>
	                                                                      </form>
	                                                                    </div>
	                                                                  </div>
	                                                                </div>
	                                                                <div class="modal-footer">
	                                                                  <button type="button" class="btn btn-danger btn-outline" data-dismiss="modal">ปิด</button>
	                                                                </div>
	                                                              </div>

	                                                            </div>
	                                                          </div>
	                                                          <div id="myModal32" class="modal fade" role="dialog">
	                                                            <div class="modal-dialog">
	                                                              <!-- Modal content-->
	                                                              <div class="modal-content">
	                                                                <div class="modal-header">
	                                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
	                                                                  <h5 class="modal-title"><b>คอมเม้นท์</b></h5>
	                                                                </div>
	                                                                <div class="modal-body">
	                                                                  <div class="row">
	                                                                    <div class="col-md-12">
	                                                                      <form>
	                                                                        <div class="form-group">
	                                                                          <textarea name="comment" rows="8" cols="70" class="form-control"></textarea>
	                                                                        </div>
	                                                                        <button class="btn btn-outline btn-primary"  type="submit" name="button">ยืนยัน</button>
	                                                                      </form>
	                                                                    </div>
	                                                                  </div>
	                                                                </div>
	                                                                <div class="modal-footer">
	                                                                  <button type="button" class="btn btn-danger btn-outline" data-dismiss="modal">ปิด</button>
	                                                                </div>
	                                                              </div>

	                                                            </div>
	                                                          </div>
	                                                      </tr>
	                                                      <tr>
	                                                          <td colspan="12" class="hiddenRow">
	                                                            <div class="accordian-body collapse" id="demo3">
	                                                              <div class="panel panel-success">
	                                                                <div class="panel-heading">
	                                                                  <b>คอมเม้นท์คณะกรรมการ</b>
	                                                                </div>
	                                                                <div class="panel-body">
	                                                                  <!-- Modal -->
	                                                                    <div id="myModal3" class="modal fade" role="dialog">
	                                                                      <div class="modal-dialog">

	                                                                        <!-- Modal content-->
	                                                                        <div class="modal-content">
	                                                                          <div class="modal-header">
	                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
	                                                                            <h5 class="modal-title">คอมเม้นท์</h5>
	                                                                          </div>
	                                                                          <div class="modal-body">
	                                                                            <div class="row">
	                                                                              <div class="col-md-12">
	                                                                                <form>
	                                                                                  <div class="form-group">
	                                                                                    <textarea name="comment" rows="8" cols="70" class="form-control"></textarea>
	                                                                                  </div>
	                                                                                  <button class="btn btn-outline btn-primary"  type="submit" name="button">ยืนยัน</button>
	                                                                                </form>
	                                                                              </div>
	                                                                            </div>
	                                                                          </div>
	                                                                          <div class="modal-footer">
	                                                                            <button type="button" class="btn btn-danger btn-outline" data-dismiss="modal">ปิด</button>
	                                                                          </div>
	                                                                        </div>

	                                                                      </div>
	                                                                    </div>
	                                                                  <table class="table ">
	                                                                    <thead>
	                                                                      <th style="width:170px">คณะกรรมการ</th>
	                                                                      <th>คอมเม้นท์</th>
	                                                                    </thead>
	                                                                    <tbody>
	                                                                      <tr>
	                                                                        <td style="width:170px">อ.ขุ้น ธรรมฉันธะ</td>
	                                                                        <td>หัวข้อการบรรยายยังไม่ชัดเจน</td>
	                                                                      </tr>
	                                                                      <tr>
	                                                                        <td style="width:170px">อ.ดุษฎี องค์เทียมสัคค์</td>
	                                                                        <td>ควรเลือกห้องเรียนใหม่ เนื่องจากจำนวนผู้ลงทะเบียนมีจำนวนมาก</td>
	                                                                      </tr>
	                                                                    </tbody>
	                                                                  </table>
	                                                                </div>
	                                                              </div>
	                                                            </div>
	                                                          </td>
	                                                      </tr>
	                                                  </tbody>
	                                              </table>
	                                          </div>
	                                        </div>
	                                    </div>
	                                </div>

	                                <div class="panel panel-success">
	                                    <div class="panel-heading">
	                                        <div class="panel-title">
	                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">ผ่านการประเมิน</a>
	                                        </div>
	                                    </div>
	                                    <div id="collapseTwo" class="panel-collapse collapse">
	                                        <div class="panel-body">
	                                          <div class="table-responsive">
	                                              <table class="table " style="font-size:14px;">
	                                                  <thead>
	                                                      <tr>
	                                                        <th>ลำดับ</th>
	                                                        <th>รหัสวิชา</th>
	                                                        <th>ชื่อวิชา</th>
	                                                        <th  style="text-align:center;">Course</th>
	                                                        <th  style="text-align:center;">Evaluate</th>
	                                                        <th  style="text-align:center;">Special</th>
	                                                        <th></th>
	                                                        <th></th>
	                                                        <th></th>
	                                                      </tr>
	                                                  </thead>
	                                                  <tbody>
	                                                      <tr >
	                                                          <td>1</td>
	                                                          <td>463311</td>
	                                                          <td>PHARMACEUTICAL BIOTECHNOLOGY 1</td>
	                                                          <td  style="text-align:center;">
	                                                            <a href="../../application/pdf/view.php?course=462452&info=syllabus" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
	                                                          </td>
	                                                          <td  style="text-align:center;">
	                                                            <a href="../../application/pdf/view.php?course=462452&type=draft&info=evaluate" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
	                                                          </td>
	                                                          <td  style="text-align:center;">
	                                                            <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
	                                                          </td>
	                                                          <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#demo21" class="accordion-toggle">comment</button></td>
	                                                          <td><button type="button" class="btn btn-outline btn-danger" data-toggle="modal" data-target="#myModal41">ยกเลิกไม่เห็นชอบ</button></td>
	                                                          <div id="myModal41" class="modal fade" role="dialog">
	                                                            <div class="modal-dialog">
	                                                              <!-- Modal content-->
	                                                              <div class="modal-content">
	                                                                <div class="modal-header">
	                                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
	                                                                  <h5 class="modal-title"><b>คอมเม้นท์</b></h5>
	                                                                </div>
	                                                                <div class="modal-body">
	                                                                  <div class="row">
	                                                                    <div class="col-md-12">
	                                                                      <form>
	                                                                        <div class="form-group">
	                                                                          <textarea name="comment" rows="8" cols="70" class="form-control"></textarea>
	                                                                        </div>
	                                                                        <button class="btn btn-outline btn-primary"  type="submit" name="button">ยืนยัน</button>
	                                                                      </form>
	                                                                    </div>
	                                                                  </div>
	                                                                </div>
	                                                                <div class="modal-footer">
	                                                                  <button type="button" class="btn btn-danger btn-outline" data-dismiss="modal">ปิด</button>
	                                                                </div>
	                                                              </div>

	                                                            </div>
	                                                          </div>

	                                                      </tr>
	                                                      <tr class="hiddenRow">
	                                                          <td colspan="12">
	                                                            <div class="accordian-body collapse" id="demo21">
	                                                              <div class="panel panel-success">
	                                                                <div class="panel-heading">
	                                                                  <b>คอมเม้นท์คณะกรรมการ</b>
	                                                                </div>
	                                                                <div class="panel-body">
	                                                                  <!-- Modal -->
	                                                                    <div id="myModal4" class="modal fade" role="dialog">
	                                                                      <div class="modal-dialog">

	                                                                        <!-- Modal content-->
	                                                                        <div class="modal-content">
	                                                                          <div class="modal-header">
	                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
	                                                                            <h5 class="modal-title">คอมเม้นท์</h5>
	                                                                          </div>
	                                                                          <div class="modal-body">
	                                                                            <div class="row">
	                                                                              <div class="col-md-12">
	                                                                                <form>
	                                                                                  <div class="form-group">
	                                                                                    <textarea name="comment" rows="8" cols="70" class="form-control"></textarea>
	                                                                                  </div>
	                                                                                  <button class="btn btn-outline btn-primary"  type="submit" name="button">ยืนยัน</button>
	                                                                                </form>
	                                                                              </div>
	                                                                            </div>
	                                                                          </div>
	                                                                          <div class="modal-footer">
	                                                                            <button type="button" class="btn btn-danger btn-outline" data-dismiss="modal">ปิด</button>
	                                                                          </div>
	                                                                        </div>

	                                                                      </div>
	                                                                    </div>
	                                                                  <table class="table ">
	                                                                    <thead>
	                                                                      <th style="width:170px">คณะกรรมการ</th>
	                                                                      <th>คอมเม้นท์</th>
	                                                                    </thead>
	                                                                    <tbody>
	                                                                      <tr>
	                                                                        <td style="width:170px">อ.ขุ้น ธรรมฉันธะ</td>
	                                                                        <td>เอกสารครบถ้วนสมบูรณ์</td>
	                                                                      </tr>
	                                                                      <tr>
	                                                                        <td style="width:170px">อ.ดุษฎี องค์เทียมสัคค์</td>
	                                                                        <td>แก้ไขตรงสัดสว่นคะแนนร้อยละ</td>
	                                                                      </tr>
	                                                                    </tbody>
	                                                                  </table>
	                                                                </div>
	                                                              </div>
	                                                            </div>
	                                                          </td>
	                                                      </tr>
	                                                      <tr>
	                                                          <td>2</td>
	                                                          <td>463331</td>
	                                                          <td>ORGANIC MEDICINAL CHEMISTRY 1</td>
	                                                          <td  style="text-align:center;">
	                                                            <a href="../../application/pdf/view.php?course=462452&info=syllabus" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
	                                                          </td>
	                                                          <td  style="text-align:center;">
	                                                            <a href="../../application/pdf/view.php?course=462452&type=draft&info=evaluate" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
	                                                          </td>
	                                                          <td  style="text-align:center;">
	                                                            <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
	                                                          </td>
	                                                          <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#demo22" class="accordion-toggle">comment</button></td>
	                                                          <td><button type="button" class="btn btn-outline btn-danger" data-toggle="modal" data-target="#myModal51">ยกเลิกไม่เห็นชอบ</button></td>
	                                                          <div id="myModal51" class="modal fade" role="dialog">
	                                                            <div class="modal-dialog">
	                                                              <!-- Modal content-->
	                                                              <div class="modal-content">
	                                                                <div class="modal-header">
	                                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
	                                                                  <h5 class="modal-title"><b>คอมเม้นท์</b></h5>
	                                                                </div>
	                                                                <div class="modal-body">
	                                                                  <div class="row">
	                                                                    <div class="col-md-12">
	                                                                      <form>
	                                                                        <div class="form-group">
	                                                                          <textarea name="comment" rows="8" cols="70" class="form-control"></textarea>
	                                                                        </div>
	                                                                        <button class="btn btn-outline btn-primary"  type="submit" name="button">ยืนยัน</button>
	                                                                      </form>
	                                                                    </div>
	                                                                  </div>
	                                                                </div>
	                                                                <div class="modal-footer">
	                                                                  <button type="button" class="btn btn-danger btn-outline" data-dismiss="modal">ปิด</button>
	                                                                </div>
	                                                              </div>

	                                                            </div>
	                                                          </div>
	                                                      </tr>
	                                                      <tr class="hiddenRow">
	                                                          <td colspan="12">
	                                                            <div class="accordian-body collapse" id="demo22">
	                                                              <div class="panel panel-success">
	                                                                <div class="panel-heading">
	                                                                  <b>คอมเม้นท์คณะกรรมการ</b>
	                                                                </div>
	                                                                <div class="panel-body">
	                                                                  <!-- Modal -->
	                                                                    <div id="myModal5" class="modal fade" role="dialog">
	                                                                      <div class="modal-dialog">

	                                                                        <!-- Modal content-->
	                                                                        <div class="modal-content">
	                                                                          <div class="modal-header">
	                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
	                                                                            <h5 class="modal-title">คอมเม้นท์</h5>
	                                                                          </div>
	                                                                          <div class="modal-body">
	                                                                            <div class="row">
	                                                                              <div class="col-md-12">
	                                                                                <form>
	                                                                                  <div class="form-group">
	                                                                                    <textarea name="comment" rows="8" cols="70" class="form-control"></textarea>
	                                                                                  </div>
	                                                                                  <button class="btn btn-outline btn-primary"  type="submit" name="button">ยืนยัน</button>
	                                                                                </form>
	                                                                              </div>
	                                                                            </div>
	                                                                          </div>
	                                                                          <div class="modal-footer">
	                                                                            <button type="button" class="btn btn-danger btn-outline" data-dismiss="modal">ปิด</button>
	                                                                          </div>
	                                                                        </div>

	                                                                      </div>
	                                                                    </div>
	                                                                  <table class="table ">
	                                                                    <thead>
	                                                                      <th style="width:170px">คณะกรรมการ</th>
	                                                                      <th>คอมเม้นท์</th>
	                                                                    </thead>
	                                                                    <tbody>
	                                                                      <tr>
	                                                                        <td style="width:170px">อ.ขุ้น ธรรมฉันธะ</td>
	                                                                        <td>แก้ไขคำผิดส่วนของรายละเอียดวิชา</td>
	                                                                      </tr>
	                                                                      <tr>
	                                                                        <td style="width:170px">อ.ดุษฎี องค์เทียมสัคค์</td>
	                                                                        <td>เอกสารครบถ้วนดี</td>
	                                                                      </tr>
	                                                                    </tbody>
	                                                                  </table>
	                                                                </div>
	                                                              </div>
	                                                            </div>
	                                                          </td>
	                                                      </tr>
	                                                      <tr  >
	                                                          <td>3</td>
	                                                          <td>464301</td>
	                                                          <td>FUNDAMENTAL OF PHARMACOKINETICS</td>
	                                                          <td  style="text-align:center;">
	                                                            <a href="../../application/pdf/view.php?course=462452&info=syllabus" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
	                                                          </td>
	                                                          <td  style="text-align:center;">
	                                                            <a href="../../application/pdf/view.php?course=462452&type=draft&info=evaluate" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
	                                                          </td>
	                                                          <td  style="text-align:center;">
	                                                            <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
	                                                          </td>
	                                                          <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#demo23" class="accordion-toggle">comment</button></td>
	                                                          <td><button type="button" class="btn btn-outline btn-danger" data-toggle="modal" data-target="#myModal61">ยกเลิกไม่เห็นชอบ</button></td>
	                                                          <div id="myModal61" class="modal fade" role="dialog">
	                                                            <div class="modal-dialog">
	                                                              <!-- Modal content-->
	                                                              <div class="modal-content">
	                                                                <div class="modal-header">
	                                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
	                                                                  <h5 class="modal-title"><b>คอมเม้นท์</b></h5>
	                                                                </div>
	                                                                <div class="modal-body">
	                                                                  <div class="row">
	                                                                    <div class="col-md-12">
	                                                                      <form>
	                                                                        <div class="form-group">
	                                                                          <textarea name="comment" rows="8" cols="70" class="form-control"></textarea>
	                                                                        </div>
	                                                                        <button class="btn btn-outline btn-primary"  type="submit" name="button">ยืนยัน</button>
	                                                                      </form>
	                                                                    </div>
	                                                                  </div>
	                                                                </div>
	                                                                <div class="modal-footer">
	                                                                  <button type="button" class="btn btn-danger btn-outline" data-dismiss="modal">ปิด</button>
	                                                                </div>
	                                                              </div>

	                                                            </div>
	                                                          </div>
	                                                      </tr>
	                                                      <tr class="hiddenRow">
	                                                          <td colspan="12">
	                                                            <div class="accordian-body collapse" id="demo23">
	                                                              <div class="panel panel-success">
	                                                                <div class="panel-heading">
	                                                                  <b>คอมเม้นท์คณะกรรมการ</b>
	                                                                </div>
	                                                                <div class="panel-body">
	                                                                  <!-- Modal -->
	                                                                    <div id="myModal6" class="modal fade" role="dialog">
	                                                                      <div class="modal-dialog">

	                                                                        <!-- Modal content-->
	                                                                        <div class="modal-content">
	                                                                          <div class="modal-header">
	                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
	                                                                            <h5 class="modal-title">คอมเม้นท์</h5>
	                                                                          </div>
	                                                                          <div class="modal-body">
	                                                                            <div class="row">
	                                                                              <div class="col-md-12">
	                                                                                <form>
	                                                                                  <div class="form-group">
	                                                                                    <textarea name="comment" rows="8" cols="70" class="form-control"></textarea>
	                                                                                  </div>
	                                                                                  <button class="btn btn-outline btn-primary"  type="submit" name="button">ยืนยัน</button>
	                                                                                </form>
	                                                                              </div>
	                                                                            </div>
	                                                                          </div>
	                                                                          <div class="modal-footer">
	                                                                            <button type="button" class="btn btn-danger btn-outline" data-dismiss="modal">ปิด</button>
	                                                                          </div>
	                                                                        </div>

	                                                                      </div>
	                                                                    </div>
	                                                                  <table class="table ">
	                                                                    <thead>
	                                                                      <th style="width:170px">คณะกรรมการ</th>
	                                                                      <th>คอมเม้นท์</th>
	                                                                    </thead>
	                                                                    <tbody>
	                                                                      <tr>
	                                                                        <td style="width:170px">อ.ขุ้น ธรรมฉันธะ</td>
	                                                                        <td>กระบวนวิชา464301 ยังไม่ผ่าน เพราะหลักสูตรเกินกรุณาตรวจสอบหลักสูตรอีกครั้ง</td>
	                                                                      </tr>
	                                                                      <tr>
	                                                                        <td style="width:170px">อ.ดุษฎี องค์เทียมสัคค์</td>
	                                                                        <td>วันที่ที่จะให้อาจารย์พิเศษมาช่วยบรรยายตรงกับรายวิชา464301 เนื่องจากสถานที่ไม่เอื้ออำนวยขอความกรุณากลับไปตรวจสอบอีกครั้ง</td>
	                                                                      </tr>
	                                                                    </tbody>
	                                                                  </table>
	                                                                </div>
	                                                              </div>
	                                                            </div>
	                                                          </td>
	                                                      </tr>
	                                                  </tbody>
	                                              </table>
	                                          </div>
	                                    </div>
	                                </div>
	                              </div>
	                                <div class="panel panel-danger">
	                                    <div class="panel-heading">
	                                        <div class="panel-title">
	                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">ไม่ผ่านการประเมิน</a>
	                                        </div>
	                                    </div>
	                                    <div id="collapseThree" class="panel-collapse collapse">
	                                        <div class="panel-body">
	                                          <div class="table-responsive">
	                                              <table class="table  " style="font-size:14px;">
	                                                  <thead>
	                                                      <tr>
	                                                        <th>ลำดับ</th>
	                                                        <th>รหัสวิชา</th>
	                                                        <th>ชื่อวิชา</th>
	                                                        <th  style="text-align:center;">Course</th>
	                                                        <th  style="text-align:center;">Evaluate</th>
	                                                        <th  style="text-align:center;">Special</th>
	                                                        <th></th>
	                                                        <th></th>
	                                                        <th></th>
	                                                      </tr>
	                                                  </thead>
	                                                  <tbody>
	                                                      <tr >
	                                                          <td>1</td>
	                                                          <td>463332</td>
	                                                          <td>ORGANIC MEDICINAL CHEMISTRY 2</td>
	                                                          <td  style="text-align:center;">
	                                                            <a href="../../application/pdf/view.php?course=462452&info=syllabus" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
	                                                          </td>
	                                                          <td  style="text-align:center;">
	                                                            <a href="../../application/pdf/view.php?course=462452&type=draft&info=evaluate" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
	                                                          </td>
	                                                          <td  style="text-align:center;">
	                                                            <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
	                                                          </td>
	                                                          <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#demo31" class="accordion-toggle">comment</button></td>
	                                                          <td><button type="button" class="btn btn-outline btn-success" data-toggle="modal" data-target="#myModal71">เห็นชอบ</button></td>
	                                                          <div id="myModal71" class="modal fade" role="dialog">
	                                                            <div class="modal-dialog">
	                                                              <!-- Modal content-->
	                                                              <div class="modal-content">
	                                                                <div class="modal-header">
	                                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
	                                                                  <h5 class="modal-title"><b>คอมเม้นท์</b></h5>
	                                                                </div>
	                                                                <div class="modal-body">
	                                                                  <div class="row">
	                                                                    <div class="col-md-12">
	                                                                      <form>
	                                                                        <div class="form-group">
	                                                                          <textarea name="comment" rows="8" cols="70" class="form-control"></textarea>
	                                                                        </div>
	                                                                        <button class="btn btn-outline btn-primary"  type="submit" name="button">ยืนยัน</button>
	                                                                      </form>
	                                                                    </div>
	                                                                  </div>
	                                                                </div>
	                                                                <div class="modal-footer">
	                                                                  <button type="button" class="btn btn-danger btn-outline" data-dismiss="modal">ปิด</button>
	                                                                </div>
	                                                              </div>

	                                                            </div>
	                                                          </div>
	                                                      </tr>
	                                                      <tr class="hiddenRow">
	                                                          <td colspan="12">
	                                                            <div class="accordian-body collapse" id="demo31">
	                                                              <div class="panel panel-success">
	                                                                <div class="panel-heading">
	                                                                  <b>คอมเม้นท์คณะกรรมการ</b>
	                                                                </div>
	                                                                <div class="panel-body">
	                                                                  <!-- Modal -->
	                                                                    <div id="myModal7" class="modal fade" role="dialog">
	                                                                      <div class="modal-dialog">

	                                                                        <!-- Modal content-->
	                                                                        <div class="modal-content">
	                                                                          <div class="modal-header">
	                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
	                                                                            <h5 class="modal-title">คอมเม้นท์</h5>
	                                                                          </div>
	                                                                          <div class="modal-body">
	                                                                            <div class="row">
	                                                                              <div class="col-md-12">
	                                                                                <form>
	                                                                                  <div class="form-group">
	                                                                                    <textarea name="comment" rows="8" cols="70" class="form-control"></textarea>
	                                                                                  </div>
	                                                                                  <button class="btn btn-outline btn-primary"  type="submit" name="button">ยืนยัน</button>
	                                                                                </form>
	                                                                              </div>
	                                                                            </div>
	                                                                          </div>
	                                                                          <div class="modal-footer">
	                                                                            <button type="button" class="btn btn-danger btn-outline" data-dismiss="modal">ปิด</button>
	                                                                          </div>
	                                                                        </div>

	                                                                      </div>
	                                                                    </div>
	                                                                  <table class="table ">
	                                                                    <thead>
	                                                                      <th style="width:170px">คณะกรรมการ</th>
	                                                                      <th>คอมเม้นท์</th>
	                                                                    </thead>
	                                                                    <tbody>
	                                                                      <tr>
	                                                                        <td style="width:170px">อ.ขุ้น ธรรมฉันธะ</td>
	                                                                        <td>กระบวนวิชา463332 ยังขาดรายชื่ออาจารย์ผู้ปฏิบัติการ</td>
	                                                                      </tr>
	                                                                      <tr>
	                                                                        <td style="width:170px">อ.ดุษฎี องค์เทียมสัคค์</td>
	                                                                        <td>การวัดผลการศึกษานั้นยังไม่ชัดเจน</td>
	                                                                      </tr>
	                                                                    </tbody>
	                                                                  </table>
	                                                                </div>
	                                                              </div>
	                                                            </div>
	                                                          </td>
	                                                      </tr>

	                                                      <tr >

	                                                          <td>2</td>
	                                                          <td>463342</td>
	                                                          <td>PHARMACEUTICAL QUALITY ASSURANCE 2</td>
	                                                          <td  style="text-align:center;">
	                                                            <a href="../../application/pdf/view.php?course=462452&info=syllabus" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
	                                                          </td>
	                                                          <td  style="text-align:center;">
	                                                            <a href="../../application/pdf/view.php?course=462452&type=draft&info=evaluate" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
	                                                          </td>
	                                                          <td  style="text-align:center;">
	                                                            <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
	                                                          </td>
	                                                          <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#demo32" class="accordion-toggle">comment</button></td>
	                                                          <td><button type="button" class="btn btn-outline btn-success" data-toggle="modal" data-target="#myModal81">เห็นชอบ</button></td>
	                                                          <div id="myModal81" class="modal fade" role="dialog">
	                                                            <div class="modal-dialog">
	                                                              <!-- Modal content-->
	                                                              <div class="modal-content">
	                                                                <div class="modal-header">
	                                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
	                                                                  <h5 class="modal-title"><b>คอมเม้นท์</b></h5>
	                                                                </div>
	                                                                <div class="modal-body">
	                                                                  <div class="row">
	                                                                    <div class="col-md-12">
	                                                                      <form>
	                                                                        <div class="form-group">
	                                                                          <textarea name="comment" rows="8" cols="70" class="form-control"></textarea>
	                                                                        </div>
	                                                                        <button class="btn btn-outline btn-primary"  type="submit" name="button">ยืนยัน</button>
	                                                                      </form>
	                                                                    </div>
	                                                                  </div>
	                                                                </div>
	                                                                <div class="modal-footer">
	                                                                  <button type="button" class="btn btn-danger btn-outline" data-dismiss="modal">ปิด</button>
	                                                                </div>
	                                                              </div>

	                                                            </div>
	                                                          </div>
	                                                      </tr>
	                                                      <tr class="hiddenRow">
	                                                          <td colspan="12">
	                                                            <div class="accordian-body collapse" id="demo32">
	                                                              <div class="panel panel-success">
	                                                                <div class="panel-heading">
	                                                                  <b>คอมเม้นท์คณะกรรมการ</b>
	                                                                </div>
	                                                                <div class="panel-body">
	                                                                  <!-- Modal -->
	                                                                    <div id="myModal8" class="modal fade" role="dialog">
	                                                                      <div class="modal-dialog">

	                                                                        <!-- Modal content-->
	                                                                        <div class="modal-content">
	                                                                          <div class="modal-header">
	                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
	                                                                            <h5 class="modal-title">คอมเม้นท์</h5>
	                                                                          </div>
	                                                                          <div class="modal-body">
	                                                                            <div class="row">
	                                                                              <div class="col-md-12">
	                                                                                <form>
	                                                                                  <div class="form-group">
	                                                                                    <textarea name="comment" rows="8" cols="70" class="form-control"></textarea>
	                                                                                  </div>
	                                                                                  <button class="btn btn-outline btn-primary"  type="submit" name="button">ยืนยัน</button>
	                                                                                </form>
	                                                                              </div>
	                                                                            </div>
	                                                                          </div>
	                                                                          <div class="modal-footer">
	                                                                            <button type="button" class="btn btn-danger btn-outline" data-dismiss="modal">ปิด</button>
	                                                                          </div>
	                                                                        </div>

	                                                                      </div>
	                                                                    </div>
	                                                                  <table class="table ">
	                                                                    <thead>
	                                                                      <th style="width:170px">คณะกรรมการ</th>
	                                                                      <th>คอมเม้นท์</th>
	                                                                    </thead>
	                                                                    <tbody>
	                                                                      <tr>
	                                                                        <td style="width:170px">อ.ขุ้น ธรรมฉันธะ</td>
	                                                                        <td>เกณฑ์คะแนนยังค่อยข้างสูง</td>
	                                                                      </tr>
	                                                                      <tr>
	                                                                        <td style="width:170px">อ.ดุษฎี องค์เทียมสัคค์</td>
	                                                                        <td>เอกสารครบถ้วน แนะปรับคะแนนกิจกรรมเพิ่มขึ้น</td>
	                                                                      </tr>
	                                                                    </tbody>
	                                                                  </table>
	                                                                </div>
	                                                              </div>
	                                                            </div>
	                                                          </td>
	                                                      </tr>

	                                                      <tr>
	                                                          <td>3</td>
	                                                          <td>464445</td>
	                                                          <td>PHARMACY PUBLIC HEALTH</td>
	                                                          <td  style="text-align:center;">
	                                                            <a href="../../application/pdf/view.php?course=462452&info=syllabus" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
	                                                          </td>
	                                                          <td  style="text-align:center;">
	                                                            <a href="../../application/pdf/view.php?course=462452&type=draft&info=evaluate" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
	                                                          </td>
	                                                          <td  style="text-align:center;">
	                                                            <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
	                                                          </td>
	                                                          <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#demo33" class="accordion-toggle">comment</button></td>
	                                                          <td><button type="button" class="btn btn-outline btn-success" data-toggle="modal" data-target="#myModal91">เห็นชอบ</button></td>
	                                                          <div id="myModal91" class="modal fade" role="dialog">
	                                                            <div class="modal-dialog">
	                                                              <!-- Modal content-->
	                                                              <div class="modal-content">
	                                                                <div class="modal-header">
	                                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
	                                                                  <h5 class="modal-title"><b>คอมเม้นท์</b></h5>
	                                                                </div>
	                                                                <div class="modal-body">
	                                                                  <div class="row">
	                                                                    <div class="col-md-12">
	                                                                      <form>
	                                                                        <div class="form-group">
	                                                                          <textarea name="comment" rows="8" cols="70" class="form-control"></textarea>
	                                                                        </div>
	                                                                        <button class="btn btn-outline btn-primary"  type="submit" name="button">ยืนยัน</button>
	                                                                      </form>
	                                                                    </div>
	                                                                  </div>
	                                                                </div>
	                                                                <div class="modal-footer">
	                                                                  <button type="button" class="btn btn-danger btn-outline" data-dismiss="modal">ปิด</button>
	                                                                </div>
	                                                              </div>

	                                                            </div>
	                                                          </div>
	                                                      </tr>
	                                                      <tr class="hiddenRow">
	                                                          <td colspan="12">
	                                                            <div class="accordian-body collapse" id="demo33">
	                                                              <div class="panel panel-success">
	                                                                <div class="panel-heading">
	                                                                  <b>คอมเม้นท์คณะกรรมการ</b>
	                                                                </div>
	                                                                <div class="panel-body">
	                                                                  <!-- Modal -->
	                                                                    <div id="myModal9" class="modal fade" role="dialog">
	                                                                      <div class="modal-dialog">

	                                                                        <!-- Modal content-->
	                                                                        <div class="modal-content">
	                                                                          <div class="modal-header">
	                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
	                                                                            <h5 class="modal-title">คอมเม้นท์</h5>
	                                                                          </div>
	                                                                          <div class="modal-body">
	                                                                            <div class="row">
	                                                                              <div class="col-md-12">
	                                                                                <form>
	                                                                                  <div class="form-group">
	                                                                                    <textarea name="comment" rows="8" cols="70" class="form-control"></textarea>
	                                                                                  </div>
	                                                                                  <button class="btn btn-outline btn-primary"  type="submit" name="button">ยืนยัน</button>
	                                                                                </form>
	                                                                              </div>
	                                                                            </div>
	                                                                          </div>
	                                                                          <div class="modal-footer">
	                                                                            <button type="button" class="btn btn-danger btn-outline" data-dismiss="modal">ปิด</button>
	                                                                          </div>
	                                                                        </div>

	                                                                      </div>
	                                                                    </div>
	                                                                  <table class="table ">
	                                                                    <thead>
	                                                                      <th style="width:170px">คณะกรรมการ</th>
	                                                                      <th>คอมเม้นท์</th>
	                                                                    </thead>
	                                                                    <tbody>
	                                                                      <tr>
	                                                                        <td style="width:170px">อ.ขุ้น ธรรมฉันธะ</td>
	                                                                        <td>วิธีตัดเกรดในส่วนของการอิงเกณฑ์นั้นยังไม่ชัดเจน</td>
	                                                                      </tr>
	                                                                      <tr>
	                                                                        <td style="width:170px">อ.ดุษฎี องค์เทียมสัคค์</td>
	                                                                        <td>อาจารย์ผู้สอนมีจำนวนน้อยมาก</td>
	                                                                      </tr>
	                                                                    </tbody>
	                                                                  </table>
	                                                                </div>
	                                                              </div>
	                                                            </div>
	                                                          </td>
	                                                      </tr>

	                                                  </tbody>
	                                              </table>
	                                          </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                        <!-- .panel-body -->
	                    </div>
	                  </div>
	                </div>
	    </div>

	</body>

</html>
<?php
function curl($type)
{
	$schema = isset($_SERVER['HTTPS']) ? "https:" : "http:";
	$dirname = dirname(dirname((dirname($_SERVER['REQUEST_URI']))));
	$url    = $schema."//".$_SERVER['HTTP_HOST'].$dirname."/application/information/index.php";
  $ch = curl_init();
  // set url
  curl_setopt($ch, CURLOPT_URL, $url);
  //return the transfer as a string
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  //set post data
	curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query(array('type' => $type)));
  // $output contains the output string
  $output = curl_exec($ch);

	if($output=== false)
	{
			return 'Curl error: ' . curl_error($ch);
	}
	else
	{
			return $output;
	}
  // close curl resource to free up system resources
	curl_close($ch);


}
 ?>
