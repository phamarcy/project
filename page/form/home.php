<?php
session_start();
$result = curl($_SESSION['level']);
$result = json_decode($result,true);
$deadline = $result['deadline'];
$data = $result['data'];
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
						<?php for($i=0;$i<count($data);$i++)
						{

								echo '<div class="panel panel-default">
										<div class="panel-heading">
												<div class="panel-title" style="font-size: 14px;">
														<a data-toggle="collapse" data-parent="#accordion" href="#'.$i.'">ภาควิชา '.$data[$i]['department'].
														'</a>
												</div>
										</div>';
								echo '<div id="'.$i.'" class="panel-collapse collapse">
										<div class="panel-body" >';
								for($j=0;$j<count($data[$i]['course']);$j++)
								{
									echo '<div class="fa fa-circle"> '.$data[$i]['course'][$j]['id'].'	'.$data[$i]['course'][$j]['name'].' </div><br><br>';
								}
								echo '	</div>
											</div>
									</div>';
						}
						?>
						<div class="glyphicon glyphicon-alert" style="color: red;"><b> วันสุดท้ายสำหรับกรอกข้อมูลกระบวนวิชา <?php echo $deadline['edit']['day'].' '.$deadline['edit']['month'].' '.$deadline['edit']['year']; ?> </b></div>
						<br>
		<?php	}
					if($_SESSION['level'] == 4 || $_SESSION['level'] == 5) {  ?>
						<div class="glyphicon glyphicon-alert" style="color: red;"><b> วันสุดท้ายสำหรับประเมิณกระบวนวิชา <?php echo $deadline['con']['day'].' '.$deadline['con']['month'].' '.$deadline['con']['year']; ?> </b></div>
						<?php }
						else if($_SESSION['level'] == 6)
						{ ?>
							<div class="glyphicon glyphicon-alert" style="color: red;"><b> วันสุดท้ายสำหรับอนุมัติกระบวนวิชา <?php echo $deadline['approve']['day'].' '.$deadline['approve']['month'].' '.$deadline['approve']['year']; ?> </b></div>
					<?php	} ?>
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
