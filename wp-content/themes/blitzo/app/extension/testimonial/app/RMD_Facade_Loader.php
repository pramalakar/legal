<?php
namespace theme\rmd\extension\testimonial\app;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
  
class RMD_Facade_Loader
{  
	protected static $app_type = '';
	protected static $prefix = 'RMD_';
	protected static $suffix = '_Facade';

	public static function load_facade($app_type = null)
	{ 	 
		if(empty($app_type)) return null;

		self::$app_type = $app_type;

		$filename = self::$prefix.self::$app_type.self::$suffix;
		require_once(dirname(__FILE__).'/facades/'.$filename.'.php');

		$target_class = "\\theme\\rmd\\extension\\testimonial\\app\\facades\\$filename"; 

		if( class_exists($target_class) ) { 
			return new $target_class(); 
		} 
		return null;
	}

}

