<?php
if(isset($_POST['id']))
{
  $data[0]['semester'] = '1';
  $data[0]['year'] = '2560';
  $data[1]['semester'] = '2';
  $data[1]['year'] = '2559';
  echo json_encode($data);
}

 ?>
