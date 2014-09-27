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
});


function process_ad(){
    $('#ad_errors').html('<img width="25" src="/pets/views/img/cool-cat.gif"/>');
    $.ajax({
        url: "/pets/ads/processad", 
        type: 'POST', 
        data: $('#ad_data').serialize(), 
        success: function (data) {
            console.log(data);
            $('#ad_errors').html('');
            var new_data = jQuery.parseJSON(data);
            if(new_data['operation'] == 2){
                $.each(new_data['errors'],function(index, value){
                    $('#ad_errors').append(new_data['errors'][index]+'<br/>');
                });
            }else if(new_data['operation'] == 1){
                $('#ad_errors').html('<span style="color:green;">تم اضافة اعلانك بنجاح</span>');
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