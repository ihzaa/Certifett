$(".pass button").on('click', function () {
  if ($('.pass input').attr("type") == "text") {
    $('.pass input').attr('type', 'password');
    $('.pass i').addClass("fa-eye-slash");
    $('.pass i').removeClass("fa-eye");
  } else if ($('.pass input').attr("type") == "password") {
    $('.pass input').attr('type', 'text');
    $('.pass i').removeClass("fa-eye-slash");
    $('.pass i').addClass("fa-eye");
  };
});

$(".newPass button").on('click', function () {
  if ($('.newPass input').attr("type") == "text") {
    $('.newPass input').attr('type', 'password');
    $('.newPass i').addClass("fa-eye-slash");
    $('.newPass i').removeClass("fa-eye");
  } else if ($('.newPass input').attr("type") == "password") {
    $('.newPass input').attr('type', 'text');
    $('.newPass i').removeClass("fa-eye-slash");
    $('.newPass i').addClass("fa-eye");
  };
});