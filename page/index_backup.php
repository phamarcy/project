<html>
<header>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Bootstrap Core CSS -->
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- MetisMenu CSS -->
	<link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="dist/css/sb-admin-2.css" rel="stylesheet">

	<!-- Morris Charts CSS -->
	<link href="vendor/morrisjs/morris.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<script src="vendor/jquery/jquery.min.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

	<!-- Metis Menu Plugin JavaScript -->
	<script src="vendor/metisMenu/metisMenu.min.js"></script>

	<!-- Morris Charts JavaScript -->
	<script src="vendor/raphael/raphael.min.js"></script>
	<script src="vendor/morrisjs/morris.min.js"></script>
	<script src="data/morris-data.js"></script>

	<!-- Custom Theme JavaScript -->
	<script src="dist/js/sb-admin-2.js"></script>

	<script>
		function loadDoc(url) {
			var xhttp;
			if (window.XMLHttpRequest) {
				// code for modern browsers
				xhttp = new XMLHttpRequest();
			} else {
				// code for IE6, IE5
				xhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("page-wrapper").innerHTML = this.responseText;
				}
			};
			xhttp.open("GET", url, true);
			xhttp.send();
		}
	</script>

	<title>แบบแจ้งวิธีการวัดผลและประเมิณผลการศึกษา คณะเภสัชศาสตร์ ภาคการศึกษาที่ 2 ปีการศึกษา 2560 </title>
	<style>
		hide {
			font-size: 0;
		}

		#submitbtn {
			height: 50px;
			width: 200px;
			font-size: 25px;
		}

		#main {
			background-color: #FFF3F3;
		}

		#myBtn {
			display: none;
			position: fixed;
			bottom: 20px;
			right: 30px;
			z-index: 99;
			border: none;
			outline: none;
			background-color: pink;
			color: white;
			cursor: pointer;
			padding: 15px;
			border-radius: 10px;
		}

		#myBtn:hover {
			background-color: #555;
		}
	</style>

	<script type="text/javascript">
		// When the user scrolls down 20px from the top of the document, show the button
		window.onscroll = function() {
			scrollFunction()
		};

		function scrollFunction() {
			if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
				document.getElementById("myBtn").style.display = "block";
			} else {
				document.getElementById("myBtn").style.display = "none";
			}
		}

		// When the user clicks on the button, scroll to the top of the document
		function topFunction() {
			document.body.scrollTop = 0;
			document.documentElement.scrollTop = 0;
		}
	</script>
</header>

