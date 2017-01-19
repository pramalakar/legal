<?php
namespace theme\rmd\extension\testimonial\app;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
  
class RMD_Factory_Loader
{    
	public static function load_factory($directory = null)
	{ 	 
		if(empty($directory)) return null; 

		require_once(dirname(__FILE__).'/factories/'.$directory.'/RMD_Handler.php');

		$target_class = "\\theme\\rmd\\extension\\testimonial\\app\\factories\\$directory\\RMD_Handler"; 

		if( class_exists($target_class) ) {  
			return new $target_class(); 
		} 
		return null;
	}

}

