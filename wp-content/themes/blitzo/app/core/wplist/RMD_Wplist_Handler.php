<?php 
namespace theme\rmd\core\wplist;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/** 
 *	RMD_Wplist_Handler - this class is use to manage to customize the wp list.
 *	
 *	// https://codex.wordpress.org/Plugin_API/Action_Reference/manage_posts_custom_column
 */
 
class RMD_Wplist_Handler
{	 
	public static function render($wplist_type, $config)
	{
		require_once(dirname(__FILE__).'/rmd_wplist_factory/RMD_Wplist_Factory.php');
		require_once(dirname(__FILE__).'/rmd_wplist_factory/RMD_Wplist_Column_Factory.php');

		$factory = new RMD_Wplist_Factory(); 
		$customized_wplist = $factory->customize_wplist($wplist_type, $config); 
		if( $customized_wplist !== false ) {
			return $customized_wplist->render();
		}
	}
}