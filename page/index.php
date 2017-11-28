<?php
	session_start();
	require_once(__DIR__."/../application/class/person.php");
	require_once(__DIR__."/../application/class/course.php");
	if(!isset($_SESSION['level']) || !isset($_SESSION['fname']) || !isset($_SESSION['lname']) || !isset($_SESSION['id']))
	{
	    die('กรุณา Login ใหม่');
	}else if($_SESSION['level'] == 7)
	{
		header('Location: admin.php');
	}
	if (empty($_SESSION['admission'])) {
		$_SESSION['admission']=0;
	}


	$person = new Person();
	$course = new Course();
	$type_status=$course->Get_Status_Text();
	$check_permission=$person->Check_Grant($_SESSION['id']);
	$check_assessor=$person->Is_Assessor($_SESSION['id']);


	
	if (isset($_POST['change_level'])) {
		if($_SESSION['level']==1){
			$_SESSION['level']=4;
		}
		else if($_SESSION['level']==4 || $_SESSION['level']==5){
			$_SESSION['level']=1;
		}
	}
	if (isset($_POST['change_leveldep'])) {
		if ($_SESSION['level']==2) {
			$_SESSION['level']=4;
		}elseif($_SESSION['level']==4){
			$_SESSION['level']=2;
		}

	}
	if (isset($_POST['change_levelfac'])) {
		if ($_SESSION['level']==3) {
			$_SESSION['level']=4;
		}elseif($_SESSION['level']==4){
			$_SESSION['level']=3;
		}

	}


	$_SESSION['oldlevel']=$check_assessor[0];
	$show_btn=0;
	$show_btndep=0;
	$show_btnfac=0;
	$show_btnmulti=0;
	$show_btnfacboard=0;
	$show_btndepboard=0;
	if ($check_assessor[1]==true || $check_assessor[2]==true || $_SESSION['level']== 6 || $_SESSION['admission']>=1 ) {


		if (($check_assessor[1]==true && $check_assessor[2]==true) || $check_assessor[2]==true) {
			$show_btnmulti=1;
		}elseif ( $_SESSION['admission']==1) {
			$show_btnmulti=1;
		}elseif ( $_SESSION['admission']==2) {
			$show_btndepboard=1;
		}elseif ( $_SESSION['admission']==3) {
			$show_btnfacboard=1;
		}
		elseif($check_assessor[0]==1 && $check_assessor[1]==true  && $_SESSION['admission']==0 && $_SESSION['level']!=6) {
			$show_btn=1;
		}elseif ($check_assessor[0]==2 && $_SESSION['admission']==0 && $_SESSION['level']!=6) {
			$show_btndep=1;
		}elseif ($check_assessor[0]==3 && $_SESSION['admission']==0 && $_SESSION['level']!=6) {
			$show_btnfac=1;
		}
		else if($check_assessor[0]==4){
			$show_btn = 0;
		}



	}

	if (isset($_GET['level'])) {
		$_SESSION['level']    = $_GET['level'];
		$_SESSION['edithome'] = $_GET['level'];
	}



	$person->Close_connection();
 ?>
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

	<!-- Custom Theme JavaScript -->
	<script src="dist/js/sb-admin-2.js"></script>
	<script src="vendor/core/core.js"></script>
	<script type="text/javascript" src="dist/js/bootstrap-filestyle.min.js"></script>

	  <link rel="stylesheet" href="dist/css/scrollbar.css">

	<script>

	window.onload =  function(){
      update_noti();
    };
	setInterval(update_noti, 5000);
	function update_noti(){
		$.ajax({
				url: "../application/notification/get_data.php" ,
				type: "POST",
				data: ''
		}).done(function(result) {
			if(result != '')
			{
				try
				{
				   var obj = jQuery.parseJSON(result);
					 if(obj != '')
	 				{
	 					$("#new_noti").text(obj.length);
	 					if ($(".label-danger").css('display') == 'none'){}
	 					{
	 						$(".label-danger").show("fast");
	 					}
	 					append_noti(obj);
	 				}
				}
				catch(e)
				{
				   console.log(result);
				}
			}
			else
			{
				$(".label-danger").hide();
			}

		});
	}
	function read_noti()
	{
		$.ajax({
				url: "../application/notification/read_data.php" ,
				type: "POST",
				data: ''
		}).done(function(result) {

		});
	}
	function append_noti(obj)
	{
		var object = document.getElementById("notification_element");
		 $("#noti").html('');
		for(var i=0;i<obj.length;i++)
		{
			try
			{
				var element = $(object).clone();
				var data = jQuery.parseJSON(obj[i]);
				var status = '';
				var type = '';
				if(data != '')
				{
					switch(data.STATUS) {
						case '0':
						status= '<?php echo '<b style=color:'.$type_status[0]["color"].'>'.$type_status[0]["status_name"]. '<i class="'.$type_status[0]["icon"].'"></i></b>' ?>';
						break;
					 case '1':
					 	status= '<?php echo '<b style=color:'.$type_status[1]["color"].'>'.$type_status[1]["status_name"]. '<i class="'.$type_status[1]["icon"].'"></i></b>' ?>';
						 break;
					 case '2':
					 	status= '<?php echo '<b style=color:'.$type_status[2]["color"].'>'.$type_status[2]["status_name"]. '<i class="'.$type_status[2]["icon"].'"></i></b>' ?>';
						 break;
					 case '3':
					 	status= '<?php echo '<b style=color:'.$type_status[3]["color"].'>'.$type_status[3]["status_name"]. '<i class="'.$type_status[3]["icon"].'"></i></b>' ?>';
						 break;
					 case '4':
					 	status= '<?php echo '<b style=color:'.$type_status[4]["color"].'>'.$type_status[4]["status_name"]. '<i class="'.$type_status[4]["icon"].'"></i></b>' ?>';
						 break;
					 case '5':
					 	status= '<?php echo '<b style=color:'.$type_status[5]["color"].'>'.$type_status[5]["status_name"]. '<i class="'.$type_status[5]["icon"].'"></i></b>' ?>';
						 break;
					 case '6':
					 	status= '<?php echo '<b style=color:'.$type_status[6]["color"].'>'.$type_status[6]["status_name"]. '<i class="'.$type_status[6]["icon"].'"></i></b>' ?>';
						 break;
					 case '7':
					 	status= '<?php echo '<b style=color:'.$type_status[7]["color"].'>'.$type_status[7]["status_name"]. '<i class="'.$type_status[7]["icon"].'"></i></b>' ?>';
						 break;
		    	 default:
		        status = '';
						break;
					}

					$(element).find("#course_id").text(data.COURSE_ID);
					$(element).find("#date").text("เมื่อวันที่ "+data.DATE_USER+" เวลา "+data.TIME_USER);
					if(data.TYPE == '1')
					{
						type = "แบบวัดผลประเมินผล";
					}
					else
					{
						type = "แบบเชิญอาจารย์พิเศษ <br> "+data.NAME;
					}
					$(element).find("#type").html(type);
					$(element).find("#status").html(status);
					$("#noti").prepend('<li class="divider"></li>');
					$("#noti").prepend(element);
				}
			}
			catch(e)
			{
				 console.log(result);
			}
		}
	}
	$(document).ready(function(){
		update_noti();
		$(document).on("click", function () {
    		$("#noti").hide("slow");
				$("#logout").hide("slow");
		});
		$("#icon-dropdown").click(function(){
			var read =  $("#noti").is(':visible');
			if(read == false)
			{
				read_noti();
			}
			$("#noti").slideToggle();
			$(".label-danger").hide("fast");
			$("#logout").hide("slow");
		});
		$("#icon-logout").click(function(){
			$("#logout").slideToggle();
			$("#noti").hide("slow");
		})
		$('#frm').on("load",function(){
	        var iframe = $('#frm').contents();
	        iframe.find("html").click(function(){
    				$("#noti").hide("slow");
						$("#logout").hide("slow");
	        });
				});
 			$('a[href="#"]').click(function(e){
 			   e.preventDefault();
 			});
 		});

		function loadDoc(url) {
			var ifrm = document.createElement("iframe");
	        ifrm.setAttribute("src", url);
	        ifrm.style.width = "100%";
	        ifrm.style.height = "100%";
	        ifrm.frameBorder = 0;
         	document.getElementById("frm").src = url;
		}

		function check_level(){
			var level = <?php echo $_SESSION['level'] ?>;
			if (level==4 || level==5 ) {
				loadDoc("form/comment.php");
			}else if(level==6){
				loadDoc("form/commentboard.php");
			}
			else{
				loadDoc('form/home.php');
			}
		}



	</script>



	<title>ยินดีต้อนรับ</title>
	<style>
		form{
			margin-top: 10px;
		}
	#frm {
		background:url('../application/picture/loading_icon.gif') center no-repeat;
	}

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

		.notilist{
			font-size: 20px;
		}
		.red{
			background:#ec2c2c;
		}
		#statcf {
		  color : #0e9d14;
		}

		#statn {
		  color : #ec2c2c;
		}

		#statwt {
		  color : #acb500;
		}

		#statal {
		  color : #da9001;
		}

		.detail{
		display:block;
    width:280px;
    word-wrap:break-word;
		}
		a.disabled {
    pointer-events: none;
    cursor: default;
		}
		a.color {
    background:#ec2c2c;
		}
		.scrollable-menu {
    height: auto;
    max-height: 500px;
    overflow-x: hidden;
}
		#frm {
			overflow-x: hidden;
		}
		.hiddenRow {
    	padding: 0 !important;
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

<body onload="check_level()">
	<div id="wrapper">

		<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" >
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
						</button>
				<a class="navbar-brand" href="#" onclick="loadDoc('form/home.php')">ระบบงานข้อมูลของงานบริการการศึกษา คณะเภสัชศาสตร์ มหาวิทยาลัยเชียงใหม่</a>
			</div>
			<!-- /.navbar-header -->

			<ul class="nav navbar-top-links navbar-right">
				<form action="index.php" method="POST" class="form-inline">
					<b>ยินดีต้อนรับ | <font color="#51cc62"> คุณ <?php echo $_SESSION['fname'].' ',$_SESSION['lname']; ?></font></b>
					<?php
					if ($show_btn==1 || $show_btnmulti==1 ||$show_btndep==1 || $show_btndepboard==1 || $show_btnfac==1 ||$show_btnfacboard==1) {
						if ($_SESSION['level']==1) {
							$status_name ="อาจารย์";
						}else if ($_SESSION['level']==2) {
							$status_name ="เจ้าหน้าที่ภาค";
						}else if ($_SESSION['level']==3){
							$status_name ="เจ้าหน้าที่คณะ";
						}else if ($_SESSION['level']==4){
							$status_name ="คณะกรรมการ";
						}
						else if ($_SESSION['level']==5){
							$status_name ="คณะกรรมการ";
						}
						else if ($_SESSION['level']==6){
							$status_name ="ผู้บริหาร";
						}
						else if ($_SESSION['level']==7){
							$status_name ="admin";
						}


						?>

						<b>สถานะ : <?php echo $status_name;?> </b>&nbsp;

						<?php

						if ($show_btn==1) {  ?>
							<button type="submit" class="btn btn-primary btn-outlne" name="change_level">เปลี่ยนสถานะ</button>
						<?php } ?>
						<?php if ($show_btndep==1) {  ?>
							<button type="submit" class="btn btn-primary btn-outlne" name="change_leveldep">เปลี่ยนสถานะ</button>
						<?php } ?>
						<?php if ($show_btnfac==1) {  ?>
							<button type="submit" class="btn btn-primary btn-outlne" name="change_levelfac">เปลี่ยนสถานะ</button>
						<?php } ?>
						<?php if ($show_btnmulti==1) {  ?>
							<div class="dropdown" style="display:inline-block;">
							<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">เปลี่ยนสถานะ
							<span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="index.php?level=1">อาจารย์</a></li>
								<li><a href="index.php?level=4">คณะกรรมการ</a></li>
								<li><a href="index.php?level=6">ผู้บริหาร</a></li>
							</ul>
							</div>
						<?php } ?>
						<?php if ($show_btnfacboard==1) {  ?>
							<div class="dropdown" style="display:inline-block;">
							<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">เปลี่ยนสถานะ
							<span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="index.php?level=3">เจ้าหน้าที่</a></li>
								<li><a href="index.php?level=4">คณะกรรมการ</a></li>
								<li><a href="index.php?level=6">ผู้บริหาร</a></li>
							</ul>
							</div>
						<?php } ?>
						<?php if ($show_btndepboard==1) {  ?>
							<div class="dropdown" style="display:inline-block;">
							<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">เปลี่ยนสถานะ
							<span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="index.php?level=2">เจ้าหน้าที่ภาค</a></li>
								<li><a href="index.php?level=4">คณะกรรมการ</a></li>
								<li><a href="index.php?level=6">ผู้บริหาร</a></li>
							</ul>
							</div>
						<?php } ?>

						<?php
					}
					?>

				<!-- /.dropdown -->
				<li class="dropdown" id="icon-dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="fa fa-bell fa-fw"></i> <span class="label label-danger red" id="new_noti">0</span>
					</a>
					<ul class="dropdown-menu scrollable-menu" role="menu" id="noti">
						<li id="notification_element" style="width: 304px;">
							<a href="#" class="disabled">
										<p id="status"></p>
										<p id="type">  </p>
										<p>กระบวนวิชา : <b id="course_id"></b>
										<p>
											<span class="pull-right text-muted small" id="date"></span>
										</p>

							</a>
						</li>
						<li class="divider" id="notification_line"></li>
					</ul>
					<!-- /.dropdown-alerts -->
				</li>
				<!-- /.dropdown -->
				<li class="dropdown" id="icon-logout">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
										<i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
								</a>
					<ul class="dropdown-menu dropdown-user" id="logout">
						<li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
						</li>
					</ul>
					<!-- /.dropdown-user -->
				</li>
				<!-- /.dropdown -->
				</form>
			</ul>
			<!-- /.navbar-top-links -->

			<div class="navbar-default sidebar" role="navigation">
				<div class="sidebar-nav navbar-collapse">
					<ul class="nav" id="side-menu">
						<li>
							<?php
								if ($_SESSION['level']<=3 ) { ?>
									<a href="#" onclick="loadDoc('form/home.php')"><i class="fa fa-home fa-fw"></i> หน้าแรก</a>

							<?php } ?>
						</li>
						<?php if($_SESSION['level'] == 2  ) { ?>
							<li>
								<a href="#"><i class="fa fa-edit fa-fw"></i> กรอกข้อมูล<span class="fa arrow"></span></a>

								<ul class="nav nav-second-level">
									<li>
										<a href="#" onclick="loadDoc('form/evaform.php')"><i class="fa fa-pencil fa-fw"></i> กรอกแบบแจ้งวิธีการวัดผลและประเมินผลการศึกษา</a>
									</li>
									<li>
										<a href="#" onclick="loadDoc('form/spclteacher.php')"><i class="fa fa-pencil fa-fw"></i> กรอกแบบขออนุมัติเชิญอาจารย์พิเศษ</a>
									</li>
									<li>
										<a href="#" onclick="loadDoc('form/upload.php')"><i class="fa fa-upload  fa-fw"></i> อัปโหลดคะแนน</a>
									</li>
								</ul>
							</li>
							<li>
								<a href="#" onclick="loadDoc('form/managesubject.php')"><i class="fa fa-user-md fa-fw"></i> จัดการกระบวนวิชา</a>
							</li>
							<li>
								<a href="#" onclick="loadDoc('form/addsubject.php')"><i class="fa fa-plus-circle fa-fw"></i> เพิ่มกระบวนวิชา</a>
							</li>
						<?php }if($_SESSION['level'] == 3 ){?>
							<li>
								<a href="#" onclick="loadDoc('form/managesubject.php')"><i class="fa fa-user-md fa-fw"></i> จัดการกระบวนวิชา</a>
							</li>
							<li>
								<a href="#" onclick="loadDoc('form/addsubject.php')"><i class="fa fa-plus-circle fa-fw"></i> เพิ่มกระบวนวิชา</a>
							</li>
							<li>
								<a href="#" onclick="loadDoc('form/deadline.php')"><i class="fa fa-list-alt fa-fw"></i> กำหนดช่วงเวลา</a>
							</li>
							<li>
								<a href="#" onclick="loadDoc('form/config_term.php')"><i class="fa fa-user-md fa-fw"></i> กำหนดภาคการศึกษาปัจจุบัน</a>
							</li>
						<?php }if($_SESSION['level'] == 3 || $_SESSION['level']==2 ){ ?>
						<li>
							<a href="#" onclick="loadDoc('form/report.php')"><i class="fa fa-bar-chart-o fa-fw"></i> รายงาน</a>
						</li>
						<?php }else { ?>
						<?php if ($_SESSION['level']<=1  ): ?>
							<li>
								<a href="#"><i class="fa fa-edit fa-fw"></i> กรอกข้อมูล<span class="fa arrow"></span></a>

								<ul class="nav nav-second-level">
									<li>
										<a href="#" onclick="loadDoc('form/evaform.php')"><i class="fa fa-pencil fa-fw"></i> กรอกแบบแจ้งวิธีการวัดผลและประเมินผลการศึกษา</a>
									</li>
									<li>
										<a href="#" onclick="loadDoc('form/spclteacher.php')"><i class="fa fa-pencil fa-fw"></i> กรอกแบบขออนุมัติเชิญอาจารย์พิเศษ</a>
									</li>
									<li>
										<a href="#" onclick="loadDoc('form/upload.php')"><i class="fa fa-upload  fa-fw"></i> อัปโหลดคะแนน</a>
									</li>
								</ul>
							</li>
						<?php endif; ?>
						<?php }
						if($_SESSION['level'] >= 4 )
						{
							if(($_SESSION['level'] == 4 || $_SESSION['level'] == 5) || $check_assessor[1]==true  &&!$_SESSION['level']==1){ ?>
							<li>
								<a href="#" onclick="loadDoc('form/comment.php')"><i class="fa fa-pencil-square fa-fw"></i> การพิจารณากระบวนวิชา</a>
							</li>
						<?php
							}else if ($_SESSION['level']==6 ) { ?>
								<li>
									<a href="#" onclick="loadDoc('form/commentboard.php')"><i class="fa fa-pencil-square fa-fw"></i> อนุมัติกระบวนวิชา</a>
								</li>
							<?php }
							else { ?>

										<li>
											<a href="#" onclick="loadDoc('form/comment.php')"><i class="fa fa-pencil-square fa-fw"></i> การพิจารณากระบวนวิชา</a>
										</li>
									<?php
								} ?>
						 <li>
							<?php
								if ($_SESSION['level']==4 || $_SESSION['level']==5 ) { ?>
									<a href="#" onclick="loadDoc('form/homeboard.php')"><i class="fa fa-home fa-fw"></i> สถานะการพิจารณา</a>
								<?php
								}elseif ($_SESSION['level']==6) { ?>
									<a href="#" onclick="loadDoc('form/homeboard.php')"><i class="fa fa-home fa-fw"></i> สถานะการอนุมัติ</a>
								<?php
								}
							?>
						</li>
						<li>
							<a href="#" onclick="loadDoc('form/history.php')"><i class="fa fa-newspaper-o  fa-fw"></i> ประวัติข้อเสนอแนะ</a>
						</li>
						<?php

						}

						 ?>


						<?php
							if($_SESSION['level']==6)
							{
								if ($_SESSION['level']==6 && (!$_SESSION['admission'])) { ?>
									<li>
										<a href="#" onclick="loadDoc('form/grant.php')"><i class="fa fa-users fa-fw"></i> มอบอำนาจการอนุมัติ</a>
									</li>
								<?php
								}
								 ?>


								<?php
							}
						?>
					</ul>
				</div>
				<!-- /.sidebar-collapse -->
			</div>
			<!-- /.navbar-static-side -->
		</nav>

		<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
		<div id="page-wrapper" style="padding-left: 0px; padding-right: 0px;">
		<iframe id="frm" frameborder="0" width="100%" height="90%" scrolling="yes"></iframe>
		</div>
	</div>
</body>

</html>
