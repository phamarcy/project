<?php
session_start();
if(!isset($_SESSION['level']))
{
	$DATA['error'] = 'no session';
}
else
{
	$DATA = array();
	if(isset($_GET['type']) && isset($_GET['query']))
	{
		$type = $_GET['type'];
		$query = $_GET['query'];
		if($query == 'add')
		{
			var_dump($_POST['DATA']);
			die;
		}
		else if($query == 'search')
		{
			if($type == 'course')
			{
				$data['semester'] = '2';
				$data['year'] = '2560';
				$data['opendate'] = '2016-08-16';
				$data['lastdate'] = '2016-08-30';
				$DATA['data'][0] = $data;
			}
			else if($type == 'approve')
			{
				$data['semester'] = '2';
				$data['year'] = '2560';
				$data['opendate'] = '2016-08-16';
				$data['lastdate'] = '2016-08-30';
				$DATA['data'][0] = $data;
			}
			else
			{
				$DATA['error'] = 'invalid type ';
			}
		}
	}
	else
	{
		$DATA['error'] = 'error';
	}
}
sleep(1);
echo json_encode($DATA);
 ?>
