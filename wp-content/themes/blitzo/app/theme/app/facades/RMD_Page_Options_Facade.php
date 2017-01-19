<?php
namespace theme\rmd\theme\app\facades;

use theme\rmd\core\wppost as Wppost;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
class RMD_Page_Options_Facade
{      

	public function create_page_options()
	{   
		add_action('init', array($this, '_create_page_options'));
	}
 

	public function _create_page_options()
	{	
		global $wp_registered_sidebars;  

		$widget_sidebar_options = array();
		foreach ($wp_registered_sidebars as $key => $widget) {
			$widget_sidebar_options[$widget['id']] = $widget['name'];
		}


		$post_type = 'page';
		$wppost_type = 'metabox'; 
		$config = array(
				'id' => 'rmd_page_options_metabox_id',
		    	'header_title' => 'Page Options',  
			    'inputs' => array(   
			        array(
						'input_type'  => 'dropdown',
						'input_label' => 'Show Title',
						'input_name'  => 'rmd_page_option_show_title',
						'input_value' => 'yes',
						'input_option' => array(
							'yes' => 'Yes',
							'no' => 'No'
							),
						'input_class' => 'widefat',
						'input_description' => '', 
						'input_display' => 'inline'
					),
					array(
						'input_type'  => 'dropdown',
						'input_label' => 'Layout',
						'input_name'  => 'rmd_page_option_layout',
						'input_value' => 'sidebar_right',
						'input_option' => array( 
							'full_width' => 'Full Width',
							'sidebar_left' => 'Sidebar (Left)',
							'sidebar_right' => 'Sidebar (Right)',
							),
						'input_class' => 'widefat',
						'input_description' => '', 
						'input_display' => 'inline'
					),
					array(
						'input_type'  => 'dropdown',
						'input_label' => 'Widget Sidebar',
						'input_name'  => 'rmd_page_option_widget_sidebar',
						'input_value' => 'sidebar',
						'input_option' =>  $widget_sidebar_options,
						'input_class' => 'widefat',
						'input_description' => '', 
						'input_display' => 'inline',
						'input_description' => 'This is intended the for Sidebar (Left) and Sidebar (Right) layout.'
					) 
			     ),
			    'placement' => 'normal',       // optional [normal|advanced|side]
				'priority'  => 'high',         // optional [high|sorted|core|default|low] 
			 );
		Wppost\RMD_Wppost_Handler::render($wppost_type, $post_type, $config);

	}
		 
}  
  

 