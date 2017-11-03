<?php

require_once(__DIR__."/../../application/class/database.php");
require_once(__DIR__."/../../application/class/person.php");
$DB = new Database();
$person = new Person();
$text='{"COURSE_ID":"202141","SECTION":"3","NORORSPE":"NORMAL","NAMETH":"Learning bitch Sakon","NAMEENG":"เรียนรู้อิดอกสกล","STUDENT":["10","5","20"],"CREDIT_TOTAL":"3(1-0-6)","TYPE_TEACHING":"OTH","TYPE_TEACHING_NAME":"ไม่บอก","TEACHER":["a","b","c","d","e"],"TEACHER-CO":"fghij","EXAM_MID1_HOUR_LEC":"10","EXAM_MID1_HOUR_LAB":"10","EXAM_MID1_NUMBER_LEC":"2","EXAM_MID1_NUMBER_LAB":"1","EXAM_MID1_COMMITTEE_LEC":["อาจารย์1 อาจารย์1","อาจารย์1 อาจารย์1"],"EXAM_MID1_COMMITTEE_LAB":["กหฟ"],"EXAM_MID2_HOUR_LEC":"20","EXAM_MID2_HOUR_LAB":"20","EXAM_MID2_NUMBER_LEC":"1","EXAM_MID2_NUMBER_LAB":"2","EXAM_MID2_COMMITTEE_LEC":["กหฟ"],"EXAM_MID2_COMMITTEE_LAB":["กฟห","กฟห"],"EXAM_FINAL_HOUR_LEC":"30","EXAM_FINAL_HOUR_LAB":"30","EXAM_FINAL_NUMBER_LEC":"2","EXAM_FINAL_NUMBER_LAB":"3","EXAM_FINAL_COMMITTEE_LEC":["กหฟ","ฟกห"],"EXAM_FINAL_COMMITTEE_LAB":["ฟหก","กหฟ","ฟหก"],"EXAM_SUGGESTION":"ฟหกฟไม่มี","MEASURE_MID1_LEC":"30","MEASURE_MID1_LAB":"0","MEASURE_MID2_LEC":"0","MEASURE_MID2_LAB":"0","MEASURE_FINAL_LEC":"30","MEASURE_FINAL_LAB":"0","MEASURE_WORK_LEC":"0","MEASURE_WORK_LAB":"20","MEASURE_OTHER_LEC":"20","MEASURE_OTHER_LAB":"0","MEASURE_OTHER_OTH":"ทำแล็ปสนุกสุดฟันฟิน","MEASURE_TOTAL_LEC":"80","MEASURE_TOTAL_LAB":"20","MEASURE_MSG":"ไม่มี","CALCULATE_TYPE":"CRITERIA","CALCULATE_EXPLAINATION":"","CALCULATE_A_MIN":"80.0","CALCULATE_B+_MIN":"75.0","CALCULATE_B+_MAX":"79.9","CALCULATE_B_MIN":"70.0","CALCULATE_B_MAX":"74.9","CALCULATE_C+_MIN":"65.0","CALCULATE_C+_MAX":"69.9","CALCULATE_C_MIN":"60.0","CALCULATE_C_MAX":"64.9","CALCULATE_D+_MIN":"55.0","CALCULATE_D+_MAX":"59.9","CALCULATE_D_MIN":"50.0","CALCULATE_D_MAX":"54.9","CALCULATE_F_MAX":"49.9","CALCULATE_S_MIN":"","CALCULATE_U_MAX":"","ABSENT":"F","SUBMIT_TYPE":"1","USERID":"007","DATE":"02","MONTH":"11","YEAR":"2560"}';
$DATA =json_decode($text, true);

 //criterion_grade
$sql_criterion_grade = "INSERT INTO `criterion_grade`(`type`, `explaination`, `A_min`, `A_max`, `B+_min`, `B+_max`, `B_min`, `B_max`, `C+_min`, `C+_max`, `C_min`, `C_max`, `D+_min`, `D+_max`, `D_max`, `D_min`, `F_max`, `S_min`, `U_max`) VALUES ('".$DATA["CALCULATE_TYPE"]."','".$DATA["CALCULATE_EXPLAINATION"]."','".$DATA["CALCULATE_A_MIN"]."','100','".$DATA["CALCULATE_B+_MIN"]."','".$DATA["CALCULATE_B+_MAX"]."','".$DATA["CALCULATE_B_MIN"]."','".$DATA["CALCULATE_B_MAX"]."','".$DATA["CALCULATE_C+_MIN"]."','".$DATA["CALCULATE_C+_MAX"]."','".$DATA["CALCULATE_C_MIN"]."','".$DATA["CALCULATE_C_MAX"]."','".$DATA["CALCULATE_D+_MIN"]."','".$DATA["CALCULATE_D+_MAX"]."','".$DATA["CALCULATE_D_MIN"]."','".$DATA["CALCULATE_D_MAX"]."','".$DATA["CALCULATE_F_MAX"]."','".$DATA["CALCULATE_S_MIN"]."','".$DATA["CALCULATE_U_MAX"]."')";
$lastrow_criterion_grade_id = "SELECT criterion_grade_id FROM criterion_grade ORDER BY criterion_grade_id DESC LIMIT 1;"; 

