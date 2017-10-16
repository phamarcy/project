<?php
session_start();
require_once(__DIR__.'/../class/curl.php');
require_once(__DIR__."/../config/configuration_variable.php");



function add_zip($zip,$course,$type)
{
  global $path_file,$year,$semester;
  if($type == 'special')
  {
    $type = 'special_instructor';
  }
  $doc_path = $path_file."/".$course."/".$type;
  if(is_dir($doc_path))
  {
    $doc_file = scandir($doc_path);
    $count = count($doc_file);
    if($count>2)
    {
        $zip->addEmptyDir($course);
    }
    for($i=2;$i<$count;$i++)
    {
      $doc_file_name = substr($doc_file[$i],0,-4);
      $prefix = explode("_",$doc_file_name);
      $count_prefix = count($prefix);
      if($prefix[0] == $course && $prefix[$count_prefix-2] == $semester && $prefix[$count_prefix-1] == $year)
      {
         $zip->addFile($doc_path."/".$doc_file[$i],$course."/".$doc_file[$i]);
      }
    }
  }

}

if(isset($_GET['course']) && isset($_GET['semester']) && isset($_GET['year']) && isset($_GET['info']))
{
  $path_file = $FILE_PATH."/complete";
  $course = $_GET['course'];
  $semester = $_GET['semester'];
  $year = $_GET['year'];
  $type = $_GET['info'];

  $zip = new ZipArchive();
  $zip_file = $path_file."/report_".$type."_".$course."_".$semester."_".$year.".zip";
  if(file_exists($zip_file))
  {
    unlink($zip_file);
  }
  if ($zip->open($zip_file, ZipArchive::CREATE)!==TRUE)
  {
      exit("cannot open <$zip_file>\n");
  }

  //get specific course in semester
  if($course != 'all')
  {
    add_zip($zip,$course,$type);
  }
  else
  {
    //get all course in semester
    $course_folder = scandir($path_file);
    $count = count($course_folder);
    for($i=2;$i<$count;$i++)
    {
      if(is_dir($path_file."/".$course_folder[$i]))
      {
        add_zip($zip,$course_folder[$i],$type);
      }
    }
  }

  if($zip->numFiles <= 0)
  {
    echo "ไม่มีข้อมูล";
    $zip->close();
    die;
  }
  else
  {
    $zip->close();
    session_write_close();
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($zip_file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($zip_file));
    readfile($zip_file);
  }

}




 ?>
