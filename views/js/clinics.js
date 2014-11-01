$(document).ready(function () {
    $("#clinic_data").validate({
        rules: {
            doc_name: {
                required: true,
                minlength: 3
            },
            phone1: {
                required: true,
                digits: true,
                minlength: 10

            },
            phone2: {
                digits: true,
                minlength: 10
            },
            phone3: {
                digits: true,
                minlength: 10
            },
            name: {
                required: true,
                minlength: 3
            },
            desc: {
                required: true
            },
            clinic_img: {
                accept: "image/jpg,image/jpeg,image/png"
            },
            address: {
                required: true,
                minlength: 5
            },
            country: {
                required: true,
                digits: true
            },
            city: {
                required: true,
                digits: true
            },
            region: {
                required: true,
                digits: true
            }
        },
        messages: {
            doc_name: {
                required: 'يجب ادخال اسم الدكتور',
                minlength: 'لا يقل عن 3 أحرف'
            },
            phone1: {
                required: 'يجب ادخال رقم الهاتف',
                digits: 'يجب أن يكون رقم',
                minlength: 'يجب ادخال رقم هاتف صحيح'

            },
            phone2: {
                digits: 'يجب أن يكون رقم',
                minlength: 'يجب ادخال رقم هاتف صحيح'

            },
            phone3: {
                digits: 'يجب أن يكون رقم',
                minlength: 'يجب ادخال رقم هاتف صحيح'

            },
            name: {
                required: 'يجب ادخال اسم العيادة',
                minlength: 'لا يقل عن 3 أحرف'
            },
            desc: {
                required: 'يجب كتابة مواعيد عمل العيادة'
            },
            clinic_img: {
                accept: 'يجب اختيار صورة (JPG , JPEG , PNG)'
            },
            address: {
                required: 'يجب ادخال عنوان العيادة',
                minlength: 'لا يقل عن 5 أحرف'
            },
            country: {
                required: 'يجب اختيار الدولة',
                digits: 'خطأ'
            },
            city: {
                required: 'يجب اختيار المدينة',
                digits: 'خطأ'
            },
            region: {
                required: 'يجب اختيار المنطقة',
                digits: 'خطأ'
            }
        },
        submitHandler: function () {
            var formData = new FormData($('#clinic_data')[0]);
            $('#rt_errors').html('<img width="25" src="/views/img/AjaxLoader.gif"/>');
            $('#md_errors').html('');
            $('#lt_errors').html('');
            $("html, body").animate({
                scrollTop: 0
            }, 500);
            $.ajax({
                url: "/clinics/processclinic",
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    console.log(data);
                    $('#rt_errors').html('');
                    $('#md_errors').html('');
                    $('#lt_errors').html('');
                    var new_data = jQuery.parseJSON(data);
                    if (new_data['operation'] == 2) {
                        $.each(new_data['errors']['rt'], function (index, value) {
                            $('#rt_errors').append(new_data['errors']['rt'][index] + '<br/>');
                        });
                        $.each(new_data['errors']['md'], function (index, value) {
                            $('#md_errors').append(new_data['errors']['md'][index] + '<br/>');
                        });
                        $.each(new_data['errors']['lt'], function (index, value) {
                            $('#lt_errors').append(new_data['errors']['lt'][index] + '<br/>');
                        });
                    } else if (new_data['operation'] == 1) {
                        if (new_data['type'] == 'add')
                            $('#rt_errors').html('<span style="color:green;">تم اضافة العيادة بنجاح</span>');
                        else
                            $('#rt_errors').html('<span style="color:green;">تم تعديل العيادة بنجاح</span>');
                        window.location = '/index';
                    }
                }
            });
        }

    });
});
 