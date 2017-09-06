<?php
	session_start();
  if(!isset($_SESSION['level']) || !isset($_SESSION['fname']) || !isset($_SESSION['lname']) || !isset($_SESSION['id']))
	{
	    header('Location: login.php');
	}
  else
  {
    if($_SESSION['level']!=7)
    {

      die("คุณไม่สามารถใช้งานส่วนนี้ได้");
    }
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
		function loadDoc(url) {
			var ifrm = document.createElement("iframe");
	        ifrm.setAttribute("src", url);
	        ifrm.style.width = "100%";
	        ifrm.style.height = "100%";
	        ifrm.frameBorder = 0;
         	document.getElementById("frm").src = url;
		}
    $(document).ready(function(){
   			$('a[href="#"]').click(function(e){
   			   e.preventDefault();
   			});
   		});
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

<body onload="loadDoc('form/managesubject.php')">
	<div id="wrapper">

		<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" >
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
						</button>
				<a class="navbar-brand" >ระบบงานข้อมูลของงานบริการการศึกษา คณะเภสัชศาสตร์ มหาวิทยาลัยเชียงใหม่</a>
			</div>
			<!-- /.navbar-header -->

			<ul class="nav navbar-top-links navbar-right">
				<b>ยินดีต้อนรับ | <font color="#51cc62"> คุณ <?php echo $_SESSION['fname'].' ',$_SESSION['lname']; ?></font></b>
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
								<a href="#" onclick="loadDoc('form/managesubject.php')"><i class="fa fa-user-md fa-fw"></i> จัดการกระบวนวิชา</a>
							</li>
              <li>
								<a href="#" onclick="loadDoc('form/config_term.php')"><i class="fa fa-user-md fa-fw"></i> กำหนดภาคการศึกษาปัจจุบัน</a>
							</li>
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
