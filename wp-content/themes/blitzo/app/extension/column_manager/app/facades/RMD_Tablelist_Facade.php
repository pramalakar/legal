<?php
namespace theme\rmd\extension\column_manager\app\facades;

use theme\rmd\core\wplist as Wplist;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class RMD_Tablelist_Facade
{       
	public function create_child_page_identifier_column($post_type)
	{	    
		$config = array(
			'post_type' => $post_type,
			'args' => array(
				array(
					'data_type'   => 'metabox',
					'field_name'  => 'rmd_cm_metabox_child_page_identifier',
					'header_title' => 'Child Page Identifier',
					'position' => 2,
					'replacement_value' => array(
						'child_page' => 'As normal page',
						'child_section' => 'As section'
						)
					)
			)
		);
		
		$wplist_type = 'Addcolumn';
		Wplist\RMD_Wplist_Handler::render($wplist_type, $config);

	} 

}  

 