$result_criterion_grade = $DB->Insert_Update_Delete($sql_criterion_grade);
if ($result_criterion_grade) {
    $result_criterion_grade_id = $DB->Query($lastrow_criterion_grade_id);
}


//measure_evaluate
$sql_measure_evaluate = "INSERT INTO `measure_evaluate`( `mid1_LEC`, `mid1_LAB`, `mid2_LEC`, `mid2_LAB`, `final_LEC`, `final_LAB`, `work_LEC`, `work_LAB`, `other_LEC`, `other_LAB`, `other_OTH`, `total_LEC`, `total_LAB`, `msg`) 
VALUES ('".$DATA["MEASURE_MID1_LEC"]."','".$DATA["MEASURE_MID1_LAB"]."','".$DATA["MEASURE_MID2_LEC"]."','".$DATA["MEASURE_MID1_LAB"]."','".$DATA["MEASURE_FINAL_LEC"]."','".$DATA["MEASURE_FINAL_LAB"]."','".$DATA["MEASURE_WORK_LEC"]."','".$DATA["MEASURE_WORK_LAB"]."','".$DATA["MEASURE_OTHER_LEC"]."','".$DATA["MEASURE_OTHER_LAB"]."','".$DATA["MEASURE_OTHER_OTH"]."','".$DATA["MEASURE_TOTAL_LEC"]."','".$DATA["MEASURE_TOTAL_LAB"]."','".$DATA["MEASURE_MSG"]."')";
$lastrow_measure_evaluate_id = "SELECT measure_evaluate_id FROM measure_evaluate ORDER BY measure_evaluate_id DESC LIMIT 1;"; 

$result_measure_evaluate = $DB->Insert_Update_Delete($sql_measure_evaluate);
if ($result_measure_evaluate) {
    $result_measure_evaluate_id = $DB->Query($lastrow_measure_evaluate_id);
}


//exam_evaluate
$sql_exam_evaluate = "INSERT INTO `exam_evaluate`(`mid1_HOUR_LEC`, `mid1_HOUR_LAB`, `mid1_NUMBER_LEC`, `mid1_NUMBER_LAB`, `mid2_HOUR_LEC`, `mid2_HOUR_LAB`, `mid2_NUMBER_LEC`, `mid2_NUMBER_LAB`, `final_HOUR_LEC`, `final_HOUR_LAB`, `final_NUMBER_LEC`, `final_NUMBER_LAB`, `suggestion`) 
VALUES ('".$DATA["EXAM_MID1_HOUR_LEC"]."','".$DATA["EXAM_MID1_HOUR_LAB"]."','".$DATA["EXAM_MID1_NUMBER_LEC"]."','".$DATA["EXAM_MID1_NUMBER_LAB"]."','".$DATA["EXAM_MID2_HOUR_LEC"]."','".$DATA["EXAM_MID2_HOUR_LAB"]."','".$DATA["EXAM_MID2_NUMBER_LEC"]."','".$DATA["EXAM_MID2_NUMBER_LAB"]."','".$DATA["EXAM_FINAL_HOUR_LEC"]."','".$DATA["EXAM_FINAL_HOUR_LAB"]."','".$DATA["EXAM_FINAL_NUMBER_LEC"]."','".$DATA["EXAM_FINAL_NUMBER_LAB"]."','".$DATA["EXAM_SUGGESTION"]."')";
$lastrow_exam_evaluate_id = "SELECT exam_evaluate_id FROM exam_evaluate ORDER BY exam_evaluate_id DESC LIMIT 1;"; 

$result_exam_evaluate = $DB->Insert_Update_Delete($sql_exam_evaluate);
if ($result_exam_evaluate) {
    $result_exam_evaluate_id = $DB->Query($lastrow_exam_evaluate_id);
}
$teacher_id =$person->Get_Teacher_Id(["EXAM_MID1_COMMITTEE_LEC"][0]);
echo '<pre>' ;var_dump($teacher_id ,$DATA["EXAM_MID1_COMMITTEE_LEC"][0]); '</pre>';

//exam_commitee
//MID1
for ($i=0; $i < sizeof($DATA["EXAM_MID1_COMMITTEE_LEC"]); $i++) {
    $teacher_id =$person->Get_Teacher_Id(["EXAM_MID1_COMMITTEE_LEC"][$i]);
    echo '<pre>' ;var_dump($teacher_id); '</pre>';
    if ($teacher_id) {
        $sql="INSERT INTO `exam_commitee`( `exam_id`, `teacher_id`, `type`, `type_commitee`) VALUES ('".$result_exam_evaluate_id[0]["exam_evaluate_id"]."','".$teacher_id."','MID1','LEC')";        
    }
}


