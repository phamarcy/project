<html>
<header>
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
    <link rel="stylesheet" href="../dist/css/scrollbar.css">
</header>


<body class="mybox">
    <div id="wrapper" style="padding-left: 30px; padding-right: 30px;">
      <div class="row" >
        <center>
            <h1 class="page-header">อนุมัติกระบวนวิชา<br /></h1>
            <div class="form-inline">
                <h style="width: 100px;">ภาคการศึกษาที่ </h>
                <div class="form-group">
                    <select class="form-control" id="semester" style="width: 70px; ">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                    </select>
                </div>
                ปีการศึกษา
                <input class="form-control" id="year" placeholder="Ex. 2560" style="width: 100px;">
                <button type="button" class="btn btn-primary">ค้นหา</button>

            </div>
        </center>
      </div>
      <br>
      <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3>ภาคการศึกษาที่ 2 ปีการศึกษา 2560</h3>
                        </div>
                        <!-- .panel-heading -->
                        <div class="panel-body">
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-yellow">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><h4><b>รอการอนุมัติ</b></h4></a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
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
                                                          <th></th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                      <tr>
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
                                                      <tr>
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
                                                      <tr>
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
                                                  </tbody>
                                              </table>
                                          </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-green">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><h4><b>อนุมัติ</b></h4></a>
                                        </h4>
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
                                                      <tr>
                                                          <td>1</td>
                                                          <td>Mark</td>
                                                          <td>Mark</td>
                                                          <td>Otto</td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-danger">ยกเลิกอนุมัติ</button></td>
                                                      </tr>
                                                      <tr>
                                                          <td>2</td>
                                                          <td>Jacob</td>
                                                          <td>Mark</td>
                                                          <td>Thornton</td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-danger">ยกเลิกอนุมัติ</button></td>
                                                      </tr>
                                                      <tr>
                                                          <td>3</td>
                                                          <td>Larry</td>
                                                          <td>Mark</td>
                                                          <td>the Bird</td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-danger">ยกเลิกอนุมัติ</button></td>
                                                      </tr>
                                                  </tbody>
                                              </table>
                                          </div>
                                    </div>
                                </div>
                              </div>
                                <div class="panel panel-red">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"><h4><b>ไม่อนุมัติ</b></h4></a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse">
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
                                                      <tr>
                                                          <td>1</td>
                                                          <td>Mark</td>
                                                          <td>Mark</td>
                                                          <td>Otto</td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-success">อนุมัติ</button></td>
                                                      </tr>
                                                      <tr>
                                                          <td>2</td>
                                                          <td>Jacob</td>
                                                          <td>Mark</td>
                                                          <td>Thornton</td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-success">อนุมัติ</button></td>
                                                      </tr>
                                                      <tr>
                                                          <td>3</td>
                                                          <td>Larry</td>
                                                          <td>Mark</td>
                                                          <td>the Bird</td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-primary">Primary</button></td>
                                                          <td><button type="button" class="btn btn-success">อนุมัติ</button></td>
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
