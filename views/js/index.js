function login(){
    $('#login_errors').html('');
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

function register(){
    $('#register_errors').html('');
    $.ajax({
        url: "/pets/index/register", 
        type: 'POST', 
        data: $('#register_form').serialize(), 
        success: function (data) {
            console.log(data);
            $('#register_errors').html('');
            var new_data = jQuery.parseJSON(data);
            if(new_data['operation'] == 2){
                $.each(new_data['errors'],function(index, value){
                    $('#register_errors').append(new_data['errors'][index]+'<br/>');
                });
            }else if(new_data['operation'] == 1){
                $('#register_errors').html('<span style="color:green;">تم تسجيل عضويتك بنجاح</span>');
            //window.location = '/pets/index';
            }
        }
    });
}

function forgot_pass(){
    $('#forgot_errors').html('');
    
    if($('input[name="forgot_email"]').val() == ''){
        $('#forgot_errors').html('قم بادخال البريد الالكترونى');
        return;
    }
    
    $.ajax({
        url: "/pets/index/forgotpass", 
        type: 'POST', 
        data: $('#forgot_form').serialize(), 
        success: function (data) {
            console.log(data);
            $('#forgot_errors').html('');
            var new_data = jQuery.parseJSON(data);
            if(new_data['operation'] == 2){
                $.each(new_data['errors'],function(index, value){
                    $('#forgot_errors').append(new_data['errors'][index]+'<br/>');
                });
            }else if(new_data['operation'] == 1){
                $('#forgot_errors').html('<span style="color:green;">تم ارسال رسالة الى بريدك الالكترونى لاسترجاع كلمة المرور</span>');
            //window.location = '/pets/index';
            }
        }
    });
}