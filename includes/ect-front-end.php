<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


if (!function_exists('ectp_generate_heading')) { 
    
    function ectp_generate_heading($ect_table_settings){

        if($ect_table_settings['ect_image'] == 'checked'){
            
            echo ectp_div_wrapper(esc_html('Image'));
            
        }

        if($ect_table_settings['ect_name'] == 'checked'){
            
            echo ectp_div_wrapper(esc_html('Name'));
            
        }
        
        if($ect_table_settings['ect_sku'] == 'checked'){
            
            echo ectp_div_wrapper(esc_html('sku'));

        }

        if($ect_table_settings['ect_categories'] == 'checked'){

            echo ectp_div_wrapper(esc_html('Categories'));

        }
        
        if($ect_table_settings['ect_tags'] == 'checked'){
            
            echo ectp_div_wrapper(esc_html('Tags'));
            
        }

        if($ect_table_settings['ect_price'] == 'checked'){

            echo ectp_div_wrapper(esc_html('Price'));

        }
        
        if($ect_table_settings['ect_weight'] == 'checked'){
            
            echo ectp_div_wrapper(esc_html('Weight'));
            
        }
        
        if($ect_table_settings['ect_dimention'] == 'checked'){

            echo ectp_div_wrapper(esc_html('Dimention'));
            
        }
        
        if($ect_table_settings['ect_stock_status'] == 'checked'){
            
            echo ectp_div_wrapper(esc_html('Status'));

        }

        if($ect_table_settings['ect_stock_quantity'] == 'checked'){
            
            echo ectp_div_wrapper(esc_html('Quantity'));
            
        }
        
        if($ect_table_settings['ect_short_description'] == 'checked'){
            
            echo ectp_div_wrapper(esc_html('Description'));
            
        }
        
    }

}

if (!function_exists('ectp_generate_table')) { 
    
    function ectp_generate_table($post_id, $ect_table_settings){
        
        $ect_product = wc_get_product( $post_id );
        
        if($ect_table_settings['ect_image'] == 'checked'){
            
            echo ectp_div_wrapper($ect_product->get_image(array($ect_table_settings['ect_image_size'], $ect_table_settings['ect_image_size'])), esc_attr("ect_image_".$post_id));        
            
        }
        
        if($ect_table_settings['ect_name'] == 'checked'){
            
            echo ectp_div_wrapper(ectp_anchor_wrapper(esc_html($ect_product->get_data()['name']), get_permalink( )), esc_attr('ect_title_'.$post_id));        
            
        }

        if($ect_table_settings['ect_sku'] == 'checked'){
            
            if($ect_product->get_data()['sku'] != ""){
                
                echo ectp_div_wrapper(esc_html('#'.$ect_product->get_data()['sku']));        
                
            }else{
                
                echo ectp_div_wrapper( esc_html( '-' ) );
                
            }
            
        }

        if($ect_table_settings['ect_categories'] == 'checked'){
            
            if(isset($ect_product->get_category_ids()[0])){

                echo ectp_get_categories($ect_product->get_category_ids());        

            }else{

                echo ectp_div_wrapper( esc_html( '-' ) );
                
            }
            
        }
        
        if($ect_table_settings['ect_tags'] == 'checked'){
            
            if(isset($ect_product->get_tag_ids()[0])){

                echo ectp_get_tags($ect_product->get_tag_ids());        

            }else{

                echo ectp_div_wrapper( esc_html( '-' ) );

            }
            
        }
        
        if($ect_table_settings['ect_price'] == 'checked'){
                       
            if($ect_product->get_data()['price'] != ""){
              
                if($ect_product->get_data()['price'] != $ect_product->get_data()['regular_price']){
                                                           
                    if(strlen($ect_product->get_data()['regular_price']) > 0){
                                                                       
                        echo ectp_div_wrapper(
                            
                            ectp_p_wrapper(esc_html(
                                
                                get_woocommerce_currency_symbol().
                                
                                $ect_product->get_data()['regular_price']),
                                
                                esc_attr(  "text-decoration: line-through;") )
                                
                                .esc_html(get_woocommerce_currency_symbol()
                                
                                .$ect_product->get_data()['price']), esc_attr("ect_price")
                                
                            );        

                        }else{
                            
                        echo ectp_div_wrapper(esc_html(get_woocommerce_currency_symbol().$ect_product->get_data()['price']), esc_attr("ect_price"));        
                        
                    }

                }else{

                    echo ectp_div_wrapper(esc_html(get_woocommerce_currency_symbol().$ect_product->get_data()['price']), esc_attr("ect_price"));        

                }

            }else{

                echo ectp_div_wrapper( esc_html( '-' ) );        

            }

        }
               
        if($ect_table_settings['ect_weight'] == 'checked'){
            
            if($ect_product->get_data()['weight'] != ""){
                
                echo ectp_div_wrapper(esc_html($ect_product->get_data()['weight']." Kg"));   
                
            }else{
                
                echo ectp_div_wrapper( esc_html( '-' ) );        
                
            }
            
        }

        if($ect_table_settings['ect_dimention'] == 'checked'){
            
            if($ect_product->get_data()['length'] != "" || $ect_product->get_data()['width'] != "" || $ect_product->get_data()['height'] != ""){
                
                echo ectp_div_wrapper(esc_html(
                    
                    $ect_product->get_data()['length']." x ".
                    
                    $ect_product->get_data()['width']." x ".
                    
                    $ect_product->get_data()['height']." cm")
                    
                );    
                
            }else{
                
                echo ectp_div_wrapper( esc_html( '-' ) );        
                
            }

        }
        
        if($ect_table_settings['ect_stock_status'] == 'checked'){

            if($ect_product->get_data()['stock_status'] != ""){
                
                echo ectp_div_wrapper(esc_html($ect_product->get_data()['stock_status']), esc_attr("ect_stock"));    
                
            }else{
                
                echo ectp_div_wrapper( esc_html( '-' ) );        
                
            }    
            
        }
        
        if($ect_table_settings['ect_stock_quantity'] == 'checked'){
            
            if($ect_product->get_data()['stock_quantity'] != ""){
                
                echo ectp_div_wrapper(esc_html($ect_product->get_data()['stock_quantity'].' In Stock'));   

            }else{

                echo ectp_div_wrapper( esc_html( '-' ) );        
                
            }         
            
        }
        
        if($ect_table_settings['ect_short_description'] == 'checked'){

            if($ect_product->get_data()['short_description'] != ""){
                
                echo ectp_div_wrapper(esc_html($ect_product->get_data()['short_description']));        
                
            }else{

                echo ectp_div_wrapper( esc_html( '-' ) );

            }
            
        }

        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
        
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
        
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );

        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
        
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_after_shop_loop_item', 5 );
        
        remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation', 10 );
        
        add_filter( 'woocommerce_get_stock_html', '__return_empty_string' );
        
        
        
        if(isset(get_post_meta($post_id, "_product_url")[0])){
            
            echo '<a href="'.esc_url(get_post_meta($post_id, "_product_url")[0]).'"><button type="submit" name="add-to-cart" value="'.esc_attr($post_id).'" class="single_add_to_cart_button button alt">';
            
            echo esc_html(get_post_meta(esc_attr($post_id), "_button_text")[0])."</button></a>";
            
        }elseif(isset(get_post_meta($post_id, "_children")[0])){
            
            echo '<a href="'.esc_url(get_permalink( $post_id )).'"><button type="submit" name="add-to-cart" value="'.esc_attr($post_id).'" class="single_add_to_cart_button button alt">';
            
            echo "View Products</button></a>";
            
        }else{
            
            echo "<div>";
            
            do_action( 'woocommerce_single_product_summary' );
            
            echo "</div>";
            
        }
        
    }

}

