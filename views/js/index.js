$(document).ready(function () {
    $('body').on('change', 'input[name="all"]', function () {
        var check = $(this).attr('check');
        var current = $(this).attr('checked');
        if (!this.checked) {
            $('input[name="' + check + '[]"]').prop('checked', false);
        } else {
            $('input[name="' + check + '[]"]').prop('checked', true);
        }
    });

    $('body').on('click', '#search_ads', function () {
        $('#errors').html('<img width="25" src="/pets/views/img/AjaxLoader.gif"/>');
        $('#ads_button').remove();
        load_search('ads');

    });

    $('body').on('click', '#search_users', function () {
        $('#errors').html('<img width="25" src="/pets/views/img/AjaxLoader.gif"/>');
        $('#users_button').remove();
        load_search('users');

    });

    $('body').on('click', '#users_button', function () {
        $('#users_more').html('<img width="25" src="/pets/views/img/AjaxLoader.gif"/>');
        load_more('users');
    });

    $('body').on('click', '#ads_button', function () {
        $('#ads_more').html('<img width="25" src="/pets/views/img/AjaxLoader.gif"/>');
        load_more('ads');
    });

    $('body').on('click', '#activate_users', function () {
        $('#errors').html('<img width="25" src="/pets/views/img/AjaxLoader.gif"/>');
        handle_groups('users', 1);
    });

    $('body').on('click', '#deactivate_users', function () {
        $('#errors').html('<img width="25" src="/pets/views/img/AjaxLoader.gif"/>');
        handle_groups('users', 2);
    });

    $('body').on('click', '#activate_ads', function () {
        $('#errors').html('<img width="25" src="/pets/views/img/AjaxLoader.gif"/>');
        handle_groups('ads', 1);
    });
    $('body').on('click', '#deactivate_ads', function () {
        $('#errors').html('<img width="25" src="/pets/views/img/AjaxLoader.gif"/>');
        handle_groups('ads', 2);
    });
});


function handle_groups(type, val) {
    var atLeastOneIsChecked = $('input[name="' + type + '[]"]:checked').length > 0;
    if (atLeastOneIsChecked != true) {
        $('#errors').html('يجب الاختيار من الجدول أولا');
        return;
    }
    var form = $('#' + type + '_form').serialize();

    $.ajax({
        url: "/pets/index/handle/?t=" + val + "&ty=" + type,
        type: 'POST',
        data: form,
        success: function (data) {
            console.log(data);
            $('#errors').html('<span style="color:green;">تمت العملية بنجاح</span>');
            location.reload(true);
        }
    });
}

function load_search(type) {
    var search = $('#' + type + '_search_box').val();
    if (search == '') {
        $('#errors').html('يجب كتابة البحث المطلوب');
        return;
    }
    $.ajax({
        url: "/pets/index/search_cp",
        type: 'POST',
        data: {
            'type': type,
            'value': search
        },
        success: function (data) {
            console.log(data);
            $('#errors').html('');
            if (data == '') {
                $('#' + type + '_body').html('<tr><td colspan="4">لا يوجد نتائج بحث</td></tr>');
            } else {
                $('#' + type + '_body').html(data);
            }
        }
    });
}

function load_more(type) {
    var page = $('input[name="' + type + '_page"]').val();
    $.ajax({
        url: "/pets/index/load_more",
        type: 'POST',
        data: {
            'type': type,
            'value': page
        },
        success: function (data) {
            console.log(data);
            $('#' + type + '_body').append(data);
            var new_page = parseInt(page) + 1;
            var total = $('input[name="' + type + '_total"]').val();
            if ((new_page * 18) < total) {
                $('input[name="' + type + '_page"]').val(new_page);
                $('#' + type + '_more').html('<input id="' + type + '_button" type="submit" value="المزيد">');
            } else {
                $('#' + type + '_more').html('');
            }
        }
    });
}


function login() {
    $('#login_errors').html('');
    if ($('input[name="email"]').val() == '') {
        $('#login_errors').html('قم بادخال البريد الالكترونى');
        return;
    }
    if ($('input[name="password"]').val() == '') {
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
            if (new_data['operation'] == 2) {
                if (new_data['status'] == 'blocked')
                    $('#captcha_display').show();
                document.getElementById('captcha').src = '/pets/index/captcha?' + Math.random();
                $('input[name="captcha_code"]').val('');

                $.each(new_data['errors'], function (index, value) {
                    $('#login_errors').append(new_data['errors'][index] + '<br/>');
                });
            } else if (new_data['operation'] == 1) {
                $('#login_errors').html('<span style="color:green;">تم تسجيل الدخول بنجاح</span>');
                location.reload(true);
            }
        }
    });
}

function register() {
    $('#register_errors').html('');
    $.ajax({
        url: "/pets/index/register",
        type: 'POST',
        data: $('#register_form').serialize(),
        success: function (data) {
            console.log(data);
            $('#register_errors').html('');
            var new_data = jQuery.parseJSON(data);
            if (new_data['operation'] == 2) {
                $.each(new_data['errors'], function (index, value) {
                    $('#register_errors').append(new_data['errors'][index] + '<br/>');
                });
            } else if (new_data['operation'] == 1) {
                $('#register_errors').html('<span style="color:green;">تم تسجيل عضويتك بنجاح</span>');
                window.location = '/pets/index';
            }
        }
    });
}

function forgot_pass() {
    $('#forgot_errors').html('');

    if ($('input[name="forgot_email"]').val() == '') {
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
            if (new_data['operation'] == 2) {
                $.each(new_data['errors'], function (index, value) {
                    $('#forgot_errors').append(new_data['errors'][index] + '<br/>');
                });
            } else if (new_data['operation'] == 1) {
                $('#forgot_errors').html('<span style="color:green;">تم ارسال رسالة الى بريدك الالكترونى لاسترجاع كلمة المرور</span>');
                //window.location = '/pets/index';
            }
        }
    });
}
