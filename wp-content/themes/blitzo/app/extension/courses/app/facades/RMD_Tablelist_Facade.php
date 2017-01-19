<?php
namespace theme\rmd\extension\courses\app\facades;

use theme\rmd\core\wplist as Wplist;
use theme\rmd\core\wpquery as Wpquery;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class RMD_Tablelist_Facade
{       

	public function create_courses_outline_courses_column($post_type)
	{	  
		$config = array(
			'post_type' => $post_type,
			'args' => array(
				array( 
					'data_type'   => 'metaboxtitle',
					'field_name'  => 'rmd_courses_category',
					'header_title' => 'Course',
					'position' => 2,
				), 
			)
		); 
		
		$wplist_type = 'addcolumn';
		Wplist\RMD_Wplist_Handler::render($wplist_type, $config);	
	}  
  	 

}  

 