$(document).ready(function () {
    $("#ad_data").validate({
        rules: {
            cat: {
                required: true,
                digits: true
            },
            type: {
                required: true,
                digits: true

            },
            pet: {
                required: true,
                digits: true
            },
            title: {
                required: true,
                minlength: 3
            },
            desc: {
                required: true,
                minlength: 10
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
            cat: {
                required: 'يجب اختيار نوع الحيوان الأليف',
                digits: 'خطأ'
            },
            type: {
                required: 'يجب اختيار نوع الاعلان',
                digits: 'خطأ'

            },
            pet: {
                required: 'يجب اختيار الفصيلة',
                digits: 'خطأ'
            },
            title: {
                required: 'يجب كتابة عنوان للاعلان',
                minlength: 'لا يقل عن 3 أحرف'
            },
            desc: {
                required: 'يجب كتابة معلومات الاعلان',
                minlength: 'لا يقل عن 10 أحرف'
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
            $('#rt_errors').html('<img width="25" src="/views/img/AjaxLoader.gif"/>');
            $('#md_errors').html('');
            $('#lt_errors').html('');
            $("html, body").animate({
                scrollTop: 0
            }, 500);
            $.ajax({
                url: "/ads/processad",
                type: 'POST',
                data: $('#ad_data').serialize(),
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
                            $('#rt_errors').html('<span style="color:green;">تم اضافة اعلانك بنجاح</span>');
                        else
                            $('#rt_errors').html('<span style="color:green;">تم تعديل اعلانك بنجاح</span>');
                        window.location = '/index';
                    }
                }
            });
        }

    });

    $('#country').on('change', function () {
        load_cities($(this).val(), 'city', 'region');
    });

    $('#city').on('change', function () {
        load_regions($(this).val(), 'region');
    });
    $('#search_country').on('change', function () {
        load_cities($(this).val(), 'search_city', 'search_region');
    });

    $('#search_city').on('change', function () {
        load_regions($(this).val(), 'search_region');
    });

    $('#category').on('change', function () {
        load_pets($(this).val(), $('#ad_type').val());
    });
    $('#ad_type').on('change', function () {
        load_pets($('#category').val(), $(this).val());
    });
    $('#activate').click(function (event) {
        event.preventDefault();
        $.ajax({
            url: "/ads/activate_ad",
            type: 'POST',
            data: {
                'ad_id': $('input[name="id"]').val(),
                'activate': 1
            },
            success: function (data) {
                console.log(data);
                $('#errors').html('تم تفعيل الاعلان');
                window.location = '/ads/activate';
            }
        });
    });

    $('#deactivate').click(function (event) {
        event.preventDefault();
        $.ajax({
            url: "/ads/activate_ad",
            type: 'POST',
            data: {
                'ad_id': $('input[name="id"]').val(),
                'activate': 2
            },
            success: function (data) {
                console.log(data);
                $('#errors').html('تم الغاء الاعلان');
                window.location = '/ads/activate';
            }
        });
    });
});

function load_cities(country, city_id, region_id) {
    $.ajax({
        url: "/ads/jsload",
        type: 'POST',
        data: {
            'type': 1,
            'data': country
        },
        success: function (data) {
            console.log(data);
            $('#' + city_id).html(data);
            $('#' + region_id).html('<option value="">اختار المنطقة</option>');
        }
    });
}

function load_regions(city, region_id) {
    $.ajax({
        url: "/ads/jsload",
        type: 'POST',
        data: {
            'type': 2,
            'data': city
        },
        success: function (data) {
            console.log(data);
            $('#' + region_id).html(data);
        }
    });
}

function load_pets(cat, ad_type) {
    $.ajax({
        url: "/ads/jsload",
        type: 'POST',
        data: {
            'type': 3,
            'data': cat,
            'ad_type': ad_type
        },
        success: function (data) {
            console.log(data);
            $('#pet').html(data);
        }
    });
}

  