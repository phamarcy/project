<?php
require_once(__DIR__.'/../../application/class/curl.php');
require_once(__DIR__.'/../../application/class/manage_deadline.php');
require_once(__DIR__."/../../application/class/approval.php");
require_once(__DIR__."/../../application/class/course.php");
session_start();
if(!isset($_SESSION['level']) || !isset($_SESSION['fname']) || !isset($_SESSION['lname']) || !isset($_SESSION['id']))
{
    die('กรุณา Login ใหม่');
}
$information_url = "application/information/index.php";
$curl            = new CURL();
$deadline        = new Deadline;
$approve         = new approval($_SESSION['level']);
$course          = new course;
$data['level']   = $_SESSION['level'];
$deadline_form   = $deadline->Get_Current_Deadline($_SESSION['level']);
$semester        = $deadline->Get_Current_Semester();
$var             = $approve->Check_Status($_SESSION['id']);

$type_status=$course->Get_Status_Text();

$data_course     = json_decode($var, true);

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
	<script type="text/javascript" src="../dist/js/validator.min.js"></script>
	<link rel="stylesheet" href="../dist/css/scrollbar.css">
	<script src="../dist/js/core.js"></script>

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

		.spec{
			margin-top: -23px;
		}
		.forminline{
			display:inline-block;
			margin:0;
		}
		.pull-right {
			margin-top: 0px;
		}
		.eva{
			margin-top: 0px;
		}
		.checkbox{
			display:inline-block;
			margin-top:5px;
		}

		@media only screen and (max-width: 500px) {
			.pull-right{
				margin-top: 0px;
			}
		}
	</style>
</head>

