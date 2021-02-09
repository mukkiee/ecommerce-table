<?php 

/*
Plugin Name: Ecommerce Table
Author: Mukul Lodhi
Version: 1.1
Requires at least: 5.5.3
Tested up to: 5.6
Description: This Plugin displays products in tabular format
Requires PHP: 5.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This Plugin arrange products into tabular format.

*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

function activate_ect_Table() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/ect-activator.php';
	Ect_Table_Activator::activate();
}
 
function deactivate_ect_Table() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/ect-deactivator.php';
	Ect_Table_Deactivator::deactivate();
}
 
register_activation_hook( __FILE__, 'activate_ect_Table' );
register_deactivation_hook( __FILE__, 'deactivate_ect_Table' );
register_uninstall_hook( __FILE__, 'deactivate_ect_Table' );

require plugin_dir_path( __FILE__ ) . 'ect_table_functions.php';