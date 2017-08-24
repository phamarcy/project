<?php
session_start();
require_once(__DIR__."/../../application/class/course.php");
require_once(__DIR__."/../../application/class/person.php");
$course = new Course();
$person = new Person();
?>
  <html>
  <header>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <style>
      /*div[class="row"] {
  border: 1px dotted rgba(0, 0, 0, 0.5);
}

div[class^="col-"] {
  background-color: rgba(255, 0, 0, 0.2);
}*/
    </style>

  </header>


  <body class="mybox">
    <div id="wrapper" style="padding-left: 30px; padding-right: 30px;">
      <div class="container">
        <div class="row">
          <center>
            <h3 class="page-header">กำหนดกระบวนวิชา</h3>

          </center>
        </div>
        <br>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h5><b>ภาคการศึกษาที่ 1 ปีการศึกษา 2560 ภาควิชาบริบาลเภสัชกรรม</b></h5>
          </div>
          <!-- .panel-heading -->
          <div class="panel-body">
            <div class="panel panel-warning">
              <div class="panel-heading">
                <h5>
                                    <b>กำหนดวิชาให้กับอาจารย์</b>
                                </h5>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-8">
                    <div class="form-group">
                      <label style="font-size:16px;">วิชา</label>
                      <select class="form-control" name="course">
                                        <?php foreach ($course->Get_All_Course() as $value_course): ?>
                                          <option value="<?php echo $value_course['id'] ?>"><?php echo $value_course['id']." ".$value_course['name']['en']; ?></option>
                                        <?php endforeach; ?>
                                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label style="font-size:16px;">รายชื่ออาจารย์</label>
                      <select class="form-control" name="teacher">
                                          <?php foreach ($person->Get_All_Teacher() as $value_teacher): ?>
                                                  <option value="<?php echo $value_teacher['id'] ?>"><?php echo $value_teacher['prefix']." ".$value_teacher['name'] ?></option>
                                          <?php endforeach; ?>
                                        </select>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <button class="btn btn-outline btn-primary" type="submit" name="button">เพิ่ม</button>
                  </div>
                </div>
              </div>
            </div>


            <table class="table ">
              <thead>
                <tr>
                  <th>รหัสวิชา</th>
                  <th>ชื่อวิชา</th>
                  <th style="width:30%">อาจารย์ผู้สอน</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td rowspan="3">462533</td>
                  <td rowspan="3">HEALTH BEHAVIORS AND PHARMACEUTICAL CARE</td>
                  <td>รศ.ดร. ภก.วิรัตน์ นิวัฒนนันท์</td>
                  <td><button class="btn btn-outline btn-danger" type="button" name="button">ลบ</button></td>
                </tr>
                <tr>
                  <td>รศ.ดร. ภญ.ศิริวิภา ปิยะมงคล</td>
                  <td><button class="btn btn-outline btn-danger" type="button" name="button">ลบ</button></td>
                </tr>
                <tr>
                  <td>ผศ.ดร. ภก.ทรงวุฒิ ยศวิมลวัฒน์</td>
                  <td><button class="btn btn-outline btn-danger" type="button" name="button">ลบ</button></td>
                </tr>

                <tr>
                  <td rowspan="4">464341</td>
                  <td rowspan="4">HEALTH AND PHARMACEUTICAL INFORMATIONHEALTH AND PHARMACEUTICAL INFORMATION</td>
                  <td>ผศ.ดร. ภญ.รัตนาภรณ์ อาวิพันธ์</td>
                  <td><button class="btn btn-outline btn-danger" type="button" name="button">ลบ</button></td>
                </tr>
                  <td>ผศ.ดร. ภญ.รัตนาภรณ์ อาวิพันธ์</td>
                  <td><button class="btn btn-outline btn-danger" type="button" name="button">ลบ</button></td>
                </tr>
                </tr>
                  <td>รศ.ดร. ภญ.หทัยกาญจน์ เชาวนพูนผล์</td>
                  <td><button class="btn btn-outline btn-danger" type="button" name="button">ลบ</button></td>
                </tr>
                </tr>
                  <td>ผศ.ดร. ภก.สกนธ์ สุภากุล</td>
                  <td><button class="btn btn-outline btn-danger" type="button" name="button">ลบ</button></td>
                </tr>

                <tr>
                  <td rowspan="2">464341</td>
                  <td rowspan="2">HEALTH AND PHARMACEUTICAL INFORMATIONHEALTH AND PHARMACEUTICAL INFORMATION</td>
                  <td>ผศ.ดร. ภญ.อำไพ พฤติวรพงศ์กุล</td>
                  <td><button class="btn btn-outline btn-danger" type="button" name="button">ลบ</button></td>
                </tr>
                  <td>อ.ดร. ภก.สมจริง รุ่งแจ้ง</td>
                  <td><button class="btn btn-outline btn-danger" type="button" name="button">ลบ</button></td>
                </tr>



              </tbody>
            </table>
          </div>
        </div>
  </body>
  <script type="text/javascript">
    $('select').select2();
  </script>

  </html>
