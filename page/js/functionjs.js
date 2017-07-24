function lecloop() {
  var lec = document.getElementById("leclist");
  var i;
  if (lec.value == 0) {
    for (i = 1; i <= 11; i++) {
      document.getElementById("li" + i).style.display = "none";
      document.getElementById('ctlec' + i).classList.add('hide');
      document.getElementById("TEACHERLEC_F" + i).style.display = "none";
      document.getElementById("TEACHERLEC_L" + i).style.display = "none";
    }
  } else {
    //document.getElementById("test1").innerHTML = lec.value;
    for (i = 1; i <= 11; i++) {
      document.getElementById("li" + i).style.display = "none";
      document.getElementById('ctlec' + i).classList.add('hide');
      document.getElementById('TEACHERLEC_F' + i).style.display = "none";
      document.getElementById("TEACHERLEC_L" + i).style.display = "none";
    }

    for (i = 1; i <= lec.value; i++) {
      document.getElementById("li" + i).style.display = "";
      document.getElementById('ctlec' + i).classList.remove('hide');
      document.getElementById('TEACHERLEC_F' + i).style.display = "";
      document.getElementById("TEACHERLEC_L" + i).style.display = "";
    }
  }
}

function labloop() {
  var lab = document.getElementById("lablist");
  var i;
  if (lab.value == 0) {
    for (i = 1; i <= 11; i++) {
      document.getElementById("la" + i).style.display = "none";
      document.getElementById('ctlab' + i).classList.add('hide');
      document.getElementById("TEACHERLAB_F" + i).style.display = "none";
      document.getElementById('TEACHERLAB_L' + i).style.display = "none";
    }
  } else {
    //document.getElementById("test1").innerHTML = lab.value;
    for (i = 1; i <= 11; i++) {
      document.getElementById("la" + i).style.display = "none";
      document.getElementById('ctlab' + i).classList.add('hide');
      document.getElementById('TEACHERLAB_F' + i).style.display = "none";
      document.getElementById('TEACHERLAB_L' + i).style.display = "none";

    }

    for (i = 1; i <= lab.value; i++) {
      document.getElementById("la" + i).style.display = "";
      document.getElementById('ctlab' + i).classList.remove('hide');
      document.getElementById('TEACHERLAB_F' + i).style.display = "";
      document.getElementById('TEACHERLAB_L' + i).style.display = "";

    }
  }
}

function midexam_hour_lec() {
  var lec = document.getElementById("mexholec");
  var i;
  if (lec.value == 0) {
    for (i = 1; i <= 5; i++) {
      document.getElementById("mehle" + i).style.display = "none";
      document.getElementById('mehlec' + i).classList.add('hide');
      document.getElementById("MIDEXCOM_LECF" + i).style.display = "none";
      document.getElementById('MIDEXCOM_LECL' + i).style.display = "none";
    }
  } else {
    //document.getElementById("test1").innerHTML = lab.value;
    for (i = 1; i <= 5; i++) {
      document.getElementById("mehle" + i).style.display = "none";
      document.getElementById('mehlec' + i).classList.add('hide');
      document.getElementById('MIDEXCOM_LECF' + i).style.display = "none";
      document.getElementById('MIDEXCOM_LECL' + i).style.display = "none";

    }

    for (i = 1; i <= lec.value; i++) {
      document.getElementById("mehle" + i).style.display = "";
      document.getElementById('mehlec' + i).classList.remove('hide');
      document.getElementById('MIDEXCOM_LECF' + i).style.display = "";
      document.getElementById('MIDEXCOM_LECL' + i).style.display = "";

    }
  }
}

function midexam_hour_lab() {
  var lab = document.getElementById("mexholac");
  var i;
  if (lab.value == 0) {
    for (i = 1; i <= 5; i++) {
      document.getElementById("ehla" + i).style.display = "none";
      document.getElementById('ehlab' + i).classList.add('hide');
      document.getElementById("MIDEXCOM_LABF" + i).style.display = "none";
      document.getElementById('MIDEXCOM_LABL' + i).style.display = "none";
    }
  } else {
    //document.getElementById("test1").innerHTML = lab.value;
    for (i = 1; i <= 5; i++) {
      document.getElementById("ehla" + i).style.display = "none";
      document.getElementById('ehlab' + i).classList.add('hide');
      document.getElementById('MIDEXCOM_LABF' + i).style.display = "none";
      document.getElementById('MIDEXCOM_LABL' + i).style.display = "none";

    }

    for (i = 1; i <= lab.value; i++) {
      document.getElementById("ehla" + i).style.display = "";
      document.getElementById('ehlab' + i).classList.remove('hide');
      document.getElementById('MIDEXCOM_LABF' + i).style.display = "";
      document.getElementById('MIDEXCOM_LABL' + i).style.display = "";

    }
  }
}

