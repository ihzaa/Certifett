function checkAll(ele) {
    var checkboxes = document.getElementsByTagName("input");
    if (ele.checked) {
        $("#jml_dicentang").html($(".check_input").length);
        for (var i = 0; i < checkboxes.length; i++) {
            if (
                checkboxes[i].type == "checkbox"
                // &&
                // !checkboxes[i].classList.contains("sudah_dibuat")
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
    $("#cpy_btn").notify("tautan dicopy", "success", { position: "bottom" });
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
    if ($("#jml_dicentang").html() == 0) {
        swal("Maaf", "Tidak Peserta Yang Dipilih.", "error");
    } else if ($(".blm_dibuat:checked").length == 0) {
        swal(
            "Maaf",
            "Peserta Yang Dipilih Sudah Dibuatkan Sertifikat.",
            "error"
        );
    } else {
        $(".se-pre-con").fadeIn();
        $("#form_centang").submit();
    }
});

$("#input-csv").on("change", function () {
    $("#input-csv-label").html($(this).val().substr(12));
    if ($("#input-csv-label").html().split(".").pop() === "csv") {
        $("#btn-cek-kolom").removeAttr("disabled");
    } else {
        $("#btn-cek-kolom").attr("disabled", "");
    }
});

let data = [];
$("#btn-cek-kolom").on("click", function () {
    $("#body_bawah_modal").show();
    $("#btn-up-csv").show();
    Papa.parse(document.getElementById("input-csv").files[0], {
        complete: function (results) {
            data = results.data;
            let nama = document.querySelector("#grb-nama");
            let email = document.querySelector("#grb-email");
            let i = 0;
            data[0].forEach((el) => {
                nama.innerHTML += `
                <label class="btn btn-outline-dark">
                    <input type="radio" name="options_nama" value="${i}" autocomplete="off" required> ${el}
                </label>
                `;
                email.innerHTML += `
                <label class="btn btn-outline-dark">
                    <input type="radio" name="options_email" value="${i}" autocomplete="off" required> ${el}
                </label>
                `;
                i++;
            });
        },
    });
});

$("#btn-up-csv").on("click", function () {
    if (
        $("input[name='options_nama']:checked").val() &&
        $("input[name='options_email']:checked").val() &&
        $("input[name='options_email']:checked").val() !=
            $("input[name='options_nama']:checked").val()
    ) {
        $(".se-pre-con").fadeIn();
        var dataform = new FormData();
        dataform.append("data", JSON.stringify(data));
        dataform.append("_token", $('meta[name="csrf-token"]').attr("content"));
        dataform.append(
            "col_nama",
            $("input[name='options_nama']:checked").val()
        );
        dataform.append(
            "col_email",
            $("input[name='options_email']:checked").val()
        );
        axios({
            method: "post",
            url: path.ev,
            data: dataform,
        })
            .then((resp) => {
                if (resp.data.message === "ok") {
                    location.reload();
                }
            })
            .catch((err) => {
                console.log(err);
            });
    } else if (
        $("input[name='options_email']:checked").val() ==
        $("input[name='options_nama']:checked").val()
    ) {
        swal("Kolom nama dan email tidak boleh sama", "", "error");
    } else {
        swal("Silahkan pilih kolom", "", "error");
    }
});

$(".btn-hps").on("click", function () {
    event.preventDefault();
    swal({
        title: "Yakin menghapus peserta?",
        text: "Sertifikat peserta juga akan dihapus!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $(".se-pre-con").fadeIn();
            let a = $(this).parents("tr").find("input").attr("name");
            var id_p = a.substring(a.lastIndexOf("[") + 1, a.lastIndexOf("]"));
            var dataform = new FormData();
            dataform.append("id", id_p);
            axios({
                method: "post",
                url: path.ps,
                data: dataform,
            })
                .then((resp) => {
                    if (resp.data.message === "ok") {
                        $(".se-pre-con").fadeOut("slow");
                        $(this).parents("tr").remove();
                        swal("Peserta telah dihapus!", {
                            icon: "success",
                        });
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        }
    });
});

$("#btn-hps-all").on("click", function () {
    event.preventDefault();
    if ($("#jml_dicentang").html() == 0) {
        swal("Maaf", "Tidak Peserta Yang Dipilih.", "error");
    } else {
        let jml_ctg = $("#jml_dicentang").html();
        swal({
            title: `Yakin menghapus ${jml_ctg} peserta yang dipilih?`,
            text: "Sertifikat peserta juga akan dihapus!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $(".se-pre-con").fadeIn();
                let arr = $("input[type='checkbox']:checked");
                let arr_id = Array();
                console.log(arr);
                let a = "";
                for (let i = 0; i < arr.length; i++) {
                    a = arr[i].getAttribute("name");
                    if (a == null) {
                        continue;
                    }
                    arr[i].closest("tr").remove();
                    arr_id.push(
                        a.substring(a.lastIndexOf("[") + 1, a.lastIndexOf("]"))
                    );
                }
                var dataform = new FormData();
                dataform.append("id", JSON.stringify(arr_id));
                axios({
                    method: "post",
                    url: path.psb,
                    data: dataform,
                })
                    .then((resp) => {
                        if (resp.data.message === "ok") {
                            $("#checkbox_header").css("background-color", "");
                            $("#jml_dicentang").html(0);
                            $("#jml_psrt").html(
                                parseInt($("#jml_psrt").html()) - jml_ctg
                            );
                            $(".se-pre-con").fadeOut("slow");
                            swal(`${jml_ctg} Peserta telah dihapus!`, {
                                icon: "success",
                            });
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            }
        });
    }
});

$(".btn-edit").on("click", function () {
    event.preventDefault();
    let id = $(this).parents("tr").find("input").attr("name");
    $("#modal_edit form").attr(
        "action",
        "/acara/Edit/Peserta/" +
            id.substring(id.lastIndexOf("[") + 1, id.lastIndexOf("]"))
    );
    $("#modal_edit #nama_edit").val(
        $(this).parents("tr").find("#col_nama").html()
    );
    $("#modal_edit #email_edit").val(
        $(this).parents("tr").find("#col_email").html()
    );
    $("#modal_edit").modal("show");
});

function previewSertif(nama,id){
    $("#id_peserta_prev").html("#"+id);
    $("#nama_peserta_modal").html(nama);
    $("#modal-preview").modal("show");
}
