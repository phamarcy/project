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
            <h3 class="page-header">ประวัติข้อเสนอแนะ</h3>

          <form data-toggle="validator" role="form">
            <div class="form-inline" style="font-size:16px;">
              <div class="form-group ">
                ค้นหาวิชา
                <input type="text" class="form-control numonly" id="id" name="id" size="7" placeholder="e.g. 204111" maxlength="6" pattern=".{6,6}" required>
              </div>
              <input type="hidden" name="type" value="1">
              <button type="button" class="btn btn-outline btn-primary" >ค้นหา</button>
            </div>

            <div id="formdrpd" style="display: none;">
              <div class="form-inline">
                <div class="form-group " style="font-size:16px;">
                  ภาคการศึกษาและปีการศึกษา
                  <select class="form-control required" id="semester" style="width: 300px;" required>
            </select>
                </div>
                <input type="button" class="btn btn-outline btn-primary" name="subhead" id="subhead" value="ยืนยัน" >
              </div>
            </div>
          </form>
          </center>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h5 class="panel-title">
              <b>ผลการค้นหา</b>
            </h5>
          </div>
          <!-- .panel-heading -->
          <div class="panel-body">

                    <div class="table-responsive">
                      <table class="table " style="font-size:14px;">
                        <thead>
                          <tr>
                            <th>ลำดับ</th>
                            <th>รหัสวิชา</th>
                            <th>ชื่อวิชา</th>
                            <th  style="text-align:center;">ปีการศึกษา</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td >463681</td>
                            <td>INDUSTRIAL PHARMACY CLERKSHIP IN PRODUCTION 1</td>
                            <td style="text-align:center;">1/2559</td>
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
                                            <a data-toggle="collapse" href="#comment463681-2"><b>แบบแจ้งวิธีการวัดผลและประเมินผลการศึกษา</b></a>
                                            <a href="../../application/pdf/view.php?course=462452&type=draft&info=evaluate" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
                                          </div>
                                        </div>
                                        <div id="comment463681-2" class="panel-collapse collapse in">
                                          <div class="panel-body">

                                            <table class="table " style="font-size:14px">
                                              <thead>
                                                <?php if ($_SESSION['level'] > 4 ): ?>
                                                <th style="width:230px">คณะกรรมการ</th>
                                                <?php endif; ?>
                                                <th>ข้อเสนอแนะ</th>
                                              </thead>
                                              <tbody>
                                                <tr>
                                                  <?php if ($_SESSION['level'] > 4 ): ?>
                                                  <td style="width:230px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                  <?php endif; ?>
                                                  <td>วิธีตัดเกรดในส่วนของการอิงเกณฑ์นั้นยังไม่ชัดเจน</td>
                                                </tr>
                                                <tr>
                                                  <?php if ($_SESSION['level'] > 4 ): ?>
                                                  <td style="width:230px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
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
                                                  <a data-toggle="collapse" href="#comment463681-3"><b>แบบเชิญอาจารย์พิเศษ</b></a>
                                              </div>
                                        </div>
                                        <div id="comment463681-3" class="panel-collapse collapse in">
                                          <div class="panel-body">
                                            <div class="panel-group" id="teachersp463681">
                                              <div class="panel panel-default">
                                                <div class="panel-heading">
                                                  <div class="panel-title" style="font-size:14px">
                                                                <a data-toggle="collapse" data-parent="#teachersp463681" href="#teachersp463681-1">ดร.พจมาน ชำนาญกิจ</a>
                                                                <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>

                                                            </div>
                                                </div>
                                                <div id="teachersp463681-1" class="panel-collapse collapse">
                                                  <div class="panel-body">

                                                    <table class="table " style="font-size:14px">
                                                      <thead>
                                                        <?php if ($_SESSION['level'] > 4 ): ?>
                                                        <th style="width:230px">คณะกรรมการ</th>
                                                        <?php endif; ?>
                                                        <th>ข้อเสนอแนะ</th>
                                                      </thead>
                                                      <tbody>
                                                        <tr>
                                                          <?php if ($_SESSION['level'] > 4 ): ?>
                                                          <td style="width:230px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                          <?php endif; ?>
                                                          <td>อาจารย์ไม่ยังไม่เหมาะกับวิชา</td>
                                                        </tr>
                                                        <tr>
                                                          <?php if ($_SESSION['level'] > 4 ): ?>
                                                          <td style="width:230px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
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
                                                      <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
                                                  </div>
                                                </div>
                                                <div id="teachersp463681-2" class="panel-collapse collapse">
                                                  <div class="panel-body">

                                                    <table class="table " style="font-size:14px">
                                                      <thead>
                                                        <?php if ($_SESSION['level'] > 4 ): ?>
                                                        <th style="width:230px">คณะกรรมการ</th>
                                                        <?php endif; ?>
                                                        <th>ข้อเสนอแนะ</th>
                                                      </thead>
                                                      <tbody>
                                                        <tr>
                                                          <?php if ($_SESSION['level'] > 4 ): ?>
                                                          <td style="width:230px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                          <?php endif; ?>
                                                          <td>อาจารย์ท่านนี้เหมาะสมกับวิชานี้</td>
                                                        </tr>
                                                        <tr>
                                                          <?php if ($_SESSION['level'] > 4 ): ?>
                                                          <td style="width:230px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                          <?php endif; ?>
                                                          <td>อาจารย์ท่านี้เป็นผู้มีประสบการณ์</td>
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
                                                                <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank" ><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>

                                                            </div>
                                                </div>
                                                <div id="teachersp463681-3" class="panel-collapse collapse">
                                                  <div class="panel-body">

                                                    <table class="table " style="font-size:14px">
                                                      <thead>
                                                        <?php if ($_SESSION['level'] > 4 ): ?>
                                                        <th style="width:230px">คณะกรรมการ</th>
                                                        <?php endif; ?>
                                                        <th>ข้อเสนอแนะ</th>
                                                      </thead>
                                                      <tbody>
                                                        <tr>
                                                          <?php if ($_SESSION['level'] > 4 ): ?>
                                                          <td style="width:230px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                          <?php endif; ?>
                                                          <td>อาจารย์ท่านนี้ยังไม่มีประสบการณ์</td>
                                                        </tr>
                                                        <tr>
                                                          <?php if ($_SESSION['level'] > 4 ): ?>
                                                          <td style="width:230px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
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
                            <td >463681</td>
                            <td>INDUSTRIAL PHARMACY CLERKSHIP IN PRODUCTION 1</td>
                            <td style="text-align:center;">1/2558</td>
                            <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#463201" class="accordion-toggle">ดูข้อมูล</button></td>
                          </tr>
                          <tr class="hiddenRow">
                            <td colspan="12">
                              <div class="accordian-body collapse" id="463201">
                                <div class="panel panel-success">
                                  <div class="panel-heading">
                                    <b>ข้อเสนอแนะคณะกรรมการ</b>
                                  </div>
                                  <div class="panel-body">
                                    <div class="panel-group" id="comment463201">
                                      <div class="panel panel-default">
                                        <div class="panel-heading">
                                          <div class="panel-title" style="font-size:14px">
                                            <a data-toggle="collapse" href="#comment463201-2"><b>แบบแจ้งวิธีการวัดผลและประเมินผลการศึกษา</b></a>
                                            <a href="../../application/pdf/view.php?course=462452&type=draft&info=evaluate" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
                                          </div>
                                        </div>
                                        <div id="comment463201-2" class="panel-collapse collapse in">
                                          <div class="panel-body">

                                            <table class="table " style="font-size:14px">
                                              <thead>
                                                <?php if ($_SESSION['level'] > 4 ): ?>
                                                <th style="width:230px">คณะกรรมการ</th>
                                                <?php endif; ?>
                                                <th>ข้อเสนอแนะ</th>
                                              </thead>
                                              <tbody>
                                                <tr>
                                                  <?php if ($_SESSION['level'] > 4 ): ?>
                                                  <td style="width:230px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                  <?php endif; ?>
                                                  <td>วิธีตัดเกรดในส่วนของการอิงเกณฑ์นั้นยังไม่ชัดเจน</td>
                                                </tr>
                                                <tr>
                                                  <?php if ($_SESSION['level'] > 4 ): ?>
                                                  <td style="width:230px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
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
                                                  <a data-toggle="collapse" href="#comment463201-3"><b>แบบเชิญอาจารย์พิเศษ</b></a>
                                              </div>
                                        </div>
                                        <div id="comment463201-3" class="panel-collapse collapse in">
                                          <div class="panel-body">
                                            <div class="panel-group" id="teachersp463201">
                                              <div class="panel panel-default">
                                                <div class="panel-heading">
                                                  <div class="panel-title" style="font-size:14px">
                                                                <a data-toggle="collapse" data-parent="#teachersp463201" href="#teachersp463201-1">ดร.พจมาน ชำนาญกิจ</a>
                                                                <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>

                                                            </div>
                                                </div>
                                                <div id="teachersp463201-1" class="panel-collapse collapse">
                                                  <div class="panel-body">

                                                    <table class="table " style="font-size:14px">
                                                      <thead>
                                                        <?php if ($_SESSION['level'] > 4 ): ?>
                                                        <th style="width:230px">คณะกรรมการ</th>
                                                        <?php endif; ?>
                                                        <th>ข้อเสนอแนะ</th>
                                                      </thead>
                                                      <tbody>
                                                        <tr>
                                                          <?php if ($_SESSION['level'] > 4 ): ?>
                                                          <td style="width:230px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                          <?php endif; ?>
                                                          <td>อาจารย์ไม่ยังไม่เหมาะกับวิชา</td>
                                                        </tr>
                                                        <tr>
                                                          <?php if ($_SESSION['level'] > 4 ): ?>
                                                          <td style="width:230px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
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
                                                      <a data-toggle="collapse" data-parent="#teachersp463201" href="#teachersp463201-2">ผศ.ดร.พนมพร จินดาสมุทร์</a>
                                                      <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>
                                                  </div>
                                                </div>
                                                <div id="teachersp463201-2" class="panel-collapse collapse">
                                                  <div class="panel-body">

                                                    <table class="table " style="font-size:14px">
                                                      <thead>
                                                        <?php if ($_SESSION['level'] > 4 ): ?>
                                                        <th style="width:230px">คณะกรรมการ</th>
                                                        <?php endif; ?>
                                                        <th>ข้อเสนอแนะ</th>
                                                      </thead>
                                                      <tbody>
                                                        <tr>
                                                          <?php if ($_SESSION['level'] > 4 ): ?>
                                                          <td style="width:230px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                          <?php endif; ?>
                                                          <td>อาจารย์ท่านนี้เหมาะสมกับวิชานี้</td>
                                                        </tr>
                                                        <tr>
                                                          <?php if ($_SESSION['level'] > 4 ): ?>
                                                          <td style="width:230px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                          <?php endif; ?>
                                                          <td>อาจารย์ท่านี้เป็นผู้มีประสบการณ์</td>
                                                        </tr>
                                                      </tbody>
                                                    </table>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="panel panel-default">
                                                <div class="panel-heading">
                                                  <div class="panel-title" style="font-size:14px">
                                                                <a data-toggle="collapse" data-parent="#teachersp463201" href="#teachersp463201-3">อ.พรพิมล ศิวินา</a>
                                                                <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank" ><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a>

                                                            </div>
                                                </div>
                                                <div id="teachersp463201-3" class="panel-collapse collapse">
                                                  <div class="panel-body">

                                                    <table class="table " style="font-size:14px">
                                                      <thead>
                                                        <?php if ($_SESSION['level'] > 4 ): ?>
                                                        <th style="width:230px">คณะกรรมการ</th>
                                                        <?php endif; ?>
                                                        <th>ข้อเสนอแนะ</th>
                                                      </thead>
                                                      <tbody>
                                                        <tr>
                                                          <?php if ($_SESSION['level'] > 4 ): ?>
                                                          <td style="width:230px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                          <?php endif; ?>
                                                          <td>อาจารย์ท่านนี้ยังไม่มีประสบการณ์</td>
                                                        </tr>
                                                        <tr>
                                                          <?php if ($_SESSION['level'] > 4 ): ?>
                                                          <td style="width:230px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
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

          <!-- .panel-body -->
        </div>
      </div>
    </div>
    </div>

  </body>


  </html>
