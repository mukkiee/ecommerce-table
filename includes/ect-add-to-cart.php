<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if (!function_exists('ectp_generate_heading')) { 

    function ectp_product_update(){

        if(isset($_POST['nonce'])){

            $nonce = sanitize_text_field( $_POST['nonce'] );

            if ( ! wp_verify_nonce( $nonce, 'ect-ajax-nonce' ) ) {

                die( 'Nonce value cannot be verified.' );

            }

            $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint(sanitize_text_field( $_POST['post_id'] )));

            $quantity = empty(sanitize_text_field( $_POST['quantity'] )) ? 1 : wc_stock_amount(sanitize_text_field( $_POST['quantity'] ));

            $variation_id = absint(sanitize_text_field( $_POST['var_id'] ));

            wc_stock_amount(sanitize_text_field($_POST['quantity']));

            $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);

            $product_status = get_post_status($product_id);

            if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {

                echo 'added';

            } else {

                $data = array(

                    'error' => true,

                    'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));

                echo wp_send_json($data);

            }

            die();

        }

        die();

    }

}
add_action( 'wp_ajax_ectp_product_update', 'ectp_product_update' );

add_action( 'wp_ajax_nopriv_ectp_product_update', 'ectp_product_update' );