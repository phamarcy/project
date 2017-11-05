<?php
session_start();
require_once(__DIR__.'/../class/curl.php');
require_once(__DIR__."/../config/configuration_variable.php");
require_once(__DIR__."/../class/manage_deadline.php");
require_once(__DIR__."/../class/database.php");
$deadline = new Deadline();
$db = new Database();
function add_zip($zip,$course,$path_name)
{
  global $path_file,$year,$semester;
  $doc_path = $path_file.$path_name;
  $file_name = explode("/",$path_name);
  $file_name = $file_name[count($file_name)-1];
  if(file_exists($doc_path))
  {
      $zip->addEmptyDir($course);
      $zip->addFile($doc_path,$course."/".$file_name);
  }

}

if(isset($_GET['course']) && isset($_GET['semester']) && isset($_GET['year']) && isset($_GET['info']))
{
  $path_file = $FILE_PATH;
  $course = $_GET['course']; //course id
  $semester = $_GET['semester'];
  $year = $_GET['year'];
  $semester_id = $deadline->Search_Semester_id($semester,$year);
  $type = $_GET['info']; //evaluate , special

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
    if($type == 'evaluate')
    {
      $sql = "SELECT `course_id`,`pdf_file` FROM `course_evaluate` ce, `student_evaluate` se" ;
      $sql .= " WHERE  ce.`course_evaluate_id` = se.`course_evaluate_id` AND ce.`status` = '1' AND ce.`semester_id` = ".$semester_id;
      $result = $db->Query($sql);
      if($result)
      {
        for($i=0 ;$i< count($result);$i++)
        {
          add_zip($zip,$result[$i]['course_id'],$result[$i]['pdf_file']);
        }
      }
    }
  }
  else
  {
    if($type == 'special') //special instrucor
    {
      $sql = "SELECT `course_id`,`instructor_id`,`pdf_file` FROM `course_hire_special_instructor` WHERE `status` = '1' AND `semester_id` = ".$semester_id;
      $result = $db->Query($sql);
      if($result)
      {
        for($i=0 ;$i< count($result);$i++)
        {
          add_zip($zip,$result[$i]['course_id'],$result[$i]['pdf_file']);
        }
      }
    }
    else //course evaluate
    {

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
