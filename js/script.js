$(document).ready(function(){
    $('.message a').click(function(){
        // $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
        $('form').toggle();
    });
    $('.loginBtn').click(function(e) {
        e.preventDefault();
        window.location.replace('../homepage.html');
        console.log('hi');
    });
});