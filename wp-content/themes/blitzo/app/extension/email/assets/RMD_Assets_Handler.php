<?php
namespace theme\rmd\extension\email\assets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
} 


class RMD_Assets_Handler
{ 

	protected $path_to = '';

	public function __construct()
	{    
		$this->path_to = get_stylesheet_directory_uri().'/app/extension/email/assets/'; 

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
		/* CSS for the extented modules */
		wp_register_style( 'rmd-cf-style-css', $this->path_to . 'css/contact-form-style.css'); 

	}



	/**
	 *	This method will manage to register all the necessary scripts for the frontend and admin
	 *	that will be used later on.
	 */
	public function register_all_scripts()
	{   
		wp_register_script( 'rmd-cf-jquery-min-js', $this->path_to . 'js/plugins/jquery.min.js', array(), null, true ); 
		wp_register_script( 'rmd-cf-jquery-validate-min-js', $this->path_to . 'js/plugins/jquery.validate.min.js', array('rmd-cf-jquery-min-js'), null, true ); 
		wp_register_script( 'rmd-cf-additional-methods-min-js', $this->path_to . 'js/plugins/additional-methods.min.js', array('rmd-cf-jquery-min-js', 'rmd-cf-jquery-validate-min-js'), null, true );   
		wp_register_script( 'rmd-cf-validator-script-js', $this->path_to . 'js/contact-form-validator-script.js', array('rmd-cf-jquery-min-js', 'rmd-cf-jquery-validate-min-js','rmd-cf-additional-methods-min-js'), null, true );   
	}  
 	

 	/**
	 *	This method will manage to enqueue the needed styles and scripts for the frontend.
	 */
	public function _wp_enqueue_scripts()
	{	  			
		 /* Enqueue styles */ 
        wp_enqueue_style('rmd-cf-style-css');      

        /* Enqueue scripts */
        wp_enqueue_script('rmd-cf-jquery-min-js'); 
        wp_enqueue_script('rmd-cf-jquery-validate-min-js');   
        wp_enqueue_script('rmd-cf-additional-methods-min-js');
        wp_enqueue_script('rmd-cf-validator-script-js'); 
        
	}

}  

$RMD_Assets_Handler = new RMD_Assets_Handler();

 