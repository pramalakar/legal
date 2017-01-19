<?php
namespace theme\rmd\core\wplist;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
class RMD_Metabox_Wplist_Column extends RMD_Wplist_Column 
{	  
	public function render()
	{	   
		extract($this->config);
		
		extract($args); 

		$data = get_post_meta( $post_id, $field_name, true ); 

		$data = (isset($args['replacement_value'][$data]))? $args['replacement_value'][$data] : $data;
		  
		if($like_thumbnail == true) {
			if(!empty($data)) {
				echo $content_wrapper_before.'<img style="height: 50px; width: auto" src="'.$data.'" >'.$content_wrapper_after;
			} else {
				echo $content_wrapper_before.'-'.$content_wrapper_after;
			} 
		} else {
			echo ( $data )? __( $content_wrapper_before.$data.$content_wrapper_after ) : '-'; 
		} 
	} 
}

