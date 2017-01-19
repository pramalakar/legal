<?php
namespace theme\rmd\theme\assets;
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 *  RMD_Assets_Loader - This will manage to compile the necessary styles and scripts for a particular page.
 */

require_once dirname(__FILE__).'/default/wp-bootstrap-navwalker/wp_bootstrap_navwalker.php';

 
class RMD_Assets_Loader
{ 

	protected $path_to = '';

	public function __construct()
	{    
		$this->path_to = get_stylesheet_directory_uri().'/app/theme/assets/'; 

		add_action('init',  array($this, 'register_all_styles') );
		add_action('init',  array($this, 'register_all_scripts') );  

		add_action('wp_enqueue_scripts', array($this, '_wp_enqueue_scripts') ); 
	}  



	/**
	 *	This method will manage to register all the necessary styles for the frontend and admin
	 *	that will be used later on.
	 */
	public function register_all_styles()
	{ 
		/* CSS Plugins Style */
		wp_register_style( 'rmd-bootstrap-min-css', $this->path_to . 'default/bootstrap/css/bootstrap.min.css');  
		wp_register_style( 'rmd-jasny-bootstrap-min-css', $this->path_to . 'default/jasny-bootstrap/css/jasny-bootstrap.min.css'); 
		wp_register_style( 'rmd-font-awesome-css', $this->path_to . 'default/font-awesome/css/font-awesome.css'); 
		wp_register_style( 'rmd-style-css', get_stylesheet_uri());  

	}



	/**
	 *	This method will manage to register all the necessary scripts for the frontend and admin
	 *	that will be used later on.
	 */
	public function register_all_scripts()
	{  
		/* JS Plugins Script */
		wp_register_script( 'rmd-jquery-min-js', $this->path_to . 'default/js/plugins/jquery.min.js', array(), null, true ); 
		wp_register_script( 'rmd-bootstrap-min-js', $this->path_to . 'default/bootstrap/js/bootstrap.min.js', array('rmd-jquery-min-js'), null, true ); 
		wp_register_script( 'rmd-jasny-bootstrap-min-js', $this->path_to . 'default/jasny-bootstrap/js/jasny-bootstrap.min.js', array('rmd-jquery-min-js'), null, true); 
		 
		/* Custom js */
		wp_register_script( 'rmd-default-script-js', $this->path_to . 'default/js/scripts/default-script.js', array('rmd-jquery-min-js'), null, true );  
		wp_register_script( 'rmd-back-to-top-script-js', $this->path_to . 'default/js/scripts/back-to-top-script.js', array('rmd-jquery-min-js'), null, true );  
		wp_register_script( 'rmd-sticky-nav-script-js', $this->path_to . 'default/js/scripts/sticky-nav-script.js', array('rmd-jquery-min-js'), null, true );  
		wp_register_script( 'rmd-on-page-link-script-js', $this->path_to . 'default/js/scripts/on-page-link-script.js', array('rmd-jquery-min-js'), null, true );  

	  
	}
 


	/**
	 *	This method will manage to enqueue the needed styles and scripts for the frontend.
	 */
	public function _wp_enqueue_scripts()
	{	 
		/* Common styles */
		wp_enqueue_style('rmd-bootstrap-min-css');   
		wp_enqueue_style('rmd-jasny-bootstrap-min-css'); 
		wp_enqueue_style('rmd-font-awesome-css'); 
		wp_enqueue_style('rmd-style-css'); 
		 
		//wp_enqueue_style('rmd-theme-color-1-css');  
		
		/* Javascript Plugins */
		wp_enqueue_script('rmd-jquery-min-js'); 
		wp_enqueue_script('rmd-bootstrap-min-js');  
		wp_enqueue_script('rmd-jasny-bootstrap-min-js');   

		 
		/* Custom scripts */
		wp_enqueue_script('rmd-default-script-js'); 
		wp_enqueue_script('rmd-back-to-top-script-js'); 
		wp_enqueue_script('rmd-sticky-nav-script-js');    
		wp_enqueue_script('rmd-on-page-link-script-js');  

	}
		

}  


$RMD_Assets_Loader = new RMD_Assets_Loader();