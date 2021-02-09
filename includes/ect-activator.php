<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class Ect_Table_Activator {

        public static function activate() {

        if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

        }else{

            deactivate_plugins( plugin_basename( __FILE__ ) );

            wp_die( __( 'This plugin requires Woocommerce' ) );
            
        }

        $ect_table_settings = get_option( 'ect_table_settings' );

        $ect_table_options = get_option( 'ect_table_options' );

        $defaults = array(

                        'version' 				    => 1.1,

                        'enabled'				    => 'yes',

                        'ect_display_count'			=> 10,

                        'ect_price'                 => 'checked',                

                        'ect_stock_quantity'        => 'checked',                        

                        'ect_stock_status'          => '',                    

                        'ect_dimention'             => '',                    

                        'ect_weight'                => '',                

                        'ect_short_description'     => 'checked',                            

                        'ect_sku'                   => 'checked',            

                        'ect_name'                  => 'checked',            

                        'ect_categories'            => 'checked',                    

                        'ect_row_count'             => 7,     

                        'ect_image_size'            => 80,     

                        'ect_image'                 => 'checked', 

                        'ect_tags'                  => '',

                        'ect_currency'              => '',           

                    );

        $option_defaults = array(

                        'ect_featured_products'     => '',

                        'ect_instock'               => '',

                    );

        $ect_table_settings = wp_parse_args( $ect_table_settings, $defaults );	

        $ect_table_options = wp_parse_args( $ect_table_options, $option_defaults );	

        update_option("ect_table_settings" , $ect_table_settings);

        update_option("ect_table_options" , $ect_table_options);

    }

}

?>