/* 
for ($i=0; $i < sizeof($DATA["EXAM_MID1_COMMITTEE_LAB"]); $i++) { 
    $teacher_id =$person->Get_Teacher_Id(["EXAM_MID1_COMMITTEE_LAB"][$i]);
    if ($teacher_id) {
        $sql="INSERT INTO `exam_commitee`( `exam_id`, `teacher_id`, `type`, `type_commitee`) VALUES ('".$result_exam_evaluate_id[0]["exam_evaluate_id"]."','".$teacher_id."','MID1','LAB')";
    }
    
}

//MID2
for ($i=0; $i < sizeof($DATA["EXAM_MID2_COMMITTEE_LEC"]); $i++) {
    $teacher_id =$person->Get_Teacher_Id(["EXAM_MID2_COMMITTEE_LEC"][$i]);
    if ($teacher_id) {
        $sql="INSERT INTO `exam_commitee`( `exam_id`, `teacher_id`, `type`, `type_commitee`) VALUES ('".$result_exam_evaluate_id[0]["exam_evaluate_id"]."','".$teacher_id."','MID2','LEC')";        
    }
}

for ($i=0; $i < sizeof($DATA["EXAM_MID2_COMMITTEE_LAB"]); $i++) { 
    $teacher_id = Get_Teacher_Id(["EXAM_MID2_COMMITTEE_LAB"][$i]);
    if ($teacher_id) {
        $sql="INSERT INTO `exam_commitee`( `exam_id`, `teacher_id`, `type`, `type_commitee`) VALUES ('".$result_exam_evaluate_id[0]["exam_evaluate_id"]."','".$teacher_id."','MID2','LAB')";
    }
    
}

//FINAL
for ($i=0; $i < sizeof($DATA["EXAM_FINAL_COMMITTEE_LEC"]); $i++) {
    $teacher_id = Get_Teacher_Id(["EXAM_FINAL_COMMITTEE_LEC"][$i]);
    if ($teacher_id) {
        $sql="INSERT INTO `exam_commitee`( `exam_id`, `teacher_id`, `type`, `type_commitee`) VALUES ('".$result_exam_evaluate_id[0]["exam_evaluate_id"]."','".$teacher_id."','FINAL','LEC')";        
    }
}

for ($i=0; $i < sizeof($DATA["EXAM_FINAL_COMMITTEE_LAB"]); $i++) { 
    $teacher_id = Get_Teacher_Id(["EXAM_FINAL_COMMITTEE_LAB"][$i]);
    if ($teacher_id) {
        $sql="INSERT INTO `exam_commitee`( `exam_id`, `teacher_id`, `type`, `type_commitee`) VALUES ('".$result_exam_evaluate_id[0]["exam_evaluate_id"]."','".$teacher_id."','FINAL','LAB')";
    }
    
}


//course_evaluate

$sql = "INSERT INTO `course_evaluate`(`course_id`,`section`,`noorspe`,`student`, `type`, `type_other`, `semester_id`, `criterion_grade_id`, `exam_evaluate_id`,`measure_evaluate_id`,`absent`, `user_id`)
                        VALUES ('".$DATA["COURSE_ID"]."','".$DATA["SECTION"]."','".$DATA["NORORSPE"]."','120','1','".$DATA["TYPE_TEACHING"]."','".$DATA["TYPE_TEACHING_NAME"]."','66','".$result_criterion_grade_id[0]["criterion_grade_id"]."','".$lastrow_exam_evaluate_id."','".$result_measure_evaluate_id[0]["measure_evaluate_id"]."','".$DATA["ABSENT"]."','".$DATA["USERID"]."')";

$lastrow_course_evaluate = "SELECT course_evaluate_id FROM course_evaluate ORDER BY course_evaluate_id DESC LIMIT 1;"; 
//teacher_exam_evaluate
for ($i=0; $i <sizeof($DATA["STUDENT"]);  $i++) { 
    $sql="INSERT INTO `student_evalute`(`course_evalute`, `student`) VALUES ('".$lastrow_course_evaluate."',[value-3])";
}

//teacher_exam_evaluate
for ($i=0; $i < sizeof($DATA["TEACHER"]); $i++) { 
    $teacher_id = Get_Teacher_Id($DATA["TEACHER"][$i]);
    if ($teacher_id) {
        $sql[$i] = "INSERT INTO `teacher_exam_evaluate`(`teacher_id`, `course_eveluate_id`)VALUES ('".$teacher_id."','".$lastrow_course_evaluate."')";
    }
    
} */
/* 
// the message
$to = "knownamenow@gmail.com";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: webmaster@example.com" ;
mail($to,$subject,$txt,$headers);
 */







?>