<?php
require_once(__DIR__.'/../../application/class/database.php');
require_once(__DIR__.'/../../application/config/configuration_variable.php');
$db = new Database();
$db->Change_DB($PERSON_DATABASE['NAME']);
$search = $_POST['name'];
$sql = "SELECT concat(fname,' ',lname) as name FROM `staff` WHERE concat(fname,' ',lname) LIKE '%".$search."%'";
$result = $db->Query($sql);
if($result)
{
  $data = array();
  for($i=0;$i<count($result);$i++)
  {
    $name = $result[$i]['name'];
    array_push($data,$name);
  }
  echo json_encode($data);
}
else
{
  $data[0] = "No data";
  echo json_encode($data);
}
?>