function finexam_hour_lec() {
  var lec = document.getElementById("fexholec");
  var i;
  if (lec.value == 0) {
    for (i = 1; i <= 5; i++) {
      document.getElementById("fmehle" + i).style.display = "none";
      document.getElementById('fmehlec' + i).classList.add('hide');
      document.getElementById("FINEXCOM_LECF" + i).style.display = "none";
      document.getElementById('FINEXCOM_LECL' + i).style.display = "none";
    }
  } else {
    //document.getElementById("test1").innerHTML = lab.value;
    for (i = 1; i <= 5; i++) {
      document.getElementById("fmehle" + i).style.display = "none";
      document.getElementById('fmehlec' + i).classList.add('hide');
      document.getElementById('FINEXCOM_LECF' + i).style.display = "none";
      document.getElementById('FINEXCOM_LECL' + i).style.display = "none";

    }

    for (i = 1; i <= lec.value; i++) {
      document.getElementById("fmehle" + i).style.display = "";
      document.getElementById('fmehlec' + i).classList.remove('hide');
      document.getElementById('FINEXCOM_LECF' + i).style.display = "";
      document.getElementById('FINEXCOM_LECL' + i).style.display = "";

    }
  }
}

function finexam_hour_lab() {
  var lab = document.getElementById("fexholac");
  var i;
  if (lab.value == 0) {
    for (i = 1; i <= 5; i++) {
      document.getElementById("fehla" + i).style.display = "none";
      document.getElementById('fehlab' + i).classList.add('hide');
      document.getElementById("FINEXCOM_LABF" + i).style.display = "none";
      document.getElementById('FINEXCOM_LABL' + i).style.display = "none";
    }
  } else {
    //document.getElementById("test1").innerHTML = lab.value;
    for (i = 1; i <= 5; i++) {
      document.getElementById("fehla" + i).style.display = "none";
      document.getElementById('fehlab' + i).classList.add('hide');
      document.getElementById('FINEXCOM_LABF' + i).style.display = "none";
      document.getElementById('FINEXCOM_LABL' + i).style.display = "none";

    }

    for (i = 1; i <= lab.value; i++) {
      document.getElementById("fehla" + i).style.display = "";
      document.getElementById('fehlab' + i).classList.remove('hide');
      document.getElementById('FINEXCOM_LABF' + i).style.display = "";
      document.getElementById('FINEXCOM_LABL' + i).style.display = "";

    }
  }
}

function submitfunc() {
  var test = document.getElementById("COURSE_ID");
  var data = {
    'COURSE_ID': test.value
  };
  alert(JSON.stringify(data));

}

$(document).ready(function() {
  $('#addbtn').click(function() {
    var table = $(this).closest('table');
    console.log(table.find('input:text').length);
    if (table.find('input:text').length < 100) {
      $('#delbtn').removeAttr("disabled");
      var x = $(this).closest('tr').nextAll('tr');
      var rowCount = $('#meastable tr').length;
      $.each(x, function(i, val) {
        val.remove();
      });
      table.append('<tr class="warning" id="row' + (rowCount - 4) + '"><td colspan="2"><div class="form-inline"><input type="button" class="btn btn-danger" name="delbtn' + (rowCount - 4) + '" id="delbtn' + (rowCount - 4) +
        '" value="ลบ" onclick="deleteRow(' + (rowCount - 4) + ')">&nbsp;&nbsp;<input type="text" class="form-control" name="MEASURE_OTHERCOMMENT' + (rowCount - 4) + '" id="MEASURE_OTHERCOMMENT' + (rowCount - 4) +
        '" size="50"></div></td><td><input type="text" class="form-control" name="MEASURE_OTHERLEC' + (rowCount - 4) + '" id="MEASURE_OTHERLEC' + (rowCount - 4) +
        '" size="2"></td><td><input type="text" class="form-control" name="MEASURE_OTHERLAB' + (rowCount - 4) + '" id="MEASURE_OTHERLAB' + (rowCount - 4) + '" size="2"></td></tr>');
      $.each(x, function(i, val) {
        table.append(val);
      });
    }
  });
});

function deleteRow(r) {
  var i = r;

  var row = document.getElementById('row' + i);
  row.parentNode.removeChild(row);
}