<body class="mybox">

	<?php if($semester['id'] == false)
		{
			echo '<div class="alert alert-danger"><center>ระบบยังไม่มีภาคการศึกษา และปีการศึกษาปัจจุบัน กรุณาติดต่อเจ้าหน้าที่ </center></div>';
			die();
		}
		?>
	<div id="wrapper" style="padding-left: 30px; padding-right: 30px;">
		<div class="col-md-12 ">
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

					<?php if ($_SESSION['level'] == 1 || $_SESSION['level'] == 2 || $_SESSION['level'] == 3 || $_SESSION['admission'] == 1 || $_SESSION['admission'] == 2 || $_SESSION['admission'] == 3):?>
					<?php if (isset($deadline_form['measure'])): ?>
					<div class="glyphicon glyphicon-alert" style="color: red;font-size:16px;"></div><b style="color: red;font-size:16px;"> วันสุดท้ายสำหรับกรอกแบบแจ้งวิธีการวัดผลและประเมินผลการศึกษา <?php echo $deadline_form['measure']['day'].' '.$deadline_form['measure']['month'].' '.$deadline_form['measure']['year']."<br>"; ?> </b>
					<?php endif; ?>
					<?php if (isset($deadline_form['syllabus'])): ?>
					<div class="glyphicon glyphicon-alert" style="color: red;font-size:16px;"></div><b style="color: red;font-size:16px;"> วันสุดท้ายสำหรับอัปโหลดไฟล์ course syllabus <?php echo $deadline_form['syllabus']['day'].' '.$deadline_form['syllabus']['month'].' '.$deadline_form['syllabus']['year']."<br>"; ?> </b>
					<?php endif; ?>
					<?php if (isset($deadline_form['special'])): ?>
					<div class="glyphicon glyphicon-alert" style="color: red;font-size:16px;"></div><b style="color: red;font-size:16px;"> วันสุดท้ายสำหรับกรอกแบบขออนุมัติเชิญอาจารย์พิเศษ <?php echo $deadline_form['special']['day'].' '.$deadline_form['special']['month'].' '.$deadline_form['special']['year']."<br>"; ?> </b>
					<?php endif; ?>
					<?php endif; ?>

					<?php
				if($_SESSION['level'] == 4 || $_SESSION['level'] == 5  || $_SESSION['level'] == 2 || $_SESSION['level'] == 3  || $_SESSION['admission'] == 2 || $_SESSION['admission'] == 3) {  ?>
						<?php if (isset($deadline_form['evaluate'])): ?>
						<div class="glyphicon glyphicon-alert" style="color: red;font-size:16px;"></div><b style="color: red;font-size:16px;"> วันสุดท้ายสำหรับประเมินกระบวนวิชา <?php echo $deadline_form['evaluate']['day'].' '.$deadline_form['evaluate']['month'].' '.$deadline_form['evaluate']['year']."<br>"; ?> </b>
						<?php endif; ?>
						<?php }
					if($_SESSION['level'] == 6  || $_SESSION['level'] == 2 || $_SESSION['level'] == 3  || $_SESSION['admission'] == 3)
					{ ?>
						<?php if (isset($deadline_form['approve'])): ?>
						<div class="glyphicon glyphicon-alert" style="color: red;font-size:16px;"></div><b style="color: red;font-size:16px;"> วันสุดท้ายสำหรับอนุมัติกระบวนวิชา <?php echo $deadline_form['approve']['day'].' '.$deadline_form['approve']['month'].' '.$deadline_form['approve']['year']."<br>"; ?> </b>
						<?php endif; ?>
						<?php	} ?>
						<br>


						<?php if ($_SESSION['level']==3 || $_SESSION['admission']==3): ?>
						<div class="row">
							<div class="col-md-10 col-md-offset-4">
								<button class='btn  btn-success' onclick='selectall();'>ยืนยันการเลือกวิชา</button>
								<button class='btn  btn-primary' onclick='selectallsp();'>ยืนยันการเลือกอาจารย์พิเศษ</button>
							</div>
						</div>
						<div class="row">
							<div class="col-md-10 col-md-offset-4">
								<label style="font-size:14px"><input type="checkbox" name="checkedAll" id="checkedAll" >เลือกวิชาทั้งหมด</label>&nbsp;&nbsp;
								<label style="font-size:14px"><input type="checkbox" name="checkedAllsp" id="checkedAllsp" >เลือกอาจารย์พิเศษทั้งหมด</label>
							</div>
						</div>

						<hr>
						<?php endif; ?>


							<?php if (is_array($data_course) || is_object($data_course)){ ?>

							<?php foreach ($data_course as $key => $value_course):
								?>

							<?php
									$status_text="";
									switch ($value_course['evaluate']['status']) {

										case '0':
										$status_text='<b style="color:'.$type_status[$value_course['evaluate']['status']]["color"].';">'.$type_status[$value_course['evaluate']['status']]["status_name"].' <i class="'.$type_status[$value_course['evaluate']['status']]["icon"].'"></i></b>';
										break;
										case '1':
										$status_text='<b style="color:'.$type_status[$value_course['evaluate']['status']]["color"].';">'.$type_status[$value_course['evaluate']['status']]["status_name"].' <i class="'.$type_status[$value_course['evaluate']['status']]["icon"].'"></i></b>';
											break;
										case '2':
										$status_text='<b style="color:'.$type_status[$value_course['evaluate']['status']]["color"].';">'.$type_status[$value_course['evaluate']['status']]["status_name"].' <i class="'.$type_status[$value_course['evaluate']['status']]["icon"].'"></i></b>';
											break;
										case '3':
										$status_text='<b style="color:'.$type_status[$value_course['evaluate']['status']]["color"].';">'.$type_status[$value_course['evaluate']['status']]["status_name"].' <i class="'.$type_status[$value_course['evaluate']['status']]["icon"].'"></i></b>';
											break;
										case '4':
										$status_text='<b style="color:'.$type_status[$value_course['evaluate']['status']]["color"].';">'.$type_status[$value_course['evaluate']['status']]["status_name"].' <i class="'.$type_status[$value_course['evaluate']['status']]["icon"].'"></i></b>';
											break;
										case '5':
										$status_text='<b style="color:'.$type_status[$value_course['evaluate']['status']]["color"].';">'.$type_status[$value_course['evaluate']['status']]["status_name"].' <i class="'.$type_status[$value_course['evaluate']['status']]["icon"].'"></i></b>';
											break;
										case '6':
										$status_text='<b style="color:'.$type_status[$value_course['evaluate']['status']]["color"].';">'.$type_status[$value_course['evaluate']['status']]["status_name"].' <i class="'.$type_status[$value_course['evaluate']['status']]["icon"].'"></i></b>';
											break;
										case '7':
										$status_text='<b style="color:'.$type_status[$value_course['evaluate']['status']]["color"].';">'.$type_status[$value_course['evaluate']['status']]["status_name"].' <i class="'.$type_status[$value_course['evaluate']['status']]["icon"].'"></i></b>';
										break;
										}
?>
								<div class="panel-group" id="accordione1">
									<div class="panel panel-success">
										<div class="panel-heading clearfix"> 
											<h4 class="panel-title  pull-left" style="font-size:14px;padding-top: 7.5px">
												<b><u>กระบวนวิชา</u></b> :<?php echo $value_course['id']." ".$value_course['name']?>
											</h4>
											<div class="btn-group pull-right">
											<?php if ((isset($value_course['document']['all']) && $value_course['evaluate']['status']!=0) || ($_SESSION['admission']==3 && isset($value_course['pdf']) && $value_course['evaluate']['status']!=0)): ?>
											<a id="hover" href="<?php echo $value_course['document']['all'] ?>" target="_blank" ><button type="button" class="btn btn-default btn-sm" >ดาวน์โหลดแบบแจ้งและแบบเชิญอาจารย์พิเศษทั้งหมด</button></a>
												<?php endif; ?>
												<?php if ($value_course['evaluate']['status']==0 && ($_SESSION['level']==1 || $_SESSION['level']==2)) {?>
													<form action="evaform.php" method="post" class="forminline">
														<input type="hidden" name="course_id" value="<?php echo $value_course['id'] ?>">
														<button type="submit" class="btn btn-success btn-sm ">กรอกแบบแจ้ง</button>
													</form>
												<?php } ?>
												<?php if ($_SESSION['level']==1 || $_SESSION['level']==2 ) {?>
													<form action="spclteacher.php" method="post" class="forminline">
														<input type="hidden" name="course_id" value="<?php echo $value_course['id'] ?>">
														<button type="submit" class="btn btn-primary btn-sm ">เชิญอาจารย์พิเศษ</button>
													</form>
												<?php } ?>
											</div>
										</div>
										<div class="panel-body" style="font-size:14px;">
											<div class="panel-group">
												<div class="panel panel-default">
													<div class="panel-heading clearfix" >
													
														<h3 class="panel-title pull-left " style="font-size:14px;padding-top: 8px" >
															<a data-toggle="collapse" href="#evaluate<?php echo $value_course['id']."_".$key ?>">
															<i class="fa fa-file-o fa-fw"></i><b> แบบแจ้งวิธีการวัดผล ประเมินผลการศึกษาและประมวลกระบวนวิชา  </b>
															<i class="fa fa-long-arrow-right fa-fw"></i>
															<?php echo $status_text ?>
															</a>
															
														</h3>
														<div class="btn-group pull-right eva">
															
														<?php if ($_SESSION['level']==3 || $_SESSION['admission']==3): ?>
															<?php if(($value_course['evaluate']['status'])==4){ ?>
																<div class="forminline">
																<button class='btn btn-success btn-sm' onclick='senttohead("<?php echo $value_course['id'] ?>");'>ยืนยัน</button>
															</div>
															<?php
															} ?>
																<?php endif; ?>
																<?php if ($_SESSION['level']==2 || $_SESSION['admission']==2): ?>
																<?php if(($value_course['evaluate']['status'])==1 ){ ?>
																	<div class="forminline">
																	<button class='btn  btn-success btn-sm' onclick='sendtoboard("<?php echo $value_course['id'] ?>");'>ผ่าน</button>
																	</div>
																<?php
															} ?>
																	<?php endif; ?>
															<?php if (($value_course['evaluate']['edit']==true && $value_course['evaluate']['status']==1 && ($_SESSION['level']==1 || $_SESSION['level']==2)) || ( $value_course['evaluate']['status']==3 || $value_course['evaluate']['status']==6 )&& $_SESSION['level']==1 ): ?>
																<form action="evaform.php" method="post" class="forminline">
																	<input type="hidden" name="course_id" value="<?php echo $value_course['id'] ?>">
																	<input type="hidden" name="semester" value="<?php echo $semester['semester'] ?>">
																	<input type="hidden" name="year" value="<?php echo $semester['year'] ?>">
																	<button type="submit" class="btn btn-warning btn-sm " >แก้ไข</button>
																</form>

															<?php endif; ?>
															<?php if ((isset($value_course['pdf']) && $value_course['evaluate']['status']!=0) || ($_SESSION['admission']==3 && isset($value_course['pdf']) && $value_course['evaluate']['status']!=0)): ?>
															<a id="hover" href="<?php echo $value_course['pdf'] ?>" target="_blank" ><button type="button" class="btn btn-default btn-sm" >ดาวน์โหลดแบบแจ้ง</button></a>
																<?php endif; ?>

																<?php if ($_SESSION['level']==3 && ($value_course['evaluate']['status'])==4 || ($_SESSION['admission']==3 && $value_course['evaluate']['status']==4)): ?>
																<label style="font-size:14px" ><input type="checkbox" name="coursecheck" id="checkedAll" class="checkSingle " value="<?php echo $value_course['id'] ?>"></input></label>
															<?php endif; ?>
															</div>	
													</div>
													<?php if (isset($_SESSION['level'])) { ?>
													<div id="evaluate<?php echo $value_course['id']."_".$key ?>" class="panel-collapse collapse">
														<div class="panel-body" style="font-size:14px;">
															<table class="table " style="font-size:14px;">
																<thead>
																	<?php if ($_SESSION['level'] >=2  || $_SESSION['admission']==1): ?>
																	<th style="width:300px">คณะกรรมการ</th>
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

													<div class="panel-heading clearfix" >
														<h4 class="panel-title pull-left" style="font-size:14px;padding-top:8px" >
															<a data-toggle="collapse" href="#special<?php echo $value_course['id']."_".$key ?>" disabled="disabled">
																<i class="fa fa-file-o fa-fw"></i><b>  แบบขออนุมัติเชิญอาจารย์พิเศษ </b></b></a>
														</h4>
														<div class="btn-group pull-right eva">
														<?php if ((isset($value_course['document']['instructor'])) && count($value_course['special'])>0): ?>
															<a id="hover" href="<?php echo $value_course['document']['instructor'] ?>" target="_blank"><button type="button" class="btn btn-default btn-sm" >ดาวน์โหลดเชิญอาจารย์พิเศษทั้งหมด</button></a>
														<?php endif; ?>
														</div>
													</div>
													<?php if (isset($_SESSION['level'])) { ?>
													<div id="special<?php echo $value_course['id']."_".$key ?>" class="panel-collapse collapse  in">
														<div class="panel-body" style="font-size:14px;">
															<?php 
																if (count($value_course['special'])==0) { ?>
																	<div class="fa fa-exclamation-circle" style="color: #ec2c2c;font-size:16px;"></div><b style="color: #ec2c2c;font-size:16px;"> กระบวนวิชานี้ไม่ได้เชิญอาจารย์พิเศษ </b>
														<?php		}
															?>
															<div class="panel-group" id="accordion">
																<?php foreach ($value_course['special'] as $keysp => $valuesp):
																	$status_sp='';
																	switch ($valuesp['status']) {
																		case '0':
																		$status_sp='<b style="color:'.$type_status[$valuesp['status']]["color"].';">'.$type_status[$valuesp['status']]["status_name"].' <i class="'.$type_status[$valuesp['status']]["icon"].'"></i></b>';
																		break;
																		case '1':
																		$status_sp='<b style="color:'.$type_status[$valuesp['status']]["color"].';">'.$type_status[$valuesp['status']]["status_name"].' <i class="'.$type_status[$valuesp['status']]["icon"].'"></i></b>';
																			break;
																		case '2':
																		$status_sp='<b style="color:'.$type_status[$valuesp['status']]["color"].';">'.$type_status[$valuesp['status']]["status_name"].' <i class="'.$type_status[$valuesp['status']]["icon"].'"></i></b>';
																			break;
																		case '3':
																		$status_sp='<b style="color:'.$type_status[$valuesp['status']]["color"].';">'.$type_status[$valuesp['status']]["status_name"].' <i class="'.$type_status[$valuesp['status']]["icon"].'"></i></b>';
																			break;
																		case '4':
																		$status_sp='<b style="color:'.$type_status[$valuesp['status']]["color"].';">'.$type_status[$valuesp['status']]["status_name"].' <i class="'.$type_status[$valuesp['status']]["icon"].'"></i></b>';
																			break;
																		case '5':
																		$status_sp='<b style="color:'.$type_status[$valuesp['status']]["color"].';">'.$type_status[$valuesp['status']]["status_name"].' <i class="'.$type_status[$valuesp['status']]["icon"].'"></i></b>';
																			break;
																		case '6':
																		$status_sp='<b style="color:'.$type_status[$valuesp['status']]["color"].';">'.$type_status[$valuesp['status']]["status_name"].' <i class="'.$type_status[$valuesp['status']]["icon"].'"></i></b>';
																			break;
																		case '7':
																		$status_sp='<b style="color:'.$type_status[$valuesp['status']]["color"].';">'.$type_status[$valuesp['status']]["status_name"].' <i class="'.$type_status[$valuesp['status']]["icon"].'"></i></b>';
																		break;

																		}
																		?>

																<div class="panel panel-default">
																	<div class="panel-heading clearfix">
																		<h3 class="panel-title pull-left" style="font-size:14px;padding-top: 8px">

																			<a data-toggle="collapse"  href="#special_<?php echo $value_course['id']."_".$keysp ?>">
																				<?php echo $valuesp['name'] ?> </a>
																			</b>
																			<?php echo ' <i class="fa fa-long-arrow-right fa-fw"></i>'.$status_sp; ?> 
																		</h3>
																		<div class="btn-group pull-right eva">
																		<?php 
																			 if ($_SESSION['level']==3 || $_SESSION['admission']==3):
																			if($valuesp['status']==4 ){ ?>
																			<div class="forminline">
																			<button class='btn  btn-success' onclick='senttoheadSP("<?php echo $value_course['id'] ?>","<?php echo $valuesp['id'] ?>");'>ยืนยัน</button>
																			</div>
																			<?php } ?>
																				<?php endif; ?>
																				<?php if($_SESSION['level']==2 || $_SESSION['admission']==2){
																					if ($valuesp['status']==1) {?>
																					<div class="forminline">
																				<button class='btn  btn-success btn-sm' onclick='sendtoboardsp("<?php echo $value_course['id'] ?>","<?php echo $valuesp['id'] ?>");'>ผ่าน</button>
																					</div>
																				<?php }
																					} ?>
																				
																				<?php if (($valuesp['edit']==true && $valuesp['status']==1 && ($_SESSION['level']==1 || $_SESSION['level']==2)) || ( $valuesp['status']==3 || $valuesp['status']==6)&& $_SESSION['level']==1 ): ?>
																				<form action="spclteacher.php" method="post" class="forminline">
																				<input type="hidden" name="course_id" value="<?php echo $value_course['id'] ?>">
																				<input type="hidden" name="name" value="<?php echo $valuesp['name'] ?>">
																				<input type="hidden" name="semester" value="<?php echo $semester['semester'] ?>">
																				<input type="hidden" name="year" value="<?php echo $semester['year'] ?>">
																				<input type="hidden" name="instructor_id" value="<?php echo $valuesp['id'] ?>">
																					<button type="submit" class="btn btn-warning btn-sm " >แก้ไข</button>
																					</form>
																				<?php endif; ?>
																				<?php if ((isset($valuesp['cv']) && $valuesp['status']!=0) || ($_SESSION['admission']==3 && isset($valuesp['cv']) && $valuesp['status']!=0)): ?>
																				<a id="hover" href="../../files<?php echo $valuesp['cv'] ?>" target="_blank"><button type="button" class="btn btn-default btn-sm" >ดาวน์โหลด CV</button></a>
																			<?php endif; ?>
																			<?php if ((isset($valuesp['pdf']) && $valuesp['status']!=0) || ($_SESSION['admission']==3 && isset($valuesp['pdf']) && $valuesp['status']!=0)): ?>
																				<a id="hover" href="<?php echo $valuesp['pdf'] ?>" target="_blank"><button type="button" class="btn btn-default btn-sm" >ดาวน์โหลดแบบเชิญอาจารย์พิเศษ</button></a>
																			<?php endif; ?>
																			<?php if ($_SESSION['level']==3 && $valuesp['status']==4 || ($_SESSION['admission']==3 && $valuesp['status']==4)): ?>
																					<label style="font-size:14px"><input type="checkbox" name="coursechecksp" id="checkedAllsp" class="checkSinglesp" value="<?php echo $value_course['id']?>,<?php echo $valuesp['id']?>"></input></label>
																				<?php endif; ?>
																		</div>
																	</div>
																	<div id="special_<?php echo $value_course['id']."_".$keysp ?>" class="panel-collapse collapse">
																		<div class="panel-body">

																			<table class="table " style="font-size:14px;">
																				<thead>
																					<?php if ($_SESSION['level'] >=2  || $_SESSION['admission']==1): ?>
																					<th style="width:300px">คณะกรรมการ</th>
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
	$(document).ready(function() {
        $("#checkedAll").change(function(){
          if(this.checked){
            $(".checkSingle").each(function(){
              this.checked=true;
            })
          }else{
            $(".checkSingle").each(function(){
              this.checked=false;
            })
          }
        });

        $(".checkSingle").click(function () {
          if ($(this).is(":checked")){
            var isAllChecked = 0;
            $(".checkSingle").each(function(){
              if(!this.checked)
                 isAllChecked = 1;
            })
            if(isAllChecked == 0){ $("#checkedAll").prop("checked", true); }
          }else {
            $("#checkedAll").prop("checked", false);
          }
        });
      });

	  $(document).ready(function() {
        $("#checkedAllsp").change(function(){
          if(this.checked){
            $(".checkSinglesp").each(function(){
              this.checked=true;
            })
          }else{
            $(".checkSinglesp").each(function(){
              this.checked=false;
            })
          }
        });

        $(".checkSinglesp").click(function () {
          if ($(this).is(":checked")){
            var isAllChecked = 0;
            $(".checkSinglesp").each(function(){
              if(!this.checked)
                 isAllChecked = 1;
            })
            if(isAllChecked == 0){ $("#checkedAllsp").prop("checked", true); }
          }else {
            $("#checkedAllsp").prop("checked", false);
          }
        });
      });


	  function selectall() {
        var course = [];
        $.each($("input[name='coursecheck']:checked"), function(){
            course.push($(this).val());
        });

        if (course.length==0) {
         swal({
          title: 'ผิดพลาด',
          text: 'กรุณาเลือกวิชา',
          type: 'error',

        })
        return;
        }

        swal({
          title: 'แน่ใจหรือไม่',
          text: 'คุณต้องการยืนยันวิชาที่เลือกใช่หรือไม่ใช่หรือไม่',
          type: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'ตกลง',
          cancelButtonText: 'ยกเลิก'
        }).then(function () {
          swal({
                title: 'กรุณารอสักครู่',
                text: 'ระบบกำลังประมวลผล',
                allowOutsideClick: false
              })
          swal.showLoading();
          var async_request=[];
          var responses=[];


		  for(i in course)
          {
              async_request.push( $.ajax({
                url: '../../application/approval/send_board.php',
                type: 'POST',
                async: true,
                data: {
                  course_id: course[i],
                },
                success: function (data) {
                  try {
                    var msg = JSON.parse(data)
                    console.log(msg);
                    console.log('success of ajax response')
                    responses.push(data);
                  } catch (e) {
                    swal({
                      type: "error",
                      text: "ผิดพลาด ! กรุณาติดต่อผู้ดูแลระบบ",
                      timer: 2000,
                      confirmButtonText: "Ok!",
                    });
                    console.log(data);
                  }
                }
              }));
          }

          $.when.apply(null, async_request).done( function(){
            swal.hideLoading();
            try {
                var msg = JSON.parse(responses[0])
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
                }, 2000);
              } catch (e) {
                swal({
                  type: "error",
                  text: "ผิดพลาด ! กรุณาติดต่อผู้ดูแลระบบ",
                  timer: 2000,
                  confirmButtonText: "Ok!",
                });
                console.log(responses);
              }
              console.log('all request completed')
              console.log(responses);
          });

        }, function (dismiss) {
          if (dismiss === 'cancel') {}
        })
      }

      function selectallsp() {

        var course = [];
        var tempcourseAndName=[];
        var purecourse=[];
        var purenamesp=[];
        $.each($("input[name='coursechecksp']:checked"), function(){
            course.push($(this).val());
        });

        for (var i=0; i < course.length ; i++) {
          tempcourseAndName[i]=course[i].split(",");
          purecourse.push(tempcourseAndName[i][0]);
          purenamesp.push(tempcourseAndName[i][1]);
        }

        if (course.length==0) {
			swal({
			title: 'ผิดพลาด',
			text: 'กรุณาเลือกอาจารย์พิเศษ',
			type: 'error',
			})
			return;
        }

        swal({
          title: 'แน่ใจหรือไม่',
          text: 'คุณต้องการยืนยันอาจารย์พิเศษที่เลือกใช่หรือไม่ใช่หรือไม่',
          type: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'ตกลง',
          cancelButtonText: 'ยกเลิก'
        }).then(function () {
          swal({
                title: 'กรุณารอสักครู่',
                text: 'ระบบกำลังประมวลผล',
                allowOutsideClick: false
              })
          swal.showLoading();
          var async_request=[];
          var responses=[];

          for(i in purecourse)
          {
              async_request.push( $.ajax({
                url: '../../application/approval/send_board.php',
                type: 'POST',
                async: true,
                data: {
                  course_id: purecourse[i],
                  teachersp: purenamesp[i],
                },
                success: function (data) {
                  try {
                    var msg = JSON.parse(data)
                    console.log(msg);
                    console.log('success of ajax response')
                    responses.push(data);
                  } catch (e) {
                    swal({
                        type: "error",
                        text: "ผิดพลาด ! กรุณาติดต่อผู้ดูแลระบบ",
                        timer: 2000,
                        confirmButtonText: "Ok!",
                      });
                    console.log(data);
                  }
                }
              }));
          }

          $.when.apply(null, async_request).done( function(){
            swal.hideLoading();
            try {
                var msg = JSON.parse(responses[0])
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
                }, 1500);
              } catch (e) {
                swal({
                  type: "error",
                  text: "ผิดพลาด ! กรุณาติดต่อผู้ดูแลระบบ",
                  timer: 2000,
                  confirmButtonText: "Ok!",
                });
              }
              console.log('all request completed')
              console.log(responses);
          });

        }, function (dismiss) {
          if (dismiss === 'cancel') {}
        })
      }




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