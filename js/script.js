$(document).ready(function () {
  $('.message a').click(function () {
    // $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
    console.log('hi sas');
    $('form').toggle();
  });
});

// Form Validation
document.getElementById('login-form').addEventListener('submit', function (e) {
  e.preventDefault();

  const email = document.getElementById('email').value;
  const password = document.getElementById('password').value;

  fetch('login.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: new URLSearchParams({ email, password }),
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.success) {
        window.location.href = data.redirect; 
      } else {
        document.getElementById('error-message').innerText = data.message;
      }
    });
});


$(document).ready(function () {
  $(".navbar a, footer a[href='#myPage']").on('click', function (event) {
    if (this.hash !== '') {
      event.preventDefault();

      var hash = this.hash;

      $('html, body').animate(
        {
          scrollTop: $(hash).offset().top,
        },
        900,
        function () {
          window.location.hash = hash;
        }
      );
    } 
  });

  $(window).scroll(function () {
    $('.slideanim').each(function () {
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
      if (pos < winTop + 600) {
        $(this).addClass('slide');
      }
    });
  });
});
