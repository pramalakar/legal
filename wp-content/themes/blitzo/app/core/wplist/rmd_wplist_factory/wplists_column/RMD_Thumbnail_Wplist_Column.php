<?php
namespace theme\rmd\core\wplist;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
class RMD_Thumbnail_Wplist_Column extends RMD_Wplist_Column 
{	  
	public function render()
	{	   
		extract($this->config);
		
		extract($args); 

		$data = get_the_post_thumbnail($post_id, 'my-extra-small-thumbnail');
		echo ( $data )? __( $content_wrapper_before.$data.$content_wrapper_after ) : '-'; 
	} 
}

