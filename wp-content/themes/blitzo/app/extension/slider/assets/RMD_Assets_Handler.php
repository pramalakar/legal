<?php
namespace rmd\extension\slider\assets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
} 

 
class RMD_Assets_Handler
{ 

	protected $path_to = '';

	public function __construct()
	{    
		$this->path_to = get_stylesheet_directory_uri().'/app/extension/slider/assets/'; 

		add_action('init',  array($this, 'register_all_styles') );
		add_action('init',  array($this, 'register_all_scripts') ); 
		
		add_action('admin_enqueue_scripts', array($this, '_admin_enqueue_scripts') );
		add_action('wp_enqueue_scripts', array($this, '_wp_enqueue_scripts') ); 
	}  



	/**
	 *	This method will manage to register all the necessary styles for the frontend and admin
	 *	that will be used later on.
	 */
	public function register_all_styles()
	{   
		wp_register_style( 'rmd-slider-style-css', $this->path_to . 'css/slider-style.css'); 
	}



	/**
	 *	This method will manage to register all the necessary scripts for the frontend and admin
	 *	that will be used later on.
	 */
	public function register_all_scripts()
	{   
		/* Custom Script */
		wp_register_script( 'rmd-slider-script-js', $this->path_to . 'js/slider-script.js', array('rmd-jquery-min-js'), null, true );  
	}



	public function _admin_enqueue_scripts()
	{

	}


	/**
	 *	This method will manage to enqueue the needed styles and scripts for the frontend.
	 */
	public function _wp_enqueue_scripts()
	{	  			
		/* Extended module styles */ 
		wp_enqueue_style('rmd-slider-style-css');    

		/* Extended module scripts */
		wp_enqueue_script('rmd-slider-script-js');   
 
	}
		
}  

$RMD_Assets_Handler = new RMD_Assets_Handler();
