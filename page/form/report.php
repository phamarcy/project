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
<script type="text/javascript">
function search() {
    $('#searchstatus').html("<img src='../../application/picture/loading_icon.gif' height='35' >");
    var URL = '../../application/report/staff_report.php';
    $.ajax({
        url: URL, // point to server-side PHP script
        dataType: 'text', // what to expect back from the PHP script, if anything
        data: 'ssss',
        type: 'post',
        success: function(result) {
            $("#searchstatus").hide();
            $('#searchstatus').css('color', 'green');
            $('#searchstatus').text("สำเร็จ");
            $('#searchstatus').fadeIn();
            render(result);
        },
        failure: function(result) {
            alert(result);
        },
        error: function(xhr, status, p3, p4) {
            var err = "Error " + " " + status + " " + p3 + " " + p4;
            if (xhr.responseText && xhr.responseText[0] == "{")
                err = JSON.parse(xhr.responseText).Message;
            console.log(err);
        }
    });
}
function render(data)
{
    //create report panel
    var panel = document.createElement("div");
    panel.setAttribute("class","panel panel-default");
    //create panel header
    var header = document.createElement("div");
    header.setAttribute("class","panel-heading");
    header.innerHTML = "header";
    //create panel content
    var content = document.createElement("div");
    content.setAttribute("class","panel-body");
    content.innerHTML = "Content";
    panel.appendChild(header);
    panel.appendChild(content);

    $("#body").html(panel);
}
</script>
<body>
<div >
    <h3 class="page-header"><center>สรุปข้อมูล</center></h3>
    <div class="form-inline">
        <center>
            <h style="font-size : 16px">ภาคการศึกษาที่
		     	<div class="form-group">
		          	<select class="form-control">
		              <option>1</option>
		              <option>2</option>
		              <option>3</option>
		          	</select>
		      	</div>
		      		ปีการศึกษา
		      		<input class="form-control" placeholder="Ex. 2560" style="width: 100px;">
                	&nbsp;<button type="button" class="btn btn-success" onclick="search()" >ค้นหา</button>
                	<div id="searchstatus" style="display:inline;"></div>
                </h>
        </center>
        </div>
        <br>
        <div class="container" id="body">
        </div>
  	<br>
  </div>

</div>
</body>
</html>
