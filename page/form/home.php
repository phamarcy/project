<!DOCTYPE html>
<?php
session_start();
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
		.center {
    margin: auto;
    width: 80%;
		margin-top: 5%;
    padding: 5px;
		}
		</style>
	</head>
	<body>
		<div class="center">
			<?php
				if($_SESSION['level'] != 2 && $_SESSION['level'] !=3 )
			{
				?>
					<div class="well">
						<center><h4><b> ภาคเรียนที่ 1 ปีการศึกษา 2560 </b></h4></center>
						<h4> รายวิชาที่รับผิดชอบ </h4><br>
							<div class="panel panel-default">
									<div class="panel-heading">
											<div class="panel-title" style="font-size: 14px;">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">ภาควิชา วิทยาศาสตร์เภสัชกรรม</a>
											</div>
									</div>
									<div id="collapseOne" class="panel-collapse collapse">
											<div class="panel-body" >
												<div class="fa fa-circle"> 463503	Principles in Phytochemistry </div><br><br>
												<div class="fa fa-circle"> 463512 Pharmaceutical Biotechnology 2 </div><br><br>
												<div class="fa fa-circle"> 463543	Pharmaceutical Quality Assurance 3 </div><br><br>
												<div class="fa fa-circle"> 463544	Pharmaceutical Quality Assurance 4 </div><br><br>
											</div>
									</div>
							</div>
							<div class="panel panel-default">
									<div class="panel-heading">
											<div class="panel-title" style="font-size: 14px;">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">ภาควิชา บริบาลเภสัชกรรม</a>
											</div>
									</div>
									<div id="collapseTwo" class="panel-collapse collapse">
											<div class="panel-body">
												<div class="fa fa-circle"> 463504	Natural Pharmaceutical Products </div><br><br>
												<div class="fa fa-circle"> 463558	Pharmaceutical Compounding in Hospitals </div><br><br>
												<div class="fa fa-circle"> 464541	Pharmacoepidemiology 2 </div><br><br>
												<div class="fa fa-circle"> 464504 	Medication Risk Management and Drug Use Evaluation </div><br><br>
											</div>
									</div>
							</div>
						<div class="glyphicon glyphicon-alert" style="color: red;"><b> วันสุดท้ายสำหรับกรอกข้อมูลกระบวนวิชา 20 สิงหาคม 2560 </b></div>
						<br>
		<?php	}
					if($_SESSION['level'] >= 4) {  ?>
						<div class="glyphicon glyphicon-alert" style="color: red;"><b> วันสุดท้ายสำหรับอนุมัติกระบวนวิชา 25 สิงหาคม 2560 </b></div>
						<?php } ?>
			</div>
		</div>
	</body>
</html>
<?php
function curl($type)
{
  $data['type'] = $type;
  $url = '../../application/information/';
  $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, $url);

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        //set post data
        curl_setopt($handle, CURLOPT_POSTFIELDS, $data);

        // $output contains the output string
        $output = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch);

        return $output;
}
 ?>
