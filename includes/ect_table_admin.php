<?php 

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if (!function_exists('ectp_table_settings')) { 

    function ectp_table_settings(){
        
        add_menu_page(
            
            'Ecommerce Table',
            
            'EC Table',
            
            'manage_options',
            
            'ectp-table',
            
            'ectp_table_admin'
            
            // string $icon_url = '',
            
            // int $position = null
            
        );
        
    }
    
}

if (function_exists('ectp_table_settings')) { 
    
    add_action("admin_menu" , "ectp_table_settings");

}

if (!function_exists('ectp_table_admin')) { 

    function ectp_table_admin(){

        ectp_update_values();

        $ect_table_settings = get_option( 'ect_table_settings' );

        $ect_table_options = get_option( 'ect_table_options' );

        $row_count = 0;

        foreach($ect_table_settings as $ect_single){

            if($ect_single == 'checked'){

                $row_count++;

            }

        }

        $ect_table_settings['ect_row_count'] = $row_count;

        update_option("ect_table_settings" , $ect_table_settings);

        ?>

    <div class="ect_wrapper">

        <h1>Ecommerce Table</h1>

        <form action="" method="POST">

            <div class="ect_admin_options" style="display:grid; grid-template-columns: 1fr 3fr;">

                <div>

                    <span>Set Display Count</span><br>

                    <input type="text" name="ect_count" id="" value="<?php esc_html_e( $ect_table_settings['ect_display_count']); ?>"><br>

                    <span>Set Image size (:px)</span><br>

                    <input type="text" name="ect_image_size" id="" value="<?php esc_html_e( $ect_table_settings['ect_image_size']); ?>">

                    <h4>Select Fields to display</h4>

                    <input type="checkbox" name="ect_image" <?php esc_html_e( $ect_table_settings['ect_image'] ); ?> >

                    <label for="regular_price">Image</label><br>

                    <input type="checkbox" name="ect_price" <?php esc_html_e( $ect_table_settings['ect_price'] ); ?> >

                    <label for="price">Price</label><br>

                    <input type="checkbox" name="ect_stock_quantity" <?php esc_html_e( $ect_table_settings['ect_stock_quantity'] ); ?> >

                    <label for="stock_quantity">Stock Quantity</label><br>

                    <input type="checkbox" name="ect_stock_status" <?php esc_html_e( $ect_table_settings['ect_stock_status'] ); ?> >

                    <label for="stock_status">Stock Status</label><br>

                    <input type="checkbox" name="ect_weight" <?php esc_html_e( $ect_table_settings['ect_weight'] ); ?> >

                    <label for="weight">Weight</label><br>

                    <input type="checkbox" name="ect_dimention" <?php esc_html_e( $ect_table_settings['ect_dimention'] ); ?> >

                    <label for="dimention">Dimention</label><br>

                    <input type="checkbox" name="ect_short_description" <?php esc_html_e( $ect_table_settings['ect_short_description'] ); ?> >

                    <label for="short_description">Short Description</label><br>

                    <input type="checkbox" name="ect_sku" <?php esc_html_e( $ect_table_settings['ect_sku'] ); ?> >

                    <label for="sku">sku</label><br>

                    <input type="checkbox" name="ect_name" <?php esc_html_e( $ect_table_settings['ect_name'] ); ?> >

                    <label for="name">Name</label><br>

                    <input type="checkbox" name="ect_categories" <?php esc_html_e( $ect_table_settings['ect_categories'] ); ?> >

                    <label for="categories">Categories</label><br>

                    <input type="checkbox" name="ect_tags" <?php esc_html_e( $ect_table_settings['ect_tags'] ); ?> >

                    <label for="tags">Tags</label><br>

                    <input type="hidden" name="ect_row_count" value="<?php esc_html_e( $row_count ); ?>"><br>

                    <div>

                        <input name="ect_update" type="submit" value="Update">

                        <?php wp_nonce_field( 'ect_nonce_action', 'ect_admin_nonce' ); ?>

                    </div>

                </div>

                <div>

                    <h3>Display Options</h3>

                    <h4>Sort By</h4>

                    <input type="checkbox" name="ect_featured_products" <?php esc_html_e( $ect_table_options['ect_featured_products'] ); ?> >

                    <label for="price">Featured Products</label><br>

                    <input type="checkbox" name="ect_instock" <?php esc_html_e( $ect_table_options['ect_instock'] ); ?> >

                    <label for="price">In Stock</label><br>

                </div> 

            </div>

        </form>

        <div><p>Copy and paste shortcode <code>[ect-table]</code> to page</p></div>

        <div><p>Or Copy shortcode to theme  </p></div>

        <div><code>&lt;&#63;php echo do_shortcode( "[ect-table]" ); &#63;&gt;</code></div>

    </div>

    <?php

    }

}