if (!function_exists('ectp_div_wrapper')) { 
    
    function ectp_div_wrapper($val, $class=""){
        
        return "<div class='".$class."'>".$val."</div>";
        
    }
    
}

if (!function_exists('ectp_anchor_wrapper')) { 

    function ectp_anchor_wrapper($val, $link){
        
        return "<a href='".esc_url($link)."'>".$val."</a>";
        
    }
    
}

if (!function_exists('ectp_p_wrapper')) { 
    
    function ectp_p_wrapper($val, $style=""){
    
        return "<p style='margin: 0;".$style."'>".$val."</p>";
        
    }
    
}

if (!function_exists('ectp_get_categories')) { 

    function ectp_get_categories($cat_ids){
        
        $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2)[0];

        $cats = "<div>";
        
        foreach ( (array) $cat_ids as $cat_id) {
            
            $cat_term = get_term_by('id', (int)$cat_id, 'product_cat');

            if($cat_term){

                $ect_url = esc_url(site_url().$uri_parts."?cat=".$cat_term->slug);
                
                $cats .= "&nbsp;<a href='".wp_nonce_url($ect_url, 'ect_nonce')."'>";
                
                $cats .= esc_html($cat_term->name);
                
            }
            
            $cats .= "</a>&nbsp;";

        }

        $cats .= "</div>";

        return $cats;
        
    }

}

if (!function_exists('ectp_get_tags')) { 
    
    function ectp_get_tags($tag_ids){
                       
        $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2)[0];
                        
        $tags = "<div>";
        
        foreach ( (array) $tag_ids as $tag_id) {
            
            $tag_term = get_term_by('id', (int)$tag_id, 'product_tag');
            
            if($tag_term){

                $ect_url = esc_url(site_url().$uri_parts."?tag=".$tag_term->slug);
                
                $tags .= "&nbsp;<a href='".wp_nonce_url($ect_url, 'ect_nonce')."'>";
                
                $tags .= esc_html($tag_term->name);
                
            }
            
            $tags .= "</a>&nbsp;";

        }

        $tags .= "</div>";

        return $tags;

    }

}
