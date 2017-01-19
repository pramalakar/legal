<?php
namespace theme\rmd\extension\testimonial\app\facades;

use theme\rmd\core\wplist as Wplist;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RMD_Tablelist_Facade 
{     


	public function create_content_column($post_type)
	{ 
		$wplist_type = 'Addcolumn';

		$config = array(
			'post_type' => $post_type,
			'args' => array( 
				array(
					'data_type'   => 'metabox',
					'field_name'  => 'rmd_testimonial_content',
					'header_title' => 'Content',
					'position' => 3, 
					)
			)
		);
		
		Wplist\RMD_Wplist_Handler::render($wplist_type, $config);

	}


	public function create_image_column($post_type)
	{ 
		$wplist_type = 'Addcolumn';

		$config = array(
			'post_type' => $post_type,
			'args' => array(
				array(
					'data_type'   => 'metabox',
					'field_name'  => 'rmd_testimonial_image',
					'header_title' => 'Image',
					'position' => 2, 
					'like_thumbnail' => TRUE
					) 
			)
		);
		
		Wplist\RMD_Wplist_Handler::render($wplist_type, $config);

	}

}  
 
 