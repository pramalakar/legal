<?php
namespace theme\rmd\extension\career\app\facades;

use theme\rmd\core\wppost as Wppost;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class RMD_Custompost_Facade
{        
	
	public function create_post($post_type)
	{	  
		$config = array(
				'post_label' => 'career', 
				'menu_icon' => 'dashicons-businessman',  
				'supported_taxonomies' => array(''), 
				'post_arguments' => array(  
					'labels' => array( 
						'add_new_item' => 'Add New Career',  
						'edit_item' => 'Edit Career',  
					), 
				),  
			);
		$wppost_type = 'custompost'; 
		Wppost\RMD_Wppost_Handler::render($wppost_type, $post_type, $config);

	}
 
 	
 	public function create_category($post_type, $taxonomy)
 	{  
 		$label = 'Career';
 		$plural_label_taxonomy = 'Categories';
 		$singular_label_taxonomy = 'Category';

		$config = array(
				'taxonomy'  	=> $taxonomy, 
				'args' 			=> array(
					'labels' => array( 
						    'name' => _x( $label.' '.$plural_label_taxonomy, 'taxonomy general name' ), 
						    'singular_name' => _x( $label.' '.$singular_label_taxonomy, 'taxonomy singular name' ), 
						    'search_items' =>  __( 'Search '.$label.' '.$plural_label_taxonomy ), 
						    'all_items' => __( 'All '.$label.' '.$plural_label_taxonomy ), 
						    'parent_item' => __( 'Parent '.$label.' '.$plural_label_taxonomy ), 
						    'parent_item_colon' => __( 'Parent '.$label.' '.$plural_label_taxonomy.':' ), 
						    'edit_item' => __( 'Edit '.$label.' '.$plural_label_taxonomy ), 
						    'update_item' => __( 'Update '.$label.' '.$plural_label_taxonomy ), 
						    'add_new_item' => __( 'Add New '.$label.' '.$plural_label_taxonomy ), 
						    'new_item_name' => __( 'New '.$label.' '.$plural_label_taxonomy.' Name' ), 
						    'menu_name' => __( $plural_label_taxonomy ), 
						  )
					),
				'like_category' => TRUE,
				'placement' 	=> 'side',       // optional [normal|advanced|side]
				'priority'  	=> 'core',       // optional [high|sorted|core|default|low] 
			);
		$wppost_type = 'taxonomy'; 
		Wppost\RMD_Wppost_Handler::render($wppost_type, $post_type, $config);
 	}
 

}  

 