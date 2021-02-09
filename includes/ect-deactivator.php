<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class Ect_Table_Deactivator {

	public static function deactivate() {

        delete_option( 'ect_table_settings' );
        
        delete_option( 'ect_table_options' );

    }

}