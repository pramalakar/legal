<?php
namespace theme\rmd\core\wplist;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/** 
 *	RMD_Wplist_Factory - the factory class for customizing the wp list.
 */ 

 
class RMD_Wplist_Factory
{
	protected $base_class = 'RMD_Wplist'; 
	protected $wplist_type = '';
	protected $prefix = 'RMD_';
	protected $suffix = '_Wplist';

	public function customize_wplist($wplist_type, $config)
	{ 	 
		$this->wplist_type = ucwords( $wplist_type );

		require_once(dirname(__FILE__).'/wplists/RMD_Wplist.php');
		
		$filename = $this->prefix.$this->wplist_type.$this->suffix;
		require_once(dirname(__FILE__).'/wplists/'.$filename.'.php');

		$target_class = "\\theme\\rmd\\core\\wplist\\$filename";
		if( class_exists($target_class) ) {
			return new $target_class($config);
		} 
		return false;
	}

}

