<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

require plugin_dir_path( __FILE__ ) . 'includes/ect-add-to-cart.php';

require plugin_dir_path( __FILE__ ) . 'includes/ect_table_admin.php';

require plugin_dir_path( __FILE__ ) . 'includes/ect-front-end.php';

if (!function_exists('ectp_table_scripts')) { 

    function ectp_table_scripts() {
        
        wp_enqueue_style( 'wp_table_style', plugins_url( 'assets/ect_table_style.css', __FILE__ ), array(), '1.0.0' );
        
    }

}

if (function_exists('ectp_table_scripts')) { 
    
    add_action( 'wp_enqueue_scripts', 'ectp_table_scripts');
    
}

if (!function_exists('ectp_ajax_handle')) { 
    
    function ectp_ajax_handle(){

        wp_enqueue_script( 'ect_ajax_path_handle', plugins_url('assets/ect_table_script.js', __FILE__) , array('jquery') );
        
        $translation_array = array( 
            
            'ajax_path' => admin_url( 'admin-ajax.php' ),
            
            'nonce' => wp_create_nonce('ect-ajax-nonce'),
            
        );
        
        wp_localize_script( 'ect_ajax_path_handle', 'ajax_object', $translation_array );
        
        wp_enqueue_script( 'ect_ajax_path_handle' );
        
    }
}

if (function_exists('ectp_ajax_handle')) { 
    
    add_action( 'wp_enqueue_scripts', 'ectp_ajax_handle' );
    
}


if (!function_exists('ectp_tabular_posts')) { 

    function ectp_tabular_posts(){
        
        $ect_table_settings = get_option( 'ect_table_settings' );

        $ect_table_options = get_option( 'ect_table_options' );
        
        $count = $ect_table_settings['ect_display_count'];
        
        $ect_tax_query_featured     = '';
        
        $ect_meta_query             = '';
        
        $ect_tax_query_cat          = '';
        
        $ect_tax_query_tag          = '';
        
        if($ect_table_options['ect_featured_products'] == 'checked'){

            $ect_tax_query_featured = array(

                'taxonomy' => 'product_visibility',
                
                'field'    => 'name',
                
                'terms'    => 'featured',

            );
            
        }  
        
        if($ect_table_options['ect_instock'] == 'checked'){
            
            $ect_meta_query = array(

                array(

                    'key' => '_stock_status',

                    'value' => 'instock',
                    
                    'compare' => '=',

                )
                
            );   
            
        }

        if(isset($_GET['_wpnonce'])){

            $nonce = sanitize_text_field( $_GET['_wpnonce'] );
    
            if ( ! wp_verify_nonce( $nonce, 'ect_nonce' ) ) {
    
                die( 'Nonce value cannot be verified.' );
    
            }else{

                if(isset($_GET['cat'])){
            
                    $ect_tax_query_cat = array(
        
                        'taxonomy' => 'product_cat',
                        
                        'field'    => 'slug',
                        
                        'terms'    => sanitize_text_field( $_GET['cat'] ),
                        
                    );
                    
                }
                
                if(isset($_GET['tag'])){
                    
                    $ect_tax_query_tag = array(
                        
                        'taxonomy' => 'product_tag',
                        
                        'field'    => 'slug',
                        
                        'terms'    => sanitize_text_field( $_GET['tag'] ),
        
                    );
                    
                }  

            }
            
        }
        
        $args = array(
            
            'posts_per_page'    => $count,
            
            'post_type'         => 'product',
            
            'post_status'       => 'publish',

            'tax_query'         => array( 
                
                'relation'  => 'AND',
                
                $ect_tax_query_featured,
                
                $ect_tax_query_cat,
                
                $ect_tax_query_tag,
                
            ),
            
            'meta_query'        => $ect_meta_query,
            
        );
        
        $the_query	= new WP_Query( $args );
        
        if ( $the_query->have_posts() ) {

            echo "<div class='ect_table_wrapper'>";

            echo "<div id='ect_single_heading' class='ect_table' style='display: grid; grid-template-columns: repeat(".$ect_table_settings['ect_row_count'].", 1fr) 2fr;'>";

            ectp_generate_heading($ect_table_settings);
            
            echo "</div>";
            
            while ( $the_query->have_posts() ) {
                
                $the_query->the_post();
                
                $post_id = get_the_ID();	
                
                echo "<div id='ect_single_".$post_id."' class='ect_table' style='display: grid; grid-template-columns: repeat(".$ect_table_settings['ect_row_count'].", 1fr) 2fr;'>";
                
                ectp_generate_table($post_id, $ect_table_settings);

                echo "</div>";

            }

            $arr = wp_json_encode($ect_table_settings);
            
            echo "<input type='hidden' id='ect_table_settings' value='".$arr."'>";
            
            echo "</div>";
            
        }

    }

}

if (function_exists('ectp_tabular_posts')) { 

    add_shortcode( 'ect-table', 'ectp_tabular_posts' );

}