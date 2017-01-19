<?php
namespace theme\rmd\core\wplist;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
class RMD_The_excerpt_Wplist_Column extends RMD_Wplist_Column 
{	  
	public function render()
	{	   
		extract($this->config);
		
		extract($args); 

		$data = get_the_excerpt();
		echo $content_wrapper_before.$data.$content_wrapper_after;
	} 
}

