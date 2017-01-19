<?php
namespace theme\rmd\extension\slider\app\facades;

use theme\rmd\core\wplist as Wplist;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
class RMD_Tablelist_Facade
{     
	
	public function manage_title_column($post_type)
	{	 
		$wplist_type = 'headertitle';

		$config = array(
			'post_type' => $post_type,
			'args' => array(
				array(
					'field_name'  => 'title', 	// to get the field name of a column you can just refer to its ID hmtl attr.
					'header_title' => 'Slider Name'	// the new column header title.
				)
			)
		);
		
		Wplist\RMD_Wplist_Handler::render($wplist_type, $config);	
	} 


	public function create_image_column($post_type)
	{	 
		$wplist_type = 'addcolumn';

		$config = array(
			'post_type' => $post_type,
			'args' => array(
				array( 
					'data_type'   => 'metabox',
					'field_name'  => 'rmd_slider_image',
					'header_title' => 'Image',
					'position' => 2,
					'like_thumbnail' => TRUE
				)
			)
		);
		
		Wplist\RMD_Wplist_Handler::render($wplist_type, $config);	
	} 

}   

 