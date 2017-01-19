<?php
namespace theme\rmd\extension\gallery\app\facades;

use theme\rmd\core\wplist as Wplist;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class RMD_Tablelist_Facade
{      
	protected $post_type = '';

	public function create_image_column($post_type)
	{	 
		$this->post_type = $post_type;
 
		$config = array(
			'post_type' => $post_type,
			'args' => array(
				array( 
					'data_type'   => 'metabox',
					'field_name'  => 'rmd_gallery_image',
					'header_title' => 'Image',
					'position' => 2,
					'like_thumbnail' => TRUE
				), 
			)
		); 
		
		$wplist_type = 'addcolumn';
		Wplist\RMD_Wplist_Handler::render($wplist_type, $config);	
	} 

}  

 