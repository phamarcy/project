<?php
if(isset($_GET['type']) && isset($_GET['info']))
{
    $FILE_TYPE = $_GET['type']; //draft, complete
    $INFORMATION_TYPE = $_GET['info']; //evaluate,syllabus,special
    $PATH_FILE = "../../files/";
   if($INFORMATION_TYPE == 'special')
   {
     if(isset($_GET['id']))
     {
       $SPECIAL_ID = $_GET['id']; //instructor id
       $FILE_NAME = $PATH_FILE.$FILE_TYPE."/special_instructor/".$SPECIAL_ID.".pdf";
     }
     else
     {
       error();
     }

   }
   else if($INFORMATION_TYPE == 'evaluate')
   {
     if(isset($_GET['course']))
     {
       $FILE_COURSE = $_GET['course'];
       $FILE_NAME = $PATH_FILE.$FILE_TYPE."/".$INFORMATION_TYPE.'/'.$FILE_COURSE."_".$INFORMATION_TYPE.".pdf";
     }
     else
     {
       error();
     }
   }
   else if($INFORMATION_TYPE == 'syllabus')
   {
     if(isset($_GET['course']))
     {
       $FILE_COURSE = $_GET['course'];
       $FILE_NAME = $PATH_FILE."/".$INFORMATION_TYPE.'/'.$FILE_COURSE.".pdf";
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
   header("Content-type: application/pdf");
   header("Content-Disposition: inline;");
   readfile($FILE_NAME);
}
else {
  error();
}
function error()
{
  die("<center><h1>Error : Invalid data </h1></center>");
}
 ?>
