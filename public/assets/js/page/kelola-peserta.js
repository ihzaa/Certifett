function checkAll(ele) {
    var checkboxes = document.getElementsByTagName("input");
    if (ele.checked) {
        $("#jml_dicentang").html($(".check_input").length);
        for (var i = 0; i < checkboxes.length; i++) {
            if (
                checkboxes[i].type == "checkbox" &&
                !checkboxes[i].classList.contains("sudah_dibuat")
            ) {
                checkboxes[i].checked = true;
                $("#checkbox_header")
                    .css("background-color", "")
                    .css("background-color", "");
            }
        }
    } else {
        $("#jml_dicentang").html(0);
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].type == "checkbox") {
                checkboxes[i].checked = false;
                $("#checkbox_header")
                    .css("background-color", "")
                    .css("background-color", "");
            }
        }
    }
}

$(".check_input").change(function () {
    if ($(this).is(":checked")) {
        $("#jml_dicentang").html(parseInt($("#jml_dicentang").html()) + 1);
    } else {
        $("#jml_dicentang").html(parseInt($("#jml_dicentang").html()) - 1);
    }
    if ($(".check_input:checked").length == $(".check_input").length) {
        document.getElementById("check_header").checked = true;
        $("#checkbox_header")
            .css("background-color", "")
            .css("background-color", "");
    } else if ($(".check_input:checked").length > 0) {
        $("#checkbox_header")
            .css("background-color", "")
            .css("background-color", "#26A69A");
    } else {
        document.getElementById("checkbox_header").style.backgroundColor =
            "#ffffff";
        document.getElementById("check_header").checked = false;
    }
});

$(".sudah_dibuat").click(function () {
    $(this).prop("checked", false);
    let el_p = document.createElement("p");
    let el_img = document.createElement("img");
    el_img.setAttribute("src", "/assets/icons/check_circle-24px.svg");
    el_p.innerHTML = "Sertifikat peserta dengan icon ";
    el_p.append(el_img);
    el_p.innerHTML += " telah dibuat.";
    swal({
        title: "Sertifikat telah dibuat.",
        content: el_p,
    });
});

function copyToClipboard(str) {
    // Create new element
    var el = document.createElement("textarea");
    // Set value (string to be copied)
    el.value = str;
    // Set non-editable to avoid focus and move outside of view
    el.setAttribute("readonly", "");
    el.style = { display: "none" };
    document.body.appendChild(el);
    // Select text inside element
    el.select();
    // Copy text to clipboard
    document.execCommand("copy");
    // Remove temporary element
    document.body.removeChild(el);
    alert("link telah di copy");
}

function search() {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("src_in");
    filter = input.value.toUpperCase();
    table = document.getElementById("tabel_list");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td_nama = tr[i].getElementsByTagName("td")[0];
        td_email = tr[i].getElementsByTagName("td")[1];
        if (td_nama) {
            txtNama = td_nama.innerText.toUpperCase();
            txtEmail = td_email.innerText.toUpperCase();
            if (
                txtNama.toUpperCase().indexOf(filter) > -1 ||
                txtEmail.toUpperCase().indexOf(filter) > -1
            ) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

$("#buatSertif").on("click", function () {
    $(".se-pre-con").fadeIn();
    $("#form_centang").submit();
});
