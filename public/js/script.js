$(document).ready(() => {

    // Page loading animation

    $("#preloader").animate({
        'opacity': '0'
    }, 1000, () => {
        setTimeout(() => {
            $("#preloader").css("visibility", "hidden").fadeOut();
        }, 300);
    });

    // Set fade duration for all initial alerts

    window.setTimeout(() => {
        $('#alert-box > .alert').alert('close');
    }, 3000);

});

// Issues a warning

const msgAlert = (message, theme = 'info', duration = 3) => {
    var maxCount = 4,
        alertCount = $('#alert-box').children('.alert').length,
        alertElem = $(`<div class="alert alert-${theme} fade show">${message}</div>`);

    if (alertCount >= maxCount)
        $('#alert-box > .alert:last').remove();

    $('#alert-box').append(alertElem);

    window.setTimeout(() => {
        $(alertElem).alert('close');
    }, duration * 1000);
}