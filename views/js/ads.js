$(document).ready(function() {       
    $('#country').on('change',function(){
        load_cities($(this).val());
    });
    
    $('#city').on('change',function(){
        load_regions($(this).val());
    });
    
    $('#category').on('change',function(){
        load_pets($(this).val());
    });
    $('#activate').click(function (event){
        event.preventDefault();
        $.ajax({
            url: "/pets/ads/activate_ad", 
            type: 'POST', 
            data: {
                'ad_id': $('input[name="id"]').val(),
                'activate':1
            } , 
            success: function (data) {
                console.log(data);
                $('#errors').html('تم تفعيل الاعلان');
                window.location = '/pets/ads/activate';
            }
        });
    });
  
    $('#deactivate').click(function (event){
        event.preventDefault();
        $.ajax({
            url: "/pets/ads/activate_ad", 
            type: 'POST', 
            data: {
                'ad_id': $('input[name="id"]').val(),
                'activate':2
            } , 
            success: function (data) {
                console.log(data);
                $('#errors').html('تم الغاء الاعلان');
                window.location = '/pets/ads/activate';
            }
        });
    });
});


function process_ad(){
    $('#rt_errors').html('<img width="25" src="/pets/views/img/AjaxLoader.gif"/>');
    $('#md_errors').html('');
    $('#lt_errors').html('');
    $.ajax({
        url: "/pets/ads/processad", 
        type: 'POST', 
        data: $('#ad_data').serialize(), 
        success: function (data) {
            console.log(data);
            $('#rt_errors').html('');
            $('#md_errors').html('');
            $('#lt_errors').html('');
            var new_data = jQuery.parseJSON(data);
            if(new_data['operation'] == 2){
                $.each(new_data['errors']['rt'],function(index, value){
                    $('#rt_errors').append(new_data['errors']['rt'][index]+'<br/>');
                });
                $.each(new_data['errors']['md'],function(index, value){
                    $('#md_errors').append(new_data['errors']['md'][index]+'<br/>');
                });
                $.each(new_data['errors']['lt'],function(index, value){
                    $('#lt_errors').append(new_data['errors']['lt'][index]+'<br/>');
                });
            }else if(new_data['operation'] == 1){
                if(new_data['type'] == 'add')
                    $('#rt_errors').html('<span style="color:green;">تم اضافة اعلانك بنجاح</span>');
                else
                    $('#rt_errors').html('<span style="color:green;">تم تعديل اعلانك بنجاح</span>');
            //window.location = '/pets/index';
            }
        }
    });
}

function load_cities(country){
    $.ajax({
        url: "/pets/ads/jsload", 
        type: 'POST', 
        data: {
            'type':1,
            'data':country
        }, 
        success: function (data) {
            console.log(data);
            $('#city').html(data);
            $('#region').html('<option>اختار المنطقة</option>');
        }
    });
}

function load_regions(city){
    $.ajax({
        url: "/pets/ads/jsload", 
        type: 'POST', 
        data: {
            'type':2,
            'data':city
        } , 
        success: function (data) {
            console.log(data);
            $('#region').html(data);
        }
    });
}

function load_pets(cat){
    $.ajax({
        url: "/pets/ads/jsload", 
        type: 'POST', 
        data: {
            'type':3,
            'data':cat
        } , 
        success: function (data) {
            console.log(data);
            $('#pet').html(data);
        }
    });
}

  