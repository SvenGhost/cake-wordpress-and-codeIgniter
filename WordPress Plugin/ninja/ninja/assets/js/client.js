
jQuery(document).ready(function () { 

    if(jQuery('#ninja_cake_list').length > 0){

        if(jQuery('#ninja_cake_list').data('cat') !=''){
            var c_data = {type: jQuery('#ninja_cake_list').data('cat'),auth_token:'Ninja@cake_Project**'};
        }else{
            var c_data = {auth_token:'Ninja@cake_Project**'};
        }

        jQuery.ajax({
            url: NINJA.API_URL+'products/all_products',
            type: 'POST',
            beforeSend: function (xhr) {
                //xhr.setRequestHeader('Authorization', NINJA.API_TOKEN);
            },
            data: c_data,
            success: function (res) {

                let parent_url = jQuery('#ninja_cake_list').data('url');

                jQuery.each(res.result, function(index, element) {

                    let c_img = (element.product_image[0] && element.product_image[0]['image_name']) ? 'https://cakeci.projectanddemoserver.com/uploads/products/'+element.product_image[0]['image_name'] : '';
    
                    jQuery('#ninja_cake_list').append('<div class="col-md-3"><div class="item"><div class="item-img"> <img class="img-1" src="'+c_img+'" alt=""></div><div class="item-name"> <a href="'+parent_url+'?cakeid='+element.id+'">'+element.product_name+'</a><p>'+element.product_recipe+'</p></div><span class="price"><small>$</small>'+element.product_price+'</span><div class = "purchase-info"><button type = "button" class = "btn">Add to Cart <i class = "fas fa-shopping-cart"></i></button></div></div></div>');
                });
             },
            error: function () { },
        });


    }

}); 



jQuery(document).ready(function () { 

    if(jQuery('#cake_detail_block').length > 0){


        var c_id = jQuery('#cake_detail_block').data('cid');
        var c_data = {id:c_id,auth_token:'Ninja@cake_Project**'};

        jQuery.ajax({
            url: NINJA.API_URL+'products/edit_product_information',
            type: 'POST',
            beforeSend: function (xhr) {
                //xhr.setRequestHeader('Authorization', NINJA.API_TOKEN);
            },
            data: c_data,
            success: function (res) {

                var ele = res.result[0];

                jQuery.each(ele.product_image, function(index, ig) {
                    jQuery('#cake_imgs').append('<img src = "https://cakeci.projectanddemoserver.com/uploads/products/'+ig.image_name+'" alt = "shoe image">');
                    jQuery('#cake_thumbs').append('<div class = "img-item"><a href = "#" data-id = "'+index+'"><img src = "https://cakeci.projectanddemoserver.com/uploads/products/'+ig.image_name+'" alt = "shoe image"></a></div>');
                });

                jQuery('#cake_title').html(ele.product_name);
                jQuery('#cake_type').html(ele.product_type);
                jQuery('#cake_receipe').html(ele.product_recipe);
                jQuery('#cake_price').html(ele.product_price);


             },
            error: function () { },
        });

    }

}); 