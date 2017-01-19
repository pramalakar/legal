<?php
namespace theme\rmd\extension\testimonial\assets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
} 


class RMD_Assets_Handler
{ 

	protected $path_to = '';

	public function __construct()
	{    
		$this->path_to = get_stylesheet_directory_uri().'/app/extension/testimonial/assets/'; 

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
		/* CSS for the extented modules */
		wp_register_style( 'rmd-testimonial-style-css', $this->path_to . 'css/testimonial-style.css'); 

	}



	/**
	 *	This method will manage to register all the necessary scripts for the frontend and admin
	 *	that will be used later on.
	 */
	public function register_all_scripts()
	{   
		
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
		wp_enqueue_style('rmd-testimonial-style-css');   
	}
		
}  

$RMD_Assets_Handler = new RMD_Assets_Handler();

 