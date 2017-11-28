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
  if($file_name)
  {
    $file_name = $file_name[count($file_name)-1];
    if(file_exists($doc_path) && is_file($doc_path))
    {
        $zip->addEmptyDir($course);
        $zip->addFile($doc_path,$course."/".$file_name);
    }
  }


}

if(isset($_GET['course']) && isset($_GET['semester']) && isset($_GET['year']) && isset($_GET['info']) && isset($_GET['type']))
{
  $path_file = $FILE_PATH;
  $course = $_GET['course']; //course id
  $semester = $_GET['semester'];
  $year = $_GET['year'];
  $semester_id = $deadline->Search_Semester_id($semester,$year);
  $info = $_GET['info']; //evaluate , special
  $type = $_GET['type'];
  $dept = $_GET['dept'];
  $zip = new ZipArchive();
  if($type == "report")
  {
    $zip_file = $path_file."/report_".$info."_".$course."_".$semester."_".$year.".zip";
    if(file_exists($zip_file))
    {
      unlink($zip_file);
    }
    if ($zip->open($zip_file, ZipArchive::CREATE)!==TRUE)
    {
        exit("cannot open <$zip_file>\n");
    }
    if($course != 'all')
    {
      if($info == 'evaluate')
      {
        $sql = "SELECT `pdf_file` FROM `course_evaluate` ce, `student_evaluate` se" ;
        $sql .= " WHERE  ce.`course_evaluate_id` = se.`course_evaluate_id` AND se.`section` = 1 AND ce.`status` = '1' AND `course_id` = '".$course."' AND ce.`semester_id` = ".$semester_id;
        $result = $db->Query($sql);
        if($result)
        {
          for($i=0 ;$i< count($result);$i++)
          {
            add_zip($zip,$course,$result[$i]['pdf_file']);
          }
        }
      }
    }
    else
    {
      if($info == 'special') //special instrucor
      {
        $sql = "SELECT ci.`course_id`,ci.`instructor_id`,ci.`pdf_file` FROM `course_hire_special_instructor` ci WHERE `status` = '1' AND `semester_id` = ".$semester_id;
        $sql .= " AND ci.`course_id` IN (SELECT `course_id` FROM `department_course_responsible` WHERE `department_id` = '".$dept."' AND `semester_id` = ".$semester_id.")";
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
        $sql = "SELECT `course_id`,`pdf_file` FROM `course_evaluate` ce, `student_evaluate` se" ;
        $sql .= " WHERE  ce.`course_evaluate_id` = se.`course_evaluate_id` AND ce.`status` = '1'AND se.`section` = 1 AND ce.`semester_id` = ".$semester_id;
        $sql .= " AND ce.`course_id` IN (SELECT `course_id` FROM `department_course_responsible` WHERE `department_id` = '".$dept."' AND `semester_id` = ".$semester_id.")";
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
  }
  else if($type == 'draft')
  {
    if($info == 'all')
    {
      $zip_file = $path_file."/document_".$course."_".$semester."_".$year.".zip";
      if(file_exists($zip_file))
      {
        unlink($zip_file);
      }
      if ($zip->open($zip_file, ZipArchive::CREATE)!==TRUE)
      {
          exit("cannot open <$zip_file>\n");
      }
    }
    else if($info == 'instructor')
    {
      $zip_file = $path_file."/instructor_".$course."_".$semester."_".$year.".zip";
      if(file_exists($zip_file))
      {
        unlink($zip_file);
      }
      if ($zip->open($zip_file, ZipArchive::CREATE)!==TRUE)
      {
          exit("cannot open <$zip_file>\n");
      }
    }
    if($info == 'instructor' || $info == 'all')
    {
      // get all special instructor pdf file
      $sql = "SELECT ci.`course_id`,ci.`instructor_id`,ci.`pdf_file`,si.`cv` FROM `course_hire_special_instructor` ci, `special_instructor` si ";
      $sql .= "WHERE ci.`course_id` = '".$course."' AND ci.`semester_id` = ".$semester_id." AND ci.`instructor_id` = si.`instructor_id`";
      $result = $db->Query($sql);
      if($result)
      {
        for($i=0 ;$i< count($result);$i++)
        {
          add_zip($zip,$result[$i]['course_id'],$result[$i]['pdf_file']);
          // get cv of special instructor
          add_zip($zip,$result[$i]['course_id'],'/cv/'.$result[$i]['cv']);
        }
      }
    }
    if($info == 'all')
    {
      // get course evaluate pdf file
      $sql = "SELECT `pdf_file` FROM `course_evaluate` ce, `student_evaluate` se" ;
      $sql .= " WHERE  ce.`course_evaluate_id` = se.`course_evaluate_id` AND ce.`course_id` = '".$course."' AND se.`section` = 1 AND ce.`semester_id` = ".$semester_id;
      $result = $db->Query($sql);
      if($result)
      {
        for($i=0 ;$i< count($result);$i++)
        {
          add_zip($zip,$course,$result[$i]['pdf_file']);
        }
      }
    }

  }


  //get specific course in semester

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
