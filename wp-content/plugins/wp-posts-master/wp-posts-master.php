<?php
/**
 * WP_Posts_Pro class file.
 * @package Posts
 * @author Flipper Code <hello@flippercode.com>
 * @version 1.0.5
 */

/*
Plugin Name: WP Posts Master
Plugin URI: http://www.flippercode.com/
Description: Display Posts Listing in Pages, Posts & Custom Templates. It’s Responsive, Multi-Lingual and Multi-Site Supported.
Author: flippercode
Author URI: http://www.flippercode.com/
Version: 1.0.5
Text Domain: wp_posts_pro
Domain Path: /lang/
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( 'You are not allowed to call this page directly.' );
}

if ( ! class_exists( 'WP_Posts_Pro' ) ) {

	/**
	 * Main plugin class
	 * @author Flipper Code <hello@flippercode.com>
	 * @package Posts
	 */
	class WP_Posts_Pro
	{
		/**
		 * List of Modules.
		 * @var array
		 */
		private $modules = array();

		/**
		 * Intialize variables, files and call actions.
		 * @var array
		 */
		public function __construct() {
			error_reporting( E_ERROR | E_PARSE );
			$this->_define_constants();
			$this->_load_files();
			register_activation_hook( __FILE__, array( $this, 'plugin_activation' ) );
			register_deactivation_hook( __FILE__, array( $this, 'plugin_deactivation' ) );
			add_action( 'plugins_loaded', array( $this, 'load_plugin_languages' ) );
			add_action( 'init', array( $this, '_init' ) );
			add_action( 'wp_ajax_wpp_ajax_call',array( $this, 'wpp_ajax_call' ) );
			add_action( 'wp_ajax_nopriv_wpp_ajax_call', array( $this, 'wpp_ajax_call' ) );
			add_shortcode( 'wprpw_display_layout', array( $this, 'wpp_posts_listing' ) );
		}
		/**
		 * Register Posts Pro Widget
		 */
		function wpp_posts_widget() {

			register_widget( 'wpp_Posts_Widget_Class' );
		}
		/**
		 * Display posts on the frontend using wpp_posts_listing shortcode.
		 * @param  array  $atts   Template Options.
		 * @param  string $content Content.
		 */
		function wpp_posts_listing($atts, $content = null) {

			try {
				$factoryObject = new WPP_Controller();
				$viewObject = $factoryObject->create_object( 'shortcode' );
				$output = $viewObject->display( 'pmp-posts-listing',$atts );
				return $output;

			} catch (Exception $e) {
				echo FlipperCode_Template::show_message( array( 'error' => $e->getMessage() ) );

			}

		}
		/**
		 * Ajax Call
		 */
		function wpp_ajax_call() {

			check_ajax_referer( 'pmp-call-nonce', 'nonce' );
			$operation = sanitize_text_field( wp_unslash( $_POST['operation'] ) );
			$value = wp_unslash( $_POST );
			$selected = wp_unslash( $_POST['selected_value'] );
			if ( 'wpp_load_template' == $operation ) {
				$obj = new FlipperCode_Layout();
				echo json_encode( $obj->wpp_load_template( $value ) );
			} else if ( 'get_next_posts' == $operation ) {
				$obj = new FlipperCode_Layout();
				echo $obj->wpp_load_posts( $value );
			} else if ( isset( $operation ) ) {
				$this->$operation($value,$selected);
			}
			exit;
		}

		/**
		 * Get Taxonomies of the Post Type.
		 * @param  array  $value    Post Data.
		 * @param  string $selected Selected Layout.
		 */
		function get_taxonomies($value, $selected) {

			$output = '';
			$all_taxonomies = get_object_taxonomies( $value );
			$modelFactory = new WPP_Model();
			$rule_obj = $modelFactory->create_object( 'rules' );
			$rule_obj = $rule_obj->fetch( array( array( 'rule_id', '=', intval( wp_unslash( $selected ) ) ) ) );
			$data = (array) $rule_obj[0];
			if ( ! empty( $all_taxonomies ) ) {
				foreach ( $all_taxonomies as $taxonomy ) {
					if ( 'post_format' == $taxonomy ) {
						continue;
					}
					$output .= FlipperCode_HTML_Markup::field_radio('rule_match[category_taxonomy]',array(
						'radio-val-label' => array( $taxonomy => ucwords( $taxonomy ) ),
						'current' => $data['rule_match']['category_taxonomy'],
						'desc' => $taxonomy,
						'class' => 'chkbox_class',
						));
				}
			} else {
				$output = __( 'No taxonomies found.',WPP_TEXT_DOMAIN );
			}
			echo $output;
		}

		/**
		 * Get Terms by taxonomy.
		 * @param  array  $value    Post Data.
		 * @param  string $selected  Selected Template.
		 */
		function get_terms($value, $selected) {

			$output = '';
			$all_terms = $categories = get_terms( $value['value'], array(
				'orderby'    => 'count',
				'hide_empty' => 0,
				) );
			$modelFactory = new WPP_Model();
			$rule_obj = $modelFactory->create_object( 'rules' );
			$rule_obj = $rule_obj->fetch( array( array( 'rule_id', '=', intval( wp_unslash( $selected ) ) ) ) );
			$data = (array) $rule_obj[0];
			$all_selected_terms = $data['rule_match']['category_term'];
			if ( ! is_array( $all_selected_terms ) ) {
				$all_selected_terms = array();
			}
			if ( ! empty( $all_terms ) ) {
				foreach ( $all_terms as $term ) {
					if ( in_array( $term->term_id, $all_selected_terms ) ) {
						$current = $term->term_id;
					} else {
						$current = '0';
					}
					if ( '' != $term->name ) {
						$output .= FlipperCode_HTML_Markup::field_checkbox('rule_match[category_term][]',array(
							'value' => $term->term_id,
							'current' => $current,
							'desc' => ucwords( $term->name ),
							'class' => 'chkbox_class',
						));
					}
				}
			} else {
				$output = __( 'No terms found.',WPP_TEXT_DOMAIN );
			}
			if ( '' == $output ) {
				$output = __( 'No terms found.',WPP_TEXT_DOMAIN );
			}
			echo $output;
		}

		/**
		 * Call WordPress hooks.
		 */
		function _init() {
			global $wpdb;
			add_action( 'admin_menu', array( $this, 'create_menu' ) );
			if ( ! is_admin() ) {
				add_action( 'wp_enqueue_scripts', array( $this, 'wpp_frontend_scripts' ) );
			}
			add_filter( 'plugin_action_links_'.plugin_basename(__FILE__), array($this,'plugin_action_links') );
		add_filter( 'plugin_row_meta', array($this,'plugin_row_meta'), 10,2 );

		}
		/**
		 * Settings link.
		 * @param  array $links Array of Links.
		 * @return array        Array of Links.
		 */
		function plugin_row_meta( $links, $file ) {

			if( basename(dirname($file)) == 'wp-posts-master' ) {
				$links[] = '<a href="http://www.flippercode.com/product/wp-posts-pro/" target="_blank">Upgrade to Pro</a>';
		   		$links[] = '<a href="http://www.flippercode.com/forums" target="_blank">Support Forums</a>';
			}		
		   
		   return $links;
		}
		/**
		 * Settings link.
		 * @param  array $links Array of Links.
		 * @return array        Array of Links.
		 */
		function plugin_action_links( $links ) {
		   $links[] = '<a href="'. esc_url( get_admin_url(null, 'admin.php?page=wpp_howto_overview') ) .'">How to Use</a>';
		   return $links;
		}

		/**
		 * Eneque scripts at frontend.
		 */
		function wpp_frontend_scripts() {

			$scripts = array();
			wp_enqueue_script( 'jquery' );

			$scripts[] = array(
			'handle'  => 'pmp-frontend',
			'src'   => WPP_JS.'frontend.js',
			'deps'    => array(),
			);

			$where = apply_filters( 'wpp_script_position', true );
			if ( $scripts ) {
				foreach ( $scripts as $script ) {
					wp_register_script( $script['handle'], $script['src'], $script['deps'], '', $where );
				}
			}
			$frontend_styles = array(
			'pmp-frontend'  => WPP_CSS.'frontend.css',
			);

			if ( $frontend_styles ) {
				foreach ( $frontend_styles as $frontend_style_key => $frontend_style_value ) {
					wp_register_style( $frontend_style_key, $frontend_style_value );
				}
			}
		}

		/**
		 * Process slug and display view in the backend.
		 */
		function processor() {

			$return = '';
			if ( isset( $_GET['page'] ) ) {
				$page = sanitize_text_field( wp_unslash( $_GET['page'] ) );
			} else {
				$page = 'wpp_view_overview';
			}

			$pageData = explode( '_', $page );
			$obj_type = $pageData[2];
			$obj_operation = $pageData[1];

			if ( count( $pageData ) < 3 ) {
				die( 'Cheating!' );
			}

			try {
				if ( count( $pageData ) > 3 ) {
					$obj_type = $pageData[2].'_'.$pageData[3];
				}

				$factoryObject = new WPP_Controller();
				$viewObject = $factoryObject->create_object( $obj_type );
				$viewObject->display( $obj_operation );

			} catch (Exception $e) {
				echo wpp_Template::show_message( array( 'error' => $e->getMessage() ) );

			}

		}

		/**
		 * Create backend navigation.
		 */
		function create_menu() {

			global $navigations;

			$pagehook1 = add_menu_page(
				__( 'WP Posts Lite', WPP_TEXT_DOMAIN ),
				__( 'WP Posts Lite', WPP_TEXT_DOMAIN ),
				'wpp_admin_overview',
				WPP_SLUG,
				array( $this,'processor' )
			);

			if ( current_user_can( 'manage_options' )  ) {
								$role = get_role( 'administrator' );
								$role->add_cap( 'wpp_admin_overview' );
			}

			$this->load_modules_menu();

			add_action( 'load-'.$pagehook1, array( $this, 'wpp_backend_scripts' ) );

		}

		/**
		 * Read models and create backend navigation.
		 */
		function load_modules_menu() {

			$modules = $this->modules;
			$pagehooks = array();
			if ( is_array( $modules ) ) {
				foreach ( $modules as $module ) {

						$object = new $module;
					if ( method_exists( $object,'navigation' ) ) {

						if ( ! is_array( $object->navigation() ) ) {
							continue;
						}

						foreach ( $object->navigation() as $nav => $title ) {

							if ( current_user_can( 'manage_options' ) && is_admin() ) {
								$role = get_role( 'administrator' );
								$role->add_cap( $nav );

							}

							$pagehooks[] = add_submenu_page(
								WPP_SLUG,
								$title,
								$title,
								$nav,
								$nav,
								array( $this,'processor' )
							);

						}
					}
				}
			}

			if ( is_array( $pagehooks ) ) {

				foreach ( $pagehooks as $key => $pagehook ) {
					add_action( 'load-'.$pagehooks[ $key ], array( $this, 'wpp_backend_scripts' ) );
				}
			}

		}

		/**
		 * Eneque scripts in the backend.
		 */
		function wpp_backend_scripts() {

			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style( 'thickbox' );
			$wp_scripts = array( 'jQuery','thickbox', 'wp-color-picker', 'jquery-ui-datepicker' );

			if ( $wp_scripts ) {
				foreach ( $wp_scripts as $wp_script ) {
					wp_enqueue_script( $wp_script );
				}
			}

			$scripts = array();

			$scripts[] = array(
			'handle'  => 'pmp-backend-bootstrap',
			'src'   => WPP_JS.'bootstrap.min.js',
			'deps'    => array(),
			);
			$scripts[] = array(
			'handle'  => 'pmp-backend',
			'src'   => WPP_JS.'backend.js',
			'deps'    => array(),
			);

			if ( $scripts ) {
				foreach ( $scripts as $script ) {
					wp_enqueue_script( $script['handle'], $script['src'], $script['deps'] );
				}
			}

			$wpp_js_lang = array();
			$wpp_js_lang['ajax_url'] = admin_url( 'admin-ajax.php' );
			$wpp_js_lang['nonce'] = wp_create_nonce( 'pmp-call-nonce' );
			$wpp_js_lang['confirm'] = __( 'Are you sure to delete item?',WPP_TEXT_DOMAIN );
			wp_localize_script( 'pmp-backend', 'wpp_js_lang', $wpp_js_lang );

			$admin_styles = array(
			'flippercode-bootstrap' => WPP_CSS.'bootstrap.min.flat.css',
			'pmp-backend-style' => WPP_CSS.'backend.css',
			'pmp-frontend-style' => WPP_CSS.'frontend.css',
			);

			if ( $admin_styles ) {
				foreach ( $admin_styles as $admin_style_key => $admin_style_value ) {
					wp_enqueue_style( $admin_style_key, $admin_style_value );
				}
			}
			wp_enqueue_style( 'jquery-style', WPP_CSS.'jquery-ui/jquery-ui.css' );

		}

		/**
		 * Load plugin language file.
		 */
		function load_plugin_languages() {

			load_plugin_textdomain( WPP_TEXT_DOMAIN, false, WPP_FOLDER.'/lang/' );
		}
		/**
		 * Call hook on plugin activation for both multi-site and single-site.
		 */
		function plugin_activation($network_wide = null) {

			if ( is_multisite() && $network_wide ) {
				global $wpdb;
				$currentblog = $wpdb->blogid;
				$activated = array();
				$sql = "SELECT blog_id FROM {$wpdb->blogs}";
				$blog_ids = $wpdb->get_col( $wpdb->prepare( $sql, null ) );

				foreach ( $blog_ids as $blog_id ) {
					switch_to_blog( $blog_id );
					$this->wpp_activation();
					$activated[] = $blog_id;
				}

				switch_to_blog( $currentblog );
				update_site_option( 'op_activated', $activated );

			} else {
				$this->wpp_activation();
			}
		}
		/**
		 * Call hook on plugin deactivation for both multi-site and single-site.
		 */
		function plugin_deactivation($network_wide) {

			if ( is_multisite() && $network_wide ) {
				global $wpdb;
				$currentblog = $wpdb->blogid;
				$activated = array();
				$sql = "SELECT blog_id FROM {$wpdb->blogs}";
				$blog_ids = $wpdb->get_col( $wpdb->prepare( $sql, null ) );

				foreach ( $blog_ids as $blog_id ) {
					switch_to_blog( $blog_id );
					$this->wpp_deactivation();
					$activated[] = $blog_id;
				}

				switch_to_blog( $currentblog );
				update_site_option( 'op_activated', $activated );

			} else {
				$this->wpp_deactivation();
			}
		}

		/**
		 * Perform tasks on plugin deactivation.
		 */
		function wpp_deactivation() {

		}

		/**
		 * Perform tasks on plugin deactivation.
		 */
		function wpp_activation() {

			global $wpdb;

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

			$modules = $this->modules;
			$pagehooks = array();

			if ( is_array( $modules ) ) {
				foreach ( $modules as $module ) {
					$object = new $module;
					if ( method_exists( $object,'install' ) ) {
								$tables[] = $object->install();
					}
				}
			}

			if ( is_array( $tables ) ) {
				foreach ( $tables as $i => $sql ) {
					dbDelta( $sql );
				}
			}

		}

		/**
		 * Define all constants.
		 */
		private function _define_constants() {

			global $wpdb;

			if ( ! defined( 'WPP_SLUG' ) ) {
				define( 'WPP_SLUG', 'wpp_view_overview' );
			}

			if ( ! defined( 'WPP_VERSION' ) ) {
				define( 'WPP_VERSION', '1.0.5' );
			}

			if ( ! defined( 'WPP_TEXT_DOMAIN' ) ) {
				define( 'WPP_TEXT_DOMAIN', 'WP_Posts_Pro' );
			}

			if ( ! defined( 'WPP_FOLDER' ) ) {
				define( 'WPP_FOLDER', basename( dirname( __FILE__ ) ) );
			}

			if ( ! defined( 'WPP_DIR' ) ) {
				define( 'WPP_DIR', plugin_dir_path( __FILE__ ) );
			}

			if ( ! defined( 'WPP_CORE_CLASSES' ) ) {
				define( 'WPP_CORE_CLASSES', WPP_DIR.'core/' );
			}
			
			if ( ! defined( 'WPP_PLUGIN_CLASSES' ) ) {
				define( 'WPP_PLUGIN_CLASSES', WPP_DIR.'classes/' );
			}

			if ( ! defined( 'WPP_CONTROLLER' ) ) {
				define( 'WPP_CONTROLLER', WPP_CORE_CLASSES );
			}

			if ( ! defined( 'WPP_CORE_CONTROLLER_CLASS' ) ) {
				define( 'WPP_CORE_CONTROLLER_CLASS', WPP_CORE_CLASSES.'class.controller.php' );
			}

			if ( ! defined( 'WPP_MODEL' ) ) {
				define( 'WPP_MODEL', WPP_DIR.'modules/' );
			}

			if ( ! defined( 'WPP_URL' ) ) {
				define( 'WPP_URL', plugin_dir_url( WPP_FOLDER ).WPP_FOLDER.'/' );
			}

			if ( ! defined( 'FC_CORE_URL' ) ) {
				define( 'FC_CORE_URL', plugin_dir_url( WPP_FOLDER ).WPP_FOLDER.'/core/' );
			}

			if ( ! defined( 'WPP_INC_URL' ) ) {
				define( 'WPP_INC_URL', WPP_URL.'includes/' );
			}

			if ( ! defined( 'WPP_VIEWS_PATH' ) ) {
				define( 'WPP_VIEWS_PATH', wpp_CLASSES.'view' );
			}

			if ( ! defined( 'WPP_CSS' ) ) {
				define( 'WPP_CSS', WPP_URL.'/assets/css/' );
			}

			if ( ! defined( 'WPP_JS' ) ) {
				define( 'WPP_JS', WPP_URL.'/assets/js/' );
			}

			if ( ! defined( 'WPP_IMAGES' ) ) {
				define( 'WPP_IMAGES', WPP_URL.'/assets/images/' );
			}

			if ( ! defined( 'WPP_FONTS' ) ) {
				define( 'WPP_FONTS', WPP_URL.'fonts/' );
			}

			if ( ! defined( 'WPP_TBL_LAYOUT' ) ) {
				define( 'WPP_TBL_LAYOUT', $wpdb->prefix.'post_widget_layouts' );
			}

			if ( ! defined( 'WPP_TBL_RULES' ) ) {
				define( 'WPP_TBL_RULES', $wpdb->prefix.'post_widget_rules' );
			}

		}

		/**
		 * Load all required core classes.
		 */
		private function _load_files() {

			
			$coreInitialisationFile = plugin_dir_path( __FILE__ ).'core/class.initiate-core.php';
			if ( file_exists( $coreInitialisationFile ) ) {
			   require_once( $coreInitialisationFile );
			}
			
			//Load Plugin Files	
			$plugin_files_to_include = array('wpp-controller.php',
											 'wpp-model.php',
											 'class.posts.php',
											 'class.frontend.php',
											 'class.public.php');
											 											 
			foreach ( $plugin_files_to_include as $file ) {

				if(file_exists(WPP_PLUGIN_CLASSES . $file))
				require_once( WPP_PLUGIN_CLASSES . $file ); 
			}
			// Load all modules.
			$core_modules = array( 'overview','rules','layout' );
			if ( is_array( $core_modules ) ) {
				foreach ( $core_modules as $module ) {

					$file = WPP_MODEL.$module.'/model.'.$module.'.php';
					if ( file_exists( $file ) ) {
						include_once( $file );
						$class_name = 'wpp_Model_'.ucwords( $module );
						array_push( $this->modules, $class_name );
					}
				}
			}
		}
	}
}

new WP_Posts_Pro();
