<?php
require_once(__DIR__."/../class/curl.php");
require_once(__DIR__."/../class/manage_deadline.php");
require_once(__DIR__."/../class/database.php");
require_once(__DIR__."/../config/configuration_variable.php");
$db = new Database();
$deadline = new Deadline();
if(isset($_GET['info']) && isset($_GET['semester']) && isset($_GET['year']) && isset($_GET['course']))
{
     $COURSE_ID = $_GET['course'];
     $SEMESTER = $_GET['semester'];
     $YEAR = $_GET['year'];
     $SEMESTER_ID = $deadline->Search_Semester_id($SEMESTER,$YEAR);

     $INFORMATION_TYPE = $_GET['info']; //evaluate,syllabus,special
     if($INFORMATION_TYPE == 'special')
     {
         $SPECIAL_ID = $_GET['id']; //instructor id
         $sql = "SELECT `pdf_file` FROM `course_hire_special_instructor` WHERE `course_id` ='".$COURSE_ID."' AND `instructor_id` = ".$SPECIAL_ID." AND `semester_id` = ".$SEMESTER_ID;
         $result = $db->Query($sql);
         if($result)
         {
           $pdf_file = $result[0]['pdf_file'];
         }
         $FILE_NAME = $FILE_PATH.$pdf_file;
         header("Content-type: application/pdf");
         //  header("Content-Disposition: inline;");
         readfile($FILE_NAME);
     }
     else if($INFORMATION_TYPE == 'evaluate')
     {
       if(isset($_GET['type']))
       {
         $FILE_TYPE = $_GET['type']; //draft, complete
         if(isset($_GET['course']))
         {
           $sql = "SELECT se.`pdf_file` FROM `course_evaluate` ce,`student_evaluate` se WHERE ce.`course_evaluate_id` = se.`course_evaluate_id` AND se.`section` = '1' AND `course_id` = '".$COURSE_ID."' AND `semester_id` = ".$SEMESTER_ID;
           $result = $db->Query($sql);
           if($result)
           {
             $pdf_file = $result[0]['pdf_file'];
           }
           $FILE_NAME = $FILE_PATH.$pdf_file;
           header("Content-type: application/pdf");
          //  header("Content-Disposition: inline;");
           readfile($FILE_NAME);
         }
         else
         {
           error();
         }
       }
       else
       {
          error();
       }
     }
     else
     {
       error();
     }

  }
  else {
    error();
  }
function error()
{
  die("<center><h1>Error : Invalid data </h1></center>");
}
 ?>
