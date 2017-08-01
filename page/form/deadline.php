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
<style>
.form-control {
    height: 30px;
}
</style>
<script type="text/javascript">
$(document).ready(function(){
    $("#addbtn").click(function(){
        var i = 0;
        var object = document.getElementById("group");
        $(object).clone().find("input").val("").end().prependTo("#body");
    });
});
$(document).on('click',"#submitbtn", function(){
    url = "../../application/deadline/update_deadline.php";
    var form = $(this).parent();
    var formData = {};
    $(form).find("input[id]").each(function (index, node) {
        formData[node.id] = node.value;
    });
    $.post(url,{'DATA' : formData}).done(function (data){
        alert(data);
    });
});
</script>

<body>
    <h3 class="page-header"><center>กำหนดช่วงเวลา</center></h3>
    <div class="form-inline">
    </div>
    <br>
    <div class="container">
        <div class="panel panel-default" >
            <div class="panel-heading">
                <div class="form-inline">
                    <h5 style="font-size : 16px">กำหนดเวลากรอกข้อมูลรายละเอียดกระบวนวิชา
                    <button type="button" class="btn btn-default" id="addbtn">เพิ่ม</button>
                    </h5>
                </div>
            </div>
            <div class="panel-body" id="body">
                <div class="well" style="position: relative;" id="group">
                    <br>
                    <form>
                        <div class="form-inline">
                            <h style="width: 100px; " ">ภาคการศึกษาที่ </h>
                            <div class="form-group">
                                <select class="form-control " id="semester" style="width: 70px; ">
                                  <option>1</option>
                                  <option>2</option>
                                  <option>3</option>
                                </select>
                            </div> 
                                ปีการศึกษา 
                                <input class="form-control " id="year" placeholder="Ex. 2560" style="width: 100px; ">
                        </div>
                        <br>
                    <div class="form-inline ">
                        วันเปิดการกรอกข้อมูลกระบวนวิชา <input class="form-control " type="date" id="opendate"> <br><br>
                        วันสุดท้ายของการกรอกข้อมูลกระบวนวิชา <input class="form-control " type="date" id="lastdate">
                    </div>
                        <button type="button" class="btn btn-outline btn-default" style="position: absolute; right: 10px; bottom: 10px;" id="submitbtn">บันทึก</button>
                    </form>
                </div>
            </div>       
        </div>
       
    </div>
</body>
</html>