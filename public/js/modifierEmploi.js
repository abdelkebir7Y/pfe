
$('input[type=checkbox]').on('click', function() {
    if ($(this).is(":checked"))
        $(this).parents("td:first").find('.hidden').show();
    else
        $(this).parents("td:first").find('.hidden').hide();
});