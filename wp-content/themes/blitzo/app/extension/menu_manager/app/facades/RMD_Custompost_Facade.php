<?php
namespace theme\rmd\extension\menu_manager\app\facades;

use theme\rmd\core\wppost as Wppost;
use theme\rmd\core\adminpage as Adminpage;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RMD_Custompost_Facade
{     

    public function create_post($post_type)
	{	 
		$config = array(
				'post_label' =>  'Menu Manager', 
				'menu_icon' => 'dashicons-menu', 
				'supported_inputs' => array('title'), 
				'supported_taxonomies' => array(''), 
				'exclude_from_search' => TRUE,
				'post_arguments' => array(  
					'labels' => array( 
						'add_new_item' => 'Add Dropdown Widget',  
						'edit_item' => 'Edit Dropdown Widget',  
					),  
				),  
			);

		$wppost_type = 'custompost'; 
		Wppost\RMD_Wppost_Handler::render($wppost_type, $post_type, $config);

	}
 


	public function create_metabox($post_type)
	{ 
		$menu_name = 'primary';
		$locations = get_nav_menu_locations();
		$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
		$menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) ); 

		$nav_options = array();
		if($menuitems != FALSE) {
			if(is_array($menuitems)) {
				foreach ($menuitems as $key => $nav) { 
					if($nav->menu_item_parent != 0) {
						$title = (!empty($nav->post_title))? $nav->post_title : $nav->title;
						$nav_options[$nav->ID] = $title;
					}
				}
			}
		} else {
			$nav_options['none'] = 'No available menu';
		}

		$config = array(
					'id' => 'rmd_mm_metabox_description_id',
			    	'header_title' => 'Dropdown Widget Details',  
				    'inputs' => array(     
						array(
							'input_type'  => 'dropdown',
							'input_label' => 'Dropdown Menu',
							'input_name'  => 'rmd_mm_nav_menu_id',
							'input_value' => '',
							'input_class' => 'widefat',
							'input_display' => 'inline', 
							'input_option' => $nav_options
						), 
						array(
							'input_type'  => 'dropdown',
							'input_label' => 'No. of widget column(s)',
							'input_name'  => 'rmd_mm_num_col_widget',
							'input_value' => '',
							'input_class' => 'widefat',
							'input_display' => 'inline', 
							'input_option' => array(
										1 => 1,
										2 => 2,
										3 => 3,
										4 => 4
									)
						), 
				     ),
				    'placement' => 'normal',       // optional [normal|advanced|side]
					'priority'  => 'high',         // optional [high|sorted|core|default|low] 
				    'bottom_text' => '' //optional
			);

		$wppost_type = 'metabox';
		Wppost\RMD_Wppost_Handler::render($wppost_type, $post_type, $config);

	} 


	

		
}  

 
 