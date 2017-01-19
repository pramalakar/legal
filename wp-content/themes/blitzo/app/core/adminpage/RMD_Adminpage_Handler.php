<?php 
namespace theme\rmd\core\adminpage;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/** 
 *	RMD_Adminpage_Handler - this class is use to generate a specific admin page based on its admin page type.
 */
/**
 *	Position #
 *	2 - Dashboard
 *	4 - Separator
 *	5 - Posts
 *	10 - Media
 *	15 - Links
 *	20 - Pages
 *	25 - Comments
 *	59 - Separator
 *	60 - Appearnace
 *	65 - Plugins
 *	70 - Users
 *	75 - Tools
 *	80 - Settings
 *	99 - Separator
 *
 */ 
class RMD_Adminpage_Handler
{	  
	public static function render($adminpage_type = '', array $config = array())
	{ 
		if( empty($adminpage_type) || empty($config) ) return;
		
		require_once(dirname(__FILE__).'/rmd_adminpage_factory/RMD_Adminpage_Factory.php');
		
		$factory = new RMD_Adminpage_Factory(); 
		$created_adminpage = $factory->create_adminpage($adminpage_type, $config); 
		if( $created_adminpage !== false ) {
			$created_adminpage->render();
		}
	}
}