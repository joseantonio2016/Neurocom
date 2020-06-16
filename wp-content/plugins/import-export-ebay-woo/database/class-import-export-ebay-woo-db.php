<?php 
class Import_Export_Ebay_Woo_DB {
	private $version;

public function __construct( $version ) {

		$this->version = $version;

	}

function ie_ebay_woo_db_install() {
	global $wpdb;

	$table_name_user = $wpdb->prefix . 'ie_ebay_woo_user';
	$table_name_query = $wpdb->prefix . 'ie_ebay_woo_query';
	$table_name_success = $wpdb->prefix . 'ie_ebay_woo_success';
	$table_name_list = $wpdb->prefix . 'ie_ebay_woo_list';

	$charset_collate = $wpdb->get_charset_collate();

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

	$sql = "DROP TABLE IF EXISTS $table_name_user,"
		."$table_name_query,$table_name_success,$table_name_list;";
    $wpdb->query($sql);

	$sql  = "CREATE TABLE ".$table_name_user." (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		appid varchar(55) NOT NULL,
		devid varchar(50) DEFAULT '' NOT NULL,
		certid varchar(55) DEFAULT '' NOT NULL,
		email varchar(85) DEFAULT '' NOT NULL,
		token TEXT NOT NULL,
		ambito tinyint(1) DEFAULT 1 NOT NULL,
		PRIMARY KEY (id),
		UNIQUE KEY user (appid, ambito)
	) ".$charset_collate.";";
	dbDelta( $sql);

	$sql = "CREATE TABLE ".$table_name_query." (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		querys varchar(255) NOT NULL,
		filters TEXT NOT NULL,
		options TEXT NOT NULL,
		date_saved TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		id_user mediumint(9) NOT NULL,
		PRIMARY KEY (id)
	) ".$charset_collate.";";
	dbDelta( $sql);

	$sql = "CREATE TABLE ".$table_name_success." (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		id_query mediumint(9) NOT NULL,
		date_request TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		success mediumint(7) NOT NULL,
		PRIMARY KEY (id)
		) ".$charset_collate.";";
	dbDelta( $sql);

	$sql = "CREATE TABLE ".$table_name_list." (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		id_post mediumint(9) NOT NULL,
		id_ebay mediumint(15) NOT NULL,
		id_success mediumint(9) NOT NULL,
		PRIMARY KEY (id)
		) ".$charset_collate.";";
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

	


