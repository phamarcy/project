<?php
session_start();
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
    <link rel="stylesheet" href="../dist/css/scrollbar.css">

    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="../js/function.js"></script>


    <!--ใช้ตัวนี้-->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>


    <style>

    </style>

  </header>


  <body class="mybox">
    <div id="wrapper" style="padding-left: 30px; padding-right: 30px;">
      <div class="container">
        <div class="row">
          <center>
            <?php $approve_text="";
             if ($_SESSION['level']==6):
            $approve_text="อนุมัติ";
            ?>
            <h3 class="page-header">อนุมัติกระบวนวิชา</h3>
            <?php else:
            $approve_text="เห็นชอบ";?>
            <h3 class="page-header">ประเมินกระบวนวิชา</h3>
            <?php endif; ?>
          </center>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h5 class="panel-title">
              <b>ภาคการศึกษาที่ 2 ปีการศึกษา 2560</b>
          </h5>
          </div>
          <!-- .panel-heading -->
          <div class="panel-body">
            <h5><b>หมายเหตุ</b></h5>
            <ol style="font-size:16px;">
              <li>Course Syllabus (Course)</li>
              <li>แบบแจ้งวิธีการวัดผลและประเมินผลการศึกษา (Evaluate)</li>
              <li>แบบขออนุมัติอาจารย์พิเศษ (Instructor)</li>
              <p class="text-info">* คำย่อภาษาอังกฤษใช้เป็นตัวย่อในตาราง</p>
            </ol>
            <div class="panel-group" id="accordion">
              <div class="panel panel-warning">
                <div class="panel-heading">
                  <div class="panel-title" style="font-size:14px">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">รอการประเมิน</a>
                  </div>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in">
                  <div class="panel-body">
                    <div class="table-responsive">
                      <table class="table " style="font-size:14px;">
                        <thead>
                          <tr>
                            <th>ลำดับ</th>
                            <th>รหัสวิชา</th>
                            <th>ชื่อวิชา</th>
                            <th style="text-align:center;">Course</th>
                            <th style="text-align:center;">Evaluate</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>202141</td>
                            <td>BIOLOGY FOR PHARMACY STUDENTS</td>
                            <td style="text-align:center;">
                              <a href="../../application/pdf/view.php?course=462452&info=syllabus" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
                            </td>
                            <td style="text-align:center;">
                              <a href="../../application/pdf/view.php?course=462452&type=draft&info=evaluate" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
                            </td>
                            <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#202141" class="accordion-toggle">ดูข้อมูล</button></td>
                          </tr>
                          <tr class="hiddenRow">
                            <td colspan="12">
                              <div class="accordian-body collapse" id="202141">
                                <div class="panel panel-success">
                                  <div class="panel-heading">
                                    <b>ข้อเสนอแนะคณะกรรมการ</b>
                                  </div>
                                  <div class="panel-body">

                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <div class="panel-title" style="font-size:14px">
                                                    <a data-toggle="collapse" data-parent="#comment202141" href="#comment202141-2">แบบแจ้งวิธีการวัดผลและประเมินผลการศึกษาและ Course Syllabus</a>
                                                    <button type="button" class="btn btn-outline btn-success "><?php echo $approve_text ?></bunton>
                                                    <button type="button" class="btn btn-outline btn-danger ">ไม่<?php echo $approve_text ?></button>
                                                </div>
                                            </div>
                                            <div id="comment202141-2" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                  <div class="form-group ">
                                                    <label for="">ข้อเสนอแนะ</label>
                                                    <textarea class="form-control"name="name" rows="8" cols="40"></textarea>
                                                    <br>
                                                    <button type="button" class="btn btn-primary btn-outline" name="button">ยืนยัน</button>
                                                  </div>
                                                  <table class="table ">
                                                    <thead>
                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                      <th style="width:170px">คณะกรรมการ</th>
                                                      <?php endif; ?>
                                                      <th>ข้อเสนอแนะ</th>
                                                    </thead>
                                                    <tbody>
                                                      <tr>
                                                        <?php if ($_SESSION['level'] > 4 ): ?>
                                                        <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                        <?php endif; ?>
                                                        <td>วิธีตัดเกรดในส่วนของการอิงเกณฑ์นั้นยังไม่ชัดเจน</td>
                                                      </tr>
                                                      <tr>
                                                        <?php if ($_SESSION['level'] > 4 ): ?>
                                                        <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                        <?php endif; ?>
                                                        <td>ควรเพิ่มอาจารย์ปฏิบัติการ</td>
                                                      </tr>
                                                    </tbody>
                                                  </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading ">
                                                <div class="panel-title" style="font-size:14px">
                                                    <a data-toggle="collapse" data-parent="#comment202141" href="#comment202141-3">Instructor</a>
                                                </div>
                                            </div>
                                            <div id="comment202141-3" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                  <div class="panel-group" id="teachersp202141">
                                                      <div class="panel panel-default">
                                                          <div class="panel-heading">
                                                              <div class="panel-title" style="font-size:14px">
                                                                  <a data-toggle="collapse" data-parent="#teachersp202141" href="#teachersp202141-1">ดร.พจมาน ชำนาญกิจ</a>
                                                                  <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank" class="btn btn-primary btn-outline">PDF</a>
                                                                  <button type="button" class="btn btn-outline btn-success "><?php echo $approve_text ?></bunton>
                                                                  <button type="button" class="btn btn-outline btn-danger ">ไม่<?php echo $approve_text ?></button>
                                                              </div>
                                                          </div>
                                                          <div id="teachersp202141-1" class="panel-collapse collapse">
                                                              <div class="panel-body">
                                                                <div class="form-group ">
                                                                  <label for="">ข้อเสนอแนะ</label>
                                                                  <textarea class="form-control"name="name" rows="8" cols="40"></textarea>
                                                                  <br>
                                                                  <button type="button" class="btn btn-primary btn-outline" name="button">ยืนยัน</button>
                                                                </div>
                                                                <table class="table ">
                                                                  <thead>
                                                                    <?php if ($_SESSION['level'] > 4 ): ?>
                                                                    <th style="width:170px">คณะกรรมการ</th>
                                                                    <?php endif; ?>
                                                                    <th>ข้อเสนอแนะ</th>
                                                                  </thead>
                                                                  <tbody>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์ไม่ยังไม่เหมาะกับวิชา</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์เคยมีประสบการณ์</td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="panel panel-default">
                                                          <div class="panel-heading">
                                                              <div class="panel-title" style="font-size:14px">
                                                                  <a data-toggle="collapse" data-parent="#teachersp202141" href="#teachersp202141-2">ผศ.ดร.พนมพร จินดาสมุทร์</a>
                                                                  <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank" class="btn btn-primary btn-outline">PDF</a>
                                                                  <button type="button" class="btn btn-outline btn-success "><?php echo $approve_text ?></bunton>
                                                                  <button type="button" class="btn btn-outline btn-danger ">ไม่<?php echo $approve_text ?></button>
                                                              </div>
                                                          </div>
                                                          <div id="teachersp202141-2" class="panel-collapse collapse">
                                                              <div class="panel-body">
                                                                <div class="form-group ">
                                                                  <label for="">ข้อเสนอแนะ</label>
                                                                  <textarea class="form-control"name="name" rows="8" cols="40"></textarea>
                                                                  <br>
                                                                  <button type="button" class="btn btn-primary btn-outline" name="button">ยืนยัน</button>
                                                                </div>
                                                                <table class="table ">
                                                                  <thead>
                                                                    <?php if ($_SESSION['level'] > 4 ): ?>
                                                                    <th style="width:170px">คณะกรรมการ</th>
                                                                    <?php endif; ?>
                                                                    <th>ข้อเสนอแนะ</th>
                                                                  </thead>
                                                                  <tbody>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์ท่านนี้เหมาะสมกับวิชานี้</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์ท่านนี้เป็นผู้มีประสบการณ์</td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="panel panel-default">
                                                          <div class="panel-heading">
                                                              <div class="panel-title" style="font-size:14px">
                                                                  <a data-toggle="collapse" data-parent="#teachersp202141" href="#teachersp202141-3">อ.พรพิมล ศิวินา</a>
                                                                  <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank" class="btn btn-primary btn-outline">PDF</a>
                                                                  <button type="button" class="btn btn-outline btn-success "><?php echo $approve_text ?></bunton>
                                                                  <button type="button" class="btn btn-outline btn-danger ">ไม่<?php echo $approve_text ?></button>
                                                              </div>
                                                          </div>
                                                          <div id="teachersp202141-3" class="panel-collapse collapse">
                                                              <div class="panel-body">
                                                                <div class="form-group ">
                                                                  <label for="">ข้อเสนอแนะ</label>
                                                                  <textarea class="form-control"name="name" rows="8" cols="40"></textarea>
                                                                  <br>
                                                                  <button type="button" class="btn btn-primary btn-outline" name="button">ยืนยัน</button>
                                                                </div>
                                                                <table class="table ">
                                                                  <thead>
                                                                    <?php if ($_SESSION['level'] > 4 ): ?>
                                                                    <th style="width:170px">คณะกรรมการ</th>
                                                                    <?php endif; ?>
                                                                    <th>ข้อเสนอแนะ</th>
                                                                  </thead>
                                                                  <tbody>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์ท่านนี้ยังไม่มีประสบการณ์</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>ควรทดลองให้อาจารย์มาสอนก่อน</td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>203151</td>
                            <td>GENERAL CHEMISTRY FOR THE HEALTH SCIENCES</td>
                            <td style="text-align:center;">
                              <a href="../../application/pdf/view.php?course=462452&info=syllabus" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
                            </td>
                            <td style="text-align:center;">
                              <a href="../../application/pdf/view.php?course=462452&type=draft&info=evaluate" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
                            </td>
                            <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#203151" class="accordion-toggle">ดูข้อมูล</button></td>
                          </tr>
                          <tr class="hiddenRow">
                            <td colspan="12">
                              <div class="accordian-body collapse" id="203151">
                                <div class="panel panel-success">
                                  <div class="panel-heading">
                                    <b>ข้อเสนอแนะคณะกรรมการ</b>
                                  </div>
                                  <div class="panel-body">
                                    <div class="panel-group" id="comment203151">

                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <div class="panel-title" style="font-size:14px">
                                                    <a data-toggle="collapse" data-parent="#comment203151" href="#comment203151-2">แบบแจ้งวิธีการวัดผลและประเมินผลการศึกษาและCourse Syllabus</a>
                                                    <button type="button" class="btn btn-outline btn-success "><?php echo $approve_text ?></bunton>
                                                    <button type="button" class="btn btn-outline btn-danger ">ไม่<?php echo $approve_text ?></button>
                                                </div>
                                            </div>
                                            <div id="comment203151-2" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                  <div class="form-group ">
                                                    <label for="">ข้อเสนอแนะ</label>
                                                    <textarea class="form-control"name="name" rows="8" cols="40"></textarea>
                                                    <br>
                                                    <button type="button" class="btn btn-primary btn-outline" name="button">ยืนยัน</button>
                                                  </div>
                                                  <table class="table ">
                                                    <thead>
                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                      <th style="width:170px">คณะกรรมการ</th>
                                                      <?php endif; ?>
                                                      <th>ข้อเสนอแนะ</th>
                                                    </thead>
                                                    <tbody>
                                                      <tr>
                                                        <?php if ($_SESSION['level'] > 4 ): ?>
                                                        <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                        <?php endif; ?>
                                                        <td>วิธีตัดเกรดในส่วนของการอิงเกณฑ์นั้นยังไม่ชัดเจน</td>
                                                      </tr>
                                                      <tr>
                                                        <?php if ($_SESSION['level'] > 4 ): ?>
                                                        <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                        <?php endif; ?>
                                                        <td>ควรเพิ่มอาจารย์ปฏิบัติการ</td>
                                                      </tr>
                                                    </tbody>
                                                  </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading ">
                                                <div class="panel-title" style="font-size:14px">
                                                    <a data-toggle="collapse" data-parent="#comment203151" href="#comment203151-3">Instructor</a>
                                                </div>
                                            </div>
                                            <div id="comment203151-3" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                  <div class="panel-group" id="teachersp203151">
                                                      <div class="panel panel-default">
                                                          <div class="panel-heading">
                                                              <div class="panel-title" style="font-size:14px">
                                                                  <a data-toggle="collapse" data-parent="#teachersp203151" href="#teachersp203151-1">ดร.พจมาน ชำนาญกิจ</a>
                                                                  <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank" class="btn btn-primary btn-outline">PDF</a>
                                                                  <button type="button" class="btn btn-outline btn-success "><?php echo $approve_text ?></bunton>
                                                                  <button type="button" class="btn btn-outline btn-danger ">ไม่<?php echo $approve_text ?></button>
                                                              </div>
                                                          </div>
                                                          <div id="teachersp203151-1" class="panel-collapse collapse">
                                                              <div class="panel-body">
                                                                <div class="form-group ">
                                                                  <label for="">ข้อเสนอแนะ</label>
                                                                  <textarea class="form-control"name="name" rows="8" cols="40"></textarea>
                                                                  <br>
                                                                  <button type="button" class="btn btn-primary btn-outline" name="button">ยืนยัน</button>
                                                                </div>
                                                                <table class="table ">
                                                                  <thead>
                                                                    <?php if ($_SESSION['level'] > 4 ): ?>
                                                                    <th style="width:170px">คณะกรรมการ</th>
                                                                    <?php endif; ?>
                                                                    <th>ข้อเสนอแนะ</th>
                                                                  </thead>
                                                                  <tbody>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์ไม่ยังไม่เหมาะกับวิชา</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์เคยมีประสบการณ์</td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="panel panel-default">
                                                          <div class="panel-heading">
                                                              <div class="panel-title" style="font-size:14px">
                                                                  <a data-toggle="collapse" data-parent="#teachersp203151" href="#teachersp203151-2">ผศ.ดร.พนมพร จินดาสมุทร์</a>
                                                                  <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank" class="btn btn-primary btn-outline">PDF</a>
                                                                  <button type="button" class="btn btn-outline btn-success "><?php echo $approve_text ?></bunton>
                                                                  <button type="button" class="btn btn-outline btn-danger ">ไม่<?php echo $approve_text ?></button>
                                                              </div>
                                                          </div>
                                                          <div id="teachersp203151-2" class="panel-collapse collapse">
                                                              <div class="panel-body">
                                                                <div class="form-group ">
                                                                  <label for="">ข้อเสนอแนะ</label>
                                                                  <textarea class="form-control"name="name" rows="8" cols="40"></textarea>
                                                                  <br>
                                                                  <button type="button" class="btn btn-primary btn-outline" name="button">ยืนยัน</button>
                                                                </div>
                                                                <table class="table ">
                                                                  <thead>
                                                                    <?php if ($_SESSION['level'] > 4 ): ?>
                                                                    <th style="width:170px">คณะกรรมการ</th>
                                                                    <?php endif; ?>
                                                                    <th>ข้อเสนอแนะ</th>
                                                                  </thead>
                                                                  <tbody>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์ท่านนี้เหมาะสมกับวิชานี้</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์ท่านนี้เป็นผู้มีประสบการณ์</td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="panel panel-default">
                                                          <div class="panel-heading">
                                                              <div class="panel-title" style="font-size:14px">
                                                                  <a data-toggle="collapse" data-parent="#teachersp203151" href="#teachersp203151-3">อ.พรพิมล ศิวินา</a>
                                                                  <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank" class="btn btn-primary btn-outline">PDF</a>
                                                                  <button type="button" class="btn btn-outline btn-success "><?php echo $approve_text ?></bunton>
                                                                  <button type="button" class="btn btn-outline btn-danger ">ไม่<?php echo $approve_text ?></button>
                                                              </div>
                                                          </div>
                                                          <div id="teachersp203151-3" class="panel-collapse collapse">
                                                              <div class="panel-body">
                                                                <div class="form-group ">
                                                                  <label for="">ข้อเสนอแนะ</label>
                                                                  <textarea class="form-control"name="name" rows="8" cols="40"></textarea>
                                                                  <br>
                                                                  <button type="button" class="btn btn-primary btn-outline" name="button">ยืนยัน</button>
                                                                </div>
                                                                <table class="table ">
                                                                  <thead>
                                                                    <?php if ($_SESSION['level'] > 4 ): ?>
                                                                    <th style="width:170px">คณะกรรมการ</th>
                                                                    <?php endif; ?>
                                                                    <th>ข้อเสนอแนะ</th>
                                                                  </thead>
                                                                  <tbody>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์ท่านนี้ยังไม่มีประสบการณ์</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>ควรทดลองให้อาจารย์มาสอนก่อน</td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>3</td>
                            <td>463681</td>
                            <td>INDUSTRIAL PHARMACY CLERKSHIP IN PRODUCTION 1</td>
                            <td style="text-align:center;">
                              <a href="../../application/pdf/view.php?course=462452&info=syllabus" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
                            </td>
                            <td style="text-align:center;">
                              <a href="../../application/pdf/view.php?course=462452&type=draft&info=evaluate" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
                            </td>
                            <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#463681" class="accordion-toggle">ดูข้อมูล</button></td>
                          </tr>
                          <tr class="hiddenRow">
                            <td colspan="12">
                              <div class="accordian-body collapse" id="463681">
                                <div class="panel panel-success">
                                  <div class="panel-heading">
                                    <b>ข้อเสนอแนะคณะกรรมการ</b>
                                  </div>
                                  <div class="panel-body">
                                    <div class="panel-group" id="comment463681">

                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <div class="panel-title" style="font-size:14px">
                                                    <a data-toggle="collapse" data-parent="#comment463681" href="#comment463681-2">แบบแจ้งวิธีการวัดผลและประเมินผลการศึกษา</a>
                                                    <button type="button" class="btn btn-outline btn-success "><?php echo $approve_text ?></bunton>
                                                    <button type="button" class="btn btn-outline btn-danger ">ไม่<?php echo $approve_text ?></button>
                                                </div>
                                            </div>
                                            <div id="comment463681-2" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                  <div class="form-group ">
                                                    <label for="">ข้อเสนอแนะ</label>
                                                    <textarea class="form-control"name="name" rows="8" cols="40"></textarea>
                                                    <br>
                                                    <button type="button" class="btn btn-primary btn-outline" name="button">ยืนยัน</button>
                                                  </div>
                                                  <table class="table ">
                                                    <thead>
                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                      <th style="width:170px">คณะกรรมการ</th>
                                                      <?php endif; ?>
                                                      <th>ข้อเสนอแนะ</th>
                                                    </thead>
                                                    <tbody>
                                                      <tr>
                                                        <?php if ($_SESSION['level'] > 4 ): ?>
                                                        <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                        <?php endif; ?>
                                                        <td>วิธีตัดเกรดในส่วนของการอิงเกณฑ์นั้นยังไม่ชัดเจน</td>
                                                      </tr>
                                                      <tr>
                                                        <?php if ($_SESSION['level'] > 4 ): ?>
                                                        <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                        <?php endif; ?>
                                                        <td>ควรเพิ่มอาจารย์ปฏิบัติการ</td>
                                                      </tr>
                                                    </tbody>
                                                  </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading ">
                                                <div class="panel-title" style="font-size:14px">
                                                    <a data-toggle="collapse" data-parent="#comment463681" href="#comment463681-3">Instructor</a>
                                                </div>
                                            </div>
                                            <div id="comment463681-3" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                  <div class="panel-group" id="teachersp463681">
                                                      <div class="panel panel-default">
                                                          <div class="panel-heading">
                                                              <div class="panel-title" style="font-size:14px">
                                                                  <a data-toggle="collapse" data-parent="#teachersp463681" href="#teachersp463681-1">ดร.พจมาน ชำนาญกิจ</a>
                                                                  <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank" class="btn btn-primary btn-outline">PDF</a>
                                                                  <button type="button" class="btn btn-outline btn-success "><?php echo $approve_text ?></bunton>
                                                                  <button type="button" class="btn btn-outline btn-danger ">ไม่<?php echo $approve_text ?></button>
                                                              </div>
                                                          </div>
                                                          <div id="teachersp463681-1" class="panel-collapse collapse">
                                                              <div class="panel-body">
                                                                <div class="form-group ">
                                                                  <label for="">ข้อเสนอแนะ</label>
                                                                  <textarea class="form-control"name="name" rows="8" cols="40"></textarea>
                                                                  <br>
                                                                  <button type="button" class="btn btn-primary btn-outline" name="button">ยืนยัน</button>
                                                                </div>
                                                                <table class="table ">
                                                                  <thead>
                                                                    <?php if ($_SESSION['level'] > 4 ): ?>
                                                                    <th style="width:170px">คณะกรรมการ</th>
                                                                    <?php endif; ?>
                                                                    <th>ข้อเสนอแนะ</th>
                                                                  </thead>
                                                                  <tbody>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์ไม่ยังไม่เหมาะกับวิชา</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์เคยมีประสบการณ์</td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="panel panel-default">
                                                          <div class="panel-heading">
                                                              <div class="panel-title" style="font-size:14px">
                                                                  <a data-toggle="collapse" data-parent="#teachersp463681" href="#teachersp463681-2">ผศ.ดร.พนมพร จินดาสมุทร์</a>
                                                                  <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank" class="btn btn-primary btn-outline">PDF</a>
                                                                  <button type="button" class="btn btn-outline btn-success "><?php echo $approve_text ?></bunton>
                                                                  <button type="button" class="btn btn-outline btn-danger ">ไม่<?php echo $approve_text ?></button>
                                                              </div>
                                                          </div>
                                                          <div id="teachersp463681-2" class="panel-collapse collapse">
                                                              <div class="panel-body">
                                                                <div class="form-group ">
                                                                  <label for="">ข้อเสนอแนะ</label>
                                                                  <textarea class="form-control"name="name" rows="8" cols="40"></textarea>
                                                                  <br>
                                                                  <button type="button" class="btn btn-primary btn-outline" name="button">ยืนยัน</button>
                                                                </div>
                                                                <table class="table ">
                                                                  <thead>
                                                                    <?php if ($_SESSION['level'] > 4 ): ?>
                                                                    <th style="width:170px">คณะกรรมการ</th>
                                                                    <?php endif; ?>
                                                                    <th>ข้อเสนอแนะ</th>
                                                                  </thead>
                                                                  <tbody>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์ท่านนี้เหมาะสมกับวิชานี้</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์ท่านนี้เป็นผู้มีประสบการณ์</td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="panel panel-default">
                                                          <div class="panel-heading">
                                                              <div class="panel-title" style="font-size:14px">
                                                                  <a data-toggle="collapse" data-parent="#teachersp463681" href="#teachersp463681-3">อ.พรพิมล ศิวินา</a>
                                                                  <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank" class="btn btn-primary btn-outline">PDF</a>
                                                                  <button type="button" class="btn btn-outline btn-success "><?php echo $approve_text ?></bunton>
                                                                  <button type="button" class="btn btn-outline btn-danger ">ไม่<?php echo $approve_text ?></button>
                                                              </div>
                                                          </div>
                                                          <div id="teachersp463681-3" class="panel-collapse collapse">
                                                              <div class="panel-body">
                                                                <div class="form-group ">
                                                                  <label for="">ข้อเสนอแนะ</label>
                                                                  <textarea class="form-control"name="name" rows="8" cols="40"></textarea>
                                                                  <br>
                                                                  <button type="button" class="btn btn-primary btn-outline" name="button">ยืนยัน</button>
                                                                </div>
                                                                <table class="table ">
                                                                  <thead>
                                                                    <?php if ($_SESSION['level'] > 4 ): ?>
                                                                    <th style="width:170px">คณะกรรมการ</th>
                                                                    <?php endif; ?>
                                                                    <th>ข้อเสนอแนะ</th>
                                                                  </thead>
                                                                  <tbody>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์ท่านนี้ยังไม่มีประสบการณ์</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>ควรทดลองให้อาจารย์มาสอนก่อน</td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <div class="panel panel-success">
                <div class="panel-heading">
                  <div class="panel-title" style="font-size:14px">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">ผ่านการประเมิน</a>
                  </div>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse">
                  <div class="panel-body">
                    <div class="table-responsive">
                      <table class="table " style="font-size:14px;">
                        <thead>
                          <tr>
                            <th>ลำดับ</th>
                            <th>รหัสวิชา</th>
                            <th>ชื่อวิชา</th>
                            <th style="text-align:center;">Course</th>
                            <th style="text-align:center;">Evaluate</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>463311</td>
                            <td>PHARMACEUTICAL BIOTECHNOLOGY 1</td>
                            <td style="text-align:center;">
                              <a href="../../application/pdf/view.php?course=462452&info=syllabus" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
                            </td>
                            <td style="text-align:center;">
                              <a href="../../application/pdf/view.php?course=462452&type=draft&info=evaluate" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
                            </td>
                            <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#463311" class="accordion-toggle">ดูข้อมูล</button></td>
                          </tr>
                          <tr class="hiddenRow">
                            <td colspan="12">
                              <div class="accordian-body collapse" id="463311">
                                <div class="panel panel-success">
                                  <div class="panel-heading">
                                    <b>ข้อเสนอแนะคณะกรรมการ</b>
                                  </div>
                                  <div class="panel-body">
                                    <div class="panel-group" id="comment463311">

                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <div class="panel-title" style="font-size:14px">
                                                    <a data-toggle="collapse" data-parent="#comment463311" href="#comment463311-2">แบบแจ้งวิธีการวัดผลและประเมินผลการศึกษา</a>

                                                </div>
                                            </div>
                                            <div id="comment463311-2" class="panel-collapse collapse">
                                                <div class="panel-body">

                                                  <table class="table ">
                                                    <thead>
                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                      <th style="width:170px">คณะกรรมการ</th>
                                                      <?php endif; ?>
                                                      <th>ข้อเสนอแนะ</th>
                                                    </thead>
                                                    <tbody>
                                                      <tr>
                                                        <?php if ($_SESSION['level'] > 4 ): ?>
                                                        <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                        <?php endif; ?>
                                                        <td>วิธีตัดเกรดในส่วนของการอิงเกณฑ์นั้นยังไม่ชัดเจน</td>
                                                      </tr>
                                                      <tr>
                                                        <?php if ($_SESSION['level'] > 4 ): ?>
                                                        <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                        <?php endif; ?>
                                                        <td>ควรเพิ่มอาจารย์ปฏิบัติการ</td>
                                                      </tr>
                                                    </tbody>
                                                  </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading ">
                                                <div class="panel-title" style="font-size:14px">
                                                    <a data-toggle="collapse" data-parent="#comment463311" href="#comment463311-3">Instructor</a>
                                                </div>
                                            </div>
                                            <div id="comment463311-3" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                  <div class="panel-group" id="teachersp463311">
                                                      <div class="panel panel-default">
                                                          <div class="panel-heading">
                                                              <div class="panel-title" style="font-size:14px">
                                                                  <a data-toggle="collapse" data-parent="#teachersp463311" href="#teachersp463311-1">ดร.พจมาน ชำนาญกิจ</a>
                                                                  <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank" class="btn btn-primary btn-outline">PDF</a>

                                                              </div>
                                                          </div>
                                                          <div id="teachersp463311-1" class="panel-collapse collapse">
                                                              <div class="panel-body">

                                                                <table class="table ">
                                                                  <thead>
                                                                    <?php if ($_SESSION['level'] > 4 ): ?>
                                                                    <th style="width:170px">คณะกรรมการ</th>
                                                                    <?php endif; ?>
                                                                    <th>ข้อเสนอแนะ</th>
                                                                  </thead>
                                                                  <tbody>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์ไม่ยังไม่เหมาะกับวิชา</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์เคยมีประสบการณ์</td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="panel panel-default">
                                                          <div class="panel-heading">
                                                              <div class="panel-title" style="font-size:14px">
                                                                  <a data-toggle="collapse" data-parent="#teachersp463311" href="#teachersp463311-2">ผศ.ดร.พนมพร จินดาสมุทร์</a>
                                                                  <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank" class="btn btn-primary btn-outline">PDF</a>

                                                              </div>
                                                          </div>
                                                          <div id="teachersp463311-2" class="panel-collapse collapse">
                                                              <div class="panel-body">

                                                                <table class="table ">
                                                                  <thead>
                                                                    <?php if ($_SESSION['level'] > 4 ): ?>
                                                                    <th style="width:170px">คณะกรรมการ</th>
                                                                    <?php endif; ?>
                                                                    <th>ข้อเสนอแนะ</th>
                                                                  </thead>
                                                                  <tbody>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์ท่านนี้เหมาะสมกับวิชานี้</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์ท่านนี้เป็นผู้มีประสบการณ์</td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="panel panel-default">
                                                          <div class="panel-heading">
                                                              <div class="panel-title" style="font-size:14px">
                                                                  <a data-toggle="collapse" data-parent="#teachersp463311" href="#teachersp463311-3">อ.พรพิมล ศิวินา</a>
                                                                  <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank" class="btn btn-primary btn-outline">PDF</a>

                                                              </div>
                                                          </div>
                                                          <div id="teachersp463311-3" class="panel-collapse collapse">
                                                              <div class="panel-body">

                                                                <table class="table ">
                                                                  <thead>
                                                                    <?php if ($_SESSION['level'] > 4 ): ?>
                                                                    <th style="width:170px">คณะกรรมการ</th>
                                                                    <?php endif; ?>
                                                                    <th>ข้อเสนอแนะ</th>
                                                                  </thead>
                                                                  <tbody>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์ท่านนี้ยังไม่มีประสบการณ์</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>ควรทดลองให้อาจารย์มาสอนก่อน</td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>463331</td>
                            <td>ORGANIC MEDICINAL CHEMISTRY 1</td>
                            <td style="text-align:center;">
                              <a href="../../application/pdf/view.php?course=462452&info=syllabus" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
                            </td>
                            <td style="text-align:center;">
                              <a href="../../application/pdf/view.php?course=462452&type=draft&info=evaluate" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
                            </td>
                            <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#463331" class="accordion-toggle">ดูข้อมูล</button></td>
                          </tr>
                          <tr class="hiddenRow">
                            <td colspan="12">
                              <div class="accordian-body collapse" id="463331">
                                <div class="panel panel-success">
                                  <div class="panel-heading">
                                    <b>ข้อเสนอแนะคณะกรรมการ</b>
                                  </div>
                                  <div class="panel-body">
                                    <div class="panel-group" id="comment463331">

                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <div class="panel-title" style="font-size:14px">
                                                    <a data-toggle="collapse" data-parent="#comment463331" href="#comment463331-2">แบบแจ้งวิธีการวัดผลและประเมินผลการศึกษาและCourse Syllabus</a>

                                                </div>
                                            </div>
                                            <div id="comment463331-2" class="panel-collapse collapse">
                                                <div class="panel-body">

                                                  <table class="table ">
                                                    <thead>
                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                      <th style="width:170px">คณะกรรมการ</th>
                                                      <?php endif; ?>
                                                      <th>ข้อเสนอแนะ</th>
                                                    </thead>
                                                    <tbody>
                                                      <tr>
                                                        <?php if ($_SESSION['level'] > 4 ): ?>
                                                        <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                        <?php endif; ?>
                                                        <td>วิธีตัดเกรดในส่วนของการอิงเกณฑ์นั้นยังไม่ชัดเจน</td>
                                                      </tr>
                                                      <tr>
                                                        <?php if ($_SESSION['level'] > 4 ): ?>
                                                        <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                        <?php endif; ?>
                                                        <td>ควรเพิ่มอาจารย์ปฏิบัติการ</td>
                                                      </tr>
                                                    </tbody>
                                                  </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading ">
                                                <div class="panel-title" style="font-size:14px">
                                                    <a data-toggle="collapse" data-parent="#comment463331" href="#comment463331-3">Instructor</a>
                                                </div>
                                            </div>
                                            <div id="comment463331-3" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                  <div class="panel-group" id="teachersp463331">
                                                      <div class="panel panel-default">
                                                          <div class="panel-heading">
                                                              <div class="panel-title" style="font-size:14px">
                                                                  <a data-toggle="collapse" data-parent="#teachersp463331" href="#teachersp463331-1">ดร.พจมาน ชำนาญกิจ</a>
                                                                  <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank" class="btn btn-primary btn-outline">PDF</a>

                                                              </div>
                                                          </div>
                                                          <div id="teachersp463331-1" class="panel-collapse collapse">
                                                              <div class="panel-body">

                                                                <table class="table ">
                                                                  <thead>
                                                                    <?php if ($_SESSION['level'] > 4 ): ?>
                                                                    <th style="width:170px">คณะกรรมการ</th>
                                                                    <?php endif; ?>
                                                                    <th>ข้อเสนอแนะ</th>
                                                                  </thead>
                                                                  <tbody>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์ไม่ยังไม่เหมาะกับวิชา</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์เคยมีประสบการณ์</td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="panel panel-default">
                                                          <div class="panel-heading">
                                                              <div class="panel-title" style="font-size:14px">
                                                                  <a data-toggle="collapse" data-parent="#teachersp463331" href="#teachersp463331-2">ผศ.ดร.พนมพร จินดาสมุทร์</a>
                                                                  <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank" class="btn btn-primary btn-outline">PDF</a>

                                                              </div>
                                                          </div>
                                                          <div id="teachersp463331-2" class="panel-collapse collapse">
                                                              <div class="panel-body">

                                                                <table class="table ">
                                                                  <thead>
                                                                    <?php if ($_SESSION['level'] > 4 ): ?>
                                                                    <th style="width:170px">คณะกรรมการ</th>
                                                                    <?php endif; ?>
                                                                    <th>ข้อเสนอแนะ</th>
                                                                  </thead>
                                                                  <tbody>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์ท่านนี้เหมาะสมกับวิชานี้</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์ท่านนี้เป็นผู้มีประสบการณ์</td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="panel panel-default">
                                                          <div class="panel-heading">
                                                              <div class="panel-title" style="font-size:14px">
                                                                  <a data-toggle="collapse" data-parent="#teachersp463331" href="#teachersp463331-3">อ.พรพิมล ศิวินา</a>
                                                                  <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank" class="btn btn-primary btn-outline">PDF</a>

                                                              </div>
                                                          </div>
                                                          <div id="teachersp463331-3" class="panel-collapse collapse">
                                                              <div class="panel-body">

                                                                <table class="table ">
                                                                  <thead>
                                                                    <?php if ($_SESSION['level'] > 4 ): ?>
                                                                    <th style="width:170px">คณะกรรมการ</th>
                                                                    <?php endif; ?>
                                                                    <th>ข้อเสนอแนะ</th>
                                                                  </thead>
                                                                  <tbody>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์ท่านนี้ยังไม่มีประสบการณ์</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>ควรทดลองให้อาจารย์มาสอนก่อน</td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>464301</td>
                            <td>FUNDAMENTAL OF PHARMACOKINETICS</td>
                            <td style="text-align:center;">
                              <a href="../../application/pdf/view.php?course=462452&info=syllabus" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
                            </td>
                            <td style="text-align:center;">
                              <a href="../../application/pdf/view.php?course=462452&type=draft&info=evaluate" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
                            </td>
                            <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#464301" class="accordion-toggle">ดูข้อมูล</button></td>
                          </tr>
                          <tr class="hiddenRow">
                            <td colspan="12">
                              <div class="accordian-body collapse" id="464301">
                                <div class="panel panel-success">
                                  <div class="panel-heading">
                                    <b>ข้อเสนอแนะคณะกรรมการ</b>
                                  </div>
                                  <div class="panel-body">
                                    <div class="panel-group" id="comment464301">

                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <div class="panel-title" style="font-size:14px">
                                                    <a data-toggle="collapse" data-parent="#comment464301" href="#comment464301-2">แบบแจ้งวิธีการวัดผลและประเมินผลการศึกษาและCourse Syllabus</a>

                                                </div>
                                            </div>
                                            <div id="comment464301-2" class="panel-collapse collapse">
                                                <div class="panel-body">

                                                  <table class="table ">
                                                    <thead>
                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                      <th style="width:170px">คณะกรรมการ</th>
                                                      <?php endif; ?>
                                                      <th>ข้อเสนอแนะ</th>
                                                    </thead>
                                                    <tbody>
                                                      <tr>
                                                        <?php if ($_SESSION['level'] > 4 ): ?>
                                                        <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                        <?php endif; ?>
                                                        <td>วิธีตัดเกรดในส่วนของการอิงเกณฑ์นั้นยังไม่ชัดเจน</td>
                                                      </tr>
                                                      <tr>
                                                        <?php if ($_SESSION['level'] > 4 ): ?>
                                                        <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                        <?php endif; ?>
                                                        <td>ควรเพิ่มอาจารย์ปฏิบัติการ</td>
                                                      </tr>
                                                    </tbody>
                                                  </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading ">
                                                <div class="panel-title" style="font-size:14px">
                                                    <a data-toggle="collapse" data-parent="#comment464301" href="#comment464301-3">Instructor</a>
                                                </div>
                                            </div>
                                            <div id="comment464301-3" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                  <div class="panel-group" id="teachersp464301">
                                                      <div class="panel panel-default">
                                                          <div class="panel-heading">
                                                              <div class="panel-title" style="font-size:14px">
                                                                  <a data-toggle="collapse" data-parent="#teachersp464301" href="#teachersp464301-1">ดร.พจมาน ชำนาญกิจ</a>
                                                                  <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank" class="btn btn-primary btn-outline">PDF</a>

                                                              </div>
                                                          </div>
                                                          <div id="teachersp464301-1" class="panel-collapse collapse">
                                                              <div class="panel-body">

                                                                <table class="table ">
                                                                  <thead>
                                                                    <?php if ($_SESSION['level'] > 4 ): ?>
                                                                    <th style="width:170px">คณะกรรมการ</th>
                                                                    <?php endif; ?>
                                                                    <th>ข้อเสนอแนะ</th>
                                                                  </thead>
                                                                  <tbody>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์ไม่ยังไม่เหมาะกับวิชา</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์เคยมีประสบการณ์</td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="panel panel-default">
                                                          <div class="panel-heading">
                                                              <div class="panel-title" style="font-size:14px">
                                                                  <a data-toggle="collapse" data-parent="#teachersp464301" href="#teachersp464301-2">ผศ.ดร.พนมพร จินดาสมุทร์</a>
                                                                  <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank" class="btn btn-primary btn-outline">PDF</a>

                                                              </div>
                                                          </div>
                                                          <div id="teachersp464301-2" class="panel-collapse collapse">
                                                              <div class="panel-body">

                                                                <table class="table ">
                                                                  <thead>
                                                                    <?php if ($_SESSION['level'] > 4 ): ?>
                                                                    <th style="width:170px">คณะกรรมการ</th>
                                                                    <?php endif; ?>
                                                                    <th>ข้อเสนอแนะ</th>
                                                                  </thead>
                                                                  <tbody>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์ท่านนี้เหมาะสมกับวิชานี้</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์ท่านนี้เป็นผู้มีประสบการณ์</td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="panel panel-default">
                                                          <div class="panel-heading">
                                                              <div class="panel-title" style="font-size:14px">
                                                                  <a data-toggle="collapse" data-parent="#teachersp464301" href="#teachersp464301-3">อ.พรพิมล ศิวินา</a>
                                                                  <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank" class="btn btn-primary btn-outline">PDF</a>

                                                              </div>
                                                          </div>
                                                          <div id="teachersp464301-3" class="panel-collapse collapse">
                                                              <div class="panel-body">

                                                                <table class="table ">
                                                                  <thead>
                                                                    <?php if ($_SESSION['level'] > 4 ): ?>
                                                                    <th style="width:170px">คณะกรรมการ</th>
                                                                    <?php endif; ?>
                                                                    <th>ข้อเสนอแนะ</th>
                                                                  </thead>
                                                                  <tbody>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์ท่านนี้ยังไม่มีประสบการณ์</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>ควรทดลองให้อาจารย์มาสอนก่อน</td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel panel-danger">
                <div class="panel-heading">
                  <div class="panel-title" style="font-size:14px">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">ไม่ผ่านการประเมิน</a>
                  </div>
                </div>
                <div id="collapseThree" class="panel-collapse collapse">
                  <div class="panel-body">
                    <div class="table-responsive">
                      <table class="table " style="font-size:14px;">
                        <thead>
                          <tr>
                            <th>ลำดับ</th>
                            <th>รหัสวิชา</th>
                            <th>ชื่อวิชา</th>
                            <th style="text-align:center;">Course</th>
                            <th style="text-align:center;">Evaluate</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>463332</td>
                            <td>ORGANIC MEDICINAL CHEMISTRY 2</td>
                            <td style="text-align:center;">
                              <a href="../../application/pdf/view.php?course=462452&info=syllabus" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
                            </td>
                            <td style="text-align:center;">
                              <a href="../../application/pdf/view.php?course=462452&type=draft&info=evaluate" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
                            </td>
                            <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#463332" class="accordion-toggle">ดูข้อมูล</button></td>
                          </tr>
                          <tr class="hiddenRow">
                            <td colspan="12">
                              <div class="accordian-body collapse" id="463332">
                                <div class="panel panel-success">
                                  <div class="panel-heading">
                                    <b>ข้อเสนอแนะคณะกรรมการ</b>
                                  </div>
                                  <div class="panel-body">
                                    <div class="panel-group" id="comment463332">

                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <div class="panel-title" style="font-size:14px">
                                                    <a data-toggle="collapse" data-parent="#comment463332" href="#comment463332-2">แบบแจ้งวิธีการวัดผลและประเมินผลการศึกษา</a>

                                                </div>
                                            </div>
                                            <div id="comment463332-2" class="panel-collapse collapse">
                                                <div class="panel-body">

                                                  <table class="table ">
                                                    <thead>
                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                      <th style="width:170px">คณะกรรมการ</th>
                                                      <?php endif; ?>
                                                      <th>ข้อเสนอแนะ</th>
                                                    </thead>
                                                    <tbody>
                                                      <tr>
                                                        <?php if ($_SESSION['level'] > 4 ): ?>
                                                        <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                        <?php endif; ?>
                                                        <td>วิธีตัดเกรดในส่วนของการอิงเกณฑ์นั้นยังไม่ชัดเจน</td>
                                                      </tr>
                                                      <tr>
                                                        <?php if ($_SESSION['level'] > 4 ): ?>
                                                        <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                        <?php endif; ?>
                                                        <td>ควรเพิ่มอาจารย์ปฏิบัติการ</td>
                                                      </tr>
                                                    </tbody>
                                                  </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading ">
                                                <div class="panel-title" style="font-size:14px">
                                                    <a data-toggle="collapse" data-parent="#comment463332" href="#comment463332-3">Instructor</a>
                                                </div>
                                            </div>
                                            <div id="comment463332-3" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                  <div class="panel-group" id="teachersp463332">
                                                      <div class="panel panel-default">
                                                          <div class="panel-heading">
                                                              <div class="panel-title" style="font-size:14px">
                                                                  <a data-toggle="collapse" data-parent="#teachersp463332" href="#teachersp463332-1">ดร.พจมาน ชำนาญกิจ</a>
                                                                  <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank" class="btn btn-primary btn-outline">PDF</a>
                                                              </div>
                                                          </div>
                                                          <div id="teachersp463332-1" class="panel-collapse collapse">
                                                              <div class="panel-body">

                                                                <table class="table ">
                                                                  <thead>
                                                                    <?php if ($_SESSION['level'] > 4 ): ?>
                                                                    <th style="width:170px">คณะกรรมการ</th>
                                                                    <?php endif; ?>
                                                                    <th>ข้อเสนอแนะ</th>
                                                                  </thead>
                                                                  <tbody>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์ไม่ยังไม่เหมาะกับวิชา</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์เคยมีประสบการณ์</td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="panel panel-default">
                                                          <div class="panel-heading">
                                                              <div class="panel-title" style="font-size:14px">
                                                                  <a data-toggle="collapse" data-parent="#teachersp463332" href="#teachersp463332-2">ผศ.ดร.พนมพร จินดาสมุทร์</a>
                                                                  <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank" class="btn btn-primary btn-outline">PDF</a>
                                                              </div>
                                                          </div>
                                                          <div id="teachersp463332-2" class="panel-collapse collapse">
                                                              <div class="panel-body">

                                                                <table class="table ">
                                                                  <thead>
                                                                    <?php if ($_SESSION['level'] > 4 ): ?>
                                                                    <th style="width:170px">คณะกรรมการ</th>
                                                                    <?php endif; ?>
                                                                    <th>ข้อเสนอแนะ</th>
                                                                  </thead>
                                                                  <tbody>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์ท่านนี้เหมาะสมกับวิชานี้</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์ท่านนี้เป็นผู้มีประสบการณ์</td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="panel panel-default">
                                                          <div class="panel-heading">
                                                              <div class="panel-title" style="font-size:14px">
                                                                  <a data-toggle="collapse" data-parent="#teachersp463332" href="#teachersp463332-3">อ.พรพิมล ศิวินา</a>
                                                                  <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank" class="btn btn-primary btn-outline">PDF</a>
                                                              </div>
                                                          </div>
                                                          <div id="teachersp463332-3" class="panel-collapse collapse">
                                                              <div class="panel-body">

                                                                <table class="table ">
                                                                  <thead>
                                                                    <?php if ($_SESSION['level'] > 4 ): ?>
                                                                    <th style="width:170px">คณะกรรมการ</th>
                                                                    <?php endif; ?>
                                                                    <th>ข้อเสนอแนะ</th>
                                                                  </thead>
                                                                  <tbody>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์ท่านนี้ยังไม่มีประสบการณ์</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>ควรทดลองให้อาจารย์มาสอนก่อน</td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>463342</td>
                            <td>PHARMACEUTICAL QUALITY ASSURANCE 2</td>
                            <td style="text-align:center;">
                              <a href="../../application/pdf/view.php?course=462452&info=syllabus" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
                            </td>
                            <td style="text-align:center;">
                              <a href="../../application/pdf/view.php?course=462452&type=draft&info=evaluate" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
                            </td>
                            <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#463342" class="accordion-toggle">ดูข้อมูล</button></td>
                          </tr>
                          <tr class="hiddenRow">
                            <td colspan="12">
                              <div class="accordian-body collapse" id="463342">
                                <div class="panel panel-success">
                                  <div class="panel-heading">
                                    <b>ข้อเสนอแนะคณะกรรมการ</b>
                                  </div>
                                  <div class="panel-body">
                                    <div class="panel-group" id="comment463342">

                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <div class="panel-title" style="font-size:14px">
                                                    <a data-toggle="collapse" data-parent="#comment463342" href="#comment463342-2">แบบแจ้งวิธีการวัดผลและประเมินผลการศึกษา</a>

                                                </div>
                                            </div>
                                            <div id="comment463342-2" class="panel-collapse collapse">
                                                <div class="panel-body">

                                                  <table class="table ">
                                                    <thead>
                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                      <th style="width:170px">คณะกรรมการ</th>
                                                      <?php endif; ?>
                                                      <th>ข้อเสนอแนะ</th>
                                                    </thead>
                                                    <tbody>
                                                      <tr>
                                                        <?php if ($_SESSION['level'] > 4 ): ?>
                                                        <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                        <?php endif; ?>
                                                        <td>วิธีตัดเกรดในส่วนของการอิงเกณฑ์นั้นยังไม่ชัดเจน</td>
                                                      </tr>
                                                      <tr>
                                                        <?php if ($_SESSION['level'] > 4 ): ?>
                                                        <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                        <?php endif; ?>
                                                        <td>ควรเพิ่มอาจารย์ปฏิบัติการ</td>
                                                      </tr>
                                                    </tbody>
                                                  </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading ">
                                                <div class="panel-title" style="font-size:14px">
                                                    <a data-toggle="collapse" data-parent="#comment463342" href="#comment463342-3">Instructor</a>
                                                </div>
                                            </div>
                                            <div id="comment463342-3" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                  <div class="panel-group" id="teachersp463342">
                                                      <div class="panel panel-default">
                                                          <div class="panel-heading">
                                                              <div class="panel-title" style="font-size:14px">
                                                                  <a data-toggle="collapse" data-parent="#teachersp463342" href="#teachersp463342-1">ดร.พจมาน ชำนาญกิจ</a>
                                                                  <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank" class="btn btn-primary btn-outline">PDF</a>
                                                              </div>
                                                          </div>
                                                          <div id="teachersp463342-1" class="panel-collapse collapse">
                                                              <div class="panel-body">

                                                                <table class="table ">
                                                                  <thead>
                                                                    <?php if ($_SESSION['level'] > 4 ): ?>
                                                                    <th style="width:170px">คณะกรรมการ</th>
                                                                    <?php endif; ?>
                                                                    <th>ข้อเสนอแนะ</th>
                                                                  </thead>
                                                                  <tbody>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์ไม่ยังไม่เหมาะกับวิชา</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์เคยมีประสบการณ์</td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="panel panel-default">
                                                          <div class="panel-heading">
                                                              <div class="panel-title" style="font-size:14px">
                                                                  <a data-toggle="collapse" data-parent="#teachersp463342" href="#teachersp463342-2">ผศ.ดร.พนมพร จินดาสมุทร์</a>
                                                                  <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank" class="btn btn-primary btn-outline">PDF</a>
                                                              </div>
                                                          </div>
                                                          <div id="teachersp463342-2" class="panel-collapse collapse">
                                                              <div class="panel-body">

                                                                <table class="table ">
                                                                  <thead>
                                                                    <?php if ($_SESSION['level'] > 4 ): ?>
                                                                    <th style="width:170px">คณะกรรมการ</th>
                                                                    <?php endif; ?>
                                                                    <th>ข้อเสนอแนะ</th>
                                                                  </thead>
                                                                  <tbody>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์ท่านนี้เหมาะสมกับวิชานี้</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์ท่านนี้เป็นผู้มีประสบการณ์</td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="panel panel-default">
                                                          <div class="panel-heading">
                                                              <div class="panel-title" style="font-size:14px">
                                                                  <a data-toggle="collapse" data-parent="#teachersp463342" href="#teachersp463342-3">อ.พรพิมล ศิวินา</a>
                                                                  <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank" class="btn btn-primary btn-outline">PDF</a>

                                                              </div>
                                                          </div>
                                                          <div id="teachersp463342-3" class="panel-collapse collapse">
                                                              <div class="panel-body">

                                                                <table class="table ">
                                                                  <thead>
                                                                    <?php if ($_SESSION['level'] > 4 ): ?>
                                                                    <th style="width:170px">คณะกรรมการ</th>
                                                                    <?php endif; ?>
                                                                    <th>ข้อเสนอแนะ</th>
                                                                  </thead>
                                                                  <tbody>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์ท่านนี้ยังไม่มีประสบการณ์</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>ควรทดลองให้อาจารย์มาสอนก่อน</td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>464445</td>
                            <td>PHARMACY PUBLIC HEALTH</td>
                            <td style="text-align:center;">
                              <a href="../../application/pdf/view.php?course=462452&info=syllabus" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
                            </td>
                            <td style="text-align:center;">
                              <a href="../../application/pdf/view.php?course=462452&type=draft&info=evaluate" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
                            </td>
                            <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#464445" class="accordion-toggle">ดูข้อมูล</button></td>
                          </tr>
                          <tr class="hiddenRow">
                            <td colspan="12">
                              <div class="accordian-body collapse" id="464445">
                                <div class="panel panel-success">
                                  <div class="panel-heading">
                                    <b>ข้อเสนอแนะคณะกรรมการ</b>
                                  </div>
                                  <div class="panel-body">
                                    <div class="panel-group" id="comment464445">

                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <div class="panel-title" style="font-size:14px">
                                                    <a data-toggle="collapse" data-parent="#comment464445" href="#comment464445-2">แบบแจ้งวิธีการวัดผลและประเมินผลการศึกษา</a>

                                                </div>
                                            </div>
                                            <div id="comment464445-2" class="panel-collapse collapse">
                                                <div class="panel-body">

                                                  <table class="table ">
                                                    <thead>
                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                      <th style="width:170px">คณะกรรมการ</th>
                                                      <?php endif; ?>
                                                      <th>ข้อเสนอแนะ</th>
                                                    </thead>
                                                    <tbody>
                                                      <tr>
                                                        <?php if ($_SESSION['level'] > 4 ): ?>
                                                        <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                        <?php endif; ?>
                                                        <td>วิธีตัดเกรดในส่วนของการอิงเกณฑ์นั้นยังไม่ชัดเจน</td>
                                                      </tr>
                                                      <tr>
                                                        <?php if ($_SESSION['level'] > 4 ): ?>
                                                        <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                        <?php endif; ?>
                                                        <td>ควรเพิ่มอาจารย์ปฏิบัติการ</td>
                                                      </tr>
                                                    </tbody>
                                                  </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading ">
                                                <div class="panel-title" style="font-size:14px">
                                                    <a data-toggle="collapse" data-parent="#comment464445" href="#comment464445-3">Instructor</a>
                                                </div>
                                            </div>
                                            <div id="comment464445-3" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                  <div class="panel-group" id="teachersp464445">
                                                      <div class="panel panel-default">
                                                          <div class="panel-heading">
                                                              <div class="panel-title" style="font-size:14px">
                                                                  <a data-toggle="collapse" data-parent="#teachersp464445" href="#teachersp464445-1">ดร.พจมาน ชำนาญกิจ</a>
                                                                  <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank" class="btn btn-primary btn-outline">PDF</a>

                                                              </div>
                                                          </div>
                                                          <div id="teachersp464445-1" class="panel-collapse collapse">
                                                              <div class="panel-body">

                                                                <table class="table ">
                                                                  <thead>
                                                                    <?php if ($_SESSION['level'] > 4 ): ?>
                                                                    <th style="width:170px">คณะกรรมการ</th>
                                                                    <?php endif; ?>
                                                                    <th>ข้อเสนอแนะ</th>
                                                                  </thead>
                                                                  <tbody>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์ไม่ยังไม่เหมาะกับวิชา</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์เคยมีประสบการณ์</td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="panel panel-default">
                                                          <div class="panel-heading">
                                                              <div class="panel-title" style="font-size:14px">
                                                                  <a data-toggle="collapse" data-parent="#teachersp464445" href="#teachersp464445-2">ผศ.ดร.พนมพร จินดาสมุทร์</a>
                                                                  <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank" class="btn btn-primary btn-outline">PDF</a>

                                                              </div>
                                                          </div>
                                                          <div id="teachersp464445-2" class="panel-collapse collapse">
                                                              <div class="panel-body">

                                                                <table class="table ">
                                                                  <thead>
                                                                    <?php if ($_SESSION['level'] > 4 ): ?>
                                                                    <th style="width:170px">คณะกรรมการ</th>
                                                                    <?php endif; ?>
                                                                    <th>ข้อเสนอแนะ</th>
                                                                  </thead>
                                                                  <tbody>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์ท่านนี้เหมาะสมกับวิชานี้</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์ท่านนี้เป็นผู้มีประสบการณ์</td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="panel panel-default">
                                                          <div class="panel-heading">
                                                              <div class="panel-title" style="font-size:14px">
                                                                  <a data-toggle="collapse" data-parent="#teachersp464445" href="#teachersp464445-3">อ.พรพิมล ศิวินา</a>
                                                                  <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank" class="btn btn-primary btn-outline">PDF</a>

                                                              </div>
                                                          </div>
                                                          <div id="teachersp464445-3" class="panel-collapse collapse">
                                                              <div class="panel-body">

                                                                <table class="table ">
                                                                  <thead>
                                                                    <?php if ($_SESSION['level'] > 4 ): ?>
                                                                    <th style="width:170px">คณะกรรมการ</th>
                                                                    <?php endif; ?>
                                                                    <th>ข้อเสนอแนะ</th>
                                                                  </thead>
                                                                  <tbody>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>อาจารย์ท่านนี้ยังไม่มีประสบการณ์</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <?php if ($_SESSION['level'] > 4 ): ?>
                                                                      <td style="width:170px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                                      <?php endif; ?>
                                                                      <td>ควรทดลองให้อาจารย์มาสอนก่อน</td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- .panel-body -->
        </div>
      </div>
    </div>
    </div>

  </body>

  </html>
