<?php
namespace theme\rmd\core\wppost;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/** 
 *	RMD_Wppost_Factory - the factory class for generating custom wp post.
 */
  
 
class RMD_Wppost_Factory
{
	protected $base_class = 'RMD_Wppost'; 
	protected $wppost_type = '';
	protected $prefix = 'RMD_';
	protected $suffix = '_Wppost';

	public function create_wppost($wppost_type, $post_type, $config)
	{ 	 
		$this->wppost_type = ucwords( $wppost_type );

		require_once(dirname(__FILE__).'/wpposts/RMD_Wppost.php');
		
		$filename = $this->prefix.$this->wppost_type.$this->suffix;
		require_once(dirname(__FILE__).'/wpposts/'.$filename.'.php');

		$target_class = "\\theme\\rmd\\core\\wppost\\$filename";
		if( class_exists($target_class) ) {
			return new $target_class($post_type, $config);
		} 
		return false;
	}

}
 