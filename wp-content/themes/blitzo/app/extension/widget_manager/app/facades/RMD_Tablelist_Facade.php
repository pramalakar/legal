<?php
namespace theme\rmd\extension\widget_manager\app\facades;

use theme\rmd\core\wplist as Wplist;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RMD_Tablelist_Facade
{     
	protected $post_type = '';

	public function create_description_column($post_type)
	{ 
		$this->post_type = $post_type;		

		$config = array(
			'post_type' => $post_type,
			'args' => array(
				array(
					'data_type'   => 'metabox',
					'field_name'  => 'rmd_wm_description',
					'header_title' => 'Description', 
					'position' => 2,  
					) 
			)
		);
		
		$wplist_type = 'Addcolumn';
		Wplist\RMD_Wplist_Handler::render($wplist_type, $config);

	} 

}  
 
 