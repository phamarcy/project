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
				if($type == 'course')
				{
					$type = '1';
					$result = $deadline->Update($_POST['DATA'],$type);
					$DATA = $result;
				}
				else if($type == 'syllabus')
				{
					$type = '2';
					$result = $deadline->Update($_POST['DATA'],$type);
					$DATA = $result;
				}
				else if($type == 'special')
				{
					$type = '3';
					$result = $deadline->Update($_POST['DATA'],$type);
					$DATA = $result;
				}
				else if($type == 'evaluate')
				{
					$type = '4';
					$result = $deadline->Update($_POST['DATA'],$type);
					$DATA = $result;
				}
				else if($type == 'approve')
				{
					$type = '5';
					$result = $deadline->Update($_POST['DATA'],$type);
					$DATA = $result;
				}
				else if($type == 'grade')
				{
					$type = '6';
					$result = $deadline->Update($_POST['DATA'],$type);
					$DATA = $result;
				}
				else
				{
					$DATA['error'] = 'Invalid format';
				}

			}

		}
		else if($query == 'search')
		{
			if($type == 'course')
			{
				$result = $deadline->Search_all('1');
				$DATA['data'] = $result;
			}
			else if($type == 'syllabus')
			{
				$result = $deadline->Search_all('2');
				$DATA['data'] = $result;
			}
			else if($type == 'special')
			{
				$result = $deadline->Search_all('3');
				$DATA['data'] = $result;
			}
			else if($type == 'evaluate')
			{
				$result = $deadline->Search_all('4');
				$DATA['data'] = $result;
			}
			else if($type == 'approve')
			{
				$result = $deadline->Search_all('5');
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
	$deadline->Close_connection();
}
echo json_encode($DATA);

 ?>
