<?php
namespace theme\rmd\core\wplist;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/** 
 * 	RMD_Addcolumn_Wplist - this class will manage to customize the wp list column header title.
 */
/***
 *	HOW TO USE:

	$wplist_type = 'Addcolumn';

	$config = array(
		'post_type' => 'rmd_testimonial',
		'args' => array(
			array(
				'data_type'   => 'metabox',
				'field_name'  => 'rmd_testimonial_photo',
				'header_title' => 'Photo',
				'position' => 2,
				'like_thumbnail' => TRUE
				),
			array(
				'data_type'   => 'metabox',
				'field_name'  => 'rmd_testimonial_content',
				'header_title' => 'Content',
				'position' => 3, 
				), 
		)
	);
	
	\RMD_Wplist_Handler::render($wplist_type, $config);
 *
 */ 
 
class RMD_Addcolumn_Wplist extends RMD_Wplist 
{	 
		public $column_counter = 0;

	public function render()
	{	   
		extract($this->new_config);
		$this->add_new_column($post_type, $args);
	} 


	private function add_new_column($post_type, $args)
	{
		if( ! is_array($args) ) return;

		foreach ($args as $key => $value) 
		{  
			$new_args = array_merge($this->default_args, $value); 

			$this->set_column($post_type, $new_args);
			$this->set_position($post_type, $new_args);
			$this->set_content($post_type, $new_args);  

		} 

	}
  
}

