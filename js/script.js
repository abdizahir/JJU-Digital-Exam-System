$(document).ready(function () {
  $('.message a').click(function () {
    // $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
    console.log('hi sas');
    $('form').toggle();
  });
});

$(document).ready(function () {
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function (event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== '') {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate(
        {
          scrollTop: $(hash).offset().top,
        },
        900,
        function () {
          // Add hash (#) to URL when done scrolling (default click behavior)
          window.location.hash = hash;
        }
      );
    } // End if
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

document.getElementById('login-form').addEventListener('submit', function (e) {
  e.preventDefault();

  const email = document.getElementById('email').value;
  const password = document.getElementById('password').value;
  const role = document.querySelector('input[name="role"]:checked')?.value;

  if (!role) {
    document.getElementById('error-message').innerText =
      'Please select a role (Student or Teacher)';
    return;
  }

  fetch('login.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: new URLSearchParams({ email, password, role }),
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.success) {
        window.location.href = data.redirect; // Redirect to the appropriate page
      } else {
        document.getElementById('error-message').innerText = data.message;
      }
    });
});


// ---------------------------- SideNav Toggle ---------------------------------
document.getElementById('sidenav-btn').addEventListener('click', function () {
  console.log('clicked')
  const sidebar = document.getElementById('sidenav');
  sidebar.classList.toggle('side-nav-small');
  sidebar.classList.toggle('side-nav-big');
});

//!
// function handleLogin(formId, emailId, passwordId, errorId) {
//   document.getElementById(formId).addEventListener('submit', function (e) {
//     e.preventDefault();

//     const email = document.getElementById(emailId).value;
//     const password = document.getElementById(passwordId).value;

//     fetch('login.php', {
//       method: 'POST',
//       headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
//       body: new URLSearchParams({ email, password }),
//     })
//       .then((res) => res.json())
//       .then((data) => {
//         if (data.success) {
//           window.location.href = data.redirect;
//         } else {
//           document.getElementById(errorId).innerText = data.message;
//           console.log('error' + formId);
//         }
//       });
//   });
// }

// handleLogin('student-login-form', 'student-email', 'student-password', 'student-error');
// handleLogin('teacher-login-form', 'teacher-email', 'teacher-password', 'teacher-error');

//!

// home page dropdown menu
// const moreBtn = document.querySelector('.more-btn');
// const moreMenu = document.querySelector('.more');

// // Toggle dropdown on button click
// // moreBtn.addEventListener('click', (e) => {
// //   e.stopPropagation(); // prevent triggering document click
// //   moreMenu.classList.toggle('open');
// //   moreBtn.classList.toggle('fa-bars');
// //   moreBtn.classList.toggle('fa-times');
// // });

// // Close on click outside
// document.addEventListener('click', (e) => {
//   if (!moreMenu.contains(e.target)) {
//     moreMenu.classList.remove('open');
//     moreBtn.classList.add('fa-bars');
//     moreBtn.classList.remove('fa-times');
//   }
// });

// // Close on scroll
// window.addEventListener('scroll', () => {
//   moreMenu.classList.remove('open');
//   moreBtn.classList.add('fa-bars');
//   moreBtn.classList.remove('fa-times');
// });

// // add hidden nav items to the dropdown
// document.addEventListener('DOMContentLoaded', function () {
//   const navMenu = document.querySelector('.nav-menu');
//   const dropdownMenu = document.querySelector('.dropdown');

//   function updateDropdown() {
//     const navItems = navMenu.querySelectorAll('.nav-item');
//     dropdownMenu.innerHTML = '';

//     navItems.forEach((item) => {
//       if (window.getComputedStyle(item).display === 'none') {
//         const clone = item.cloneNode(true);
//         clone.style.display = 'block';
//         dropdownMenu.appendChild(clone);
//       }
//     });
//   }

//   window.addEventListener('resize', updateDropdown);
//   updateDropdown();
// });

// //!  navbar
// let lastScrollTop = 0;
// const navbar = document.querySelector('.navbar');

// window.addEventListener('scroll', () => {
//   const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

//   if (scrollTop > lastScrollTop) {
//     // Scrolling down
//     navbar.classList.add('hide');
//   } else {
//     // Scrolling up
//     navbar.classList.remove('hide');
//   }

//   lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // Prevent negative scroll
// });
