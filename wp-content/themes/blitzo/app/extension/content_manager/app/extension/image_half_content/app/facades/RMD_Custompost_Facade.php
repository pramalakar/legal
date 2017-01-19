<?php
namespace theme\rmd\extension\content_manager\app\extension\image_half_content\app\facades;

use theme\rmd\extension\content_manager\app as Base;
use theme\rmd\core\wppost as Wppost;
use theme\rmd\core\adminpage as Adminpage;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class RMD_Custompost_Facade extends Base\RMD_Base_Content_Manager
{         

	public function create_metabox_content_details($post_type)
	{ 
		$wppost_type = 'metabox'; 
		$config = array(
					'id' => 'rmd_cm_image_half_content_details',
			    	'header_title' => 'Content Details',  
				    'inputs' => array(    
						array(
							'input_type'  => 'mediauploader',
							'input_label' => 'Image',
							'input_name'  => 'rmd_cm_image_half_content_image',
							'input_value' => '',
							'input_class' => 'widefat',
							'input_description' => '',
							'input_display' => 'inline'
						),    
						array(
							'input_type'  => 'wpeditor',
							'input_label' => 'Content',
							'input_name'  => 'rmd_cm_image_half_content_content',
							'input_value' => '', 
							'input_class' => 'widefat', 
							'input_display' => 'inline', 
						),  
										 
				     ),
				    'placement' => 'normal',       // optional [normal|advanced|side]
					'priority'  => 'high',         // optional [high|sorted|core|default|low] 
				    'bottom_text' => '' //optional
			);
		Wppost\RMD_Wppost_Handler::render($wppost_type, $post_type, $config);

	} 


	public function create_metabox_content_setting($post_type)
	{ 
		$wppost_type = 'metabox'; 
		$config = array(
					'id' => 'rmd_cm_image_half_content_setting',
			    	'header_title' => 'Content Setting',  
				    'inputs' => array(    
						array(
							'input_type'  => 'dropdown',
							'input_label' => 'Image Alignment',
							'input_name'  => 'rmd_cm_image_half_content_image_alignment',
							'input_value' => '',
							'input_option' => array(
								'align-image-left' => 'Left',
								'align-image-right' => 'Right'
								),
							'input_class' => 'widefat',
							'input_display' => ''
						),  
						array(
							'input_type'  => 'color',
							'input_label' => 'Content Background Color',
							'input_name'  => 'rmd_cm_image_half_content_content_bgcolor',
							'input_value' => '',
							'input_class' => 'widefat',
							'input_description' => '',
							'input_display' => ''
						),
										 
				     ),
				    'placement' => 'side',       // optional [normal|advanced|side]
					'priority'  => 'default',         // optional [high|sorted|core|default|low] 
				    'bottom_text' => '' //optional
			);
		Wppost\RMD_Wppost_Handler::render($wppost_type, $post_type, $config);

	} 

		
}  

 
 