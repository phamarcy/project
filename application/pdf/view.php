<?php
require_once(__DIR__."/../class/curl.php");

if(isset($_GET['info']) && isset($_GET['semester']) && isset($_GET['year']) && isset($_GET['course']))
{
     $FILE_COURSE = $_GET['course'];
     $SEMESTER = $_GET['semester'];
     $YEAR = $_GET['year'];
     $INFORMATION_TYPE = $_GET['info']; //evaluate,syllabus,special
     $PATH_FILE = "../../files/";
     if($INFORMATION_TYPE == 'special')
     {
       if(isset($_GET['type']))
       {
         $FILE_TYPE = $_GET['type']; //draft, complete
         if(isset($_GET['id']))
         {
           $SPECIAL_ID = $_GET['id']; //instructor id
           $FILE_NAME = $PATH_FILE.$FILE_TYPE."/".$FILE_COURSE."/special_instructor/".$FILE_COURSE."_".$SPECIAL_ID."_".$SEMESTER."_".$YEAR.".pdf";
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
     else if($INFORMATION_TYPE == 'evaluate')
     {
       if(isset($_GET['type']))
       {
         $FILE_TYPE = $_GET['type']; //draft, complete
         if(isset($_GET['course']))
         {
           $FILE_NAME = $PATH_FILE.$FILE_TYPE."/".$FILE_COURSE."/evaluate/".$FILE_COURSE."_".$INFORMATION_TYPE."_".$SEMESTER."_".$YEAR.".pdf";
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
     else if($INFORMATION_TYPE == 'syllabus')
     {
       $curl = new CURL();
       $server_url = $curl->GET_SERVER_URL();
       if(isset($_GET['course']))
       {
         $FILE_COURSE = $_GET['course'];
         $FILE_NAME = $PATH_FILE."/".$INFORMATION_TYPE.'/'.$FILE_COURSE.".docx";
         if(!file_exists($FILE_NAME))
         {
           $FILE_NAME = $PATH_FILE."/".$INFORMATION_TYPE.'/'.$FILE_COURSE.".doc";
           $doc_url = $server_url."/files/syllabus/".$FILE_COURSE.".doc";
         }
         else
         {
           $doc_url = $server_url."/files/syllabus/".$FILE_COURSE.".docx";
         }
         $url = 'http://docs.google.com/gview?url='.$doc_url;
         header( "Location: $url" );
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
