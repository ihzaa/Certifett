$("#btn_dwnld").on("click", function () {
    $(".se-pre-con").fadeIn();
    domtoimage
        .toJpeg(document.getElementById("sertifikat"), { quality: 0.95 })
        .then(function (dataUrl) {
            var link = document.createElement("a");
            link.download = "Sertifikat.jpeg";
            link.href = dataUrl;
            link.click();
            $(".se-pre-con").fadeOut("slow");
        });
});
