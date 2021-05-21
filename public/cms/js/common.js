$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();

    var CURRENT_URL = window.location.href.split('#')[0].split('?')[0];

    $('.side-menu li a').each(function () {
        var gethref = $(this).attr('href');
        if(CURRENT_URL.indexOf(gethref) > -1 && !$(this).children('i').hasClass('fa-home')){
            $(this).parent('li').addClass('current-page');
        }
    });

});

$(document).ready(function() {
    $(".only-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 189, 190]) !== -1 ||
            // Allow: Ctrl/cmd+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: Ctrl/cmd+C
            (e.keyCode === 67 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: Ctrl/cmd+X
            (e.keyCode === 88 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});