

jQuery(document).ready(function () { 
    jQuery('body').on('click', '#submit_cake', function(){

        var btn = jQuery(this);
        btn.prop('disabled', true);

        var form = new FormData(jQuery('#ninja_add_cake_form')[0]);

        jQuery.ajax({
            url: NINJA.API_URL+'products/add_product',
            type: 'POST',
            xhr: function() {
                var myXhr = jQuery.ajaxSettings.xhr();
                return myXhr;
            },
            beforeSend: function (xhr) {
                //xhr.setRequestHeader('Authorization', NINJA.API_TOKEN);
            },
            success: function (res) {
                jQuery('#ninja_add_success').html('Cake Added successfully');
                btn.prop('disabled', false);
            },
            error: function (err) {
                jQuery('#ninja_add_success').html('Something went wrong');
                btn.prop('disabled', false);
            },
            data: form,
            cache: false,
            contentType: false,
            processData: false
        });
    });
}); 

jQuery(document).ready(function () { 

    if(jQuery('#admin_cake_list').length > 0){

        var auth_token = {auth_token: 'Ninja@cake_Project**'};

        jQuery.ajax({
            url: NINJA.API_URL+'products/all_products',
            type: 'POST',
            beforeSend: function (xhr) {
                //xhr.setRequestHeader('Authorization', NINJA.API_TOKEN);
                xhr.setRequestHeader('Content-Type', 'multipart/form-data;');
            },
            data: auth_token,
            success: function (res) {

                let parent_url = jQuery('#admin_cake_list').data('url');

                jQuery.each(res.data.data, function(index, element) {

                    let c_img = (element.product_image[0] && element.product_image[0]['image_name']) ? element.product_image[0]['image_name'] : '';
    
                    jQuery('#admin_cake_list').append('<tr><td><a href="'+parent_url+'?cakeid='+element.id+'">'+element.product_name+'</a></td><td><a href="'+parent_url+'?cakeid='+element.id+'&action=delete">Edit</a><a href="'+parent_url+'?cakeid='+element.id+'">Delete</a></td></tr>');
                });
             },
            error: function () { },
        });


    }

}); 