<body>
	<div id="wrapper">

		<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
						</button>
				<a class="navbar-brand" href="index.html">Pharmacy 1.0</a>
			</div>
			<!-- /.navbar-header -->

			<ul class="nav navbar-top-links navbar-right">
				<b>ยินดีต้อนรับ | <font color="#51cc62"> คุณ คำแก้ว มาลูน </font></b>
				<!-- /.dropdown -->
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
										<i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
								</a>
					<ul class="dropdown-menu dropdown-alerts">
						<li>
							<a href="#">
								<div>
									<i class="fa fa-comment fa-fw"></i> New Comment
									<span class="pull-right text-muted small">4 minutes ago</span>
								</div>
							</a>
						</li>
						<li class="divider"></li>
						<li>
							<a href="#">
								<div>
									<i class="fa fa-twitter fa-fw"></i> 3 New Followers
									<span class="pull-right text-muted small">12 minutes ago</span>
								</div>
							</a>
						</li>
						<li class="divider"></li>
						<li>
							<a href="#">
								<div>
									<i class="fa fa-envelope fa-fw"></i> Message Sent
									<span class="pull-right text-muted small">4 minutes ago</span>
								</div>
							</a>
						</li>
						<li class="divider"></li>
						<li>
							<a href="#">
								<div>
									<i class="fa fa-tasks fa-fw"></i> New Task
									<span class="pull-right text-muted small">4 minutes ago</span>
								</div>
							</a>
						</li>
						<li class="divider"></li>
						<li>
							<a href="#">
								<div>
									<i class="fa fa-upload fa-fw"></i> Server Rebooted
									<span class="pull-right text-muted small">4 minutes ago</span>
								</div>
							</a>
						</li>
						<li class="divider"></li>
						<li>
							<a class="text-center" href="#">
														<strong>See All Alerts</strong>
														<i class="fa fa-angle-right"></i>
												</a>
						</li>
					</ul>
					<!-- /.dropdown-alerts -->
				</li>
				<!-- /.dropdown -->
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
										<i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
								</a>
					<ul class="dropdown-menu dropdown-user">
						<li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
						</li>
					</ul>
					<!-- /.dropdown-user -->
				</li>
				<!-- /.dropdown -->
			</ul>
			<!-- /.navbar-top-links -->

			<div class="navbar-default sidebar" role="navigation">
				<div class="sidebar-nav navbar-collapse">
					<ul class="nav" id="side-menu">
						<li class="sidebar-search">
							<div class="input-group custom-search-form">
								<input type="text" class="form-control" placeholder="Search...">
								<span class="input-group-btn">
														<button class="btn btn-default" type="button">
																<i class="fa fa-search"></i>
														</button>
												</span>
							</div>
							<!-- /input-group -->
						</li>
						<li>
							<a href="#" onclick="loadDoc('test.php')"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
						</li>
						<li>
							<a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Charts<span class="fa arrow"></span></a>

							<ul class="nav nav-second-level">
								<li>
									<a href="flot.html">Flot Charts</a>
								</li>
								<li>
									<a href="morris.html">Morris.js Charts</a>
								</li>
							</ul>
							<!-- /.nav-second-level -->
						</li>
						<li>
							<a href="tables.html"><i class="fa fa-table fa-fw"></i> Tables</a>
						</li>
						<li>
							<a href="forms.html"><i class="fa fa-edit fa-fw"></i> Forms</a>
						</li>
						<li>
							<a href="#"><i class="fa fa-wrench fa-fw"></i> UI Elements<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li>
									<a href="panels-wells.html">Panels and Wells</a>
								</li>
								<li>
									<a href="buttons.html">Buttons</a>
								</li>
								<li>
									<a href="notifications.html">Notifications</a>
								</li>
								<li>
									<a href="typography.html">Typography</a>
								</li>
								<li>
									<a href="icons.html"> Icons</a>
								</li>
								<li>
									<a href="grid.html">Grid</a>
								</li>
							</ul>
							<!-- /.nav-second-level -->
						</li>
						<li>
							<a href="#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li>
									<a href="#">Second Level Item</a>
								</li>
								<li>
									<a href="#">Second Level Item</a>
								</li>
								<li>
									<a href="#">Third Level <span class="fa arrow"></span></a>
									<ul class="nav nav-third-level">
										<li>
											<a href="#">Third Level Item</a>
										</li>
										<li>
											<a href="#">Third Level Item</a>
										</li>
										<li>
											<a href="#">Third Level Item</a>
										</li>
										<li>
											<a href="#">Third Level Item</a>
										</li>
									</ul>
									<!-- /.nav-third-level -->
								</li>
							</ul>
							<!-- /.nav-second-level -->
						</li>
						<li>
							<a href="#"><i class="fa fa-files-o fa-fw"></i> Sample Pages<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li>
									<a href="blank.html">Blank Page</a>
								</li>
								<li>
									<a href="login.html">Login Page</a>
								</li>
							</ul>
							<!-- /.nav-second-level -->
						</li>
					</ul>
				</div>
				<!-- /.sidebar-collapse -->
			</div>
			<!-- /.navbar-static-side -->
		</nav>

		<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
		<div id="page-wrapper">
			<div class="row">
				<center>
					<h1 class="page-header">แบบแจ้งวิธีการวัดผลและประเมิณผลการศึกษา คณะเภสัชศาสตร์<br /><h3>ภาคการศึกษาที่ 2 ปีการศึกษา 2560</h3></h1>
				</center>
			</div>

			<form action="" name="form1" method="post">
				<div class="form-group" id="bgmain">
					<ol>
						<br><br>
						<li style="font-size: 20px">
							<div class="form-inline">
								<b>รหัสกระบวนวิชา</b> &nbsp;<input type="text" class="form-control" name="COURSE_ID" id="COURSE_ID" size="4" maxlength="6"> &nbsp;ตอนที่ &nbsp;<input type="text" class="form-control" name="SECTION" id="SECTION" size="2" maxlength="2">
								<br><br><div class="radio">
									<input type="radio" name="NORORSPE" id="NORORSPE" value="NORMAL" checked>&nbsp;<b>ภาคปกติ</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="radio" name="NORORSPE" id="NORORSPE" value="SPECIAL">&nbsp;<b>ภาคพิเศษ</b>
								</div><br><br>
								<div class="row">
									<div class="col-md-4">จำนวนนักศึกษาที่ลงทะเบียนเรียน &nbsp;<input type="text" class="form-control" name="ENROLL" id="ENROLL" size="2" maxlength="3"> &nbsp; คน </div>
									<div class="col-md-4">จำนวนหน่วยกิตทั้งหมด &nbsp;<input type="text" class="form-control" name="TOTAL" id="TOTAL" size="2" maxlength="2">&nbsp; ชั่วโมง</div>
									</div><br>
								<div class="row">
									<div class="col-md-4">จำนวนชั่วโมงบรรยาย (Lecture) &nbsp;<input type="text" class="form-control" name="LEC" id="LEC" size="2" maxlength="2">&nbsp; ชั่วโมง</div>
									<div class="col-md-4">จำนวนชั่วโมงปฏิบัติการ (LAB) &nbsp;<input type="text" class="form-control" name="LAB" id="LAB" size="2" maxlength="2"> &nbsp; ชั่วโมง</div>
									<div class="col-md-4">จำนวนชั่วโมงเรียนรู้ด้วยตัวเอง &nbsp;<input type="text" class="form-control" name="SELF" id="SELF" size="2" maxlength="2">&nbsp; ชั่วโมง</div>
								</div>
								<br>



								<script type="text/javascript">
									/*function ck_frm() {
										var ck = document.getElementById('SPECIAL');
										if (ck.checked == true) {
											document.getElementById('text0').style.display = "";
										} else {
											document.getElementById('text0').style.display = "none";
										}

									}*/
								</script>
								<!--<div id="text0" style="display:none;">
									<br>ตอนที่ &nbsp;<input type="text" class="form-control" name="SECTION" id="SECTION" size="2" maxlength="2">
									<br><br>จำนวนหน่วยกิตทั้งหมด &nbsp;<input type="text" class="form-control" name="TOTALSPC" id="TOTALSPC" size="2" maxlength="2"> &nbsp;จำนวนหน่วยกิต (Lecture) &nbsp;<input type="text" class="form-control" name="LECSPC" id="LECSPC" size="2" maxlength="2">
									<br><br>จำนวนหน่วยกิต (LAB) &nbsp;<input type="text" class="form-control" name="LABSPC" id="LABSPC" size="2" maxlength="2"> &nbsp;จำนวนหน่วยกิต (Self) &nbsp;<input type="text" class="form-control" name="SELFSPC" id="SELFSPC" size="2" maxlength="2">
									<br><br>จำนวนนักศึกษาที่ลงทะเบียนเรียน &nbsp;<input type="text" class="form-control" name="ENROLLSPC" id="ENROLL" size="2" maxlength="3">
								</div>-->
							</div>
						</li>

						<br>
						<li style="font-size: 20px">
							<div class="form-inline">
								<b>ลักษณะการเรียนการสอน&nbsp;&nbsp;</b><br>
								<div class="radio">
									<input type="radio" name="TYPE_TEACHING" id="TYPE_TEACHING" value="LEC" checked> บรรยาย &nbsp;<br>
									<input type="radio" name="TYPE_TEACHING" id="TYPE_TEACHING" value="LECLAB"> บรรยายและงานปฏิบัติการทดลอง&nbsp;<br>
									<input type="radio" name="TYPE_TEACHING" id="TYPE_TEACHING" value="SPE"> กระบวนวิชาปัญหาพิเศษ&nbsp;<br>

									<input type="radio" name="TYPE_TEACHING" id="TYPE_TEACHING" value="TRA"> ฝึกงาน &nbsp;<br>
									<input type="radio" name="TYPE_TEACHING" id="TYPE_TEACHING" value="SEM"> สัมนา &nbsp;<br>
									<input type="radio" name="TYPE_TEACHING" id="TYPE_TEACHING" value="LAB"> ปฏิบัติการ &nbsp;<br>
									<input type="radio" name="TYPE_TEACHING" id="TYPE_TEACHING" value="OTH"> อื่นๆ &nbsp;
								</div>
							</div>
						</li>

						<br>
						<li style="font-size: 20px">
							<div class="form-inline">

								<div id="text"><b>รายชื่ออาจารย์ผู้สอนบรรยาย</b> &nbsp; จำนวน &nbsp;
									<select name="leclist" id="leclist" class="form-control" onchange="lecloop()">
			 	<option value="0" selected>----</option>
			 	<script type="text/javascript">
			 		var i;
			 		for(i=1;i<=11;i++)
			 		{
			 			document.write('<option value="'+i+'">'+i+'</option>');
			 		}
			 	</script>

			 </select> &nbsp;คน

								</div>
							</div>

							<script type="text/javascript">
								function lecloop() {
									var lec = document.getElementById("leclist");
									var i;
									if (lec.value == 0) {
										for (i = 1; i <= 11; i++) {
											document.getElementById("li" + i).style.display = "none";
											document.getElementById('ctlec' + i).classList.add('hide');
											document.getElementById("TEACHERLEC_F" + i).style.display = "none";
											document.getElementById("TEACHERLEC_L" + i).style.display = "none";
										}
									} else {
										//document.getElementById("test1").innerHTML = lec.value;
										for (i = 1; i <= 11; i++) {
											document.getElementById("li" + i).style.display = "none";
											document.getElementById('ctlec' + i).classList.add('hide');
											document.getElementById('TEACHERLEC_F' + i).style.display = "none";
											document.getElementById("TEACHERLEC_L" + i).style.display = "none";
										}

										for (i = 1; i <= lec.value; i++) {
											document.getElementById("li" + i).style.display = "";
											document.getElementById('ctlec' + i).classList.remove('hide');
											document.getElementById('TEACHERLEC_F' + i).style.display = "";
											document.getElementById("TEACHERLEC_L" + i).style.display = "";
										}
									}
								}
							</script>

							<div class="form-inline hide" id="ctlec1">
								<br><label id="li1" style="display:none;">1. &nbsp;</label>
								<input type="text" style="display:none;" class="form-control" name="TEACHERLEC_F1" id="TEACHERLEC_F1" placeholder="ชื่อ" size="20">
								<input type="text" style="display:none;" class="form-control" name="TEACHERLEC_L1" id="TEACHERLEC_L1" placeholder="นามสกุล" size="20">
							</div>

							<div class="form-inline hide" id="ctlec2">
								<br><label id="li2" style="display:none;">2. &nbsp;</label>
								<input type="text" style="display:none;" class="form-control" name="TEACHERLEC_F2" id="TEACHERLEC_F2" placeholder="ชื่อ" size="20">
								<input type="text" style="display:none;" class="form-control" name="TEACHERLEC_L2" id="TEACHERLEC_L2" placeholder="นามสกุล" size="20">
							</div>

							<div class="form-inline hide" id="ctlec3">
								<br><label id="li3" style="display:none;">3. &nbsp;</label>
								<input type="text" style="display:none;" class="form-control" name="TEACHERLEC_F3" id="TEACHERLEC_F3" placeholder="ชื่อ" size="20">
								<input type="text" style="display:none;" class="form-control" name="TEACHERLEC_L3" id="TEACHERLEC_L3" placeholder="นามสกุล" size="20">
							</div>
							<div class="form-inline hide" id="ctlec4">
								<br><label id="li4" style="display:none;">4. &nbsp;</label>
								<input type="text" style="display:none;" class="form-control" name="TEACHERLEC_F4" id="TEACHERLEC_F4" placeholder="ชื่อ" size="20">
								<input type="text" style="display:none;" class="form-control" name="TEACHERLEC_L4" id="TEACHERLEC_L4" placeholder="นามสกุล" size="20">
							</div>
							<div class="form-inline hide" id="ctlec5">
								<br><label id="li5" style="display:none;">5. &nbsp;</label>
								<input type="text" style="display:none;" class="form-control" name="TEACHERLEC_F5" id="TEACHERLEC_F5" placeholder="ชื่อ" size="20">
								<input type="text" style="display:none;" class="form-control" name="TEACHERLEC_L5" id="TEACHERLEC_L5" placeholder="นามสกุล" size="20">
							</div>
							<div class="form-inline hide" id="ctlec6">
								<br><label id="li6" style="display:none;">6. &nbsp;</label>
								<input type="text" style="display:none;" class="form-control" name="TEACHERLEC_F6" id="TEACHERLEC_F6" placeholder="ชื่อ" size="20">
								<input type="text" style="display:none;" class="form-control" name="TEACHERLEC_L6" id="TEACHERLEC_L6" placeholder="นามสกุล" size="20">
							</div>
							<div class="form-inline hide" id="ctlec7">
								<br><label id="li7" style="display:none;">7. &nbsp;</label>
								<input type="text" style="display:none;" class="form-control" name="TEACHERLEC_F7" id="TEACHERLEC_F7" placeholder="ชื่อ" size="20">
								<input type="text" style="display:none;" class="form-control" name="TEACHERLEC_L7" id="TEACHERLEC_L7" placeholder="นามสกุล" size="20">
							</div>
							<div class="form-inline hide" id="ctlec8">
								<br><label id="li8" style="display:none;">8. &nbsp;</label>
								<input type="text" style="display:none;" class="form-control" name="TEACHERLEC_F8" id="TEACHERLEC_F8" placeholder="ชื่อ" size="20">
								<input type="text" style="display:none;" class="form-control" name="TEACHERLEC_L8" id="TEACHERLEC_L8" placeholder="นามสกุล" size="20">
							</div>
							<div class="form-inline hide" id="ctlec9">
								<br><label id="li9" style="display:none;">9. &nbsp;</label>
								<input type="text" style="display:none;" class="form-control" name="TEACHERLEC_F9" id="TEACHERLEC_F9" placeholder="ชื่อ" size="20">
								<input type="text" style="display:none;" class="form-control" name="TEACHERLEC_L9" id="TEACHERLEC_L9" placeholder="นามสกุล" size="20">
							</div>
							<div class="form-inline hide" id="ctlec10">
								<br><label id="li10" style="display:none;">10.&nbsp; </label>
								<input type="text" style="display:none;" class="form-control" name="TEACHERLEC_F10" id="TEACHERLEC_F10" placeholder="ชื่อ" size="20">
								<input type="text" style="display:none;" class="form-control" name="TEACHERLEC_L10" id="TEACHERLEC_L10" placeholder="นามสกุล" size="20">
							</div>
							<div class="form-inline hide" id="ctlec11">
								<br><label id="li11" style="display:none;">11.&nbsp; </label>
								<input type="text" style="display:none;" class="form-control" name="TEACHERLEC_F11" id="TEACHERLEC_F11" placeholder="ชื่อ" size="20">
								<input type="text" style="display:none;" class="form-control" name="TEACHERLEC_L11" id="TEACHERLEC_L11" placeholder="นามสกุล" size="20">
							</div>



							<br>
							<div style="font-size: 20px">
								<div class="form-inline">

									<div id="text"><b>รายชื่ออาจารย์ผู้สอนปฏิบัติการ</b> &nbsp; จำนวน &nbsp;
										<select name="lablist" id="lablist" class="form-control" onchange="labloop()">
			 	<option value="0" selected>----</option>
			 	<script type="text/javascript">
			 		var i;
			 		for(i=1;i<=11;i++)
			 		{
			 			document.write('<option value="'+i+'">'+i+'</option>');
			 		}
			 	</script>

			 </select> &nbsp;คน

									</div>
								</div>
								<script type="text/javascript">
									function labloop() {
										var lab = document.getElementById("lablist");
										var i;
										if (lab.value == 0) {
											for (i = 1; i <= 11; i++) {
												document.getElementById("la" + i).style.display = "none";
												document.getElementById('ctlab' + i).classList.add('hide');
												document.getElementById("TEACHERLAB_F" + i).style.display = "none";
												document.getElementById('TEACHERLAB_L' + i).style.display = "none";
											}
										} else {
											//document.getElementById("test1").innerHTML = lab.value;
											for (i = 1; i <= 11; i++) {
												document.getElementById("la" + i).style.display = "none";
												document.getElementById('ctlab' + i).classList.add('hide');
												document.getElementById('TEACHERLAB_F' + i).style.display = "none";
												document.getElementById('TEACHERLAB_L' + i).style.display = "none";

											}

											for (i = 1; i <= lab.value; i++) {
												document.getElementById("la" + i).style.display = "";
												document.getElementById('ctlab' + i).classList.remove('hide');
												document.getElementById('TEACHERLAB_F' + i).style.display = "";
												document.getElementById('TEACHERLAB_L' + i).style.display = "";

											}
										}
									}
								</script>

								<div class="form-inline hide" id="ctlab1">
									<br><label id="la1" style="display:none;">1. &nbsp;</label>
									<input type="text" style="display:none;" class="form-control" name="TEACHERLAB_F1" id="TEACHERLAB_F1" placeholder="ชื่อ" size="20">
									<input type="text" style="display:none;" class="form-control" name="TEACHERLAB_L1" id="TEACHERLAB_L1" placeholder="นามสกุล" size="20">
								</div>


								<div class="form-inline hide" id="ctlab2">
									<br><label id="la2" style="display:none;">2. &nbsp;</label>
									<input type="text" style="display:none;" class="form-control" name="TEACHERLAB_F2" id="TEACHERLAB_F2" placeholder="ชื่อ" size="20">
									<input type="text" style="display:none;" class="form-control" name="TEACHERLAB_L2" id="TEACHERLAB_L2" placeholder="นามสกุล" size="20">
								</div>


								<div class="form-inline hide" id="ctlab3">
									<br><label id="la3" style="display:none;">3. &nbsp;</label>
									<input type="text" style="display:none;" class="form-control" name="TEACHERLAB_F3" id="TEACHERLAB_F3" placeholder="ชื่อ" size="20">
									<input type="text" style="display:none;" class="form-control" name="TEACHERLAB_L3" id="TEACHERLAB_L3" placeholder="นามสกุล" size="20">
								</div>

								<div class="form-inline hide" id="ctlab4">
									<br><label id="la4" style="display:none;">4. &nbsp;</label>
									<input type="text" style="display:none;" class="form-control" name="TEACHERLAB_F4" id="TEACHERLAB_F4" placeholder="ชื่อ" size="20">
									<input type="text" style="display:none;" class="form-control" name="TEACHERLAB_L4" id="TEACHERLAB_L4" placeholder="นามสกุล" size="20">
								</div>

								<div class="form-inline hide" id="ctlab5">
									<br><label id="la5" style="display:none;">5. &nbsp;</label>
									<input type="text" style="display:none;" class="form-control" name="TEACHERLAB_F5" id="TEACHERLAB_F5" placeholder="ชื่อ" size="20">
									<input type="text" style="display:none;" class="form-control" name="TEACHERLAB_L5" id="TEACHERLAB_L5" placeholder="นามสกุล" size="20">
								</div>

								<div class="form-inline hide" id="ctlab6">
									<br><label id="la6" style="display:none;">6. &nbsp;</label>
									<input type="text" style="display:none;" class="form-control" name="TEACHERLAB_F6" id="TEACHERLAB_F6" placeholder="ชื่อ" size="20">
									<input type="text" style="display:none;" class="form-control" name="TEACHERLAB_L6" id="TEACHERLAB_L6" placeholder="นามสกุล" size="20">
								</div>

								<div class="form-inline hide" id="ctlab7">
									<br><label id="la7" style="display:none;">7. &nbsp;</label>
									<input type="text" style="display:none;" class="form-control" name="TEACHERLAB_F7" id="TEACHERLAB_F7" placeholder="ชื่อ" size="20">
									<input type="text" style="display:none;" class="form-control" name="TEACHERLAB_L7" id="TEACHERLAB_L7" placeholder="นามสกุล" size="20">
								</div>

								<div class="form-inline hide" id="ctlab8">
									<br><label id="la8" style="display:none;">8. &nbsp;</label>
									<input type="text" style="display:none;" class="form-control" name="TEACHERLAB_F8" id="TEACHERLAB_F8" placeholder="ชื่อ" size="20">
									<input type="text" style="display:none;" class="form-control" name="TEACHERLAB_L8" id="TEACHERLAB_L8" placeholder="นามสกุล" size="20">
								</div>

								<div class="form-inline hide" id="ctlab9">
									<br><label id="la9" style="display:none;">9. &nbsp;</label>
									<input type="text" style="display:none;" class="form-control" name="TEACHERLAB_F9" id="TEACHERLAB_F9" placeholder="ชื่อ" size="20">
									<input type="text" style="display:none;" class="form-control" name="TEACHERLAB_L9" id="TEACHERLAB_L9" placeholder="นามสกุล" size="20">
								</div>

								<div class="form-inline hide" id="ctlab10">
									<br><label id="la10" style="display:none;">10.&nbsp; </label>
									<input type="text" style="display:none;" class="form-control" name="TEACHERLAB_F10" id="TEACHERLAB_F10" placeholder="ชื่อ" size="20">
									<input type="text" style="display:none;" class="form-control" name="TEACHERLAB_L10" id="TEACHERLAB_L10" placeholder="นามสกุล" size="20">
								</div>

								<div class="form-inline hide" id="ctlab11">
									<br><label id="la11" style="display:none;">11.&nbsp; </label>
									<input type="text" style="display:none;" class="form-control" name="TEACHERLAB_F11" id="TEACHERLAB_F11" placeholder="ชื่อ" size="20">
									<input type="text" style="display:none;" class="form-control" name="TEACHERLAB_L11" id="TEACHERLAB_L11" placeholder="นามสกุล" size="20">
								</div>

						</li>

						<br>
						<li style="font-size: 20px">
							<div class="form-inline"><b> การสอบ โปรดระบุให้ชัดเจน และครบถ้วน เพื่อใช้เป็นข้อมูลการจัดตารางสอบ </b>(กรุณาระบุชื่ออาจารย์ที่ร่วมสอนในกระบวนวิชา และจำนวนกรรมการคุมสอบอาจระบุอย่างน้อย 3 คน) </div>

							<ul>
								<br>
								<li style="font-size: 20px">

									<b>สอบกลางภาคฯ</b>
									<ul>
										<div class="form-inline">
											<li style="font-size: 20px">
												จำนวนชั่วโมงสอบการสอบ<b>บรรยาย</b>&nbsp;:&nbsp;<input type="text" class="form-control" name="MIDEXAM_HOUR_LEC" id="MIDEXAM_HOUR_LEC" size="2" maxlength="2">&nbsp; ชั่วโมง
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวนกรรมการคุมสอบ&nbsp;
												<select name="mexholec" id="mexholec" class="form-control" onchange="midexam_hour_lec()">
					 	<option value="0" selected>----</option>
					 	<script type="text/javascript">
					 		var i;
					 		for(i=1;i<=5;i++)
					 		{
					 			document.write('<option value="'+i+'">'+i+'</option>');
					 		}
					 	</script>

					</select> &nbsp; คน (แยกห้องกันคุม) <br>
												<script type="text/javascript">
													function midexam_hour_lec() {
														var lec = document.getElementById("mexholec");
														var i;
														if (lec.value == 0) {
															for (i = 1; i <= 5; i++) {
																document.getElementById("mehle" + i).style.display = "none";
																document.getElementById('mehlec' + i).classList.add('hide');
																document.getElementById("MIDEXCOM_LECF" + i).style.display = "none";
																document.getElementById('MIDEXCOM_LECL' + i).style.display = "none";
															}
														} else {
															//document.getElementById("test1").innerHTML = lab.value;
															for (i = 1; i <= 5; i++) {
																document.getElementById("mehle" + i).style.display = "none";
																document.getElementById('mehlec' + i).classList.add('hide');
																document.getElementById('MIDEXCOM_LECF' + i).style.display = "none";
																document.getElementById('MIDEXCOM_LECL' + i).style.display = "none";

															}

															for (i = 1; i <= lec.value; i++) {
																document.getElementById("mehle" + i).style.display = "";
																document.getElementById('mehlec' + i).classList.remove('hide');
																document.getElementById('MIDEXCOM_LECF' + i).style.display = "";
																document.getElementById('MIDEXCOM_LECL' + i).style.display = "";

															}
														}
													}
												</script>

												<div class="form-inline hide" id="mehlec1">
													<br><label id="mehle1" style="display:none;">1.&nbsp; </label>
													<input type="text" style="display:none;" class="form-control" name="MIDEXCOM_LECF1" id="MIDEXCOM_LECF1" placeholder="ชื่อ" size="20">
													<input type="text" style="display:none;" class="form-control" name="MIDEXCOM_LECL1" id="MIDEXCOM_LECL1" placeholder="นามสกุล" size="20">
												</div>

												<div class="form-inline hide" id="mehlec2">
													<br><label id="mehle2" style="display:none;">2.&nbsp; </label>
													<input type="text" style="display:none;" class="form-control" name="MIDEXCOM_LECF2" id="MIDEXCOM_LECF2" placeholder="ชื่อ" size="20">
													<input type="text" style="display:none;" class="form-control" name="MIDEXCOM_LECL2" id="MIDEXCOM_LECL2" placeholder="นามสกุล" size="20">
												</div>

												<div class="form-inline hide" id="mehlec3">
													<br><label id="mehle3" style="display:none;">3.&nbsp; </label>
													<input type="text" style="display:none;" class="form-control" name="MIDEXCOM_LECF3" id="MIDEXCOM_LECF3" placeholder="ชื่อ" size="20">
													<input type="text" style="display:none;" class="form-control" name="MIDEXCOM_LECL3" id="MIDEXCOM_LECL3" placeholder="นามสกุล" size="20">
												</div>

												<div class="form-inline hide" id="mehlec4">
													<br><label id="mehle4" style="display:none;">4.&nbsp; </label>
													<input type="text" style="display:none;" class="form-control" name="MIDEXCOM_LECF4" id="MIDEXCOM_LECF4" placeholder="ชื่อ" size="20">
													<input type="text" style="display:none;" class="form-control" name="MIDEXCOM_LECL4" id="MIDEXCOM_LECL4" placeholder="นามสกุล" size="20">
												</div>

												<div class="form-inline hide" id="mehlec5">
													<br><label id="mehle5" style="display:none;">5.&nbsp; </label>
													<input type="text" style="display:none;" class="form-control" name="MIDEXCOM_LECF5" id="MIDEXCOM_LECF5" placeholder="ชื่อ" size="20">
													<input type="text" style="display:none;" class="form-control" name="MIDEXCOM_LECL5" id="MIDEXCOM_LECL5" placeholder="นามสกุล" size="20">
												</div>

												<br>
												<div class="form-inline">
													<li style="font-size: 20px">
														จำนวนชั่วโมงสอบการสอบ<b>ปฏิบัติการ</b>&nbsp;:&nbsp;<input type="text" class="form-control" name="EXAM_HOUR_LAB" id="EXAM_HOUR_LAB" size="2" maxlength="2">&nbsp; ชั่วโมง
														&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวนกรรมการคุมสอบ&nbsp;
														<select name="mexholac" id="mexholac" class="form-control" onchange="midexam_hour_lab()">
					 	<option value="0" selected>----</option>
					 	<script type="text/javascript">
					 		var i;
					 		for(i=1;i<=5;i++)
					 		{
					 			document.write('<option value="'+i+'">'+i+'</option>');
					 		}
					 	</script>

					 </select> &nbsp; คน
														<script type="text/javascript">
															function midexam_hour_lab() {
																var lab = document.getElementById("mexholac");
																var i;
																if (lab.value == 0) {
																	for (i = 1; i <= 5; i++) {
																		document.getElementById("ehla" + i).style.display = "none";
																		document.getElementById('ehlab' + i).classList.add('hide');
																		document.getElementById("MIDEXCOM_LABF" + i).style.display = "none";
																		document.getElementById('MIDEXCOM_LABL' + i).style.display = "none";
																	}
																} else {
																	//document.getElementById("test1").innerHTML = lab.value;
																	for (i = 1; i <= 5; i++) {
																		document.getElementById("ehla" + i).style.display = "none";
																		document.getElementById('ehlab' + i).classList.add('hide');
																		document.getElementById('MIDEXCOM_LABF' + i).style.display = "none";
																		document.getElementById('MIDEXCOM_LABL' + i).style.display = "none";

																	}

																	for (i = 1; i <= lab.value; i++) {
																		document.getElementById("ehla" + i).style.display = "";
																		document.getElementById('ehlab' + i).classList.remove('hide');
																		document.getElementById('MIDEXCOM_LABF' + i).style.display = "";
																		document.getElementById('MIDEXCOM_LABL' + i).style.display = "";

																	}
																}
															}
														</script>

														<div class="form-inline hide" id="ehlab1">
															<br><label id="ehla1" style="display:none;">1.&nbsp; </label>
															<input type="text" style="display:none;" class="form-control" name="MIDEXCOM_LABF1" id="MIDEXCOM_LABF1" placeholder="ชื่อ" size="20">
															<input type="text" style="display:none;" class="form-control" name="MIDEXCOM_LABL1" id="MIDEXCOM_LABL1" placeholder="นามสกุล" size="20">
														</div>

														<div class="form-inline hide" id="ehlab2">
															<br><label id="ehla2" style="display:none;">2.&nbsp; </label>
															<input type="text" style="display:none;" class="form-control" name="MIDEXCOM_LABF2" id="MIDEXCOM_LABF2" placeholder="ชื่อ" size="20">
															<input type="text" style="display:none;" class="form-control" name="MIDEXCOM_LABL2" id="MIDEXCOM_LABL2" placeholder="นามสกุล" size="20">
														</div>

														<div class="form-inline hide" id="ehlab3">
															<br><label id="ehla3" style="display:none;">3.&nbsp; </label>
															<input type="text" style="display:none;" class="form-control" name="MIDEXCOM_LABF3" id="MIDEXCOM_LABF3" placeholder="ชื่อ" size="20">
															<input type="text" style="display:none;" class="form-control" name="MIDEXCOM_LABL3" id="MIDEXCOM_LABL3" placeholder="นามสกุล" size="20">
														</div>

														<div class="form-inline hide" id="ehlab4">
															<br><label id="ehla4" style="display:none;">4.&nbsp; </label>
															<input type="text" style="display:none;" class="form-control" name="MIDEXCOM_LABF4" id="MIDEXCOM_LABF4" placeholder="ชื่อ" size="20">
															<input type="text" style="display:none;" class="form-control" name="MIDEXCOM_LABL4" id="MIDEXCOM_LABL4" placeholder="นามสกุล" size="20">
														</div>

														<div class="form-inline hide" id="ehlab5">
															<br><label id="ehla5" style="display:none;">5.&nbsp; </label>
															<input type="text" style="display:none;" class="form-control" name="MIDEXCOM_LABF5" id="MIDEXCOM_LABF5" placeholder="ชื่อ" size="20">
															<input type="text" style="display:none;" class="form-control" name="MIDEXCOM_LABL5" id="MIDEXCOM_LABL5" placeholder="นามสกุล" size="20">
														</div>
													</li>
												</div>
									</ul>
									</li>


									<!--0000000000000000000000000SPLIT000000000000000-->
									<br>
									<li style="font-size: 20px">
										<b>สอบไล่</b>
										<ul>
											<div class="form-inline">
												<li style="font-size: 20px">
													จำนวนชั่วโมงสอบการสอบ<b>บรรยาย</b>&nbsp;:&nbsp;<input type="text" class="form-control" name="FINEXAM_HOUR_LEC" id="FINEXAM_HOUR_LEC" size="2" maxlength="2">&nbsp; ชั่วโมง
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวนกรรมการคุมสอบ&nbsp;
													<select name="fexholec" id="fexholec" class="form-control" onchange="finexam_hour_lec()">
					 	<option value="0" selected>----</option>
					 	<script type="text/javascript">
					 		var i;
					 		for(i=1;i<=5;i++)
					 		{
					 			document.write('<option value="'+i+'">'+i+'</option>');
					 		}
					 	</script>

					</select> &nbsp; คน (แยกห้องกันคุม) <br>
													<script type="text/javascript">
														function finexam_hour_lec() {
															var lec = document.getElementById("fexholec");
															var i;
															if (lec.value == 0) {
																for (i = 1; i <= 5; i++) {
																	document.getElementById("fmehle" + i).style.display = "none";
																	document.getElementById('fmehlec' + i).classList.add('hide');
																	document.getElementById("FINEXCOM_LECF" + i).style.display = "none";
																	document.getElementById('FINEXCOM_LECL' + i).style.display = "none";
																}
															} else {
																//document.getElementById("test1").innerHTML = lab.value;
																for (i = 1; i <= 5; i++) {
																	document.getElementById("fmehle" + i).style.display = "none";
																	document.getElementById('fmehlec' + i).classList.add('hide');
																	document.getElementById('FINEXCOM_LECF' + i).style.display = "none";
																	document.getElementById('FINEXCOM_LECL' + i).style.display = "none";

																}

																for (i = 1; i <= lec.value; i++) {
																	document.getElementById("fmehle" + i).style.display = "";
																	document.getElementById('fmehlec' + i).classList.remove('hide');
																	document.getElementById('FINEXCOM_LECF' + i).style.display = "";
																	document.getElementById('FINEXCOM_LECL' + i).style.display = "";

																}
															}
														}
													</script>

													<div class="form-inline hide" id="fmehlec1">
														<br><label id="fmehle1" style="display:none;">1.&nbsp; </label>
														<input type="text" style="display:none;" class="form-control" name="FINEXCOM_LECF1" id="FINEXCOM_LECF1" placeholder="ชื่อ" size="20">
														<input type="text" style="display:none;" class="form-control" name="FINEXCOM_LECL1" id="FINEXCOM_LECL1" placeholder="นามสกุล" size="20">
													</div>

													<div class="form-inline hide" id="fmehlec2">
														<br><label id="fmehle2" style="display:none;">2.&nbsp; </label>
														<input type="text" style="display:none;" class="form-control" name="FINEXCOM_LECF2" id="FINEXCOM_LECF2" placeholder="ชื่อ" size="20">
														<input type="text" style="display:none;" class="form-control" name="FINEXCOM_LECL2" id="FINEXCOM_LECL2" placeholder="นามสกุล" size="20">
													</div>

													<div class="form-inline hide" id="fmehlec3">
														<br><label id="fmehle3" style="display:none;">3.&nbsp; </label>
														<input type="text" style="display:none;" class="form-control" name="FINEXCOM_LECF3" id="FINEXCOM_LECF3" placeholder="ชื่อ" size="20">
														<input type="text" style="display:none;" class="form-control" name="FINEXCOM_LECL3" id="FINEXCOM_LECL3" placeholder="นามสกุล" size="20">
													</div>

													<div class="form-inline hide" id="fmehlec4">
														<br><label id="fmehle4" style="display:none;">4.&nbsp; </label>
														<input type="text" style="display:none;" class="form-control" name="FINEXCOM_LECF4" id="FINEXCOM_LECF4" placeholder="ชื่อ" size="20">
														<input type="text" style="display:none;" class="form-control" name="FINEXCOM_LECL4" id="FINEXCOM_LECL4" placeholder="นามสกุล" size="20">
													</div>

													<div class="form-inline hide" id="fmehlec5">
														<br><label id="fmehle5" style="display:none;">5.&nbsp; </label>
														<input type="text" style="display:none;" class="form-control" name="FINEXCOM_LECF5" id="FINEXCOM_LECF5" placeholder="ชื่อ" size="20">
														<input type="text" style="display:none;" class="form-control" name="FINEXCOM_LECL5" id="FINEXCOM_LECL5" placeholder="นามสกุล" size="20">
													</div>

													<br>
													<div class="form-inline">
														<li style="font-size: 20px">
															จำนวนชั่วโมงสอบการสอบ<b>ปฏิบัติการ</b>&nbsp;:&nbsp;<input type="text" class="form-control" name="FINEXAM_HOUR_LAB" id="FINEXAM_HOUR_LAB" size="2" maxlength="2">&nbsp; ชั่วโมง
															&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวนกรรมการคุมสอบ&nbsp;
															<select name="fexholac" id="fexholac" class="form-control" onchange="finexam_hour_lab()">
					 	<option value="0" selected>----</option>
					 	<script type="text/javascript">
					 		var i;
					 		for(i=1;i<=5;i++)
					 		{
					 			document.write('<option value="'+i+'">'+i+'</option>');
					 		}
					 	</script>

					 </select> &nbsp; คน
															<script type="text/javascript">
																function finexam_hour_lab() {
																	var lab = document.getElementById("fexholac");
																	var i;
																	if (lab.value == 0) {
																		for (i = 1; i <= 5; i++) {
																			document.getElementById("fehla" + i).style.display = "none";
																			document.getElementById('fehlab' + i).classList.add('hide');
																			document.getElementById("FINEXCOM_LABF" + i).style.display = "none";
																			document.getElementById('FINEXCOM_LABL' + i).style.display = "none";
																		}
																	} else {
																		//document.getElementById("test1").innerHTML = lab.value;
																		for (i = 1; i <= 5; i++) {
																			document.getElementById("fehla" + i).style.display = "none";
																			document.getElementById('fehlab' + i).classList.add('hide');
																			document.getElementById('FINEXCOM_LABF' + i).style.display = "none";
																			document.getElementById('FINEXCOM_LABL' + i).style.display = "none";

																		}

																		for (i = 1; i <= lab.value; i++) {
																			document.getElementById("fehla" + i).style.display = "";
																			document.getElementById('fehlab' + i).classList.remove('hide');
																			document.getElementById('FINEXCOM_LABF' + i).style.display = "";
																			document.getElementById('FINEXCOM_LABL' + i).style.display = "";

																		}
																	}
																}
															</script>

															<div class="form-inline hide" id="fehlab1">
																<br><label id="fehla1" style="display:none;">1.&nbsp; </label>
																<input type="text" style="display:none;" class="form-control" name="FINEXCOM_LABF1" id="FINEXCOM_LABF1" placeholder="ชื่อ" size="20">
																<input type="text" style="display:none;" class="form-control" name="FINEXCOM_LABL1" id="FINEXCOM_LABL1" placeholder="นามสกุล" size="20">
															</div>

															<div class="form-inline hide" id="fehlab2">
																<br><label id="fehla2" style="display:none;">2.&nbsp; </label>
																<input type="text" style="display:none;" class="form-control" name="FINEXCOM_LABF2" id="FINEXCOM_LABF2" placeholder="ชื่อ" size="20">
																<input type="text" style="display:none;" class="form-control" name="FINEXCOM_LABL2" id="FINEXCOM_LABL2" placeholder="นามสกุล" size="20">
															</div>

															<div class="form-inline hide" id="fehlab3">
																<br><label id="fehla3" style="display:none;">3.&nbsp; </label>
																<input type="text" style="display:none;" class="form-control" name="FINEXCOM_LABF3" id="FINEXCOM_LABF3" placeholder="ชื่อ" size="20">
																<input type="text" style="display:none;" class="form-control" name="FINEXCOM_LABL3" id="FINEXCOM_LABL3" placeholder="นามสกุล" size="20">
															</div>

															<div class="form-inline hide" id="fehlab4">
																<br><label id="fehla4" style="display:none;">4.&nbsp; </label>
																<input type="text" style="display:none;" class="form-control" name="FINEXCOM_LABF4" id="FINEXCOM_LABF4" placeholder="ชื่อ" size="20">
																<input type="text" style="display:none;" class="form-control" name="FINEXCOM_LABL4" id="FINEXCOM_LABL4" placeholder="นามสกุล" size="20">
															</div>

															<div class="form-inline hide" id="fehlab5">
																<br><label id="fehla5" style="display:none;">5.&nbsp; </label>
																<input type="text" style="display:none;" class="form-control" name="FINEXCOM_LABF5" id="FINEXCOM_LABF5" placeholder="ชื่อ" size="20">
																<input type="text" style="display:none;" class="form-control" name="FINEXCOM_LABL5" id="FINEXCOM_LABL5" placeholder="นามสกุล" size="20">
															</div>
														</li>
													</div>
										</ul>
										</li>
							</ul>

							<br>
							<div class="form-inline">
								<li style="font-size: 20px;">
									<b>การวัดผลการศึกษา</b> (สัดส่วนการให้คะแนนโปรดระบุเป็นร้อยละ)<br><br>
									<table id="meastable" class="table table-bordered table-hover" width="70%" style="font-size: 18px;">
										<tr class="success">
											<th width="67%" colspan="2"> </th>
											<th style="text-align: center;">ภาคทฤษฏี</th>
											<th style="text-align: center;">ภาคปฏิบัติ </th>
										</tr>
										<tr>
											<td colspan="2">1. สอบกลางภาคการศึกษา</td>
											<td><input type="text" class="form-control" name="MEASURE_MIDLEC" id="MEASURE_MIDLEC" size="2"></td>
											<td><input type="text" class="form-control" name="MEASURE_MIDLAB" id="MEASURE_MIDLAB" size="2"></td>
										</tr>
										<tr>
											<td colspan="2">2. สอบไล่ </td>
											<td><input type="text" class="form-control" name="MEASURE_FINLEC" id="MEASURE_FINLEC" size="2"></td>
											<td><input type="text" class="form-control" name="MEASURE_FINLAB" id="MEASURE_FINLAB" size="2"></td>
										</tr>
										<tr>
											<td colspan="2">3. อื่นๆ โปรดระบุ งานมอบหมาย </td>
											<td colspan="2" style="text-align: center;"><input type="button" class="btn btn-success" name="addbtn" id="addbtn" value="เพิ่ม"> </td>


											<script>
												$('#addbtn').click(function() {
													var table = $(this).closest('table');
													console.log(table.find('input:text').length);
													if (table.find('input:text').length < 100) {
														$('#delbtn').removeAttr("disabled");
														var x = $(this).closest('tr').nextAll('tr');
														var rowCount = $('#meastable tr').length;
														$.each(x, function(i, val) {
															val.remove();
														});
														table.append('<tr class="warning" id="row' + (rowCount - 4) + '"><td colspan="2"><div class="form-inline"><input type="button" class="btn btn-danger" name="delbtn' + (rowCount - 4) + '" id="delbtn' + (rowCount - 4) +
															'" value="ลบ" onclick="deleteRow(' + (rowCount - 4) + ')">&nbsp;&nbsp;<input type="text" class="form-control" name="MEASURE_OTHERCOMMENT' + (rowCount - 4) + '" id="MEASURE_OTHERCOMMENT' + (rowCount - 4) +
															'" size="50"></div></td><td><input type="text" class="form-control" name="MEASURE_OTHERLEC' + (rowCount - 4) + '" id="MEASURE_OTHERLEC' + (rowCount - 4) +
															'" size="2"></td><td><input type="text" class="form-control" name="MEASURE_OTHERLAB' + (rowCount - 4) + '" id="MEASURE_OTHERLAB' + (rowCount - 4) + '" size="2"></td></tr>');
														$.each(x, function(i, val) {
															table.append(val);
														});
													}
												});

												function deleteRow(r) {
													var i = r;

													var row = document.getElementById('row' + i);
													row.parentNode.removeChild(row);
												}
											</script>
										</tr>
										<tr>
											<td colspan="2" style="text-align: center;"><b>รวมคะแนน</b></td>
											<td><input type="text" class="form-control" name="MEASURE_TOTALLEC" id="MEASURE_TOTALLEC" size="2"></td>
											<td><input type="text" class="form-control" name="MEASURE_TOTALLAB" id="MEASURE_TOTALLAB" size="2"></td>
										</tr>
									</table>

									<div class="row">
										<dir class="col-md-6">
											<table id="samenatable" class="table table-bordered table-hover" width="100%" style="font-size: 18px;">
												<tbody>
													<tr class="success">
														<th colspan="2" style="text-align: center;">กระบวนวิชาสัมนา</th>
													</tr>
													<tr>
														<td width="65%" align="center">กิจกรรม</td>
														<td align="center">&nbsp;สัดส่วนการให้คะแนน&nbsp;</td>
													</tr>
													<tr>
														<td align="center" colspan="2"><input type="button" class="btn btn-success" name="addbtnsa" id="addbtnsa" value="เพิ่ม"></td>
														<script>
															$('#addbtnsa').click(function() {
																var table = $(this).closest('table');
																console.log(table.find('input:text').length);
																if (table.find('input:text').length < 100) {
																	$('#delbtnsa').removeAttr("disabled");
																	var x = $(this).closest('tr').nextAll('tr');
																	var rowCount = $('#samenatable tr').length;
																	$.each(x, function(i, val) {
																		val.remove();
																	});
																	table.append('<tr class="warning" id="row' + (rowCount - 4) + '"><td><div class="form-inline"><input type="button" class="btn btn-danger" name="delbtnsa' + (rowCount - 4) + '" id="delbtnsa' + (rowCount - 4) +
																		'" value="ลบ" onclick="deleteRow(' + (rowCount - 4) + ')">&nbsp;&nbsp;<input type="text" class="form-control" name="SAMEMA_NAME' + (rowCount - 4) + '" id="SAMEMA_NAME' + (rowCount - 4) +
																		'" size="30"></div></td><td><input type="text" class="form-control" name="SAMENA_SCORE' + (rowCount - 4) + '" id="SAMENA_SCORE' + (rowCount - 4) + '" size="2"></td></tr>');
																	$.each(x, function(i, val) {
																		table.append(val);
																	});
																}
															});

															function deleteRow(r) {
																var i = r;

																var row = document.getElementById('row' + i);
																row.parentNode.removeChild(row);
															}
														</script>


													</tr>
													<tr>
														<td align="right"><b>รวมคะแนน</b></td>
														<td><input type="text" class="form-control" name="SAMENA_TOTAL" id="SAMENA_TOTAL" size="2"></td>
													</tr>
												</tbody>
											</table>
										</dir>

										<dir class="col-md-6">
											<table id="samenatable2" class="table table-bordered table-hover" width="100%" style="font-size: 18px;">
												<tbody>
													<tr class="success">
														<th colspan="2" style="text-align: center;">ฝึกปฏิบัติ/ปัญหาพิเศษ</th>
													</tr>
													<tr>
														<td width="65%" align="center">กิจกรรม</td>
														<td align="center">&nbsp;สัดส่วนการให้คะแนน&nbsp;</td>
													</tr>
													<tr>
														<td align="center" colspan="2"><input type="button" class="btn btn-success" name="addbtnsa2" id="addbtnsa2" value="เพิ่ม"></td>
														<script>
															$('#addbtnsa2').click(function() {
																var table = $(this).closest('table');
																console.log(table.find('input:text').length);
																if (table.find('input:text').length < 100) {
																	$('#delbtnsa2').removeAttr("disabled");
																	var x = $(this).closest('tr').nextAll('tr');
																	var rowCount = $('#samenatable2 tr').length;
																	$.each(x, function(i, val) {
																		val.remove();
																	});
																	table.append('<tr class="warning" id="row2' + (rowCount - 4) + '"><td><div class="form-inline"><input type="button" class="btn btn-danger" name="delbtnsa2' + (rowCount - 4) + '" id="delbtnsa2' + (rowCount - 4) +
																		'" value="ลบ" onclick="deleteRow2(' + (rowCount - 4) + ')">&nbsp;&nbsp;<input type="text" class="form-control" name="TRAIN_NAME' + (rowCount - 4) + '" id="TRAIN_NAME' + (rowCount - 4) +
																		'" size="30"></td><td><input type="text" class="form-control" name="TRAIN_SCORE' + (rowCount - 4) + '" id="TRAIN_SCORE' + (rowCount - 4) + '" size="2"></td></tr>');
																	$.each(x, function(i, val) {
																		table.append(val);
																	});
																}
															});

															function deleteRow2(r) {
																var i = r;

																var row = document.getElementById('row2' + i);
																row.parentNode.removeChild(row);
															}
														</script>
													</tr>
													<tr>
														<td align="right"><b>รวมคะแนน</b></td>
														<td><input type="text" class="form-control" name="TRAIN_TOTAL" id="TRAIN_TOTAL" size="2"></td>
													</tr>
												</tbody>
											</table>
									</div>

								</li>

								<br>
								<li style="font-size: 20px;">
									<b>การประเมิณผล</b>
									<br>
									<div class="form-inline"><input type="radio" name="EVALUATE" id="EVALUATE" value="SU" checked>&nbsp; ให้อักษร S หรือ U (ได้รับการอนุมัติจากมหาวิทยาลัยแล้ว)</div>
									<div class="form-inline"><input type="radio" name="EVALUATE" id="EVALUATE" value="AF">&nbsp; ให้ลำดับขั้น A, B+ ,B, C+, C, D+, D, F </div>
									<br><b>วิธีการตัดเกรด</b>
									<div class="form-inline"><input type="radio" name="CALCULATE" id="CALCULATE_TYPE" value="GROUP" checked>&nbsp; อิงกลุ่ม</div>
									<div class="form-inline"><input type="radio" name="CALCULATE" id="CALCULATE_TYPE" value="CRITERIA">&nbsp; อิงเกณฑ์ &nbsp;&nbsp;ได้กำหนดเกณฑ์ดังต่อไปนี้</div>
									<br>
									<table class="table table-hover" width="100%" style="font-size: 18px; ">
										<tr align="center">
											<th>เกรด</th>
											<th>คะแนนต่ำสุด</th>
											<th></th>
											<th>คะแนนสูงสุด</th>
											<th></th>
											<th>เกรด</th>
											<th>คะแนนต่ำสุด</th>
											<th></th>
											<th>คะแนนสูงสุด</th>
											<th></th>
										</tr>
										<tr align="center">
											<td>A</td>
											<td><input type="text" class="form-control" name="CALCULATE_A_MIN" id="CALCULATE_A_MIN" placeholder="คะแนน"></td>
											<td></td>
											<td></td>
											<td></td>
											<td>D+</td>
											<td><input type="text" class="form-control" name="CALCULATE_Dp_MIN" id="CALCULATE_Dp_MIN" placeholder="คะแนน"></td>
											<td>ถึง</td>
											<td><input type="text" class="form-control" name="CALCULATE_Dp_MAX" id="CALCULATE_Dp_MAX" placeholder="คะแนน"></td>
											<td></td>
										</tr>
										<tr align="center">
											<td>B+</td>
											<td><input type="text" class="form-control" name="CALCULATE_Bp_MIN" id="CALCULATE_Bp_MIN" placeholder="คะแนน"></td>
											<td>ถึง</td>
											<td><input type="text" class="form-control" name="CALCULATE_Bp_MAX" id="CALCULATE_Bp_MAX" placeholder="คะแนน"></td>
											<td></td>
											<td>D</td>
											<td><input type="text" class="form-control" name="CALCULATE_D_MIN" id="CALCULATE_D_MIN" placeholder="คะแนน"></td>
											<td>ถึง</td>
											<td><input type="text" class="form-control" name="CALCULATE_D_MAX" id="CALCULATE_D_MAX" placeholder="คะแนน"></td>
											<td></td>
										</tr>
										<tr align="center">
											<td>B</td>
											<td><input type="text" class="form-control" name="CALCULATE_B_MIN" id="CALCULATE_B_MIN" placeholder="คะแนน"></td>
											<td>ถึง</td>
											<td><input type="text" class="form-control" name="CALCULATE_B_MAX" id="CALCULATE_B_MAX" placeholder="คะแนน"></td>
											<td></td>
											<td>F</td>
											<td></td>
											<td></td>
											<td><input type="text" class="form-control" name="CALCULATE_F_MAX" id="CALCULATE_F_MAX" placeholder="คะแนน"></td>
											<td></td>
										</tr>
										<tr align="center">
											<td>C+</td>
											<td><input type="text" class="form-control" name="CALCULATE_Cp_MIN" id="CALCULATE_Cp_MIN" placeholder="คะแนน"></td>
											<td>ถึง</td>
											<td><input type="text" class="form-control" name="CALCULATE_Cp_MAX" id="CALCULATE_Cp_MAX" placeholder="คะแนน"></td>
											<td></td>
											<td>S</td>
											<td><input type="text" class="form-control" name="CALCULATE_S_MIN" id="CALCULATE_S_MIN" placeholder="คะแนน"></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
										<tr align="center">
											<td>C</td>
											<td><input type="text" class="form-control" name="CALCULATE_C_MIN" id="CALCULATE_C_MIN" placeholder="คะแนน"></td>
											<td>ถึง</td>
											<td><input type="text" class="form-control" name="CALCULATE_C_MAX" id="CALCULATE_C_MAX" placeholder="คะแนน"></td>
											<td></td>
											<td>U</td>
											<td></td>
											<td></td>
											<td><input type="text" class="form-control" name="CALCULATE_U_MAX" id="CALCULATE_U_MAX" placeholder="คะแนน"></td>
											<td></td>
										</tr>
									</table>
								</li>

								<br>
								<li style="font-size: 20px;">
									<b>นักศึกษาที่ขาดสอบในการวัดผลครั้งสุดท้าย</b> &nbsp;&nbsp;โดยไม่ได้รับอนุญาตให้เลื่อนการสอบตามข้อบังคับฯ ของมหาวิทยาลัยเชียงใหม่ ว่าด้วยการศึกษาชั้นปริญญาตรี อาจารย์ผู้สอนจะประเมิณดังนี้
									<br>
									<input type="radio" name="ABSENT" id="ABSENT" value="F" checked>&nbsp; ให้ลำดับขั้น F &nbsp;&nbsp; <br>
									<input type="radio" name="ABSENT" id="ABSENT" value="U" >&nbsp; ให้อักษร U &nbsp;&nbsp;<br>
									<input type="radio" name="ABSENT" id="ABSENT" value="CAL" >&nbsp; นำคะแนนทั้งหมดที่นักศึกษาได้รับก่อนการสอบไล่มาประเมิณ &nbsp;&nbsp;<br>


					</ol>
					</div>
					<br><br>
					<div align="center"><input type="button" class="btn btn-success" name="submitbtn" id="submitbtn" value="ยืนยัน" onClick="submitfunc()"></div>
			</form>
			</div>


			<script>
				function submitfunc() {
					var test = document.getElementById("COURSE_ID");
					var data = {
						'COURSE_ID': test.value
					};
					alert(JSON.stringify(data));
					/*$.ajax({
						   url: url,
						   type: 'POST',
						   contentType:'application/json',
						   data: JSON.stringify(data),
						   dataType:'json',
						   success: function(data){
						     //On ajax success do this
						     alert(data);
						      },
						   error: function(xhr, ajaxOptions, thrownError) {
						      //On error do this
						        if (xhr.status == 200) {

						            alert(ajaxOptions);
						        }
						        else {
						            alert(xhr.status);
						            alert(thrownError);
						        }
						    }
						 });*/
				}
			</script>

			</div>
</body>

</html>