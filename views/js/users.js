$(document).ready(function(){
    $("#user_form").validate({
        rules: {
            username: {
                minlength: 2
            },
            email: {
                required: true,
                email: true
            },
            file: {
                accept: "image/jpg,image/jpeg,image/png"
            },
            phone: {
                digits: true,
                minlength: 10
            },
            old_pass: {
                required: true
            },
            new_pass: {
                minlength: 6
            },
            new_pass_confirm: {
                equalTo: 'input[name="new_pass"]'
            }
        },
        messages: {
            username: {
                minlength: 'لا يقل عن حرفين'
            },
            email: {
                required: 'يجب ادخال البريد الالكترونى',
                email: 'يجب ادخال بريد الكترونى صحيح'
            },
            file: {
                accept: 'يجب اختيار صورة (JPG , JPEG , PNG)'
            },
            phone: {
                digits:'يجب ادخال رقم هاتف صحيح',
                minlength: 'يجب ادخال رقم هاتف صحيح'
            },
            old_pass: {
                required: 'يجب ادخال كلمة المرور الحالية'
            },
            new_pass: {
                minlength: 'لا يقل عن 6 أحرف'
            },
            new_pass_confirm: {
                equalTo: 'تأكيد كلمة المرور غير صحيح'
            }
        },

        submitHandler: function(){
            $('#errors').html('<img width="25" src="/pets/views/img/AjaxLoader.gif"/>');
            $("html, body").animate({
                scrollTop: 0
            }, 500);
            var file_data = $('#user_img').prop('files')[0];   
            var form_data = new FormData($('#user_form').get(0));                  
            form_data.append('file', file_data);
            $.ajax({
                url: '/pets/user/update',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(data) {
                    $('#errors').html('');
                    console.log(data);
                    var new_data = jQuery.parseJSON(data);
                    if(new_data['operation'] == 2){
                        $.each(new_data['errors'],function(index, value){
                            $('#errors').append(new_data['errors'][index]+'<br/>');
                        });
                    }else if(new_data['operation'] == 1){
                        $('#errors').html('<span style="color:green;">تم تعديل المعلومات بنجاح</span>');
                        window.location = '/pets/user/edit';
                    }
                }
            });
        }
    });

});