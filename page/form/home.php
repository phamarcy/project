<?php
require_once(__DIR__.'/../../application/class/curl.php');
require_once(__DIR__.'/../../application/class/manage_deadline.php');
require_once(__DIR__."/../../application/class/approval.php");
session_start();
$information_url = "application/information/index.php";
$curl = new CURL();
$deadline = new Deadline;
$approve = new approval($_SESSION['level']);

$data['level'] = $_SESSION['level'];
$result = $curl->Request($data,$information_url);
$semeter= $deadline->Get_Current_Semester();

$var=$approve->Get_Approval_data($_SESSION['id']);
$data= json_decode($var, true);

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
		<style>
			a[disabled="disabled"] {
				<?php if ($_SESSION['level']==2 or $_SESSION['level']==3) {
					?>pointer-events: none;
					<?php
				}
				?>
			}

			#statcf {
				color: #0e9d14;
			}

			#statn {
				color: #ec2c2c;
			}

			#statwt {
				color: #acb500;
			}

			#statal {
				color: #da9001;
			}
		</style>
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
				<?php
					if($_SESSION['level'] != 2 && $_SESSION['level'] !=3 )
				{
					?>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h5 class="panel-title">
	              <b>รายชื่อวิชาที่รับผิดชอบ</b>
	          </h5>
					</div>
					<!-- .panel-heading -->
					<div class="panel-body" style="font-size:15px">
						<div class="glyphicon glyphicon-alert" style="color: red;"></div><b style="color: red;"> วันสุดท้ายสำหรับกรอกข้อมูลกระบวนวิชา <?php echo $deadline['edit']['day'].' '.$deadline['edit']['month'].' '.$deadline['edit']['year']; ?> </b>

		<?php	}
					if($_SESSION['level'] == 4 || $_SESSION['level'] == 5) {  ?>
						<div class="glyphicon glyphicon-alert" style="color: red;"></div><b style="color: red;"> วันสุดท้ายสำหรับประเมินกระบวนวิชา <?php echo $deadline['con']['day'].' '.$deadline['con']['month'].' '.$deadline['con']['year']; ?> </b>
						<?php }
						else if($_SESSION['level'] == 6)
						{ ?>
							<div class="glyphicon glyphicon-alert" style="color: red;"></div><b style="color: red;"> วันสุดท้ายสำหรับอนุมัติกระบวนวิชา <?php echo $deadline['approve']['day'].' '.$deadline['approve']['month'].' '.$deadline['approve']['year']; ?> </b>
					<?php	} ?>
					<br>
						<div class="panel-group" id="accordion1">
							<div class="panel panel-success">
								<div class="panel-heading">
									<h3 class="panel-title">
									<a data-toggle="collapse" href="#collapse2" >
									<li><b><u>รหัสกระบวนวิชา</u></b> : 204111 </li>
								</h3>
								</div>
									<div class="panel-body" style="font-size:14px;">

										<div class="panel-group">
											<div class="panel panel-default">
												<div class="panel-heading">
													<h3 class="panel-title">
												<a data-toggle="collapse" href="#collapse3" disabled="disabled">
												 <i class="fa fa-file-o fa-fw"></i><b> แบบแจ้งวิธีการวัดผล ประเมินผลการศึกษาและกระบวนวิชา  </b><i class="fa fa-long-arrow-right fa-fw"></i> สถานะการอนุมัติ : <b id="statcf">อนุมัติ <i class="fa fa-check fa-fw"></i></b></a>
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

									</div>
							</div>
						</div>
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