if (!function_exists('ectp_update_values')) { 

    function ectp_update_values(){

        if(isset($_POST['ect_admin_nonce'])){

            $nonce = sanitize_text_field( $_POST['ect_admin_nonce'] );
    
            if ( ! wp_verify_nonce( $nonce, 'ect_nonce_action' ) ) {
    
                die( 'Nonce value cannot be verified.' );
    
            }else{

                $ect_table_settings        = get_option( 'ect_table_settings' );

                $ect_image                 = false;

                $ect_price                 = false;

                $ect_stock_quantity        = false;

                $ect_stock_status          = false;

                $ect_weight                = false;

                $ect_dimention             = false;

                $ect_short_description     = false;

                $ect_sku                   = false;

                $ect_name                  = false;

                $ect_categories            = false;

                $ect_tags                  = false;

                $ect_featured_products     = false;

                $ect_instock               = false;

                

                $ect_display_count = sanitize_text_field($_POST['ect_count']);

                $ect_image_size = sanitize_text_field($_POST['ect_image_size']);

                if(isset($_POST['ect_image']) && $_POST['ect_image'] == 'on'){

                    $ect_image = 'checked';

                }

                if(isset($_POST['ect_price']) && $_POST['ect_price'] == 'on'){

                    $ect_price = 'checked';

                }

                if(isset($_POST['ect_stock_quantity']) && $_POST['ect_stock_quantity'] == 'on'){

                    $ect_stock_quantity = 'checked';

                }

                if(isset($_POST['ect_stock_status']) && $_POST['ect_stock_status'] == 'on'){

                    $ect_stock_status = 'checked';

                }

                if(isset($_POST['ect_weight']) && $_POST['ect_weight'] == 'on'){

                    $ect_weight = 'checked';

                }

                if(isset($_POST['ect_dimention']) && $_POST['ect_dimention'] == 'on'){

                    $ect_dimention = 'checked';

                }

                if(isset($_POST['ect_short_description']) && $_POST['ect_short_description'] == 'on'){

                    $ect_short_description = 'checked';

                }

                if(isset($_POST['ect_sku']) && $_POST['ect_sku'] == 'on'){

                    $ect_sku = 'checked';

                }

                if(isset($_POST['ect_name']) && $_POST['ect_name'] == 'on'){

                    $ect_name = 'checked';

                }

                if(isset($_POST['ect_categories']) && $_POST['ect_categories'] == 'on'){

                    $ect_categories = 'checked';

                }

                if(isset($_POST['ect_tags']) && $_POST['ect_tags'] == 'on'){

                    $ect_tags = 'checked';

                }

                if(isset($_POST['ect_featured_products']) && $_POST['ect_featured_products'] == 'on'){

                    $ect_featured_products = 'checked';

                }

                if(isset($_POST['ect_instock']) && $_POST['ect_instock'] == 'on'){

                    $ect_instock = 'checked';

                }

                $ect_table_settings['ect_display_count']        = $ect_display_count;

                $ect_table_settings['ect_image_size']           = $ect_image_size;

                $ect_table_settings['ect_image']                = $ect_image;

                $ect_table_settings['ect_price']                = $ect_price;

                $ect_table_settings['ect_stock_quantity']       = $ect_stock_quantity;

                $ect_table_settings['ect_stock_status']         = $ect_stock_status;

                $ect_table_settings['ect_dimention']            = $ect_dimention;

                $ect_table_settings['ect_weight']               = $ect_weight;

                $ect_table_settings['ect_short_description']    = $ect_short_description;

                $ect_table_settings['ect_sku']                  = $ect_sku;

                $ect_table_settings['ect_name']                 = $ect_name;

                $ect_table_settings['ect_categories']           = $ect_categories;

                $ect_table_settings['ect_tags']                 = $ect_tags;

                $ect_table_settings['ect_row_count']            = sanitize_text_field($_POST['ect_row_count']);

                $ect_table_settings['ect_currency']             = get_woocommerce_currency_symbol();

                $ect_table_options['ect_featured_products']     = $ect_featured_products;

                $ect_table_options['ect_instock']               = $ect_instock;
            
                update_option("ect_table_settings" , $ect_table_settings);

                update_option("ect_table_options" , $ect_table_options);
                
            }

        }

    }

}