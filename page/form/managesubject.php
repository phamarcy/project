<?php
session_start();
if(!isset($_SESSION['level']) || !isset($_SESSION['fname']) || !isset($_SESSION['lname']) || !isset($_SESSION['id']))
{
    die('กรุณา Login ใหม่');
}
require_once(__DIR__."/../../application/class/person.php");
require_once(__DIR__.'/../../application/class/manage_deadline.php');
require_once(__DIR__."/../../application/class/course.php");
$person = new Person();
$deadline = new Deadline();
$course = new course();
$semeter= $deadline->Get_Current_Semester();
$department =$person->Get_Staff_Dep($_SESSION['id']);
if ($_SESSION['level']==7) {
  if(isset($_POST['department'])){
    $_SESSION['department']=$_POST['department'];
  }
  if (isset($_SESSION['department'])) {
    $department['code']=$_SESSION['department'];
    $dep_js=$_SESSION['department'];
  }
}
$dep_js=$department['code'];
$assessor=$person->Search_Assessor($department['code']);
$list_course= $course->Get_Dept_Course($department['code'],$semeter['id']);
$history=$course->Get_History($department['code']);

$missing =array();
if (isset($assessor['status'])) {
  if ($assessor['status']=='error') {
    $checknumgroup=0;
  }
}
else {
 if (count($assessor)>0) {
  $stacknum=array();
  for ($i=1; $i <= $assessor[count($assessor)-1]['group'] ; $i++) {
      for ($j=0; $j < count($assessor); $j++) {
        if ($assessor[$j]['group']==$i) {
          array_push($stacknum,$i);
        }
      }
  }
  $stacknum=array_unique($stacknum);
  $arr2 = range(1,max($stacknum));
  $missing = array_diff($arr2,$stacknum);
  if (!empty($missing)) {
    $checknumgroup=array_shift($missing);

  }else {
    $checknumgroup=$assessor[count($assessor)-1]['group']+1;
  }
 }

}

