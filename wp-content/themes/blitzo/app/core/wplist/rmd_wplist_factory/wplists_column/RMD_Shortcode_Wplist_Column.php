<?php
namespace theme\rmd\core\wplist;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
class RMD_Shortcode_Wplist_Column extends RMD_Wplist_Column 
{	  
	public function render()
	{	   
		extract($this->config);
		
		$post_title = get_the_title( $post_id );

		$content_wrapper_before = '<code>['.$post_type.' title="'.$post_title.'" post_id="';
		$content_wrapper_after  = '"]</code>';
 
		echo ( $post_id )? __( $content_wrapper_before.$post_id.$content_wrapper_after ) : '-'; 
	} 
}

