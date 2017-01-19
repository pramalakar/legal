<?php
namespace theme\rmd\core\wplist;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/** 
 * 	RMD_Headertitle_Wplist - this class will manage to customize the wp list column header title.
 */
/***
 *	HOW TO USE:

	$wplist_type = 'headertitle';

	$config = array(
		'post_type' => 'product',
		'args' => array(
			array(
				'field_name'  => 'title', 	// to get the field name of a column you can just refer to its ID hmtl attr.
				'header_title' => 'Name'	// the new column header title.
			)
		)
	);
	
	RMD_Wplist_Handler::render($wplist_type, $config);	
 *
 */ 
	
class RMD_Headertitle_Wplist extends RMD_Wplist 
{	 

	public function render()
	{	   
		extract($this->new_config);
		$this->change_header_title($post_type, $args);
	}

	private function change_header_title($post_type, $args)
	{
		if( ! is_array($args) ) return;

		foreach ($args as $key => $value) 
		{  
			$new_args = array_merge($this->default_args, $value);  
			$this->set_column($post_type, $new_args);
		} 

	}

}

