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
$semeter= $deadline->Get_Current_Semester();
$var=$approve->Check_Status($_SESSION['id']);
$data_course= json_decode($var, true);

echo "<pre>";
print_r($data_course);
echo "</pre>";
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
		<title></title>
		<style>
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
							<h5 class="panel-title" style="font-size:14">
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
						<div class="panel-body" >
							<?php if ($_SESSION['level'] == 1 || $_SESSION['level'] == 2 || $_SESSION['level'] == 3):?>

								<div class="glyphicon glyphicon-alert" style="color: red;font-size:16px;" ></div><b style="color: red;font-size:16px;"> วันสุดท้ายสำหรับกรอกแบบแจ้งวิธีการวัดผลและประเมินผลการศึกษา <?php echo $deadline_form['measure']['day'].' '.$deadline_form['measure']['month'].' '.$deadline_form['measure']['year']."<br>"; ?> </b>
								<div class="glyphicon glyphicon-alert" style="color: red;font-size:16px;" ></div><b style="color: red;font-size:16px;"> วันสุดท้ายสำหรับอัพโหลดไฟล์ course syllabus <?php echo $deadline_form['syllabus']['day'].' '.$deadline_form['syllabus']['month'].' '.$deadline_form['syllabus']['year']."<br>"; ?> </b>
								<div class="glyphicon glyphicon-alert" style="color: red;font-size:16px;" ></div><b style="color: red;font-size:16px;"> วันสุดท้ายสำหรับกรอกแบบขออนุมัติเชิญอาจารย์พิเศษ <?php echo $deadline_form['special']['day'].' '.$deadline_form['special']['month'].' '.$deadline_form['special']['year']."<br>"; ?> </b>

							<?php endif; ?>
							<?php
					if($_SESSION['level'] == 4 || $_SESSION['level'] == 5  || $_SESSION['level'] == 2 || $_SESSION['level'] == 3) {  ?>
								<div class="glyphicon glyphicon-alert" style="color: red;font-size:16px;"></div><b style="color: red;font-size:16px;"> วันสุดท้ายสำหรับประเมินกระบวนวิชา <?php echo $deadline_form['evaluate']['day'].' '.$deadline_form['evaluate']['month'].' '.$deadline_form['evaluate']['year']."<br>"; ?> </b>
								<?php }
						if($_SESSION['level'] == 6  || $_SESSION['level'] == 2 || $_SESSION['level'] == 3)
						{ ?>
								<div class="glyphicon glyphicon-alert" style="color: red;font-size:16px;"></div><b style="color: red;font-size:16px;"> วันสุดท้ายสำหรับอนุมัติกระบวนวิชา <?php echo $deadline_form['approve']['day'].' '.$deadline_form['approve']['month'].' '.$deadline_form['approve']['year']."<br>"; ?> </b>
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
										 $status_text='<b id="statwt">รอการพิจารนา <i class="fa  fa-clock-o fa-fw"></i></b>';
											 break;
										 case '2':
										 $status_text='<b id="statn">ไม่เห็นชอบ <i class="fa fa-pencil-square-o  fa-fw"></i></b>';
											 break;
										 case '3':
										 $status_text='<b id="statn">มีการแก้ไขจากภาควิชา <i class="fa fa-pencil-square fa-fw"></i></b>';
											 break;
										 case '4':
										 $status_text='<b id="statal">ภาควิชาเห็นชอบ รอคณะกรรมเห็นชอบ <i class="fa fa-user fa-fw"></i></b>';
											 break;
										 case '5':
										 $status_text='<b id="statn">มีการแก้ไขเพิ่มเติมจากคณะ <i class="fa fa-user-plus fa-fw"></i></b>';
											 break;
										 case '6':
										 $status_text='<b id="statcf">คณะกรรมการเห็นชอบ <i class="fa fa-check fa-fw"></i></b>';
											 break;
										 }


									/*echo "<pre>"; var_export($value_course);echo "</pre>";*/ ?>
									<div class="panel-group" id="accordione1">
										<div class="panel panel-success">
											<div class="panel-heading">
												<h3 class="panel-title" style="font-size:14">
											<li><b><u>กระบวนวิชา</u></b> : <?php echo $value_course['id']." ".$value_course['name']?> </li>
										</h3>
											</div>
											<div class="panel-body" style="font-size:14px;">

												<div class="panel-group">
													<div class="panel panel-default">
														<div class="panel-heading">
															<h3 class="panel-title" style="font-size:14">
																<a data-toggle="collapse" href="#evaluate<?php echo $value_course['id']."_".$key ?>">
														 		<i class="fa fa-file-o fa-fw"></i><b> แบบแจ้งวิธีการวัดผล ประเมินผลการศึกษาและประมวลกระบวนวิชา  </b><i class="fa fa-long-arrow-right fa-fw"></i><?php echo $status_text ?></a>
															</h3>
														</div>
														<?php if (isset($_SESSION['level'])) { ?>
														<div id="evaluate<?php echo $value_course['id']."_".$key ?>" class="panel-collapse collapse">
															<div class="panel-body" style="font-size:14px;">
																<table class="table " style="font-size:14px;">
																	<thead >
																		<?php if ($_SESSION['level'] >=2): ?>
																		<th style="width:250px">คณะกรรมการ</th>
																		<?php endif; ?>
																		<th>ข้อเสนอแนะ</th>
																	</thead>
																	<tbody>

																		<?php
                                    if (!empty($valuesp['comment'])) {
                                    foreach ($value_course['evaluate']['comment'] as $comment): ?>
																			<tr>
																				<?php if ($_SESSION['level'] >=2): ?>
																				<td style="width:250px"><?php echo $comment['name'] ?></td>
																				<?php endif; ?>
																				<td><?php if ($comment['comment']=="" or $comment['comment'] ==NULL) {
																					echo "-";
																				} else {
																					echo $comment['comment'];
																				}

																				?></td>
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
															<h3 class="panel-title" style="font-size:14">
													<a data-toggle="collapse" href="#special<?php echo $value_course['id']."_".$key ?>" disabled="disabled">
													<i class="fa fa-file-o fa-fw"></i><b>  แบบขออนุมัติเชิญอาจารย์พิเศษ </b></b></a>
												</h3>
														</div>
														<?php if (isset($_SESSION['level'])) { ?>
														<div id="special<?php echo $value_course['id']."_".$key ?>" class="panel-collapse collapse">
															<div class="panel-body" style="font-size:14px;">
																<div class="panel-group" id="accordion">

																	<?php foreach ($value_course['special'] as $keysp => $valuesp):

																		switch ($valuesp['status']) {
																			case '0':
																			$status_sp='<b id="statn">ไม่เห็นชอบ <i class="fa fa-pencil-square-o  fa-fw"></i></b>';
																			break;
																		 case '1':
																		 $status_sp='<b id="statc">รอการกรอกข้อมูล <i class="fa fa-pencil-square-o  fa-fw"></i></b>';
																			 break;
																		 case '2':
																		 $status_sp='<b id="statwt">รอการพิจารนา <i class="fa  fa-clock-o fa-fw"></i></b>';
																			 break;
																		 case '3':
																		 $status_sp='<b id="statn">มีการแก้ไขจากภาควิชา <i class="fa fa-pencil-square fa-fw"></i></b>';
																			 break;
																		 case '4':
																		 $status_sp='<b id="statal">ภาควิชาเห็นชอบ รอคณะกรรมเห็นชอบ <i class="fa fa-user fa-fw"></i></b>';
																			 break;
																		 case '5':
																		 $status_sp='<b id="statn">มีการแก้ไขเพิ่มเติมจากคณะ <i class="fa fa-user-plus fa-fw"></i></b>';
																			 break;
																		 case '6':
																		 $status_sp='<b id="statcf">คณะกรรมการเห็นชอบ <i class="fa fa-check fa-fw"></i></b>';
																			 break;
																		 }
																		 ?>

																		<div class="panel panel-default">
																			<div class="panel-heading">
																				<div class="panel-title" style="font-size:14">
																						<a data-toggle="collapse" data-parent="#accordion" href="#special_<?php echo $value_course['id']."_".$keysp ?>"><?php echo $valuesp['name'].' <i class="fa fa-long-arrow-right fa-fw"></i>'.$status_sp ?> </a></b>
																				</div>
																			</div>
																			<div id="special_<?php echo $value_course['id']."_".$keysp ?>" class="panel-collapse collapse">
																				<div class="panel-body">

																					<table class="table " style="font-size:14px;">
																						<thead>
																							<?php if ($_SESSION['level'] >=2): ?>
																							<th style="width:250px">คณะกรรมการ</th>
																							<?php endif; ?>
																							<th>ข้อเสนอแนะ</th>
																						</thead>
																						<tbody>

																							<?php

                                                # code...
                                                if (!empty($valuesp['comment'])) {
                                                  # code...
                                                foreach ($valuesp['comment'] as $comment): ?>
																								<tr>
  																									<?php if ($_SESSION['level'] >=2): ?>
  																									<td style="width:250px"><?php echo $comment['name'] ?></td>
  																									<?php endif; ?>
  																									<td><?php if ($comment['comment']=="" or $comment['comment'] ==NULL) {
  																										echo "-";
  																									} else {
  																										echo $comment['comment'];
  																									}

																									?></td>
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
