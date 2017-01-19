<?php
namespace theme\rmd\core\adminenqueue;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 *	RMD_Admin_Enqueue - this class will manage of enqueuing the css for custom admin pages and some helper css
 *						like bootstrap grid system and responsive utilities, and js for input generator, like for its
 *						file uploader and media uploader.
 *	
 */ 
class RMD_Admin_Enqueue 
{	
	private $_path_dir_url = '';

	public function __construct()
	{ 	 
		$this->_path_dir_url = get_stylesheet_directory_uri().'/app/core/adminenqueue/';;

		add_action('init',  array($this, 'register_all_styles') );
			add_action('init',  array($this, 'register_all_scripts') );

		add_action('admin_enqueue_scripts', array($this,'enqueue_admin_styles_scripts') ); 
		add_action('wp_enqueue_scripts', array($this,'enqueue_frontend_styles') );
	}
		

	public function register_all_styles()
	{  
		wp_register_style('rmdwp-bootstrap-grid-system-css', $this->_path_dir_url.'css/bootstrap/bootstrap-grid-system.css', array(), '1.0.0', 'all');
		wp_register_style('rmdwp-bootstrap-responsive-utilities-css', $this->_path_dir_url.'css/bootstrap/bootstrap-responsive-utilities.css', array(), '1.0.0', 'all');
		wp_register_style('rmdwp-admin-css', $this->_path_dir_url.'css/rmdwp-admin.css', array(), '1.0.0', 'all');
	} 

	public function register_all_scripts()
	{  
		wp_register_script('rmdwp-admin-js', $this->_path_dir_url.'js/rmdwp-admin.js', array('jquery'), '1.0.0', true);
	} 

	public function enqueue_frontend_styles() 
	{
		wp_enqueue_style('rmdwp-bootstrap-grid-system-css');
		wp_enqueue_style('rmdwp-bootstrap-responsive-utilities-css'); 
	}


	public function enqueue_admin_styles_scripts() 
	{ 	
		wp_enqueue_style('rmdwp-bootstrap-grid-system-css'); 
		wp_enqueue_style('rmdwp-bootstrap-responsive-utilities-css'); 
		wp_enqueue_style('rmdwp-admin-css');

		wp_enqueue_script('jquery'); 
		
		/* For the media uploader */
		wp_enqueue_media(); 
		wp_enqueue_script('rmdwp-admin-js');


        /* For the color picker 1 */
		wp_enqueue_style('wp-color-picker');
		wp_enqueue_script('wp-color-picker');
		

		/* For the color picker 2 */
		wp_enqueue_style('farbtastic');   
        wp_enqueue_script('farbtastic'); 

	} 

}

$RMD_Admin_Enqueue = new RMD_Admin_Enqueue();


/* Created by: Raymond M. Daylo */

 