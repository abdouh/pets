$(document).ready(function(){
    $('body').on('change', 'input[name="all"]', function (){
        var check = $(this).attr('check');
        var current = $(this).attr('checked');
        alert($(this).attr('checked'));
        if(asd)
            $('input[name="'+check+'[]"]').attr('checked',false);
        else
            $('input[name="'+check+'[]"]').attr('checked',true);
    });
    
    $('body').on('click', '#users_button', function (){
        $('#users_more').html('<img width="25" src="/pets/views/img/AjaxLoader.gif"/>');
        load_more('users');
    });
    
    $('body').on('click', '#ads_button', function (){
        $('#ads_more').html('<img width="25" src="/pets/views/img/AjaxLoader.gif"/>');
        load_more('ads');
    });
    
    $('body').on('click', '#activate_users', function (){
        $('#errors').html('<img width="25" src="/pets/views/img/AjaxLoader.gif"/>');
        handle_groups('users', 1);
    });
    
    $('body').on('click', '#deactivate_users', function (){
        $('#errors').html('<img width="25" src="/pets/views/img/AjaxLoader.gif"/>');
        handle_groups('users', 2);
    });
    
    $('body').on('click', '#activate_ads', function (){
        $('#errors').html('<img width="25" src="/pets/views/img/AjaxLoader.gif"/>');
        handle_groups('ads', 1);
    });
    $('body').on('click', '#deactivate_ads', function (){
        $('#errors').html('<img width="25" src="/pets/views/img/AjaxLoader.gif"/>');
        handle_groups('ads', 2);
    });
});


function handle_groups(type,val){
    var form = $('#'+type+'_form').serialize();
    
    $.ajax({
        url: "/pets/index/handle/?t="+val+"&ty="+type, 
        type: 'POST', 
        data: form, 
        success: function (data) {
            console.log(data);  
            $('#errors').html('تمت العملية بنجاح');
            window.location = '/pets/index/petscp/';
        }
    });
}

function load_more(type){
    var page = $('input[name="'+type+'_page"]').val();
    $.ajax({
        url: "/pets/index/load_more", 
        type: 'POST', 
        data: {
            'type':type, 
            'value':page
        }, 
        success: function (data) {
            console.log(data);
            $('#'+type+'_body').append(data);
            var new_page = parseInt(page) + 1;
            var total = $('input[name="'+type+'_total"]').val();
            if((new_page * 18) < total){
                $('input[name="'+type+'_page"]').val(new_page);
                $('#'+type+'_more').html('<input id="'+type+'_button" type="submit" value="المزيد">');
            }else{
                $('#'+type+'_more').html('');
            }
        }
    });
}


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
                window.location = '/pets/index';
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
