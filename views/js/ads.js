function process_ad(){
    $('#errors').html('');
    if($('input[name="email"]').val() == ''){
        $('#login_errors').html('قم بادخال البريد الالكترونى');
        return;
    }
    if($('input[name="password"]').val() == ''){
        $('#login_errors').html('قم بادخال كلمة المرور');
        return;
    }
    $.ajax({
        url: "/pets/index/login", 
        type: 'POST', 
        data: $('#login_form').serialize(), 
        success: function (data) {
            console.log(data);
            $('#login_errors').html('');
            var new_data = jQuery.parseJSON(data);
            if(new_data['operation'] == 2){
                if(new_data['status'] == 'blocked')
                    $('#captcha_display').show();
                document.getElementById('captcha').src = '/pets/index/captcha?' + Math.random();
                $.each(new_data['errors'],function(index, value){
                    $('#login_errors').append(new_data['errors'][index]+'<br/>');
                });
            }else if(new_data['operation'] == 1){
                $('#login_errors').html('<span style="color:green;">تم تسجيل الدخول بنجاح</span>');
                window.location = '/pets/index';
            }
        }
    });
}
