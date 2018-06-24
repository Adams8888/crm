$(function () {
    $('#signupform-type').on('change', function(){
        var type = $('#signupform-type').val();
        if (type == 'individual') {
            $('.field-signupform-company_name').hide();
        } else {
            $('.field-signupform-company_name').show();
        }
    })
});
