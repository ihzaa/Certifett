$('input[type="range"]').rangeslider({
    polyfill: false,
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
// Add scrollspy to <body>
$("body").scrollspy({ target: ".navbar" });

// Add smooth scrolling on all links inside the navbar
$(".navbar-nav a").on("click", function (event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
        // Prevent default anchor click behavior
        event.preventDefault();

        // Store hash
        var hash = this.hash;

        // Using jQuery's animate() method to add smooth page scroll
        // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
        $("html, body").animate(
            {
                scrollTop: $(hash).offset().top - 80,
            },
            800,
            function () {}
        );
    } // End if
});
