function readFile(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            var htmlPreview =
                '<img width="200" src="' +
                e.target.result +
                '" />' +
                "<p>" +
                input.files[0].name +
                "</p>";
            var wrapperZone = $(input).parent();
            var previewZone = $(input).parent().parent().find(".preview-zone");
            var boxZone = $(input)
                .parent()
                .parent()
                .find(".preview-zone")
                .find(".box")
                .find(".box-body");

            wrapperZone.removeClass("dragover");
            previewZone.removeClass("hidden");
            boxZone.empty();
            boxZone.append(htmlPreview);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function reset(e) {
    e.wrap("<form>").closest("form").get(0).reset();
    e.unwrap();
}

$(document).on("change", ".dropzone", function () {
    readFile(this);
});

$(".dropzone-wrapper").on("dragover", function (e) {
    e.preventDefault();
    e.stopPropagation();
    $(this).addClass("dragover");
});

$(".dropzone-wrapper").on("dragleave", function (e) {
    e.preventDefault();
    e.stopPropagation();
    $(this).removeClass("dragover");
});

$(".remove-preview").on("click", function () {
    var boxZone = $(this).parents(".preview-zone").find(".box-body");
    var previewZone = $(this).parents(".preview-zone");
    var dropzone = $(this).parents(".form-group").find(".dropzone");
    $(this).parents(".preview-zone").find("input").val("");
    boxZone.empty();
    previewZone.addClass("hidden");

    reset(dropzone);
});

$(document).ready(function () {
    $(".datepicker").datepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        orientation: "bottom",
    });
});

let gbr = document.querySelector("#gbr_add_foto").getAttribute("src");

let box_khusus = `<div class="border border-radius-c p-2 mb-4" style="border-color: #495057;">
                <p class="text-normal d-flex">
                    Properti Dengan Gambar
                    <button type="button" class="ml-auto btn btn-danger btn-sm remove-preview btn-hapus-blok-khusus">
                                <i class="fa fa-times"></i> Hapus
                    </button>
                </p>
                <p class="text-normal">
                    Tambah properti khusus dengan gambar yang bisa dipakai untuk menambah hal-hal seperti pelaksana
                    acara lengkap dengan nama dan tanda tangan. atau untuk kebutuhan teks dan gambar lainnya.
                </p>
                <div class="row">
                    <div class="col-10 ml-auto mr-auto">
                        <div class="form-group">
                            <input type="text" class="form-control border-radius-c"
                                placeholder="Nama Properti*, contoh: Ketua Pelaksana" name="khusus_nama[]">
                        </div>
                        <div class="form-group">
                            <div class="preview-zone hidden">
                                <div class="box box-solid">
                                    <div class="box-header with-border">
                                        <div><b>Preview</b></div>
                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-danger btn-sm remove-preview">
                                                <i class="fa fa-times"></i> Hapus
                                            </button>
                                        </div>
                                    </div>
                                    <div class="box-body"></div>
                                </div>
                            </div>
                            <div class="dropzone-wrapper border-radius-c">
                                <div class="dropzone-desc" style="width: 90%;">
                                    <img src="${gbr}" alt="" height="56" width="56"
                                        class="img-fluid" style="float: left">
                                    <h5 class="text-normal">Gambar</h5>
                                    <p class="text-normal" style="font-size: 12px;">Drag atau klik untuk menambahkan
                                        (optional)</p>
                                </div>
                                <input type="file" name="khusus_gambar[]" class="dropzone">
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control border-radius-c" name="khusus_properti[]" id="karena" rows="5" placeholder="Data Properti*,
contoh:

Yusuf Ahmad
NIK. 123 456 789"></textarea>
                        </div>
                    </div>
                </div>
            </div>`;

$(document).on("click", "#btn-tambah-properti", function () {
    if ($("#switch_properti_khusus").is(":checked")) {
        $("#properti-tambahan").append(box_khusus);
    } else {
        swal(
            "Aktifkan Switch Disamping Properti Khusus Untuk Menambahkan",
            "",
            "error"
        );
    }
});

$("#switch_properti_khusus").on("click", function () {
    if ($(this).is(":checked")) {
        $("fieldset").removeAttr("disabled");
    } else {
        $("fieldset").attr("disabled", "");
    }
});

$(document).on("click", ".btn-hapus-blok-khusus", function () {
    $(this).parent().parent().remove();
});

$("#buatAcara").on("submit", function () {
    $(".se-pre-con").fadeIn();
});
