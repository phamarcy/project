<?php
require_once('application/config/configuration_variable.php');

echo "Checking document folder......";
  if(!is_dir($FILE_PATH))
  {
    echo "<br> incomplete, create folder....";
    mkdir($FILE_PATH);
  }
  if(!is_dir($FILE_PATH."/complete"))
  {
    mkdir($FILE_PATH."/complete");
  }
  if(!is_dir($FILE_PATH."/draft"))
  {
    mkdir($FILE_PATH."/draft");
  }
  if(!is_dir($FILE_PATH."/syllabus"))
  {
    mkdir($FILE_PATH."/syllabus");
  }
  if(!is_dir($FILE_PATH."/grade"))
  {
    mkdir($FILE_PATH."/grade");
  }
  if(!is_dir($FILE_PATH."/cv"))
  {
    mkdir($FILE_PATH."/cv");
  }
  if(!is_dir($FILE_PATH."/summary"))
  {
    mkdir($FILE_PATH."/summary");
  }
echo "ok <br>";


echo "Checking log folder......";
if(!is_dir($LOG_PATH))
{
  echo "<br> not exist, create folder....";
  mkdir($LOG_PATH);
}
echo "ok<br>";

echo "Complete!";
 ?>