?>
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
    <link rel="stylesheet" href="../dist/css/scrollbar.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

    <script src="../vendor/jquery/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
    <script type="text/javascript" src="../dist/js/bootstrap-filestyle.min.js"></script>
    <script type="text/javascript" src="../js/function.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="../dist/js/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="../dist/css/sweetalert2.min.css">

    <title></title>
    <style>
      .panel-heading {
        margin-top: 0px;
        margin-bottom: 0px;
      }

      #statc {
        color: #0d4b9d;
      }

      #statcf {
        color: #0e9d14;
      }

      #statn {
        color: #ec2c2c;
      }

      #statwt {
        color: #acb500;
      }

      #statal {
        color: #da9001;
      }


      .clickable{
          cursor: pointer;
      }

      .panel-heading span {
        margin-top: -20px;
        font-size: 15px;
      }
      .mypanel {
          height: 250px;
          overflow-y: scroll;
      }
    </style>
  </head>

  <body>

    <h3 class="page-header" style="margin-bottom: 0px;">
      <center><b>จัดการกระบวนวิชา</b></center>
    </h3>
    <div class="container" style="margin-top:30px">
    <?php
    if ($_SESSION['level']==7 ){ ?>
    <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">สำหรับผู้ดูแลระบบ</h3>
          </div>
          <div class="panel-body">
            <form action="managesubject.php" method="post">
            <div class="form-inline">
              <p><b>ภาควิชาปัจจุบัน : </b>
                <select name="department" class="form-control">
                <option value="1202" <?php if ($dep_js=="1202") { echo "selected";} ?>>ภาควิชาบริบาลเภสัชกรรม</option>
                <option value="1203" <?php if ($dep_js=="1203") { echo "selected";} ?>>ภาควิชาวิทยาศาสตร์เภสัชกรรม</option>
                </select>&nbsp;&nbsp;<input type="submit" value="บันทึก" class="btn btn-outline btn-primary" ></p>
            </div>
            </form>
          </div>
      </div>
    <?php
    }
    ?>
      <div class="panel panel-default">
        <div class="panel-heading">
          <b>ภาคเรียนที่ <?php echo $semeter['semester'];?> &nbsp;ปีการศึกษา <?php echo $semeter['year']." ";?><?php if ($dep_js=="1202") { echo "ภาควิชาบริบาลเภสัชกรรม";} elseif($dep_js=="1203") {echo "ภาควิชาวิทยาศาสตร์เภสัชกรรม";} ?></b>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <b>คณะกรรมการผู้รับผิดชอบ</b>
                </div>
                <div class="panel-body ">
                  <div class="form-group">
                    <div class="row">

                      <?php if ($checknumgroup>0) {
                        for ($i=1; $i <= count($assessor) ; $i++) { ?>
                          <div class="col-md-6">
                        <div class="panel panel-info">
                            <div class="panel-heading" role="tab" id="heading1"  style="font-size:14px;">
                              <div class="panel-title" style="font-size:14px;">
                                <a role="button" data-toggle="collapse" href="#collapse<?php echo$i;?>" aria-expanded="true" aria-controls="collapse<?php echo$i+1;?>" class="trigger collapsed">
                                คณะกรรมการชุดที่ <?php echo $assessor[$i-1]['group'] ;?>
                                </a>
                              </div>
                            </div>
                            <div id="collapse<?php echo$i;?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading1">
                            <div class="panel-body mypanel " style="font-size:14px;">
                            <div class="form-group">
                              <form role="form" data-toggle="validator" id="data">
                                <label for="">เพิ่มคณะกรรมการ</label>
                                <div class="form-inline">
                                  <input type="text" class="form-control " name="teacher" id="TEACHERLEC_<?php echo$assessor[$i-1]['group'];?>" list="dtl<?php echo$assessor[$i-1]['group'];?>" placeholder="ชื่อ-นามสกุล" size="35"
                                    onkeydown="searchname(<?php echo $assessor[$i-1]['group'];?>,'committee');" required>
                                  <button type="button" class="btn btn-outline btn-primary" onclick="teacherGroup(<?php echo $assessor[$i-1]['group'];?>,'add',<?php echo $department['code']  ?>)">เพิ่ม</button>
                                </div>
                                <datalist id="dtl<?php echo$assessor[$i-1]['group'];?>"></datalist>
                              </form>
                            </div>
                            <hr>
                            <div class="form-group">
                              <table class="table" style="font-size:14px">
                                <thead>
                                  <th>ลำดับ</th>
                                  <th>ชื่อ-นามสกุล</th>
                                  <th></th>
                                </thead>
                                <tbody>

                                  <?php foreach ($assessor[$i-1]['assessor'] as $key_assessor => $assessor_name): ?>
                                  <form>
                                    <input type="hidden" name="teacher" id="name_assessor<?php echo $assessor[$i-1]['group'].$key_assessor ?>" value="<?php echo $assessor_name ?>">
                                    <tr>
                                      <td>

                                        <?php echo $key_assessor+1;  ?>
                                      </td>
                                      <td>
                                        <?php echo $assessor_name ?>
                                      </td>
                                      <td>
                                        <button type="button" name="button" class="btn btn-outline btn-danger"
                                        onclick="teacherGroupremove('<?php echo $assessor[$i-1]['group'];?>','remove',<?php echo $department['code']  ?>,'<?php echo $assessor[$i-1]['group'].$key_assessor ?>')">ลบ</button></td>
                                    </tr>
                                  </form>
                                  <?php endforeach; ?>

                                </tbody>
                              </table>
                            </div>

                          </div>
                            </div>
                          </div>
                          </ul>
                        </div>

                        <?php
                        }
                      }
                      ?>
                      <div id="new_group"></div>
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      <button class="btn  btn-primary btn-add-panel" onclick="addgroupstaff()">
                          <i class="glyphicon glyphicon-plus"></i> เพื่มชุดคณะกรรมการ
                      </button>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <b>ข้อมูลกระบวนวิชาย้อนหลัง</b>
                    </div>
                    <div class="panel-body">
                      <div class="form-inline">
                        <center>
                          <?php foreach ($history as $key => $value): ?>
                          <button type="button" name="semester_history" class="btn btn-outline btn-primary " onclick="submitForm('<?php echo $value['id']?>','<?php echo $value['semester'].'/'.$value['year'] ?>')"><b><?php echo $value['semester'].'/'.$value['year'] ?></b></button>
                          <?php endforeach; ?>
                        </center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="show_old"></div>

          <div class="panel panel-info" id="course_now">
            <div class="panel-heading">
              <b>กระบวนวิชาใน <?php echo $semeter['semester'] ?>/<?php echo $semeter['year'] ?></b>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-12">
                  <form id="course" method="post">
                    <div class="form-inline">
                      <div class="form-group">
                        <label for="">วิชา</label>
                        <select class="form-control" name="course" id="search_course_id">
                            <?php foreach ($course->Get_All_Course() as $value_course): ?>
                              <option value="<?php echo $value_course['id'] ?>"><?php echo $value_course['id']." ".$value_course['name']['en']; ?></option>
                            <?php endforeach; ?>
                          </select>
                      </div>
                      <input type="hidden" name="dep_id" value="<?php echo $department['code']  ?>">
                      <input type="hidden" name="semester_id" id="semester_id" value="<?php echo $semeter['id'] ?>">
                      <input type="hidden" name="type" id="type" value="add">
                      <button type="submit" class="btn btn-outline btn-primary " id="submit" name="submit">เลือก</button>
                    </div>
                  </form>
                </div>

              </div>

              <hr>
              <table class="table table-hover" style="font-size:14px">
                <thead>
                  <tr>
                    <th width="10%">รหัสวิชา</th>
                    <th width="80%">ชื่อวิชา</th>
                    <th width="7%">สถานะ</th>
                    <th width="5%"></th>
                    <th width="5%"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (isset($list_course)): ?>

                  <?php foreach ($list_course as $value_list): ?>
                  <form id="remove" method="post">
                    <tr>
                      <td>
                        <?php echo $value_list['id']; ?>
                      </td>
                      <td>
                        <?php echo $value_list['name']; ?>
                      </td>
                      <td>
                        <?php if($value_list['teacher']!= NULL and $value_list['assessor']!= NULL){echo '<i id="statcf" class=" fa fa-check-square-o fa-2x " aria-hidden="true"></i>';}else{echo '<i id="statn" class="fa fa-times fa-2x" aria-hidden="true"></i>';} ?></td>
                      <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#<?php echo $value_list['id'] ?>"
                          class="accordion-toggle">ผู้รับผิดชอบ</button></td>
                      <td><button type="submit" class="btn btn-outline btn-danger" id="delete" name="delete">ลบ</button></td>
                      <input type="hidden" name="dep_id" value="<?php echo $department['code']  ?>">
                      <input type="hidden" name="course" value="<?php echo $value_list['id'] ?>">
                      <input type="hidden" name="semester_id" value="<?php echo $semeter['id'] ?>">
                      <input type="hidden" name="type" value="remove">
                    </tr>
                  </form>
                  <tr class="hiddenRow">
                    <td colspan="12">
                      <div class="accordian-body collapse" id="<?php echo $value_list['id'] ?>">
                        <div class="panel panel-success">
                          <div class="panel-heading">
                            <b>รายชื่ออาจารย์ผู้รับผิดชอบ</b>
                          </div>
                          <div class="panel-body">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <div class="col-md-12">
                                    <div class="form-inline">
                                      <label for="">ผู้รับผิดชอบ</label>
                                      <input type="text" name="teacher" class="form-control " name="teacher" id="TEACHERLEC_<?php echo $value_list['id'] ?>" list="dtl<?php echo $value_list['id'] ?>"
                                        placeholder="ชื่อ-นามสกุล" size="27" onkeydown="searchname(<?php echo $value_list['id'] ?>,'responsible');">
                                      <label for="">คณะกรรมการ</label>
                                      <input type="hidden" name="type" value="add_assessor">
                                      <select class="form-control" id="group<?php echo $value_list['id'] ?>">
                                        <?php
                                        for ($i=0; $i < count($assessor) ; $i++) {
                                          echo "<option value='".$assessor[$i]['group']."'>คณะกรรมการชุดที่ ".$assessor[$i]['group']." </option>";
                                        }
                                        ?>
                                      </select>
                                      <button type="button" name="button" class="btn btn-outline btn-primary" onclick="addStaffCourse('<?php echo $value_list['id'] ?>','<?php echo $dep_js ?>','<?php echo $semeter['id'] ?>')">เพิ่ม</button>
                                    </div>
                                  </div>

                                  <datalist id="dtl<?php echo $value_list['id'] ?>"></datalist>
                                  <?php
                                  if ($value_list['teacher']!=NULL && $value_list['assessor']!=NULL) { ?>
                                  <div class="col-md-6">
                                      <br>
                                    <dl class="dl-horizontal">
                                      <dt>อาจารยผู้รับผิดชอบ</dt>
                                      <dd style="font-size:14px;">
                                      <?php if ($value_list['teacher']!=NULL): ?>
                                      <?php echo $value_list['teacher'] ?>
                                      <input type="hidden" id="hiddenteacher<?php echo $value_list['id'] ?>" value="<?php echo $value_list['teacher'] ?>">
                                      <?php endif; ?>
                                      </dd>
                                      <dt>คณะกรรมการ</dt>
                                      <dd>
                                        <?php if ($value_list['assessor']!=NULL): ?>

                                          <?php if ($value_list['assessor']):echo "คณะกรรมการชุดที่ ".$value_list['assessor']; ?><?php endif; ?>

                                          <input type="hidden" id="hiddengroup<?php echo $value_list['id'] ?>" value="<?php echo $value_list['assessor'] ?>">
                                        <?php endif; ?>
                                      </dd>

                                    </dl>
                                  </div>
                                  <div class="col-md-6">
                                      <br>
                                      <button type="button" class="btn btn-outline btn-danger" onclick="removeStaffCourse('<?php echo $value_list['id'] ?>','<?php echo $dep_js ?>','<?php echo $semeter['id'] ?>');">ลบ</button>
                                  </div>
                                  <?php
                                  }
                                  ?>

                                </div>
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
    var numgroup=<?php echo $checknumgroup; ?>;
    if (numgroup==0) {
      numgroup++;
    }
    var countgroup =0;
    function addgroupstaff() {
      var checkdup=<?php echo count($assessor); ?>;

      console.log(numgroup);
      if (countgroup == 0) {
      swal({
          title: 'แน่ใจหรือไม่',
          text: 'คุณต้องเพิ่มชุดคณะกรรมการใช่หรือไม่',
          type: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'ตกลง',
          cancelButtonText: 'ยกเลิก'
        }).then(function () {
          $('#new_group').append(
        ` <div class="col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading" role="tab" id="heading1"  style="font-size:14px;">
              <div class="panel-title" style="font-size:14px;">
                <a role="button" data-toggle="collapse" href="#collapse=" aria-expanded="true" aria-controls="collapse${numgroup}" class="trigger collapsed">
                คณะกรรมการชุดที่ ${numgroup}
                </a>
              </div>
            </div>
            <div id="collapse${numgroup}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading1">
            <div class="panel-body mypanel" style="font-size:14px;">
            <div class="form-group">
              <form role="form" data-toggle="validator" id="data">
                <label for="">เพิ่มคณะกรรมการ</label>
                <div class="form-inline">
                  <input type="text" class="form-control " name="teacher" id="TEACHERLEC_${numgroup}" list="dtl${numgroup}" placeholder="ชื่อ-นามสกุล" size="35"
                    onkeydown="searchname(${numgroup},'committee');" required>
                  <button type="button" class="btn btn-outline btn-primary" onclick="teacherGroup(${numgroup},'add',<?php echo $department['code']  ?>)">เพิ่ม</button>
                </div>
                <datalist id="dtl${numgroup}"></datalist>
              </form>
            </div>
            <hr>
            <div class="form-group">
              <table class="table" style="font-size:14px">
                <thead>
                  <th>ลำดับ</th>
                  <th>ชื่อ-นามสกุล</th>
                  <th></th>
                </thead>
                <tbody>


                </tbody>
              </table>
            </div>

          </div>
            </div>
          </div>
        </div>
      `
        );
        countgroup++;
        }, function (dismiss) {
          if (dismiss === 'cancel') {}
        })

          }

    }

      function addStaffCourse(course, department, semester) {
        var text = "TEACHERLEC_" + course;
        var textgroup = "group" + course;
        var teacher = document.getElementById(text).value;
        var group = document.getElementById(textgroup).value;

        if (!teacher) {
          swal({
            type: "warning",
            text: "กรุณากรอกข้อมูลให้ครบ",
            confirmButtonText: "ตกลง!",
          });
          return false;
        }

        $.ajax({
          url: '../../application/subject/responsible_staff.php',
          type: 'POST',
          cache: false,
          async: true,
          data: {
            type: "add_teacher",
            department: department,
            course: course,
            semester_id: semester,
            teacher: teacher
          },
          success: function (data) {
            try {
              var msg = JSON.parse(data);
              console.log(msg);
              if (msg.status == "error") {
                swal({
                  type: msg.status,
                  text: msg.msg,
                  timer: 2000,
                  confirmButtonText: "Ok!"
                });
                return false;
              } else {
                $.ajax({
                  url: '../../application/subject/responsible_staff.php',
                  type: 'POST',
                  cache: false,
                  async: true,
                  data: {
                    type: "add_assessor",
                    course: course,
                    semester_id: semester,
                    dep_id: department,
                    group: group
                  },
                  success: function (data) {
                    try {
                      var msg = JSON.parse(data);
                      if (msg.status == "error") {
                        swal({
                          type: msg.status,
                          text: msg.msg,
                          timer: 2000,
                          confirmButtonText: "Ok!"
                        });
                        return false;
                      } else {
                        swal({
                          type: msg.status,
                          text: msg.msg,
                          timer: 2000,
                          confirmButtonText: "Ok!",
                        }, function () {
                          window.location.reload();
                        });
                        setTimeout(function () {
                          window.location.reload();
                        }, 1000);
                      }

                    } catch (e) {
                      console.log(data);
                      swal({
                        type: "error",
                        text: "ผิดพลาด ! กรุณาติดต่อผู้ดูแลระบบ",
                        timer: 2000,
                        confirmButtonText: "Ok!",
                      });
                    }
                  }
                });
              }


            } catch (e) {
              //console.log(data);
              swal({
                type: "error",
                text: "ผิดพลาด ! กรุณาติดต่อผู้ดูแลระบบ",
                timer: 2000,
                confirmButtonText: "Ok!",
              });
            }

          }
        });

      }

      function removeStaffCourse(course,deaprtment,semester) {
        swal({
          title: 'แน่ใจหรือไม่',
          text: 'คุณต้องการลบข้อมูลใช่หรือไม่',
          type: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'ตกลง',
          cancelButtonText: 'ยกเลิก'
        }).then(function () {
          var textteacher = "hiddenteacher"+course;
          var textgroup   = "hiddengroup"+course;
          var teacher     = document.getElementById(textteacher).value;
          var group       = document.getElementById(textgroup).value;
          console.log(teacher,group);
          $.ajax({
                    url:   '../../application/subject/responsible_staff.php',
                    type:  'POST',
                    cache: false,
                    async: true,
                    data: {
                      course: course,
                      teacher: teacher,
                      semester_id:semester,
                      type: "remove_teacher",
                    },
                    success: function (data) {
                      try {
                        var msg = JSON.parse(data);
                        if (msg.status == "error") {
                          swal({
                            type: msg.status,
                            text: msg.msg,
                            timer: 2000,
                            confirmButtonText: "Ok!"
                          });
                          return false;
                        } else {
                          $.ajax({
                                url: '../../application/subject/responsible_staff.php',
                                type: 'POST',
                                cache: false,
                                async: true,
                                data: {
                                  course: course,
                                  semester_id:semester,
                                  type: "remove_assessor",

                                },
                                success: function (data) {
                                  try {
                                    var msg = JSON.parse(data);
                                    if (msg.status == "error") {
                                      swal({
                                        type: msg.status,
                                        text: msg.msg,
                                        timer: 2000,
                                        confirmButtonText: "Ok!"
                                      });
                                      return false;
                                    } else {
                                      swal({
                                        type: msg.status,
                                        text: msg.msg,
                                        timer: 2000,
                                        confirmButtonText: "Ok!",
                                      }, function () {
                                        window.location.reload();
                                      });
                                      setTimeout(function () {
                                        window.location.reload();
                                      }, 1000);
                                    }
                                  } catch (e) {
                                    console.log(data);

                                    swal({
                                    type: "error",
                                    text: "ผิดพลาด ! กรุณาติดต่อผู้ดูแลระบบ",
                                    timer: 2000,
                                    confirmButtonText: "Ok!",
                                  });
                                  }
                                }
                              });

                        }

                      } catch (e) {
                        console.log(data);
                        swal({
                        type: "error",
                        text: "ผิดพลาด ! กรุณาติดต่อผู้ดูแลระบบ",
                        timer: 2000,
                        confirmButtonText: "Ok!",
                      });
                      }
                    }
                  });

        }, function (dismiss) {
          if (dismiss === 'cancel') {}
        })
      }


      function teacherGroup(group, type, department) {
          var teacher = "TEACHERLEC_" +group;
          var element = document.getElementById(teacher).value;

          swal({
            title: 'แน่ใจหรือไม่',
            text: 'คุณต้องการเพิ่มข้อมูลใช่หรือไม่',
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ตกลง',
            cancelButtonText: 'ยกเลิก'
          }).then(function () {

            $.ajax({
              url: '../../application/subject/group.php',
              type: 'POST',
              data: {
                group: group,
                teacher: element,
                type: type,
                department: department,
              },
              success: function (data) {
                try {
                  var msg = JSON.parse(data);
                  if (msg.status == "error") {
                    swal({
                      type: msg.status,
                      text: msg.msg,
                      timer: 2000,
                      confirmButtonText: "Ok!"
                    });
                    return false;
                  } else {
                    swal({
                      type: msg.status,
                      text: msg.msg,
                      timer: 2000,
                      confirmButtonText: "Ok!",
                    }, function () {
                      window.location.reload();
                    });
                    setTimeout(function () {
                      window.location.reload();
                    }, 1000);
                  }
                } catch (e) {
                  console.log(data);
                  swal({
                  type: "error",
                  text: "ผิดพลาด ! กรุณาติดต่อผู้ดูแลระบบ",
                  timer: 2000,
                  confirmButtonText: "Ok!",
                });
                }
              }
            });

          }, function (dismiss) {
            if (dismiss === 'cancel') {}
          })
      }
      function teacherGroupremove(group, type, department,assessor) {


          var text = "name_assessor" + assessor;
          var element = document.getElementById(text).value;
          swal({
            title: 'แน่ใจหรือไม่',
            text: 'คุณต้องการลบข้อมูลใช่หรือไม่',
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ตกลง',
            cancelButtonText: 'ยกเลิก'
          }).then(function () {

            $.ajax({
              url: '../../application/subject/group.php',
              type: 'POST',
              data: {
                group: group,
                teacher: element,
                type: type,
                department: department,
              },
              success: function (data) {
                try {
            var msg = JSON.parse(data);
            if (msg.status == "error") {
              swal({
                type: msg.status,
                text: msg.msg,
                timer: 2000,
                confirmButtonText: "Ok!"
              });
              return false;
            } else {
              swal({
                type: msg.status,
                text: msg.msg,
                timer: 2000,
                confirmButtonText: "Ok!",
              }, function () {
                window.location.reload();
              });
              setTimeout(function () {
                window.location.reload();
              }, 1000);
            }
          } catch (e) {
            console.log(data);
            swal({
            type: "error",
            text: "ผิดพลาด ! กรุณาติดต่อผู้ดูแลระบบ",
            timer: 2000,
            confirmButtonText: "Ok!",
          });
          }
              }
            });

          }, function (dismiss) {
            if (dismiss === 'cancel') {}
          })
      }

      $("form#course").submit(function () {
        //var file = document.forms['data']['filexcel'].files[0];
        var formData = new FormData(this);
        //console.log(formData);
        $.ajax({
          url: '../../application/subject/responsible_course_department.php',
          type: 'POST',
          data: formData,
          async: false,
          cache: false,
          contentType: false,
          processData: false,
          success: function (data) {
            try {
            var msg = JSON.parse(data);
            if (msg.status == "error") {
              swal({
                type: msg.status,
                text: msg.msg,
                timer: 2000,
                confirmButtonText: "Ok!"
              });
              return false;
            } else {
              swal({
                type: msg.status,
                text: msg.msg,
                timer: 2000,
                confirmButtonText: "Ok!",
              }, function () {
                window.location.reload();
              });
              setTimeout(function () {
                window.location.reload();
              }, 1000);
            }
          } catch (e) {
            console.log(data);
            swal({
            type: "error",
            text: "ผิดพลาด ! กรุณาติดต่อผู้ดูแลระบบ",
            timer: 2000,
            confirmButtonText: "Ok!",
          });
          }
          }
        });
        return false;
      });


      $("form#remove").submit(function () {
        var formData = new FormData(this);
        swal({
          title: 'แน่ใจหรือไม่',
          text: 'คุณต้องการลบข้อมูลใช่หรือไม่',
          type: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'ตกลง',
          cancelButtonText: 'ยกเลิก'
        }).then(function () {

          $.ajax({
            url: '../../application/subject/responsible_course_department.php',
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
              try {
                var msg = JSON.parse(data);
                if (msg.status == "error") {
                  swal({
                    type: msg.status,
                    text: msg.msg,
                    timer: 2000,
                    confirmButtonText: "Ok!"
                  });
                  return false;
                } else {
                  swal({
                    type: msg.status,
                    text: msg.msg,
                    timer: 2000,
                    confirmButtonText: "Ok!",
                  }, function () {
                    window.location.reload();
                  });
                  setTimeout(function () {
                    window.location.reload();
                  }, 1000);
                }
              } catch (e) {
                console.log(data);
                swal({
                type: "error",
                text: "ผิดพลาด ! กรุณาติดต่อผู้ดูแลระบบ",
                timer: 2000,
                confirmButtonText: "Ok!",
              });
              }
            }
          });

        }, function (dismiss) {
          if (dismiss === 'cancel') {}
        })


        return false;
      });

      function add() {

        var hidden = document.getElementById('hidden').value;
        var type = "add_oldcourse";
        var dep = <?php echo $dep_js ?>;
        //console.log(dep);
        $.ajax({
          url: '../../application/subject/responsible_course_department.php',
          type: 'POST',
          data: {
            course: hidden,
            type: type,
            dep: dep
          },
          contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
          success: function (data) {
            var msg = JSON.parse(data)
            swal({
              type: msg.status,
              text: msg.msg,
              timer: 2000,
              confirmButtonText: "Ok!",
            }, function () {
              window.location.reload();
            });
            setTimeout(function () {
              window.location.reload();
            }, 1000);
          },
          error: function () {
            alert("error");
          }
        });

        return false;
      }

      function submitForm(num, text) {

        var data = new FormData;
        var dep_id = <?php echo $dep_js ?>;
        JSON.stringify(num);
        JSON.stringify(dep_id);
        data.append("semester_id", num);
        data.append("department_id", dep_id);

        $.ajax({
          url: '../../application/subject/responsible_history.php',
          type: 'POST',
          data: data,
          async: false,
          cache: false,
          contentType: false,
          processData: false,
          success: function (data) {
            var obj = JSON.parse(data);

            if (typeof obj.msg == 'undefined') {
              var count = $('#show_old').children().length;

              if (count == 0) {
                $('#table_old')
                $('#show_old').append(
                  `

        <div class="panel panel-info">
        <div class="panel-heading" role="tab" id="heading">
          <div class="panel-title" style="font-size:14px;" >
          <b>
            ข้อมูลวิชาย้อนหลัง ${text}
          </b>
          </div>
        </div>
        <div class="panel-collapse collapse in" id="collapse" role="tabpanel" aria-labelledbyzz="heading">
          <div class="panel-body">

          <input type="hidden" id="hidden" name="hidden" value='` +
                  data +
                  `'>
          <button onclick="add()" class="btn btn-outline btn-primary">นำข้อมูลไปใช้</button>

          <table class="table" style="font-size:14px">
          <thead><th>รหัสวิชา</th><th>ชื่อวิชา</th><th></th> </thead>
            <tbody id="tbody"></tbody>
          </table>
          </div>
        </div>
        </div>
      `
                );
              }
              var k = '<tbody>'
              for (i = 0; i < obj.length; i++) {
                if (obj[i].assessor) {
                  var text_group = "คณะกรรมการชุดที่ "+obj[i].assessor;
                }  else {
                  var text_group = "-";
                }

                k += '<tr>';
                k += '<td>' + obj[i].id + '</td>';
                k += '<td>' + obj[i].name + '</td>';
                k +=
                  '<td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#old' +
                  obj[i].id + '" class="accordion-toggle">ผู้รับผิดชอบ</button></td>';
                k += '</tr>';
                k +=
                  `<tr class="hiddenRow">
                    <td colspan="12">
                      <div class="accordian-body collapse" id="old` +
                  obj[i].id +
                  `">
                        <div class="panel panel-success">
                          <div class="panel-heading">
                            <b><b>รายชื่ออาจารย์ผู้รับผิดชอบ</b></b>
                          </div>
                          <div class="panel-body">
                              <div class="row">
                                <div class="col-md-6 ">
                                <b >อาจารย์ผู้รับผิดชอบกระบวนวิชา</b>
                                  <p>` +
                  obj[i].teacher +
                  `</p>
                                </div>
                                <div class="col-md-6">
                                    <b >ชุดคณะกรรมการประเมินกระบวนวิชา</b>
                                    <p>` +
                  text_group +
                  `</p>
                                </div>
                              </div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>`;
              }
              k += '</tbody>';
              document.getElementById('tbody').innerHTML = k;

            } else {
              swal({
                type: obj.status,
                text: obj.msg,
                timer: 5000,
                confirmButtonText: "Ok!",
              }, function () {
                window.location.reload();
              });
            }
            //alert(msg.msg);
          }
        });
        return false;
      }

      function searchname(no, type) {
        var name_s = $("#TEACHERLEC_" + no).val();
        $("#dtl" + no).html('');
        if (name_s.length > 1) {
          $.post("search_name.php", {
              name: name_s
            }, function (data) {
              data = JSON.parse(data);
              for (var i = 0; i < data.length; i++) {
                $("#dtl" + no).append('<option value="' + data[i] + '"></option>');
              }

            })
            .fail(function () {
              alert("error");
            });
        }
      }
      $('#select').select2({
        width: '70%'
      });
      $('#search_course_id').select2();
    </script>
  </body>

  </html>
