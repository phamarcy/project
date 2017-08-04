<?php
session_start();
//for test deadline class
require_once(__DIR__.'/../class/manage_deadline.php');
if(!isset($_SESSION['level']))
{
	$DATA['error'] = 'no session';
}
else
{
	$DATA = array();
	$deadline = new Deadline();
	if(isset($_GET['type']) && isset($_GET['query']))
	{
		$type = $_GET['type'];
		$query = $_GET['query'];
		if($query == 'add')
		{
			if(isset($_POST['DATA']))
			{
				$result = $deadline->Update($_POST['DATA'],$type);
				$DATA = $result;
			}

		}
		else if($query == 'search')
		{
			if($type == 'course')
			{
				$result = $deadline->Search_all('1');
				$DATA['data'] = $result;
			}
			else if($type == 'approve')
			{
				$result = $deadline->Search_all('2');
				$DATA['data'] = $result;
			}
			else
			{
				$DATA['error'] = 'invalid type ';
			}
		}
	}
	else
	{
		$DATA['error'] = 'Invalid format';
	}
}
sleep(1);
echo json_encode($DATA);

 ?>
