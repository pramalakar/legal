<?php
namespace theme\rmd\extension\testimonial\app\facades;

use theme\rmd\core\wppost as Wppost;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

 
class RMD_Custompost_Facade 
{         
	
	public function create_post($post_type)
	{	  
		$config = array(
				'post_label' => 'Testimonials', 
				'menu_icon' => 'dashicons-admin-comments', 
				'supported_inputs' => array('title'), 
				'supported_taxonomies' => array(''), 
				'exclude_from_search' => TRUE,
				'post_arguments' => array(  
					'labels' => array( 
						'add_new_item' => 'Add New Testimonial',  
						'edit_item' => 'Edit Testimonial',  
					), 
				),   
			);
		$wppost_type = 'custompost'; 
		Wppost\RMD_Wppost_Handler::render($wppost_type, $post_type, $config);

	}


	public function create_metabox_testimonial_details($post_type)
	{ 
		
		$config = array(
					'id' => 'rmd_testimonial_details_metabox_id',
			    	'header_title' => 'Testimonial Details',  
				    'inputs' => array( 
				    	array(
					        'input_type'  => 'mediauploader',
							'input_label' => 'Image',
							'input_name'  => 'rmd_testimonial_image',
							'input_media_caption' => array(
								'upload' => 'Upload Image',
								'remove' => 'Remove Image'
							),
							'input_media_modal_heading' => 'Insert Image',
							'input_media_modal_button' => 'Set Image',
							'input_description' => '',
							'input_display' => 'inline', 
					    ),
					    array(
							'input_type'  => 'text',
							'input_label' => 'Name',
							'input_name'  => 'rmd_testimonial_name',
							'input_value' => '',
							'input_class' => 'widefat',
							'input_description' => '', 
							'input_display' => 'inline', 
						),
					    array(
							'input_type'  => 'text',
							'input_label' => 'Designation',
							'input_name'  => 'rmd_testimonial_designation',
							'input_value' => '',
							'input_class' => 'widefat',
							'input_description' => '', 
							'input_display' => 'inline', 
						), 
						array(
							'input_type'  => 'wpeditor',
							'input_label' => 'Content',
							'input_name'  => 'rmd_testimonial_content',
							'input_value' => '',
							'input_class' => 'widefat',
							'input_description' => '',
							'input_display' => 'inline', 
							'input_wpeditor_settings'	=> array( 
									'media_buttons' => false,
									'tinymce' => array(
										'toolbar1' => 'bold, italic, alignleft, aligncenter, alignright, alignjustify, hr, link, unlink, forecolor, fontsizeselect',
										'toolbar2' => false
										),
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

 
 