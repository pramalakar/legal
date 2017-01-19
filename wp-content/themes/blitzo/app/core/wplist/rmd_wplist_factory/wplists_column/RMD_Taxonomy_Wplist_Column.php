<?php
namespace theme\rmd\core\wplist;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
class RMD_Taxonomy_Wplist_Column extends RMD_Wplist_Column 
{	  
	public function render()
	{	   
		extract($this->config);
		
		extract($args); 

		$categories_obj = get_the_terms($post_id, $field_name); 
		if($categories_obj){
			if(is_array($categories_obj)) {
				foreach ($categories_obj as $key => $value) {
					$data = $value->name; 
					echo ( $data )? __( $content_wrapper_before.$data.$content_wrapper_after ) : '-'; 
				}
			} 
		} else {
			echo '---';
		}
	} 
}

