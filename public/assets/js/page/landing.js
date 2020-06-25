$('input[type="range"]').rangeslider({
    polyfill: false,
});
$("body").attr("data-spy", "scroll");
$("body").attr("data-target", ".navbar");
$("body").attr("offset", "57");

$("#nav-landing a").on("click", function (event) {
    if (this.hash !== "") {
        event.preventDefault();
        $(this).blur();
        $(".navbar-collapse").collapse("hide");
        var hash = this.hash;
        if ($(window).width() <= 991) {
            $("html, body").animate(
                {
                    scrollTop: $(hash).offset().top - 80,
                },
                400
            );
        } else {
            $("html, body").animate(
                {
                    scrollTop: $(hash).offset().top - 10,
                },
                400
            );
        }
    }
});

$(document).ready(function () {
    var slider = document.getElementById("slider");
    var output = document.getElementById("demo");
    var total = document.getElementById("TotalHarga");
    output.innerHTML = slider.value;
    total.innerHTML = "Rp. 250.000";
    slider.oninput = function () {
        output.innerHTML = this.value;
        total.innerHTML =
            "Rp. " + numberWithCommas(parseInt(this.value) * 25000);
    };

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".");
    }
});
