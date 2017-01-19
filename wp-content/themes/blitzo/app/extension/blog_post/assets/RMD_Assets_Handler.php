<?php
namespace theme\rmd\extension\blog_post\assets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
} 

class RMD_Assets_Handler
{  
	protected $path_to = '';

	public function __construct()
	{    
		$this->path_to = get_stylesheet_directory_uri().'/app/extension/blog_post/assets/';  
		add_action('init',  array($this, 'register_all_styles') );  

		add_action('wp_enqueue_scripts', array($this, '_wp_enqueue_scripts') );
 
	}  


	public function register_all_styles()
	{   
		wp_register_style( 'rmd-blog-post-style-css', $this->path_to . 'css/blog-post-style.css');  
	} 


	public function _wp_enqueue_scripts()
	{
		wp_enqueue_style('rmd-blog-post-style-css'); 
	}

}   
  
$RMD_Assets_Handler = new RMD_Assets_Handler();