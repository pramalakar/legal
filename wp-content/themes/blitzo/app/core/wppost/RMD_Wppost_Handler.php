<?php 
namespace theme\rmd\core\wppost;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/** 
 * RMD_Wppost_Handler - this class is use to generate a specific custom wp post , like custom post, metaboxes and taxonomies.
 */
 
 
class RMD_Wppost_Handler
{	 
	/**
	 *	[ render - this method will manage to call the wppost factory that will load a specific wppost file for intended functionality ]
	 *
	 *	@param 	[string] 	[ $wppost_type - the type for a particular feature like 'custompost', 'metabox' and 'taxonomy' ]
	 *	@param 	[string]	[ $post_type - wp post type ]
	 * 	@param 	[array]		[ $config - a sort of setting for your wp post ]
	 * 	@return [void]		[ Return void because in wp post actually print it out using its own functions ]
	 */
	public static function render($wppost_type = '', $post_type = '', array $config = array())
	{
		if( empty($wppost_type) || empty($config) ) return;

		require_once(dirname(__FILE__).'/rmd_wppost_factory/RMD_Wppost_Factory.php');

		$factory = new RMD_Wppost_Factory(); 
		$created_wppost = $factory->create_wppost($wppost_type, $post_type, $config); 
		if( $created_wppost !== false ) {
			$created_wppost->render();
		}
	}
}
 