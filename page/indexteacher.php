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

	<script src="js/functionjs.js" id="contentScript"></script>

	<script>

	$(document).ready(function(){
 			$('a[href="#"]').click(function(e){
 			   e.preventDefault();
 			});
 		});

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
					var content = document.createElement("div");
			        content.innerHTML = xhttp.responseText

			        var contentScript = content.querySelector("#contentScript");
			        var script = document.createElement("script");
			        script.textContent = contentScript.textContent;
			        document.getElementById("page-wrapper").innerHTML = this.responseText;
			        document.body.appendChild(script);

					// var script = document.createElement("script");

					// document.body.appendChild(script);
				}
			};
			xhttp.open("POST", url, true);
			xhttp.send();
		}
	</script>



	<title>ยินดีต้อนรับ</title>
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
				<a class="navbar-brand" href="indexteacher.php">Pharmacy 1.0</a>
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
						<li><a href="login.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
							<a href="#" onclick="loadDoc('test.php')"><i class="fa fa-home fa-fw"></i> หน้าแรก</a>
						</li>
						<li>
							<a href="#"><i class="fa fa-edit fa-fw"></i> กรอกข้อมูล<span class="fa arrow"></span></a>

							<ul class="nav nav-second-level">
								<li>
									<a href="#" onclick="loadDoc('evaform.php')"><i class="fa fa-pencil fa-fw"></i> กรอกแบบแจ้งวิธีการวัดผลและประเมินผลการศึกษา</a>
								</li>
								<li>
									<a href="#"><i class="fa fa-pencil fa-fw"></i> กรอกแบบขออนุมัติเชิญอาจารย์พิเศษ</a>
								</li>
							</ul>
							<!-- /.nav-second-level -->
						</li>
						<li>
							<a href="#"><i class="fa fa-upload fa-fw"></i> อัพโหลดคะแนน (ส่งเกรด)</a>
						</li>
						<li>
							<a href="#"><i class="fa fa-check fa-fw"></i> ตรวจสอบสถานะการอนุมัติ</a>
						</li>
					</ul>
				</div>
				<!-- /.sidebar-collapse -->
			</div>
			<!-- /.navbar-static-side -->
		</nav>

		<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
		<div id="page-wrapper">

			</div>



			</div>

</body>

</html>
