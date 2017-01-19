<?php
namespace theme\rmd\core\wplist;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
class RMD_The_id_Wplist_Column extends RMD_Wplist_Column 
{	  
	public function render()
	{	   
		extract($this->config);
		
		extract($args);   
		
		echo ( $post_id )? __( $content_wrapper_before.$post_id.$content_wrapper_after ) : '-'; 
	} 
}

