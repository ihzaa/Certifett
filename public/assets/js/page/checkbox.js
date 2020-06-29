function checkAll(ele) {
  var checkboxes = document.getElementsByTagName('input');
  if (ele.checked) {
    for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].type == 'checkbox') {
        checkboxes[i].checked = true;
      }
    }
  } else {
    for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].type == 'checkbox') {
        checkboxes[i].checked = false;
      }
    }
  }
}

$(".check_input").change(function () {
  if ($('.check_input:checked').length == $('.check_input').length) {
    document.getElementById("checkbox_header").style.backgroundColor = "#ffffff";
    console.log($('.check_input:checked').length);
  } else if ($('.check_input:checked').length > 0) {
    document.getElementById("checkbox_header").style.backgroundColor = "#26A69A";
    console.log($('.check_input:checked').length);
  } else {
    document.getElementById("checkbox_header").style.backgroundColor = "#ffffff";
    console.log($('.check_input:checked').length);
  }
});