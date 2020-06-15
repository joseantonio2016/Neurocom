<?php 
class Import_Export_Ebay_Woo_DB {
	private $version;

public function __construct( $version ) {

		$this->version = $version;

	}

function ie_ebay_woo_db_install() {
	global $wpdb;

	$table_name_usr = $wpdb->prefix . 'ie_ebay_woo_usr';
	$table_name_ack = $wpdb->prefix . 'ie_ebay_woo_ack';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql  = "CREATE TABLE $table_name_usr (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		appid varchar(55) NOT NULL,
		devid varchar(55) DEFAULT '' NOT NULL,
		certid varchar(55) DEFAULT '' NOT NULL,
		token TEXT,
		ambito tinyint(1) DEFAULT 0 NOT NULL,
		PRIMARY KEY (id),
		UNIQUE KEY user(appid, ambito)
	) $charset_collate;";

	$sql .= "CREATE TABLE $table_name_ack (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		crit_search TEXT NOT NULL,
		ack tinyint(1) NOT NULL,
		id_usr mediumint(9) NOT NULL,
		fecha_q TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql);

	update_option( 'ie_ebay_woo_db_version', $this->version );
}

function ie_ebay_woo_update_db_check() {
    if ( get_site_option( 'ie_ebay_woo_db_version' ) != $this->version ) {
        $this->ie_ebay_woo_db_install();
    }
}
//add_action( 'plugins_loaded', 'ie_ebay_woo_update_db_check' );

}

	


