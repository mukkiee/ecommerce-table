jQuery(document).ready(function($){

    var ect_table_settings = $.parseJSON($('#ect_table_settings').val());

    $('.ect_table_wrapper input.variation_id').change(function(){

        var var_id = $(this).val();

        var product_id = $(this).siblings("[name=product_id]").val();

        var attributes = $.parseJSON($('.ect_table_wrapper .variations_form[data-product_id='+product_id+']').attr('data-product_variations'));

        attributes.forEach(element => {

            if(element['variation_id'] == var_id){

                var img = "<img width='"+ect_table_settings['ect_image_size']+"' height='"+ect_table_settings['ect_image_size']+"' src="+element['image']['thumb_src']+">";

                $('.ect_table_wrapper .ect_image_'+product_id).html(img);

                $('.ect_table_wrapper #ect_single_'+product_id+' .ect_price').html(ect_table_settings['ect_currency']+element['display_price']);

            }

        });

    });

    $('form.cart .single_add_to_cart_button').attr('type', 'button');

    $('form.cart .single_add_to_cart_button').click(function(){

        if($(this).val() != ""){

            $(this).prop('disabled', true);

            var quantity = $(this).siblings(".quantity").children("input[type=number]").val();

            var product_id = $(this).val();

            $.ajax({

                type: 'post',

                url: ajax_object.ajax_path,

                data: {

                    'post_id': product_id,

                    'quantity': quantity,

                    'nonce' : ajax_object.nonce,

                    'action': 'ectp_product_update',

                },

                success: function( data ) {

                    if(data == 'added'){

                        $('.single_add_to_cart_button').prop('disabled', false);

                        alert(quantity+' '+$('.ect_title_'+product_id).children('a').text()+" has been added to cart");

                    }

                },

            });

        }else{

            $(this).prop('disabled', true);

            var product_id = $(this).siblings("input[name=product_id]").val();

            var var_id = $(this).siblings("input[name=variation_id]").val();

            var quantity = $(this).siblings(".quantity").children("input[type=number]").val();

            if(var_id != ""){

                if(var_id == "0"){

                    alert("select options");

                    $('.single_add_to_cart_button').prop('disabled', false);

                }else{

                    $.ajax({

                        type: 'post',

                        url: ajax_object.ajax_path,

                        data: {

                            'var_id': var_id,

                            'post_id': product_id,

                            'quantity': quantity,

                            'nonce' : ajax_object.nonce,

                            'action': 'ectp_product_update',

                        },

                        success: function( data ) {

                            if(data == 'added'){

                                $('.single_add_to_cart_button').prop('disabled', false);

                                alert(quantity+' '+$('.ect_title_'+product_id).children('a').text()+" has been added to cart");

                            }

                        },

                    });    

                }

            }else{

                alert("select options");

                $('.single_add_to_cart_button').prop('disabled', false);

            }

        }

    });

});