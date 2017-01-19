<?php
namespace theme\rmd\core\wplist;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/** 
 *	RMD_Wplist_Factory - the factory class for customizing the wp list.
 */ 

 
class RMD_Wplist_Column_Factory
{
	protected static $base_class = 'RMD_Wplist_Column'; 
	protected static $wplist_column_type = '';
	protected static $prefix = 'RMD_';
	protected static $suffix = '_Wplist_Column';

	public static function customize_wplist_column($wplist_column_type, $config)
	{ 	 
		self::$wplist_column_type = ucwords( $wplist_column_type );

		require_once(dirname(__FILE__).'/wplists_column/RMD_Wplist_Column.php');
		
		$filename = self::$prefix.self::$wplist_column_type.self::$suffix;
		require_once(dirname(__FILE__).'/wplists_column/'.$filename.'.php');

		$target_class = "\\theme\\rmd\\core\\wplist\\$filename";
 
		if( class_exists($target_class) ) { 
			return new $target_class($config);
		}  
		return false;
	}

}

