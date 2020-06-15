<?php
class Import_Export_Ebay_Woo {

	protected $loader, $plugin_name, $version;

     private static $instance;

     public function __construct() {
		if ( defined( 'PLUGIN_NAME_VERSION' ) ) {
			$this->version = PLUGIN_NAME_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'import-export-ebay-woo';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_db_hooks();

	}

	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-import-export-ebay-woo-loader.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-import-export-ebay-woo-i18n.php';


		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-import-export-ebay-woo-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-import-export-ebay-woo-public.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'database/class-import-export-ebay-woo-db.php'; 
		//register_activation_hook( __FILE__, 'ie_ebay_woo_db_install' ) );

		$this->loader = new Import_Export_Ebay_Woo_Loader();

	}

	private function set_locale() {

		$plugin_i18n = new Import_Export_Ebay_Woo_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	private function define_admin_hooks() {

		$plugin_admin = new Import_Export_Ebay_Woo_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'import_export_ebay_woo_menu' );
		$this->loader->add_action( 'wp_ajax_ebay_ajax', $plugin_admin, 'get_ebay' );
		$this->loader->add_action( 'wp_ajax_register_ebaydev', $plugin_admin, 'register_ebaydev' );
		$this->loader->add_action( 'wp_ajax_get_categories', $plugin_admin, 'get_categories' );
		$this->loader->add_action( 'wp_ajax_search_item', $plugin_admin, 'search_item' );
		

	}

	private function define_public_hooks() {

		$plugin_public = new Import_Export_Ebay_Woo_Public( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
       
	}

	private function define_db_hooks() {

		$plugin_db = new Import_Export_Ebay_Woo_DB( $this->get_version() );
		$this->loader->add_action( 'plugins_loaded', $plugin_db, 'ie_ebay_woo_update_db_check' );
       
	}

	public function run() {
		$this->loader->run();
	}

	public function get_plugin_name() {
		return $this->plugin_name;
	}

	public function get_loader() {
		return $this->loader;
	}

	public function get_version() {
		return $this->version;
	}




	 


}

