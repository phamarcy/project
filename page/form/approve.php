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

    <link rel="stylesheet" href="../dist/css/scrollbar.css">

    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.js"></script>

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
                <form data-toggle="validator" role="form">
                  <div class="form-inline" style="font-size:16px;">
                           <div class="form-group">
                              <label id="semester" class="control-label">ปีการศึกษา</label>
                               <select class="form-control required" id="semester" style="width: 70px;" id="select" required>
                                  <option value="">--</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                               </select>
                           </div>
                           <div class="form-group">
                             <label for="inputyear" class="control-label">ปีการศึกษา</label>
                             <input type="number" class="form-control" id="inputyear" style="width: 150px;" placeholder="e.g. 2560"  data-minlength="4"  max="9999" required>
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
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-yellow">
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
                                                      <tr>
                                                          <th>#</th>
                                                          <th>รหัสวิชา</th>
                                                          <th>ชื่อวิชา</th>
                                                          <th>อาจารย์ผู้สอน</th>
                                                          <th>เอกสาร</th>
                                                          <th>เอกสาร</th>
                                                          <th>เอกสาร</th>
                                                          <th></th>
                                                          <th></th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                      <tr data-toggle="collapse" data-target="#demo1" class="accordion-toggle">
                                                          <td>1</td>
                                                          <td>Mark</td>
                                                          <td>Mark</td>
                                                          <td>Otto</td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-success">อนุมัติ</button></td>
                                                          <td><button type="button" class="btn btn-danger">ไม่อนุมัติ</button></td>
                                                      </tr>
                                                      <tr class="hiddenRow">
                                                          <td colspan="12">
                                                            <div class="accordian-body collapse" id="demo1">
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
                                                      <tr data-toggle="collapse" data-target="#demo2" class="accordion-toggle">
                                                          <td>2</td>
                                                          <td>Jacob</td>
                                                          <td>Mark</td>
                                                          <td>Thornton</td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-success">อนุมัติ</button></td>
                                                          <td><button type="button" class="btn btn-danger">ไม่อนุมัติ</button></td>
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
                                                      <tr data-toggle="collapse" data-target="#demo3" class="accordion-toggle">
                                                          <td>3</td>
                                                          <td>Larry</td>
                                                          <td>Mark</td>
                                                          <td>the Bird</td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-success">อนุมัติ</button></td>
                                                          <td><button type="button" class="btn btn-danger">ไม่อนุมัติ</button></td>
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

                                <div class="panel panel-green">
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
                                                      <tr  data-toggle="collapse" data-target="#demo21" class="accordion-toggle">
                                                          <td>1</td>
                                                          <td>Mark</td>
                                                          <td>Mark</td>
                                                          <td>Otto</td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-danger">ยกเลิกอนุมัติ</button></td>
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
                                                      <tr  data-toggle="collapse" data-target="#demo22" class="accordion-toggle">
                                                          <td>2</td>
                                                          <td>Jacob</td>
                                                          <td>Mark</td>
                                                          <td>Thornton</td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-danger">ยกเลิกอนุมัติ</button></td>
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
                                                      <tr  data-toggle="collapse" data-target="#demo23" class="accordion-toggle">
                                                          <td>3</td>
                                                          <td>Larry</td>
                                                          <td>Mark</td>
                                                          <td>the Bird</td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-danger">ยกเลิกอนุมัติ</button></td>
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
                                <div class="panel panel-red">
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
                                                      <tr  data-toggle="collapse" data-target="#demo31" class="accordion-toggle">
                                                          <td>1</td>
                                                          <td>Mark</td>
                                                          <td>Mark</td>
                                                          <td>Otto</td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-success">อนุมัติ</button></td>
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

                                                      <tr data-toggle="collapse" data-target="#demo32" class="accordion-toggle">

                                                          <td>2</td>
                                                          <td>Jacob</td>
                                                          <td>Mark</td>
                                                          <td>Thornton</td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-success">อนุมัติ</button></td>
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

                                                      <tr data-toggle="collapse" data-target="#demo33" class="accordion-toggle">
                                                          <td>3</td>
                                                          <td>Larry</td>
                                                          <td>Mark</td>
                                                          <td>the Bird</td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-success">อนุมัติ</button></td>
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
