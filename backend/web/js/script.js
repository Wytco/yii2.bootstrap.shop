
$("document").ready(function () {
    $('.close').on('click', function () {
        var close = $(this).data('close');
        $('#' + close).removeClass('active');
    });
    $('.background').on('click', function () {
        $('.my_modal').removeClass('active');
        $('.background').removeClass('active');
    })
});

