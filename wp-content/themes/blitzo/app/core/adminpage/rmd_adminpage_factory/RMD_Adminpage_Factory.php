<?php
namespace theme\rmd\core\adminpage;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/** 
 *	RMD_Adminpage_Factory - the factory class for creating a admin pages.
 */ 
 
class RMD_Adminpage_Factory
{
	protected $base_class = 'RMD_Adminpage'; 
	protected $adminpage_type = '';
	protected $prefix = 'RMD_';
	protected $suffix = '_Adminpage';

	public function create_adminpage($adminpage_type, $config)
	{ 	 
		$this->adminpage_type = ucwords( $adminpage_type );

		require_once(dirname(__FILE__).'/adminpages/RMD_Adminpage.php');
		
		$filename = $this->prefix.$this->adminpage_type.$this->suffix;
		require_once(dirname(__FILE__).'/adminpages/'.$filename.'.php');

		$target_class = "\\theme\\rmd\\core\\adminpage\\$filename";
		if( class_exists($target_class) ) { 
			return new $target_class($config);
		} 
		return false;
	}

}

