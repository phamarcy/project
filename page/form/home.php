<?php
require_once(__DIR__.'/../../application/class/curl.php');
require_once(__DIR__.'/../../application/class/manage_deadline.php');
require_once(__DIR__."/../../application/class/approval.php");
session_start();

if(!isset($_SESSION['level']) || !isset($_SESSION['fname']) || !isset($_SESSION['lname']) || !isset($_SESSION['id']))
{
    die('กรุณา Login ใหม่');
}
$information_url = "application/information/index.php";
$curl = new CURL();
$deadline = new Deadline;
$approve = new approval($_SESSION['level']);
$data['level'] = $_SESSION['level'];
$deadline_form = $deadline->Get_Current_Deadline($_SESSION['level']);
$semester = $deadline->Get_Current_Semester();
$var=$approve->Check_Status($_SESSION['id']);
$data_course= json_decode($var, true);

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
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
	<link rel="stylesheet" href="../dist/css/scrollbar.css">
	<script src="../dist/js/sweetalert2.min.js"></script>
	<link rel="stylesheet" href="../dist/css/sweetalert2.min.css">
	<title></title>
	<style>
		#hover i:hover {

			font-size: 30px;
			font-weight: bold;
			color: red;
		}

		#statc {
			color: #0d4b9d;
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
	<?php if($semester['id'] == false)
		{
			echo '<div class="alert alert-danger"><center>ระบบยังไม่มีภาค และปีการศึกษาปัจจุบัน กรุณาติดต่อเจ้าหน้าที่ </center></div>';
			die();
		}
		?>
	<div id="wrapper" style="padding-left: 30px; padding-right: 30px;">
		<div class="container">
			<div class="row">
				<center>
					<h3 class="page-header"><b>ภาคเรียนที่ <?php echo $semester['semester'];?> &nbsp;ปีการศึกษา <?php echo $semester['year'];?></b></h3>
				</center>
			</div>
			<br>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h5 class="panel-title" style="font-size:14px;">
						<?php
							if ($_SESSION['level']==1) {
								echo "<b>รายชื่อวิชาที่รับผิดชอบ</b>";
							}else {
								echo "<b>รายชื่อวิชา</b>";
							}
							?>
					</h5>
				</div>
				<!-- .panel-heading -->
				<div class="panel-body">

					<?php if ($_SESSION['level'] == 1 || $_SESSION['level'] == 2 || $_SESSION['level'] == 3):?>
					<?php if (isset($deadline_form['measure'])): ?>
					<div class="glyphicon glyphicon-alert" style="color: red;font-size:16px;"></div><b style="color: red;font-size:16px;"> วันสุดท้ายสำหรับกรอกแบบแจ้งวิธีการวัดผลและประเมินผลการศึกษา <?php echo $deadline_form['measure']['day'].' '.$deadline_form['measure']['month'].' '.$deadline_form['measure']['year']."<br>"; ?> </b>
					<?php endif; ?>
					<?php if (isset($deadline_form['syllabus'])): ?>
					<div class="glyphicon glyphicon-alert" style="color: red;font-size:16px;"></div><b style="color: red;font-size:16px;"> วันสุดท้ายสำหรับอัพโหลดไฟล์ course syllabus <?php echo $deadline_form['syllabus']['day'].' '.$deadline_form['syllabus']['month'].' '.$deadline_form['syllabus']['year']."<br>"; ?> </b>
					<?php endif; ?>
					<?php if (isset($deadline_form['special'])): ?>
					<div class="glyphicon glyphicon-alert" style="color: red;font-size:16px;"></div><b style="color: red;font-size:16px;"> วันสุดท้ายสำหรับกรอกแบบขออนุมัติเชิญอาจารย์พิเศษ <?php echo $deadline_form['special']['day'].' '.$deadline_form['special']['month'].' '.$deadline_form['special']['year']."<br>"; ?> </b>
					<?php endif; ?>


					<?php endif; ?>
					<?php
				if($_SESSION['level'] == 4 || $_SESSION['level'] == 5  || $_SESSION['level'] == 2 || $_SESSION['level'] == 3) {  ?>
						<?php if (isset($deadline_form['evaluate'])): ?>
						<div class="glyphicon glyphicon-alert" style="color: red;font-size:16px;"></div><b style="color: red;font-size:16px;"> วันสุดท้ายสำหรับประเมินกระบวนวิชา <?php echo $deadline_form['evaluate']['day'].' '.$deadline_form['evaluate']['month'].' '.$deadline_form['evaluate']['year']."<br>"; ?> </b>
						<?php endif; ?>
						<?php }
					if($_SESSION['level'] == 6  || $_SESSION['level'] == 2 || $_SESSION['level'] == 3)
					{ ?>
						<?php if (isset($deadline_form['approve'])): ?>
						<div class="glyphicon glyphicon-alert" style="color: red;font-size:16px;"></div><b style="color: red;font-size:16px;"> วันสุดท้ายสำหรับอนุมัติกระบวนวิชา <?php echo $deadline_form['approve']['day'].' '.$deadline_form['approve']['month'].' '.$deadline_form['approve']['year']."<br>"; ?> </b>
						<?php endif; ?>
						<?php	} ?>
							<br>

							<?php if (is_array($data_course) || is_object($data_course)){ ?>

							<?php foreach ($data_course as $key => $value_course):
								?>

							<?php
									$status_text="";
									switch ($value_course['evaluate']['status']) {
										case '0':
										$status_text='<b id="statc">รอการกรอกข้อมูล <i class="fa fa-pencil-square-o  fa-fw"></i></b>';
										break;
										case '1':
										$status_text='<b id="statwt">รอการพิจารณา <i class="fa  fa-clock-o fa-fw"></i></b>';
											break;
										case '2':
										$status_text='<b id="statn">ไม่เห็นชอบ <i class="fa fa-pencil-square-o  fa-fw"></i></b>';
											break;
										case '3':
										$status_text='<b id="statal">มีการแก้ไขจากคณะกรรมการภาค <i class="fa fa-pencil-square fa-fw"></i></b>';
											break;
										case '4':
										$status_text='<b id="statcf">ผ่านการประเมินจากคณะกรรมการภาค <i class="fa fa-user fa-fw"></i></b>';
											break;
										case '5':
										$status_text='<b id="statwt">รอคณะอนุมัติ <i class="fa fa-user-plus fa-fw"></i></b>';
											break;
										case '6':
										$status_text='<b id="statal">มีการแก้ไขจากผู้บริหาร <i class="fa fa-check fa-fw"></i></b>';
											break;
									case '7':
									$status_text='<b id="statcf">ผ่าน <i class="fa fa-check fa-fw"></i></b>';
									break;

										}


								/*echo "<pre>"; var_export($value_course);echo "</pre>";*/ ?>
								<div class="panel-group" id="accordione1">
									<div class="panel panel-success">
										<div class="panel-heading">
											<h3 class="panel-title" style="font-size:14px;">
												<li><b><u>กระบวนวิชา</u></b> :
													<?php echo $value_course['id']." ".$value_course['name']?> </li>
											</h3>
										</div>
										<div class="panel-body" style="font-size:14px;">

											<div class="panel-group">
												<div class="panel panel-default">
													<div class="panel-heading">
														<h3 class="panel-title" style="font-size:14px;">
															<a data-toggle="collapse" href="#evaluate<?php echo $value_course['id']."_".$key ?>">
															<i class="fa fa-file-o fa-fw"></i><b> แบบแจ้งวิธีการวัดผล ประเมินผลการศึกษาและประมวลกระบวนวิชา  </b>
															<?php if (isset($value_course['pdf']) && $_SESSION['level']==3 && $value_course['evaluate']['status']!=0 ): ?>
																	<a id="hover" href="<?php echo $value_course['pdf'] ?>" target="_blank" TITLE="คลิ็ก ! เพื่ดเปิดPDF"><i type="button" class="fa fa-file-pdf-o fa-2x " ></i></a>
															<?php endif; ?>
															<i class="fa fa-long-arrow-right fa-fw"></i>
															<?php echo $status_text ?>
															</a>
															<?php if ($_SESSION['level']==3): ?>
															<?php if(($value_course['evaluate']['status'])==4){ ?>
															<button class='btn btn-outline btn-success' onclick='senttohead(<?php echo $value_course['id'] ?>);'>ยืนยัน</button>
															<?php
															} ?>
																<?php endif; ?>

																<?php if ($_SESSION['level']==2): ?>
																<?php if(($value_course['evaluate']['status'])==1 ){ ?>
																<button class='btn btn-outline btn-success' onclick='sendtoboard(<?php echo $value_course['id'] ?>);'>ผ่าน</button>
																<?php
															} ?>
																	<?php endif; ?>

														</h3>
													</div>
													<?php if (isset($_SESSION['level'])) { ?>
													<div id="evaluate<?php echo $value_course['id']."_".$key ?>" class="panel-collapse collapse">
														<div class="panel-body" style="font-size:14px;">
															<table class="table " style="font-size:14px;">
																<thead>
																	<?php if ($_SESSION['level'] >=2  || $_SESSION['admission']==1): ?>
																	<th style="width:250px">คณะกรรมการ</th>
																	<?php endif; ?>
																	<th>ข้อเสนอแนะ</th>
																	<th>วัน/เวลา</th>
																</thead>
																<tbody>

																	<?php
																		if (!empty($value_course['evaluate']['comment'])) {
																		foreach ($value_course['evaluate']['comment'] as $comment): ?>
																		<tr>
																			<?php if ($_SESSION['level'] >=2): ?>
																			<td style="width:250px">
																				<?php echo $comment['name'] ?>
																			</td>
																			<?php endif; ?>
																			<td>
																				<?php if ($comment['comment']=="" or $comment['comment'] ==NULL) {
																				echo "-";
																			} else {
																				echo $comment['comment'];
																			}
																			?>
																			</td>
																			<td>
																				<?php if ($comment['date']=="") {
																			echo "-";
																			} else {
																			echo $comment['date'];
																			}  ?>
																			</td>
																		</tr>
																		<?php endforeach;  }?>
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
														<h3 class="panel-title" style="font-size:14px;">
															<a data-toggle="collapse" href="#special<?php echo $value_course['id']."_".$key ?>" disabled="disabled">
													<i class="fa fa-file-o fa-fw"></i><b>  แบบขออนุมัติเชิญอาจารย์พิเศษ </b></b></a>
														</h3>
													</div>
													<?php if (isset($_SESSION['level'])) { ?>
													<div id="special<?php echo $value_course['id']."_".$key ?>" class="panel-collapse collapse  in">
														<div class="panel-body" style="font-size:14px;">
															<div class="panel-group" id="accordion">

																<?php foreach ($value_course['special'] as $keysp => $valuesp):

																	switch ($valuesp['status']) {
														case '0':
														$status_sp='<b id="statc">รอการกรอกข้อมูล <i class="fa fa-pencil-square-o  fa-fw"></i></b>';
														break;
														case '1':
														$status_sp='<b id="statwt">รอการพิจารณา <i class="fa  fa-clock-o fa-fw"></i></b>';
															break;
														case '2':
														$status_sp='<b id="statn">ไม่เห็นชอบ <i class="fa fa-pencil-square-o  fa-fw"></i></b>';
															break;
														case '3':
														$status_sp='<b id="statal">มีการแก้ไขจากคณะกรรมการภาค <i class="fa fa-pencil-square fa-fw"></i></b>';
															break;
														case '4':
														$status_sp='<b id="statcf">ผ่านการประเมินจากคณะกรรมการภาค <i class="fa fa-user fa-fw"></i></b>';
															break;
														case '5':
														$status_sp='<b id="statwt">รอคณะอนุมัติ <i class="fa fa-user-plus fa-fw"></i></b>';
															break;
														case '6':
														$status_sp='<b id="statal">มีการแก้ไขจากผู้บริหาร <i class="fa fa-check fa-fw"></i></b>';
															break;
													case '7': $status_sp='
													<b id="statcf">ผ่าน <i class="fa fa-check fa-fw"></i></b>'; break;

																		}
																		?>

																<div class="panel panel-default">
																	<div class="panel-heading">
																		<h3 class="panel-title" style="font-size:14px;">

																			<a data-toggle="collapse"  href="#special_<?php echo $value_course['id']."_".$keysp ?>">
																				<?php echo $valuesp['name'] ?> </a>
																			</b>
																			<?php if (isset($valuesp['pdf']) && $_SESSION['level']==3 && $valuesp['status']!=0 ): ?>
																			<a id="hover" href="<?php echo $valuesp['pdf'] ?>" target="_blank" TITLE="คลิ็ก ! เพื่ดเปิดPDF"><i type="button" class="fa fa-file-pdf-o fa-2x " ></i></a>
																			<?php endif; ?>
																			<?php echo ' <i class="fa fa-long-arrow-right fa-fw"></i>'.$status_sp; if ($_SESSION['level']==3): ?>
																			<?php if($valuesp['status']==4){ ?>
																			<button class='btn btn-outline btn-success' onclick='senttoheadSP(<?php echo $value_course['id'] ?>,"<?php echo $valuesp['id'] ?>");'>ยืนยัน</button>
																			<?php
																					} ?>
																				<?php endif; ?>
																				<?php if(($valuesp['status'])==1 && $_SESSION['level']==2){ ?>
																				<button class='btn btn-outline btn-success' onclick='sendtoboardsp(<?php echo $value_course['id'] ?>,"<?php echo $valuesp['id'] ?>");'>ผ่าน</button>
																				<?php
																					} ?>
																		</h3>
																	</div>
																	<div id="special_<?php echo $value_course['id']."_".$keysp ?>" class="panel-collapse collapse">
																		<div class="panel-body">

																			<table class="table " style="font-size:14px;">
																				<thead>
																					<?php if ($_SESSION['level'] >=2  || $_SESSION['admission']==1): ?>
																					<th style="width:250px">คณะกรรมการ</th>
																					<?php endif; ?>
																					<th>ข้อเสนอแนะ</th>
																					<th>วัน/เวลา</th>
																				</thead>
																				<tbody>

																					<?php

																					if (!empty($valuesp['comment'])) {
																					foreach ($valuesp['comment'] as $comment): ?>
																						<tr>
																							<?php if ($_SESSION['level'] >=2): ?>
																							<td style="width:250px">
																								<?php echo $comment['name'] ?>
																							</td>
																							<?php endif; ?>
																							<td>
																								<?php if ($comment['comment']=="" or $comment['comment'] ==NULL) {
																									echo "-";
																								} else {
																									echo $comment['comment'];
																								}
																								?>
																							</td>
																							<td>
																								<?php if ($comment['date']=="") {
																							echo "-";
																						}else {
																							echo $comment['date'];
																						} ?>
																							</td>
																						</tr>
																						<?php endforeach;
																						}  ?>
																				</tbody>
																			</table>
																		</div>
																	</div>
																</div>
																<?php endforeach; ?>
															</div>
														</div>
													</div>
													<?php  } ?>
												</div>
											</div>

										</div>
									</div>
								</div>
								<?php endforeach; ?>
								<?php } ?>

				</div>
			</div>
		</div>
	</div>
	<script>
		function senttohead(course) {
			swal({
				title: 'แน่ใจหรือไม่',
				text: 'คุณต้องการยืนยันเพื่อส่งข้อมูลใช่หรือไม่',
				type: 'question',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'ตกลง',
				cancelButtonText: 'ยกเลิก'
			}).then(function () {
				$.ajax({
					url: '../../application/approval/send_board.php',
					type: 'POST',
					data: {
						course_id: course
					},
					beforeSend: function () {
						swal(
							'กรุณารอสักครู่',
							'ระบบกำลังประมวลผล'
						)
						swal.showLoading();
					},
					success: function (data) {
						swal.hideLoading();
						try {
							var msg = JSON.parse(data);
							swal({
								type: msg.status,
								text: msg.msg,
								timer: 2000,
								confirmButtonText: "Ok!",
							}, function () {
								window.location.reload();
							});
							setTimeout(function () {
								window.location.reload();
							}, 1000);
						} catch (e) {

						} finally {

						}
					}
				});
			}, function (dismiss) {
				if (dismiss === 'cancel') {}
			})

		}

		function senttoheadSP(course, teachersp) {

			swal({
				title: 'แน่ใจหรือไม่',
				text: 'คุณต้องการยืนยันเพื่อส่งข้อมูลใช่หรือไม่',
				type: 'question',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'ตกลง',
				cancelButtonText: 'ยกเลิก'
			}).then(function () {
				$.ajax({
					url: '../../application/approval/send_board.php',
					type: 'POST',
					data: {
						course_id: course,
						teachersp: teachersp
					},
					beforeSend: function () {
						swal({
							title: 'กรุณารอสักครู่',
							text: 'ระบบกำลังประมวลผล',
							allowOutsideClick: false
						})
						swal.showLoading();
					},
					success: function (data) {
						swal.hideLoading();
						try {
							var msg = JSON.parse(data)
							swal({
								type: msg.status,
								text: msg.msg,
								timer: 2000,
								confirmButtonText: "Ok!",
							}, function () {
								window.location.reload();
							});
							setTimeout(function () {
								window.location.reload();
							}, 1000);
						} catch (e) {

						}

					}
				});
			}, function (dismiss) {
				if (dismiss === 'cancel') {}
			})
		}

		function sendtoboard(course) {

			swal({
				title: 'แน่ใจหรือไม่',
				text: 'คุณต้องการยืนยันเพื่อส่งข้อมูลใช่หรือไม่',
				type: 'question',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'ตกลง',
				cancelButtonText: 'ยกเลิก'
			}).then(function () {
				$.ajax({
					url: '../../application/approval/send_staff_dept.php',
					type: 'POST',
					data: {
						course_id: course,
					},
					beforeSend: function () {
						swal({
							title: 'กรุณารอสักครู่',
							text: 'ระบบกำลังประมวลผล',
							allowOutsideClick: false
						})
						swal.showLoading();
					},
					success: function (data) {
						swal.hideLoading();
						try {
							var msg = JSON.parse(data)
							console.log(msg);
							swal({
								type: msg.status,
								text: msg.msg,
								timer: 2000,
								confirmButtonText: "Ok!",
							}, function () {
								window.location.reload();
							});
							setTimeout(function () {
								window.location.reload();
							}, 1000);
						} catch (e) {
							console.log(data);
						}

					}
				});
			}, function (dismiss) {
				if (dismiss === 'cancel') {}
			})
		}

		function sendtoboardsp(course, teachersp) {

			swal({
				title: 'แน่ใจหรือไม่',
				text: 'คุณต้องการยืนยันเพื่อส่งข้อมูลใช่หรือไม่',
				type: 'question',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'ตกลง',
				cancelButtonText: 'ยกเลิก'
			}).then(function () {
				$.ajax({
					url: '../../application/approval/send_staff_dept.php',
					type: 'POST',
					data: {
						course_id: course,
						teachersp: teachersp
					},
					beforeSend: function () {
						swal({
							title: 'กรุณารอสักครู่',
							text: 'ระบบกำลังประมวลผล',
							allowOutsideClick: false
						})
						swal.showLoading();
					},
					success: function (data) {
						swal.hideLoading();
						try {
							var msg = JSON.parse(data)
							swal({
								type: msg.status,
								text: msg.msg,
								timer: 2000,
								confirmButtonText: "Ok!",
							}, function () {
								window.location.reload();
							});
							setTimeout(function () {
								window.location.reload();
							}, 1000);
						} catch (e) {

						}

					}
				});
			}, function (dismiss) {
				if (dismiss === 'cancel') {}
			})
		}
	</script>
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