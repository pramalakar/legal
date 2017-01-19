<?php
namespace theme\rmd\core\wplist;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
} 

/**
 *	METABOX TITLE
 *
 *	Metabox title is usually used if you have a dropdown input field 
 *	that have a list of value of post title and input value of post id.
 *
 *	Whereas when it comes to table listing we can still display the post title 
 *	instead of the actual value which is the post id.
 *
 */
class RMD_Metaboxtitle_Wplist_Column extends RMD_Wplist_Column 
{	  
	public function render()
	{	   
		extract($this->config);
		
		extract($args);  
		
		$id = get_post_meta( $post_id, $field_name, true ); 
		$data = get_the_title($id);
		echo $content_wrapper_before.$data.$content_wrapper_after;
	} 
}

