<?php
session_start();
if(!isset($_SESSION['level']) || !isset($_SESSION['fname']) || !isset($_SESSION['lname']) || !isset($_SESSION['id']))
{
    die('กรุณา Login ใหม่');
}
require_once(__DIR__."/../../application/class/database.php");
require_once(__DIR__.'/../../application/class/course.php');

$DB = new Database();
$COURSE_OBJ = new Course();
?>
<!DOCTYPE html>
<html>
<head>
	 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src="../vendor/jquery/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
    <script type="text/javascript" src="../dist/js/bootstrap-filestyle.min.js"></script>
    <script type="text/javascript" src="../js/function.js"></script>
    <script type="text/javascript" src="../vendor/validator/validator.min.js"></script>
    <link rel="stylesheet" href="../dist/css/scrollbar.css">
    <style >
    i:hover {
      font-size: 30px;
      font-weight: bold;
      color: red;
    }
    tr {
    	vertical-align: middle;
    }

    </style>
</head>
<body>
		<form id="search-panel" method="post" action="#" data-toggle="validator" role="form">
            <h3 class="page-header"><center>สรุปข้อมูล</center></h3>
            <div class="form-inline">
                <center>
                    <h style="font-size : 14px">ปีการศึกษา
                        <div class="form-group">
                          <input type="text" class="form-control numonly" placeholder="e.g. 2560" style="width: 100px;" pattern=".{4,4}" name="year" required > &nbsp;
                        </div>
                        <button type="submit" class="btn btn-outline btn-primary">ค้นหา</button>
                    </h>
                </center>
            </div>
     	</form>
        <?php if(!isset($_POST['year'])) {
            
        }
        else
        {
            $year = $_POST['year'];
            for ($i=1; $i < 4; $i++) { 
                $sql = "SELECT `semester_id` FROM `semester` WHERE `semester_num` = ".$i." 
                AND `year` = '".$year."'";
                $result_semester = $DB->Query($sql);
                if($result_semester)
                {
                    #all course
                    $semester_id[$i] = $result_semester[0]['semester_id'];
                    $sql = "SELECT count(*) as all_course FROM `course_evaluate` WHERE `status` = '1' AND `semester_id` = ".$semester_id[$i];
                    $result_all_course = $DB->Query($sql);
                    if($result_all_course)
                    {
                        $all_course[$i] = $result_all_course[0]['all_course'];
                    }
                    #care's course
                    $sql = "SELECT COUNT(*) as care_course FROM `course_evaluate` ce,`course` c WHERE ce.`course_id` = c.`course_id` AND c.`department_id` = '1202' AND ce.`status` = '1' AND ce.`semester_id` = ".$semester_id[$i];
                    $result = $DB->Query($sql);
                    if($result)
                    {
                        $care_course[$i] = $result[0]['care_course'];
                    }
                    else
                    {
                        $care_course = '0';
                    }
                    #science's course
                    $sql = "SELECT COUNT(*) as science_course FROM `course_evaluate` ce,`course` c WHERE ce.`course_id` = c.`course_id` AND c.`department_id` = '1203' AND ce.`status` = '1' AND ce.`semester_id` = ".$semester_id[$i];
                    $result = $DB->Query($sql);
                    if($result)
                    {
                        $science_course[$i] = $result[0]['science_course'];
                    }
                    else
                    {
                        $science_course = '0';
                    }
                    #based course
                                        #science's course
                    $sql = "SELECT COUNT(*) as base_course FROM `course_evaluate` ce,`course` c WHERE ce.`course_id` = c.`course_id` AND c.`department_id` = '' AND ce.`status` = '1' AND ce.`semester_id` = ".$semester_id[$i];
                    $result = $DB->Query($sql);
                    if($result)
                    {
                        $base_course[$i] = $result[0]['base_course'];
                    }
                    else
                    {
                        $base_course = '0';
                    }
                }
                else
                {
                    $all_course[$i] = '0';
                    $science_course[$i] = '0';
                    $base_course[$i] = '0';
                    $care_course[$i] = '0';
                }

            }
        ?>
     	<div>
     		<div>
     		<ul class="nav nav-tabs">
                    <li class="active"><a href="#1" data-toggle="tab" aria-expanded="true">1/<?=$year ?></a>
                    </li>
                    <li class=""><a href="#2" data-toggle="tab" aria-expanded="false">2/<?=$year ?></a>
                    </li>
                    <li class=""><a href="#3" data-toggle="tab" aria-expanded="false">3/<?=$year ?></a>
                    </li>
             </ul>
             <br>
             <br>
             <div class="tab-content">
                <?php for ($sem = 1; $sem < 4; $sem++) { ?>
                <div class="tab-pane fade <?php echo ($sem==1)? "in active" : ""; ?>" id="<?php echo $sem; ?>" >
                    <center>
                    <table id="top" style="font-size: 15px">
                    <tr>
                        <th style="padding: 0 15px 0 15px" width="50%"> จำนวนกระบวนวิชาที่เปิดสอนทั้งหมด
                        </th>
                        <th width="10%"><?php echo $all_course[$sem];  ?></th>
                        <th width="30%">วิชา </th>      
                    </tr>
                    <tr>
                        <th style="padding: 0 15px 0 15px">ภาควิชาวิทยาศาสตร์เภสัชกรรม</th>
                        <th><?php echo $science_course[$sem]; ?></th>
                        <th>วิชา</th>      
                    </tr>
                    <tr>
                        <th style="padding: 0 15px 0 15px">ภาควิชาบริบาลเภสัชกรรม</th >
                        <th><?php echo $care_course[$sem]; ?></th>
                        <th>วิชา</th>      
                    </tr>
                    <tr>
                        <th style="padding: 0 15px 0 15px">วิชาพื้นฐาน</th>
                        <th><?php echo $base_course[$sem]; ?></th>
                        <th >วิชา </th>      
                    </tr>
                    </table>
                    </center>
                <br>
                <?php if($all_course[$sem] != 0) { ?>
                <ul>
                    <?php if($science_course[$sem] != 0) { ?>
                    <li><b>ภาควิชาวิทยาศาสตร์เภสัชกรรม <br><br></b>
                <?php
                $data = null;
                 $sql = "SELECT ce.`course_id` FROM `course_evaluate` ce,`course` c WHERE ce.`course_id` = c.`course_id` AND c.`department_id` = '1203' AND ce.`status` = '1' AND ce.`semester_id` = ".$semester_id[$sem]." ORDER BY ce.`course_id`";
                 $result = $DB->Query($sql);
                 if($result)
                 {
                    $course = $result;
                    for ($i=0; $i < count($course) ; $i++) 
                    { 
                        $data[$i] = $COURSE_OBJ->Get_Document('evaluate',$course[$i]['course_id'],null,null,$sem,$year);
                        $sql = "SELECT `course_name_th`,`credit` FROM `course` 
                        WHERE `course_id` = '".$course[$i]['course_id']."'";
                        $result_course_info = $DB->Query($sql);
                        if($result_course_info)
                        {
                            $data[$i]['course_name'] = $result_course_info[0]['course_name_th'];
                            $data[$i]['credit'] = $result_course_info[0]['credit'];
                        }
                        else 
                        {
                            $data[$i]['course_name'] = '-';
                            $data[$i]['credit'] = '-';
                        }
                    }
                 }
                ?>
                        <table class="table table-striped table-bordered table-hover" style="width: 1500px;">
                            <thead>
                                <tr>
                                    <th width="20px" rowspan="2" style="text-align: center; vertical-align: middle;">#</th>
                                    <th width="50px" rowspan="2" style="text-align: center; vertical-align: middle;">รหัสกระบวนวิชา</th>
                                    <th width="100px" rowspan="2" style="text-align: center; vertical-align: middle;">ชื่อกระบวนวิชา</th>
                                    <th width="50px" rowspan="2" style="text-align: center; vertical-align: middle;">จำนวนหน่วยกิต</th>
                                    <th width="30px" rowspan="2" style="text-align: center; vertical-align: middle;">ลักษณะการเรียนการสอน</th>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">ผู้รับผิดชอบ 1 </th>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">ผู้รับผิดชอบ 2 </th>
                                    <th colspan="10" style="text-align: center; vertical-align: middle;"> การวัดผล (ร้อยละ) </th>
                                    <th colspan="3" style="text-align: center; vertical-align: middle;">การตัดเกรด</th>
                                    <th width="100px" rowspan="2" style="text-align: center; vertical-align: middle;">นศ. ขาดสอบ </th>
                                </tr>
                                <tr>                                        
                                    <td width="50px" style="text-align: center; vertical-align: middle;"><b>กลางภาค 1 ทฤษฎี</td>
                                    <td width="50px" style="text-align: center; vertical-align: middle;"><b>กลางภาค 1 ปฏิบัติ</td>
                                    <td width="50px" style="text-align: center; vertical-align: middle;"><b>กลางภาค 2 ทฤษฎี</td>
                                    <td width="50px" style="text-align: center; vertical-align: middle;"><b>กลางภาค 2 ปฏิบัติ</td>
                                    <td width="50px" style="text-align: center; vertical-align: middle;"><b>ปลายภาค ทฤษฎี</td>
                                    <td width="50px" style="text-align: center; vertical-align: middle;"><b>ปลายภาค ปฏิบัติ</td>
                                    <td width="50px" style="text-align: center; vertical-align: middle;"><b>งานมอบหมาย ทฤษฎี</td>
                                    <td width="50px" style="text-align: center; vertical-align: middle;"><b>งานมอบหมาย ปฏิบัติ</td>
                                    <td width="50px" style="text-align: center; vertical-align: middle;"><b>อื่น ๆ ทฤษฎี</td>
                                    <td width="50px" style="text-align: center; vertical-align: middle;"><b>อื่น ๆ ปฏิบัติ</td>
                                    <td width="10px" style="text-align: center; vertical-align: middle;"><b>อิงกลุ่ม</td>
                                    <td width="10px" style="text-align: center; vertical-align: middle;"><b>อิงเกณฑ์</td>
                                    <td width="10px" style="text-align: center; vertical-align: middle;"><b>S/U</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for ($i=0; $i < count($data); $i++) 
                                { 
                                    if($data[$i])
                                    {
                                        echo "<tr>";
                                        echo "<td>".($i+1)."</td>";
                                        echo "<td>".$data[$i]['course_id']."</td>";
                                        echo "<td>".$data[$i]['course_name']."</td>";
                                        echo "<td>".$data[$i]['credit']."</td>";
                                        switch ($data[$i]['type']) {
                                            case 'LEC':
                                                echo "<td>บรรยาย</td>";
                                                break;
                                            case 'LECLAB':
                                                echo "<td>บรรยายและงานปฏิบัติการ</td>";
                                                break;
                                            case 'SPE':
                                                echo "<td>โครงงานทางเภสัชกรรม</td>";
                                                break;
                                            case 'TRA':
                                                echo "<td>ฝึกงาน</td>";
                                                break;
                                            case 'SEM':
                                                echo "<td>สัมมนา</td>";
                                                break;
                                            case 'LAB':
                                                echo "<td>ปฏิบัติการ</td>";
                                                break;
                                            case 'OTH':
                                                echo "<td>อื่นๆ</td>";
                                                break;
                                            default:
                                                echo "<td> - </td>";
                                                break;
                                        }
                                        if(isset($data[$i]['teacher'][0]))
                                        {
                                            echo "<td>".$data[$i]['teacher'][0]."</td>";
                                        }
                                        else 
                                        {
                                            echo "<td>-</td>";
                                        }
                                        if(isset($data[$i]['teacher'][1]))
                                        {
                                            echo "<td>".$data[$i]['teacher'][1]."</td>";
                                        }
                                        else 
                                        {
                                            echo "<td>-</td>";
                                        }
                                        echo "<td>".number_format($data[$i]['mid1_lec'],1,'.',',')."</td>";
                                        echo "<td>".number_format($data[$i]['mid1_lab'],1,'.',',')."</td>";
                                        echo "<td>".number_format($data[$i]['mid2_lec'],1,'.',',')."</td>";
                                        echo "<td>".number_format($data[$i]['mid2_lab'],1,'.',',')."</td>";
                                        echo "<td>".number_format($data[$i]['final_lec'],1,'.',',')."</td>";
                                        echo "<td>".number_format($data[$i]['final_lab'],1,'.',',')."</td>";
                                        echo "<td>".number_format($data[$i]['work_lec'],1,'.',',')."</td>";
                                        echo "<td>".number_format($data[$i]['work_lab'],1,'.',',')."</td>";
                                        echo "<td>".number_format($data[$i]['other_lec'],1,'.',',')."</td>";
                                        echo "<td>".number_format($data[$i]['other_lab'],1,'.',',')."</td>";
                                        $CAL_CRITERIA = $CAL_GROUP = $CAL_SU = '';
                                        if($data[$i]['criterion_type'] == 'GROUP')
                                        {
                                            $CAL_GROUP = '/';
                                        }
                                        else if($data[$i]['criterion_type'] == 'CRITERIA')
                                        {
                                            $CAL_CRITERIA = '/';
                                        }
                                        else if ($data[$i]['criterion_type'] == 'SU')
                                        {
                                            $CAL_SU = '/';
                                        }
                                        echo "<td><center>".$CAL_GROUP."</center></td>";
                                        echo "<td><center>".$CAL_CRITERIA."</center></td>";
                                        echo "<td><center>".$CAL_SU."</center></td>";

                                        $absent = '';
                                        if($data[$i]['absent'] == 'F')
                                        {
                                            $absent = 'ให้ลำดับขั้น F';
                                        }
                                        else if($data[$i]['absent'] == 'U')
                                        {
                                            $absent = 'ให้อักษร U';
                                        }
                                        else if($data[$i]['absent'] == 'CAL')
                                        {
                                            $absent = 'คำนวณคะแนนก่อนสอบ';
                                        }
                                        echo "<td>".$absent."</td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        </li>
                        <?php } ?>
                <br>
                <?php if($care_course[$sem] != 0) { ?>
                    <li><b>ภาควิชาบริบาลเภสัชกรรม <br><br></b>
                <?php
                $data = null;
                 $sql = "SELECT ce.`course_id` FROM `course_evaluate` ce,`course` c WHERE ce.`course_id` = c.`course_id` AND c.`department_id` = '1202' AND ce.`status` = '1' AND ce.`semester_id` = ".$semester_id[$sem]." ORDER BY ce.`course_id`";
                 $result = $DB->Query($sql);
                 if($result)
                 {
                    $course = $result;
                    for ($i=0; $i < count($course) ; $i++) 
                    { 
                        $data[$i] = $COURSE_OBJ->Get_Document('evaluate',$course[$i]['course_id'],null,null,$sem,$year);
                        $sql = "SELECT `course_name_th`,`credit` FROM `course` WHERE `course_id` = '".$course[$i]['course_id']."'";
                        $result_course_info = $DB->Query($sql);
                        if($result_course_info)
                        {
                            $data[$i]['course_name'] = $result_course_info[0]['course_name_th'];
                            $data[$i]['credit'] = $result_course_info[0]['credit'];
                        }
                        else 
                        {
                            $data[$i]['course_name'] = '-';
                            $data[$i]['credit'] = '-';
                        }
                    }
                 }
                
                ?>
                        <table class="table table-striped table-bordered table-hover" style="width: 1500px;">
                            <thead>
                                <tr>
                                    <th width="20px" rowspan="2" style="text-align: center; vertical-align: middle;">#</th>
                                    <th width="50px" rowspan="2" style="text-align: center; vertical-align: middle;">รหัสกระบวนวิชา</th>
                                    <th width="100px" rowspan="2" style="text-align: center; vertical-align: middle;">ชื่อกระบวนวิชา</th>
                                    <th width="50px" rowspan="2" style="text-align: center; vertical-align: middle;">จำนวนหน่วยกิต</th>
                                    <th width="30px" rowspan="2" style="text-align: center; vertical-align: middle;">ลักษณะการเรียนการสอน</th>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">ผู้รับผิดชอบ 1 </th>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">ผู้รับผิดชอบ 2 </th>
                                    <th colspan="10" style="text-align: center; vertical-align: middle;"> การวัดผล (ร้อยละ) </th>
                                    <th colspan="3" style="text-align: center; vertical-align: middle;">การตัดเกรด</th>
                                    <th width="100px" rowspan="2" style="text-align: center; vertical-align: middle;">นศ. ขาดสอบ </th>
                                </tr>
                                <tr>                                        
                                    <td width="50px" style="text-align: center; vertical-align: middle;"><b>กลางภาค 1 ทฤษฎี</td>
                                    <td width="50px" style="text-align: center; vertical-align: middle;"><b>กลางภาค 1 ปฏิบัติ</td>
                                    <td width="50px" style="text-align: center; vertical-align: middle;"><b>กลางภาค 2 ทฤษฎี</td>
                                    <td width="50px" style="text-align: center; vertical-align: middle;"><b>กลางภาค 2 ปฏิบัติ</td>
                                    <td width="50px" style="text-align: center; vertical-align: middle;"><b>ปลายภาค ทฤษฎี</td>
                                    <td width="50px" style="text-align: center; vertical-align: middle;"><b>ปลายภาค ปฏิบัติ</td>
                                    <td width="50px" style="text-align: center; vertical-align: middle;"><b>งานมอบหมาย ทฤษฎี</td>
                                    <td width="50px" style="text-align: center; vertical-align: middle;"><b>งานมอบหมาย ปฏิบัติ</td>
                                    <td width="50px" style="text-align: center; vertical-align: middle;"><b>อื่น ๆ ทฤษฎี</td>
                                    <td width="50px" style="text-align: center; vertical-align: middle;"><b>อื่น ๆ ปฏิบัติ</td>
                                    <td width="10px" style="text-align: center; vertical-align: middle;"><b>อิงกลุ่ม</td>
                                    <td width="10px" style="text-align: center; vertical-align: middle;"><b>อิงเกณฑ์</td>
                                    <td width="10px" style="text-align: center; vertical-align: middle;"><b>S/U</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for ($i=0; $i < count($data); $i++) 
                                { 
                                    if($data[$i])
                                    {
                                        echo "<tr>";
                                        echo "<td>".($i+1)."</td>";
                                        echo "<td>".$data[$i]['course_id']."</td>";
                                        echo "<td>".$data[$i]['course_name']."</td>";
                                        echo "<td>".$data[$i]['credit']."</td>";
                                        switch ($data[$i]['type']) {
                                            case 'LEC':
                                                echo "<td>บรรยาย</td>";
                                                break;
                                            case 'LECLAB':
                                                echo "<td>บรรยายและงานปฏิบัติการ</td>";
                                                break;
                                            case 'SPE':
                                                echo "<td>โครงงานทางเภสัชกรรม</td>";
                                                break;
                                            case 'TRA':
                                                echo "<td>ฝึกงาน</td>";
                                                break;
                                            case 'SEM':
                                                echo "<td>สัมมนา</td>";
                                                break;
                                            case 'LAB':
                                                echo "<td>ปฏิบัติการ</td>";
                                                break;
                                            case 'OTH':
                                                echo "<td>อื่นๆ</td>";
                                                break;
                                            default:
                                                echo "<td> - </td>";
                                                break;
                                        }
                                        if(isset($data[$i]['teacher'][0]))
                                        {
                                            echo "<td>".$data[$i]['teacher'][0]."</td>";
                                        }
                                        else 
                                        {
                                            echo "<td>-</td>";
                                        }
                                        if(isset($data[$i]['teacher'][1]))
                                        {
                                            echo "<td>".$data[$i]['teacher'][1]."</td>";
                                        }
                                        else 
                                        {
                                            echo "<td>-</td>";
                                        }
                                        echo "<td>".number_format($data[$i]['mid1_lec'],1,'.',',')."</td>";
                                        echo "<td>".number_format($data[$i]['mid1_lab'],1,'.',',')."</td>";
                                        echo "<td>".number_format($data[$i]['mid2_lec'],1,'.',',')."</td>";
                                        echo "<td>".number_format($data[$i]['mid2_lab'],1,'.',',')."</td>";
                                        echo "<td>".number_format($data[$i]['final_lec'],1,'.',',')."</td>";
                                        echo "<td>".number_format($data[$i]['final_lab'],1,'.',',')."</td>";
                                        echo "<td>".number_format($data[$i]['work_lec'],1,'.',',')."</td>";
                                        echo "<td>".number_format($data[$i]['work_lab'],1,'.',',')."</td>";
                                        echo "<td>".number_format($data[$i]['other_lec'],1,'.',',')."</td>";
                                        echo "<td>".number_format($data[$i]['other_lab'],1,'.',',')."</td>";
                                        $CAL_CRITERIA = $CAL_GROUP = $CAL_SU = '';
                                        if($data[$i]['criterion_type'] == 'GROUP')
                                        {
                                            $CAL_GROUP = '/';
                                        }
                                        else if($data[$i]['criterion_type'] == 'CRITERIA')
                                        {
                                            $CAL_CRITERIA = '/';
                                        }
                                        else if ($data[$i]['criterion_type'] == 'SU')
                                        {
                                            $CAL_SU = '/';
                                        }
                                        echo "<td><center>".$CAL_GROUP."</center></td>";
                                        echo "<td><center>".$CAL_CRITERIA."</center></td>";
                                        echo "<td><center>".$CAL_SU."</center></td>";

                                        $absent = '';
                                        if($data[$i]['absent'] == 'F')
                                        {
                                            $absent = 'ให้ลำดับขั้น F';
                                        }
                                        else if($data[$i]['absent'] == 'U')
                                        {
                                            $absent = 'ให้อักษร U';
                                        }
                                        else if($data[$i]['absent'] == 'CAL')
                                        {
                                            $absent = 'คำนวณคะแนนก่อนสอบ';
                                        }
                                        echo "<td>".$absent."</td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>                           
                    </li>
                    <?php } ?>
                    <br>
                    <?php if($base_course[$sem] != 0) { ?>
                    <li><b>วิชาพื้นฐาน <br><br></b>
                    <?php
                $data = null;
                 $sql = "SELECT ce.`course_id` FROM `course_evaluate` ce,`course` c WHERE ce.`course_id` = c.`course_id` AND c.`department_id` = '' AND ce.`status` = '1' AND ce.`semester_id` = ".$semester_id[$sem]." ORDER BY ce.`course_id`";
                 $result = $DB->Query($sql);
                 if($result)
                 {
                    $course = $result;
                    for ($i=0; $i < count($course) ; $i++) 
                    { 
                        $data[$i] = $COURSE_OBJ->Get_Document('evaluate',$course[$i]['course_id'],null,null,$sem,$year);
                        $sql = "SELECT `course_name_th`,`credit` FROM `course` WHERE `course_id` = '".$course[$i]['course_id']."'";
                        $result_course_info = $DB->Query($sql);
                        if($result_course_info)
                        {
                            $data[$i]['course_name'] = $result_course_info[0]['course_name_th'];
                            $data[$i]['credit'] = $result_course_info[0]['credit'];
                        }
                        else 
                        {
                            $data[$i]['course_name'] = '-';
                            $data[$i]['credit'] = '-';
                        }
                    }
                 }
                
                ?>
                        <table class="table table-striped table-bordered table-hover" style="width: 1500px;">
                            <thead>
                                <tr>
                                    <th width="20px" rowspan="2" style="text-align: center; vertical-align: middle;">#</th>
                                    <th width="50px" rowspan="2" style="text-align: center; vertical-align: middle;">รหัสกระบวนวิชา</th>
                                    <th width="100px" rowspan="2" style="text-align: center; vertical-align: middle;">ชื่อกระบวนวิชา</th>
                                    <th width="50px" rowspan="2" style="text-align: center; vertical-align: middle;">จำนวนหน่วยกิต</th>
                                    <th width="30px" rowspan="2" style="text-align: center; vertical-align: middle;">ลักษณะการเรียนการสอน</th>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">ผู้รับผิดชอบ 1 </th>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">ผู้รับผิดชอบ 2 </th>
                                    <th colspan="10" style="text-align: center; vertical-align: middle;"> การวัดผล (ร้อยละ) </th>
                                    <th colspan="3" style="text-align: center; vertical-align: middle;">การตัดเกรด</th>
                                    <th width="100px" rowspan="2" style="text-align: center; vertical-align: middle;">นศ. ขาดสอบ </th>
                                </tr>
                                <tr>                                        
                                    <td width="50px" style="text-align: center; vertical-align: middle;"><b>กลางภาค 1 ทฤษฎี</td>
                                    <td width="50px" style="text-align: center; vertical-align: middle;"><b>กลางภาค 1 ปฏิบัติ</td>
                                    <td width="50px" style="text-align: center; vertical-align: middle;"><b>กลางภาค 2 ทฤษฎี</td>
                                    <td width="50px" style="text-align: center; vertical-align: middle;"><b>กลางภาค 2 ปฏิบัติ</td>
                                    <td width="50px" style="text-align: center; vertical-align: middle;"><b>ปลายภาค ทฤษฎี</td>
                                    <td width="50px" style="text-align: center; vertical-align: middle;"><b>ปลายภาค ปฏิบัติ</td>
                                    <td width="50px" style="text-align: center; vertical-align: middle;"><b>งานมอบหมาย ทฤษฎี</td>
                                    <td width="50px" style="text-align: center; vertical-align: middle;"><b>งานมอบหมาย ปฏิบัติ</td>
                                    <td width="50px" style="text-align: center; vertical-align: middle;"><b>อื่น ๆ ทฤษฎี</td>
                                    <td width="50px" style="text-align: center; vertical-align: middle;"><b>อื่น ๆ ปฏิบัติ</td>
                                    <td width="10px" style="text-align: center; vertical-align: middle;"><b>อิงกลุ่ม</td>
                                    <td width="10px" style="text-align: center; vertical-align: middle;"><b>อิงเกณฑ์</td>
                                    <td width="10px" style="text-align: center; vertical-align: middle;"><b>S/U</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for ($i=0; $i < count($data); $i++) 
                                { 
                                    if($data[$i])
                                    {
                                        echo "<tr>";
                                        echo "<td>".($i+1)."</td>";
                                        echo "<td>".$data[$i]['course_id']."</td>";
                                        echo "<td>".$data[$i]['course_name']."</td>";
                                        echo "<td>".$data[$i]['credit']."</td>";
                                        switch ($data[$i]['type']) {
                                            case 'LEC':
                                                echo "<td>บรรยาย</td>";
                                                break;
                                            case 'LECLAB':
                                                echo "<td>บรรยายและงานปฏิบัติการ</td>";
                                                break;
                                            case 'SPE':
                                                echo "<td>โครงงานทางเภสัชกรรม</td>";
                                                break;
                                            case 'TRA':
                                                echo "<td>ฝึกงาน</td>";
                                                break;
                                            case 'SEM':
                                                echo "<td>สัมมนา</td>";
                                                break;
                                            case 'LAB':
                                                echo "<td>ปฏิบัติการ</td>";
                                                break;
                                            case 'OTH':
                                                echo "<td>อื่นๆ</td>";
                                                break;
                                            default:
                                                echo "<td> - </td>";
                                                break;
                                        }
                                        if(isset($data[$i]['teacher'][0]))
                                        {
                                            echo "<td>".$data[$i]['teacher'][0]."</td>";
                                        }
                                        else 
                                        {
                                            echo "<td>-</td>";
                                        }
                                        if(isset($data[$i]['teacher'][1]))
                                        {
                                            echo "<td>".$data[$i]['teacher'][1]."</td>";
                                        }
                                        else 
                                        {
                                            echo "<td>-</td>";
                                        }
                                        echo "<td>".number_format($data[$i]['mid1_lec'],1,'.',',')."</td>";
                                        echo "<td>".number_format($data[$i]['mid1_lab'],1,'.',',')."</td>";
                                        echo "<td>".number_format($data[$i]['mid2_lec'],1,'.',',')."</td>";
                                        echo "<td>".number_format($data[$i]['mid2_lab'],1,'.',',')."</td>";
                                        echo "<td>".number_format($data[$i]['final_lec'],1,'.',',')."</td>";
                                        echo "<td>".number_format($data[$i]['final_lab'],1,'.',',')."</td>";
                                        echo "<td>".number_format($data[$i]['work_lec'],1,'.',',')."</td>";
                                        echo "<td>".number_format($data[$i]['work_lab'],1,'.',',')."</td>";
                                        echo "<td>".number_format($data[$i]['other_lec'],1,'.',',')."</td>";
                                        echo "<td>".number_format($data[$i]['other_lab'],1,'.',',')."</td>";
                                        $CAL_CRITERIA = $CAL_GROUP = $CAL_SU = '';
                                        if($data[$i]['criterion_type'] == 'GROUP')
                                        {
                                            $CAL_GROUP = '/';
                                        }
                                        else if($data[$i]['criterion_type'] == 'CRITERIA')
                                        {
                                            $CAL_CRITERIA = '/';
                                        }
                                        else if ($data[$i]['criterion_type'] == 'SU')
                                        {
                                            $CAL_SU = '/';
                                        }
                                        echo "<td><center>".$CAL_GROUP."</center></td>";
                                        echo "<td><center>".$CAL_CRITERIA."</center></td>";
                                        echo "<td><center>".$CAL_SU."</center></td>";

                                        $absent = '';
                                        if($data[$i]['absent'] == 'F')
                                        {
                                            $absent = 'ให้ลำดับขั้น F';
                                        }
                                        else if($data[$i]['absent'] == 'U')
                                        {
                                            $absent = 'ให้อักษร U';
                                        }
                                        else if($data[$i]['absent'] == 'CAL')
                                        {
                                            $absent = 'คำนวณคะแนนก่อนสอบ';
                                        }
                                        echo "<td>".$absent."</td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>                        
                    </li>
                    <?php } ?>
                </ul>
                <?php } ?>
            </div>
                <?php } ?>
        </div>
     </div>	
           <?php  }   ?>
</body>
</html>