$(document).ready(function(){
    $('.message a').click(function(){
        // $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
        $('form').toggle();
    });
    $('.loginBtn').click(function(e) {
        e.preventDefault();
        window.location.replace('../homepage.html');
    });
    $('.nav-item a').click(function (e) {
        localStorage.setItem('activeLink', $(this).attr('href'));
        $('.nav-item a').removeClass('active');
        $(this).addClass('active');   
    })
    var activeLink = localStorage.getItem('activeLink');
    if (activeLink) {
        $('.nav-item a[href="' + activeLink + '"]').click();
    }
});