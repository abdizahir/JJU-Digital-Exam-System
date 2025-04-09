$(document).ready(function () {
  $('.message a').click(function () {
    // $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
    $('form').toggle();
  });
  $('.loginBtn').click(function (e) {
    e.preventDefault();
    window.location.replace('../homepage.html');
  });
  // active link for nav item
  // $('.nav-item a').click(function (e) {
  //   localStorage.setItem('activeLink', $(this).attr('href'));
  //   $('.nav-item a').removeClass('active');
  //   $(this).addClass('active');
  // });
  // var activeLink = localStorage.getItem('activeLink');
  // if (activeLink) {
  //   $('.nav-item a[href="' + activeLink + '"]').click();
  // }
});

// home page dropdown menu
const moreBtn = document.querySelector('.more-btn');
const moreMenu = document.querySelector('.more');

// Toggle dropdown on button click
moreBtn.addEventListener('click', (e) => {
  e.stopPropagation(); // prevent triggering document click
  moreMenu.classList.toggle('open');
  moreBtn.classList.toggle('fa-bars');
  moreBtn.classList.toggle('fa-times');
});

// Close on click outside
document.addEventListener('click', (e) => {
  if (!moreMenu.contains(e.target)) {
    moreMenu.classList.remove('open');
    moreBtn.classList.add('fa-bars');
    moreBtn.classList.remove('fa-times');
  }
});

// Close on scroll
window.addEventListener('scroll', () => {
  moreMenu.classList.remove('open');
  moreBtn.classList.add('fa-bars');
  moreBtn.classList.remove('fa-times');
});

// add hidden nav items to the dropdown
document.addEventListener('DOMContentLoaded', function () {
  const navMenu = document.querySelector('.nav-menu');
  const dropdownMenu = document.querySelector('.dropdown');

  function updateDropdown() {
    const navItems = navMenu.querySelectorAll('.nav-item');
    dropdownMenu.innerHTML = '';

    navItems.forEach((item) => {
      if (window.getComputedStyle(item).display === 'none') {
        const clone = item.cloneNode(true);
        clone.style.display = 'block';
        dropdownMenu.appendChild(clone);
      }
    });
  }

  window.addEventListener('resize', updateDropdown);
  updateDropdown();
});

//!  navbar
let lastScrollTop = 0;
const navbar = document.querySelector('.navbar');

window.addEventListener('scroll', () => {
  const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

  if (scrollTop > lastScrollTop) {
    // Scrolling down
    navbar.classList.add('hide');
  } else {
    // Scrolling up
    navbar.classList.remove('hide');
  }

  lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // Prevent negative scroll
});
