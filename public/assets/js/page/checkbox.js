function checkAll(ele) {
  var checkboxes = document.getElementsByTagName('input');
  if (ele.checked) {
    for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].type == 'checkbox') {
        checkboxes[i].checked = true;
        $('#checkbox_header').css('background-color', '').css('background-color', '');
      }
    }
  } else {
    for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].type == 'checkbox') {
        checkboxes[i].checked = false;
        $('#checkbox_header').css('background-color', '').css('background-color', '');
      }
    }
  }
}

$('.check_input').change(function () {
  if ($('.check_input:checked').length == $('.check_input').length) {
    document.getElementById("check_header").checked = true;
    $('#checkbox_header').css('background-color', '').css('background-color', '');
  } else if ($('.check_input:checked').length > 0) {
    $('#checkbox_header').css('background-color', '').css('background-color', '#26A69A');
  } else {
    document.getElementById("checkbox_header").style.backgroundColor = "#ffffff";
    document.getElementById("check_header").checked = false;
  }
});