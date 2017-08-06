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

<style >
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
            <h3 class="page-header">การอนุมัติกระบวนวิชา</h3>
                <form  role="form">
                  <div class="form-inline" style="font-size:16px;">
                           <div class="form-group">
                              <label id="semester" class="control-label">ภาคการศึกษา</label>
                               <select class="form-control required" id="semester" style="width: 70px;" id="select" required oninvalid="this.setCustomValidity('กรุณาเลือกภาคการศึกษา')" oninput="setCustomValidity('')" >
                                  <option value="">--</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                               </select>
                               <div class="form-group">
                                 <div class="help-block with-errors" style="font-size:12px;"></div>
                               </div>
                           </div>
                           <div class="form-group">
                             <label for="inputyear" class="control-label">ปีการศึกษา</label>
                             <input type="text" class="form-control" id="inputyear" style="width: 150px;" placeholder="e.g. 2560"    max="9999" required oninvalid="this.setCustomValidity('กรุณากรอกปีการศึกษา')" oninput="setCustomValidity('')" title="กรุณากรอกตัวเลข">
                               <div class="form-group">
                                 <div class="help-block with-errors" style="font-size:12px;"></div>
                               </div>
                           </div>
                          <button type="submit" class="btn btn-primary">ค้นหา</button>
                   </div>
                </form>
          </center>
        </div>
      <br>
      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                              <b>ภาคการศึกษาที่ 2 ปีการศึกษา 2560</b>
                          </h4>
                        </div>
                        <!-- .panel-heading -->
                        <div class="panel-body">
                          <h4><b>หมายเหตุ</b></h4>
                            <ol style="font-size:16px;">
                                <li>Course Syllabus (Course)</li>
                                <li>แบบแจ้งวิธีการวัดผลและประเมินผลการศึกษา (Evaluate)</li>
                                <li>แบบขออนุมัติอาจารย์พิเศษ (Special)</li>
                                <p class="text-info">* คำย่อภาษาอังกฤษใช้เป็นตัวย่อในตาราง</p>
                            </ol>
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-warning">
                                  <div class="panel-heading">
                                      <div class="panel-title">
                                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">รอการอนุมัติ</a>
                                      </div >
                                  </div>

                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                          <div class="table-responsive">
                                              <table class="table ">
                                                  <thead>
                                                      <tr >
                                                          <th>#</th>
                                                          <th>รหัสวิชา</th>
                                                          <th>ชื่อวิชา</th>
                                                          <th  style="text-align:center;">Course</th>
                                                          <th  style="text-align:center;">Evaluate</th>
                                                          <th  style="text-align:center;">Special</th>
                                                          <th></th>
                                                          <th></th>
                                                          <th></th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                      <tr >
                                                          <td>1</td>
                                                          <td>Mark</td>
                                                          <td>Otto</td>
                                                          <td  style="text-align:center;"><button type="button" class="btn btn-outline btn-primary">คลิ๊กดู</button></td>
                                                          <td  style="text-align:center;"><button type="button" class="btn btn-outline btn-primary">คลิ๊กดู</button></td>
                                                          <td  style="text-align:center;"><button type="button" class="btn btn-outline btn-primary">คลิ๊กดู</button></td>
                                                          <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#demo1" class="accordion-toggle">comment</button></td>
                                                          <td><button type="button" class="btn btn-outline btn-success">อนุมัติ</button></td>
                                                          <td><button type="button" class="btn btn-outline btn-danger">ไม่อนุมัติ</button></td>
                                                      </tr>
                                                      <tr class="hiddenRow">
                                                          <td colspan="12">
                                                            <div class="accordian-body collapse" id="demo1">
                                                              <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                  <b>เพิ่มคอมเม้นท์</b>
                                                                </div>
                                                                <div class="panel-body">
                                                                    <div class="row">
                                                                      <div class="col-md-12">
                                                                        <form>
                                                                          <div class="form-group">
                                                                            <textarea name="comment" rows="8" cols="70" class="form-control"></textarea>
                                                                          </div>
                                                                          <button class="btn btn-primary"  type="submit" name="button">ส่งคอมเม้นท์</button>
                                                                        </form>
                                                                      </div>
                                                                    </div>
                                                                </div>
                                                              </div>
                                                              <div class="panel panel-green">
                                                                <div class="panel-heading">
                                                                  <b>คอมเม้นท์คณะกรรมการ</b>
                                                                </div>
                                                                <div class="panel-body">
                                                                  <table class="table ">
                                                                    <thead>
                                                                      <th style="width:150px">คณะกรรมการ</th>
                                                                      <th>คอมเม้นท์</th>
                                                                    </thead>
                                                                    <tbody>
                                                                      <tr>
                                                                        <td >สมยศ อิอิ</td>
                                                                        <td>Lorem Ipsum คือ เนื้อหาจำลองแบบเรียบๆ ที่ใช้กันในธุรกิจงานพิมพ์หรืองานเรียงพิมพ์ มันได้กลายมาเป็นเนื้อหาจำลองมาตรฐานของธุรกิจดังกล่าวมาตั้งแต่ศตวรรษที่ 16 เมื่อเครื่องพิมพ์โนเนมเครื่องหนึ่งนำรางตัวพิมพ์มาสลับสับตำแหน่งตัวอักษรเพื่อทำหนังสือตัวอย่าง Lorem Ipsum อยู่ยงคงกระพันมาไม่ใช่แค่เพียงห้าศตวรรษ แต่อยู่มาจนถึงยุคที่พลิกโฉมเข้าสู่งานเรียงพิมพ์ด้วยวิธีทางอิเล็กทรอนิกส์ และยังคงสภาพเดิมไว้อย่างไม่มีการเปลี่ยนแปลง มันได้รับความนิยมมากขึ้นในยุค ค.ศ. 1960 เมื่อแผ่น Letraset วางจำหน่ายโดยมีข้อความบนนั้นเป็น Lorem Ipsum และล่าสุดกว่านั้น คือเมื่อซอฟท์แวร์การทำสื่อสิ่งพิมพ์ (Desktop Publishing) อย่าง Aldus PageMaker ได้รวมเอา Lorem Ipsum เวอร์ชั่นต่างๆ เข้าไว้ในซอฟท์แวร์ด้วย</td>
                                                                      </tr>
                                                                      <tr>
                                                                        <td >สมสมัย อิอิ</td>
                                                                        <td>มีหลักฐานที่เป็นข้อเท็จจริงยืนยันมานานแล้ว ว่าเนื้อหาที่อ่านรู้เรื่องนั้นจะไปกวนสมาธิของคนอ่านให้เขวไปจากส่วนที้เป็น Layout เรานำ Lorem Ipsum มาใช้เพราะความที่มันมีการกระจายของตัวอักษรธรรมดาๆ แบบพอประมาณ ซึ่งเอามาใช้แทนการเขียนว่า ‘ตรงนี้เป็นเนื้อหา, ตรงนี้เป็นเนื้อหา' ได้ และยังทำให้มองดูเหมือนกับภาษาอังกฤษที่อ่านได้ปกติ ปัจจุบันมีแพ็กเกจของซอฟท์แวร์การทำสื่อสิ่งพิมพ์ และซอฟท์แวร์การสร้างเว็บเพจ (Web Page Editor) หลายตัวที่ใช้ Lorem Ipsum เป็นแบบจำลองเนื้อหาที่เป็นค่าตั้งต้น และเวลาที่เสิร์ชด้วยคำว่า 'lorem ipsum' ผลการเสิร์ชที่ได้ก็จะไม่พบบรรดาเว็บไซต์ที่ยังคงอยู่ในช่วงเริ่มสร้างด้วย โดยหลายปีที่ผ่านมาก็มีการคิดค้นเวอร์ชั่นต่างๆ ของ Lorem Ipsum ขึ้นมาใช้ บ้างก็เป็นความบังเอิญ บ้างก็เป็นความตั้งใจ (เช่น การแอบแทรกมุกตลก)</td>
                                                                      </tr>
                                                                    </tbody>
                                                                  </table>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          </td>
                                                      </tr>
                                                      <tr >
                                                          <td>2</td>
                                                          <td>Mark</td>
                                                          <td>Thornton</td>
                                                          <td  style="text-align:center;"><button type="button" class="btn btn-outline btn-primary">คลิ๊กดู</button></td>
                                                          <td  style="text-align:center;"><button type="button" class="btn btn-outline btn-primary">คลิ๊กดู</button></td>
                                                          <td  style="text-align:center;"><button type="button" class="btn btn-outline btn-primary">คลิ๊กดู</button></td>
                                                          <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#demo2" class="accordion-toggle">comment</button></td>
                                                          <td><button type="button" class="btn btn-outline btn-success">อนุมัติ</button></td>
                                                          <td><button type="button" class="btn btn-outline btn-danger">ไม่อนุมัติ</button></td>
                                                      </tr>
                                                      <tr class="hiddenRow">
                                                          <td colspan="12" class="hiddenRow">
                                                            <div class="accordian-body collapse" id="demo2">
                                                              <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                  <b>คอมเม้นท์</b>
                                                                </div>
                                                                <div class="panel-body">

                                                                </div>
                                                              </div>
                                                            </div>
                                                          </td>
                                                      </tr>
                                                      <tr >
                                                          <td>3</td>
                                                          <td>Mark</td>
                                                          <td>the Bird</td>
                                                          <td  style="text-align:center;"><button type="button" class="btn btn-outline btn-primary">คลิ๊กดู</button></td>
                                                          <td  style="text-align:center;"><button type="button" class="btn btn-outline btn-primary">คลิ๊กดู</button></td>
                                                          <td  style="text-align:center;"><button type="button" class="btn btn-outline btn-primary">คลิ๊กดู</button></td>
                                                          <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#demo3" class="accordion-toggle">comment</button></td>
                                                          <td><button type="button" class="btn btn-outline btn-success">อนุมัติ</button></td>
                                                          <td><button type="button" class="btn btn-outline btn-danger">ไม่อนุมัติ</button></td>
                                                      </tr>
                                                      <tr>
                                                          <td colspan="12" class="hiddenRow">
                                                            <div class="accordian-body collapse" id="demo3">
                                                              <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                  <b>คอมเม้นท์</b>
                                                                </div>
                                                                <div class="panel-body">

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
                                        <div class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">อนุมัติ</a>
                                        </div>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse">
                                        <div class="panel-body">
                                          <div class="table-responsive">
                                              <table class="table table-striped table-hover">
                                                  <thead>
                                                      <tr>
                                                          <th>#</th>
                                                          <th>รหัสวิชา</th>
                                                          <th>ชื่อวิชา</th>
                                                          <th>อาจารย์ผู้สอน</th>
                                                          <th>เอกสาร</th>
                                                          <th>เอกสาร</th>
                                                          <th>เอกสาร</th>
                                                          <th></th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                      <tr >
                                                          <td>1</td>
                                                          <td>Mark</td>
                                                          <td>Mark</td>
                                                          <td>Otto</td>
                                                          <td><button type="button" class="btn btn-outline btn-primary">คลิ๊กดู</button></td>
                                                          <td><button type="button" class="btn btn-outline btn-primary">คลิ๊กดู</button></td>
                                                          <td><button type="button" class="btn btn-outline btn-primary">คลิ๊กดู</button></td>
                                                          <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#demo21" class="accordion-toggle">comment</button></td>
                                                          <td><button type="button" class="btn btn-outline btn-danger">ยกเลิกอนุมัติ</button></td>
                                                      </tr>
                                                      <tr class="hiddenRow">
                                                          <td colspan="12">
                                                            <div class="accordian-body collapse" id="demo21">
                                                              <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                  <b>คอมเม้นท์</b>
                                                                </div>
                                                                <div class="panel-body">

                                                                </div>
                                                              </div>
                                                            </div>
                                                          </td>
                                                      </tr>
                                                      <tr>
                                                          <td>2</td>
                                                          <td>Jacob</td>
                                                          <td>Mark</td>
                                                          <td>Thornton</td>
                                                          <td><button type="button" class="btn btn-outline btn-primary">คลิ๊กดู</button></td>
                                                          <td><button type="button" class="btn btn-outline btn-primary">คลิ๊กดู</button></td>
                                                          <td><button type="button" class="btn btn-outline btn-primary">คลิ๊กดู</button></td>
                                                          <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#demo22" class="accordion-toggle">comment</button></td>
                                                          <td><button type="button" class="btn btn-outline btn-danger">ยกเลิกอนุมัติ</button></td>
                                                      </tr>
                                                      <tr class="hiddenRow">
                                                          <td colspan="12">
                                                            <div class="accordian-body collapse" id="demo22">
                                                              <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                  <b>คอมเม้นท์</b>
                                                                </div>
                                                                <div class="panel-body">

                                                                </div>
                                                              </div>
                                                            </div>
                                                          </td>
                                                      </tr>
                                                      <tr  >
                                                          <td>3</td>
                                                          <td>Larry</td>
                                                          <td>Mark</td>
                                                          <td>the Bird</td>
                                                          <td><button type="button" class="btn btn-outline btn-primary">คลิ๊กดู</button></td>
                                                          <td><button type="button" class="btn btn-outline btn-primary">คลิ๊กดู</button></td>
                                                          <td><button type="button" class="btn btn-outline btn-primary">คลิ๊กดู</button></td>
                                                          <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#demo23" class="accordion-toggle">comment</button></td>
                                                          <td><button type="button" class="btn btn-outline btn-danger">ยกเลิกอนุมัติ</button></td>
                                                      </tr>
                                                      <tr class="hiddenRow">
                                                          <td colspan="12">
                                                            <div class="accordian-body collapse" id="demo23">
                                                              <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                  <b>คอมเม้นท์</b>
                                                                </div>
                                                                <div class="panel-body">

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
                                        <div class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">ไม่อนุมัติ</a>
                                        </div>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse">
                                        <div class="panel-body">
                                          <div class="table-responsive">
                                              <table class="table table-striped table-hover" >
                                                  <thead>
                                                      <tr>
                                                          <th>#</th>
                                                          <th>รหัสวิชา</th>
                                                          <th>ชื่อวิชา</th>
                                                          <th>อาจารย์ผู้สอน</th>
                                                          <th>เอกสาร</th>
                                                          <th>เอกสาร</th>
                                                          <th>เอกสาร</th>
                                                          <th></th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                      <tr >
                                                          <td>1</td>
                                                          <td>Mark</td>
                                                          <td>Mark</td>
                                                          <td>Otto</td>
                                                          <td><button type="button" class="btn btn-outline btn-primary">คลิ๊กดู</button></td>
                                                          <td><button type="button" class="btn btn-outline btn-primary">คลิ๊กดู</button></td>
                                                          <td><button type="button" class="btn btn-outline btn-primary">คลิ๊กดู</button></td>
                                                          <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#demo31" class="accordion-toggle">comment</button></td>
                                                          <td><button type="button" class="btn btn-outline btn-success">อนุมัติ</button></td>
                                                      </tr>
                                                      <tr class="hiddenRow">
                                                          <td colspan="12">
                                                            <div class="accordian-body collapse" id="demo31">
                                                              <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                  <b>คอมเม้นท์</b>
                                                                </div>
                                                                <div class="panel-body">

                                                                </div>
                                                              </div>
                                                            </div>
                                                          </td>
                                                      </tr>

                                                      <tr >

                                                          <td>2</td>
                                                          <td>Jacob</td>
                                                          <td>Mark</td>
                                                          <td>Thornton</td>
                                                          <td><button type="button" class="btn btn-outline btn-primary">คลิ๊กดู</button></td>
                                                          <td><button type="button" class="btn btn-outline btn-primary">คลิ๊กดู</button></td>
                                                          <td><button type="button" class="btn btn-outline btn-primary">คลิ๊กดู</button></td>
                                                          <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#demo32" class="accordion-toggle">comment</button></td>
                                                          <td><button type="button" class="btn btn-outline btn-success">อนุมัติ</button></td>
                                                      </tr>
                                                      <tr class="hiddenRow">
                                                          <td colspan="12">
                                                            <div class="accordian-body collapse" id="demo32">
                                                              <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                  <b>คอมเม้นท์</b>
                                                                </div>
                                                                <div class="panel-body">

                                                                </div>
                                                              </div>
                                                            </div>
                                                          </td>
                                                      </tr>

                                                      <tr>
                                                          <td>3</td>
                                                          <td>Larry</td>
                                                          <td>Mark</td>
                                                          <td>the Bird</td>
                                                          <td><button type="button" class="btn btn-outline btn-primary">คลิ๊กดู</button></td>
                                                          <td><button type="button" class="btn btn-outline btn-primary">คลิ๊กดู</button></td>
                                                          <td><button type="button" class="btn btn-outline btn-primary">คลิ๊กดู</button></td>
                                                          <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#demo33" class="accordion-toggle">comment</button></td>
                                                          <td><button type="button" class="btn btn-outline btn-success">อนุมัติ</button></td>
                                                      </tr>
                                                      <tr class="hiddenRow">
                                                          <td colspan="12">
                                                            <div class="accordian-body collapse" id="demo33">
                                                              <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                  <b>คอมเม้นท์</b>
                                                                </div>
                                                                <div class="panel-body">

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
</body>

</html>
