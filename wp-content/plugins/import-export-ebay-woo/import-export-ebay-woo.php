<?php

/**
 
 *
 * @link              http://josewilka.com
 * @since             1.0.0
 * @package           Import_Export_Ebay_Woo
 *
 * @wordpress-plugin
 * Plugin Name:       Import Export Ebay Woo
 * Plugin URI:        http://ekumar.com.np/plugins/wp/
 * Description:       Este plugin es para importar y exportar productos desde y hacia Ebay
 * Version:           1.0.0
 * Author:            Neurocom
 * Author URI:        http://josewilka.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       import-export-ebay-woo
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use Algo - https://algo.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-import-ebay-product-to-woocommerce-activator.php
 */
 function activate_import_export_ebay_woo() {
    
 	require_once plugin_dir_path( __FILE__ ) . 'includes/class-import-export-ebay-woo-activator.php';
	Import_Export_Ebay_Woo_Activator::activate();
 }

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-import-ebay-product-to-woocommerce-deactivator.php
 */
 function deactivate_import_export_ebay_woo() {
 	require_once plugin_dir_path( __FILE__ ) . 'includes/class-import-export-ebay-woo-deactivator.php';
 	Import_Export_Ebay_Woo_Deactivator::deactivate();
 }

 register_activation_hook( __FILE__, 'activate_import_export_ebay_woo' );
 register_deactivation_hook( __FILE__, 'deactivate_import_export_ebay_woo' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */


require plugin_dir_path( __FILE__ ) . 'includes/class-import-export-ebay-woo.php';

function run_import_export_ebay_woo() {

	$plugin = new Import_Export_Ebay_Woo();
	$plugin->run();

}
run_import_export_ebay_woo();