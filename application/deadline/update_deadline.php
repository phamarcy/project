<?php 
$DATA = array();
if(isset($_GET['type']))
{
	$type = $_GET['type'];
	if($type == 'ADD')
	{
		var_dump($_POST['DATA']);
	}
	else if($type == 'SEARCH')
	{
		$data['semester'] = '2';
		$data['year'] = '2560';
		$data['opendate'] = '2016-08-16';
		$data['lastdate'] = '2016-08-30';
		$DATA['data'][0] = $data;
		
	}	
}
else
{
	$DATA['error'] = 'error';
}
sleep(1);
echo json_encode($DATA);
 ?>