<?php
namespace theme\rmd\extension\widget_manager\app\facades;

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
				'post_label' =>  'Widget Manager', 
				'menu_icon' => 'dashicons-archive', 
				'supported_inputs' => array('title'), 
				'supported_taxonomies' => array(''), 
				'exclude_from_search' => TRUE,
				'post_arguments' => array(  
					'labels' => array( 
						'add_new_item' => 'Add New Widget',  
						'edit_item' => 'Edit Widget',  
					),  
				),  
			);

		$wppost_type = 'custompost'; 
		Wppost\RMD_Wppost_Handler::render($wppost_type, $post_type, $config);

	}
 


	public function create_metabox($post_type)
	{ 
		$config = array(
					'id' => 'rmd_wm_metabox_description_id',
			    	'header_title' => 'Description',  
				    'inputs' => array(    
						array(
							'input_type'  => 'textarea',
							'input_label' => '',
							'input_name'  => 'rmd_wm_description',
							'input_value' => '',
							'input_class' => 'widefat',
							'input_description' => '', 
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

 
 