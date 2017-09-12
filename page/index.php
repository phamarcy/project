<?php
	session_start();
	if(!isset($_SESSION['level']) || !isset($_SESSION['fname']) || !isset($_SESSION['lname']) || !isset($_SESSION['id']))
	{
	    header('Location: login.php');
	}else if($_SESSION['level'] == 7)
	{
		header('Location: admin.php');
	}
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

	<script type="text/javascript" src="dist/js/bootstrap-filestyle.min.js"></script>

	  <link rel="stylesheet" href="dist/css/scrollbar.css">

	<script>
	window.onload =  function(){
      update_noti();
    };
	setInterval(update_noti, 30000);
	function update_noti(){
		$.ajax({
				url: "../application/notification/get_data.php" ,
				type: "POST",
				data: ''
		}).done(function(result) {
			if(result != '')
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
			else {
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
			var element = $(object).clone();
			var data = jQuery.parseJSON(obj[i]);
			var status = '';
			var type = '';
			if(data != '')
			{
				switch(data.STATUS) {
					case '0':
					status='<b id="statc">รอการกรอกข้อมูล <i class="fa fa-pencil-square-o  fa-fw"></i></b>';
					break;
				 case '1':
				 	status='<b id="statwt">รอการพิจารณา <i class="fa  fa-clock-o fa-fw"></i></b>';
					 break;
				 case '2':
				 	status='<b id="statn">ไม่เห็นชอบ <i class="fa fa-pencil-square-o  fa-fw"></i></b>';
					 break;
				 case '3':
				 	status='<b id="statal">มีการแก้ไขจากภาควิชา<i class="fa fa-pencil-square fa-fw"></i></b>';
					 break;
				 case '4':
				 	status='<b id="statcf">ผ่านการประเมินจากคณะกรรมการภาค<i class="fa fa-user fa-fw"></i></b>';
					 break;
				 case '5':
				 	status='<b id="statwt">รอคณะอนุมัติ<i class="fa fa-user-plus fa-fw"></i></b>';
					 break;
				 case '6':
				 	status='<b id="statal">มีการแก้ไขจากคณะ<i class="fa fa-check fa-fw"></i></b>';
					 break;
				 case '7':
				 	status='<b id="statcf">ผ่าน<i class="fa fa-check fa-fw"></i></b>';
					 break;
	    	 default:
	        status = '';
					break;
				}

				$(element).find("#course_id").text(data.COURSE_ID);
				$(element).find("#date").text("เมื่อวันที่ "+data.DATE_USER+" เวลา "+data.TIME_USER);
				console.log(data.TYPE);
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
	</script>



	<title>ยินดีต้อนรับ</title>
	<style>
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
			font-size: 20px:
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

<body onload="loadDoc('form/home.php')">
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
				<b>ยินดีต้อนรับ | <font color="#51cc62"> คุณ <?php echo $_SESSION['fname'].' ',$_SESSION['lname']; ?></font></b>
				<!-- /.dropdown -->
				<li class="dropdown" id="icon-dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
										<i class="fa fa-bell fa-fw"></i> <span class="label label-danger red" id="new_noti">0</span>
						</a>
					<ul class="dropdown-menu scrollable-menu" role="menu" id="noti">
						<li id="notification_element" style="width: 304px;">
							<a href="#" class="disabled">
										<p id="status">

										</p>
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
			</ul>
			<!-- /.navbar-top-links -->

			<div class="navbar-default sidebar" role="navigation">
				<div class="sidebar-nav navbar-collapse">
					<ul class="nav" id="side-menu">
						<li>
							<a href="#" onclick="loadDoc('form/home.php')"><i class="fa fa-home fa-fw"></i> หน้าแรก</a>
						</li>
						<?php if($_SESSION['level'] == 2) { ?>

							<li>
								<a href="#" onclick="loadDoc('form/managesubject.php')"><i class="fa fa-user-md fa-fw"></i> จัดการกระบวนวิชา</a>
							</li>
							<li>
								<a href="#" onclick="loadDoc('form/addsubject.php')"><i class="fa fa-plus-circle fa-fw"></i> เพิ่มกระบวนวิชา</a>
							</li>
						<?php }if($_SESSION['level'] == 3){?>
							<li>
								<a href="#" onclick="loadDoc('form/deadline.php')"><i class="fa fa-list-alt fa-fw"></i> กำหนดช่วงเวลา</a>
							</li>
						<?php }if($_SESSION['level'] == 3 || $_SESSION['level'] == 2){ ?>
						<li>
							<a href="#" onclick="loadDoc('form/report.php')"><i class="fa fa-bar-chart-o fa-fw"></i> รายงาน</a>
						</li>
						<?php }else { ?>
						<?php if ($_SESSION['level']<=1): ?>
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
						if($_SESSION['level'] >= 4)
						{
							if ($_SESSION['level']==6) { ?>
								<li>
									<a href="#" onclick="loadDoc('form/comment.php')"><i class="fa fa-pencil-square fa-fw"></i> อนุมัติกระบวนวิชา</a>
								</li>
						<?php
					} else { ?>
								<li>
									<a href="#" onclick="loadDoc('form/comment.php')"><i class="fa fa-pencil-square fa-fw"></i> ประเมินกระบวนวิชา</a>
								</li>
							<?php
						} ?>
						<li>
							<a href="#" onclick="loadDoc('form/history.php')"><i class="fa fa-newspaper-o  fa-fw"></i> ประวัติข้อเสนอแนะ</a>
						</li>
						<?php

						}
						 ?>

						<?php
							if($_SESSION['level']==6)
							{ ?>
								<li>
									<a href="#" onclick="loadDoc('form/grant.php')"><i class="fa fa-users fa-fw"></i> มอบอำนาจการอนุมัติ</a>
								</li>
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
