$(function () {
    $('#applicationForm').on('submit', function () {
        $('.error-highlight').removeClass('error-highlight');

        $(this)
            .find('[required]')
            .each(function () {
                if (!$(this).val()) {
                    $(this).addClass('error-highlight');
                }
            });
    });
});

