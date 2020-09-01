$(document).ready(() => {

    // Page loading animation

    $("#preloader").animate({
        'opacity': '0'
    }, 1000, () => {
        setTimeout(() => {
            $("#preloader").css("visibility", "hidden").fadeOut();
        }, 300);
    });

});