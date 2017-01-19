<?php
namespace theme\rmd\extension\slider\app\facades;

use theme\rmd\core\wppost as Wppost;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class RMD_Custompost_Facade
{        
	
	public function create_post($post_type)
	{	  
		$config = array(
				'post_label' => 'Sliders',
				'title_placeholder' => 'Enter slider name here',
				'menu_icon' => 'dashicons-format-gallery', 
				'supported_inputs' => array('title'), 
				'supported_taxonomies' => array(''), 
				'exclude_from_search' => TRUE,
				'post_arguments' => array(  
					'labels' => array( 
						'add_new_item' => 'Add New Slider',  
						'edit_item' => 'Edit Slider',  
					), 
				),  
			);
		$wppost_type = 'custompost'; 
		Wppost\RMD_Wppost_Handler::render($wppost_type, $post_type, $config);

	}
 
 	
 	public function create_category($post_type, $taxonomy)
 	{  
 		$label = 'Slider';
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
						    'edit_item' => __( 'Edit '.$label.' '.$singular_label_taxonomy ), 
						    'update_item' => __( 'Update '.$label.' '.$singular_label_taxonomy ), 
						    'add_new_item' => __( 'Add New '.$label.' '.$singular_label_taxonomy ), 
						    'new_item_name' => __( 'New '.$label.' '.$singular_label_taxonomy.' Name' ), 
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


	public function create_metabox_image_detail($post_type)
	{ 
		$wppost_type = 'metabox'; 
		$config = array(
				'id' => 'rmd_slider_image_id',
		    	'header_title' => 'Image Detail',  
			    'inputs' => array(  
			    	array(
			            'input_type'  => 'mediauploader',
						'input_label' => 'Image',
						'input_name'  => 'rmd_slider_image',
						'input_media_caption' => array(
							'upload' => 'Upload Image',
							'remove' => 'Remove Image'
						),
						'input_media_modal_heading' => 'Insert Image',
						'input_media_modal_button' => 'Set Image',
						'input_display' => 'inline'
			        ) 
			     ),
			    'placement' => 'normal',       // optional [normal|advanced|side]
				'priority'  => 'high',         // optional [high|sorted|core|default|low] 
			    'bottom_text' => '' //optional
			);
		Wppost\RMD_Wppost_Handler::render($wppost_type, $post_type, $config);

	} 


	public function create_metabox_caption_details($post_type)
	{ 
		$wppost_type = 'metabox'; 
		$config = array(
				'id' => 'rmd_slider_caption',
		    	'header_title' => 'Caption Details',  
			    'inputs' => array( 
					array(
						'input_type'  => 'wpeditor',
						'input_label' => 'Caption Title',
						'input_name'  => 'rmd_slider_caption_title',
						'input_value' => '',
						'input_class' => 'widefat',
						'input_description' => '',
						'input_display' => 'inline',
						'input_wpeditor_height' => '60px',
						'input_wpeditor_settings'	=> array( 
								'media_buttons' => false,
								'tinymce' => array(
									'toolbar1' => 'bold, italic, link, unlink, forecolor, fontsizeselect',
									'toolbar2' => false
									),
							) 
					),
					array(
						'input_type'  => 'wpeditor',
						'input_label' => 'Caption Content',
						'input_name'  => 'rmd_slider_caption_content',
						'input_value' => '',
						'input_class' => 'widefat',
						'input_description' => '',
						'input_display' => 'inline',
						'input_wpeditor_settings'	=> array( 
								'media_buttons' => false,
								'tinymce' => array(
									'toolbar1' => 'bold, italic, link, unlink, forecolor, fontsizeselect',
									'toolbar2' => false
									),
							) 
					), 		 
					array(
						'input_type'  => 'dropdown',
						'input_label' => 'Caption Alignment',
						'input_name'  => 'rmd_slider_caption_alignment',
						'input_value' => '',
						'input_option' => array(
							'left' => 'Left',
							'center' => 'Center',
							'right' => 'Right', 
						),
						'input_class' => 'widefat',
						'input_display' => 'inline'
					)
			     ),
			    'placement' => 'normal',       // optional [normal|advanced|side]
				'priority'  => 'high',         // optional [high|sorted|core|default|low] 
			    'bottom_text' => '' //optional
			);
		Wppost\RMD_Wppost_Handler::render($wppost_type, $post_type, $config);

	} 


	public function create_metabox_button_details($post_type)
	{ 
		$wppost_type = 'metabox'; 
		$config = array(
				'id' => 'rmd_slider_button',
		    	'header_title' => 'Button Details',  
			    'inputs' => array(  
					array(
						'input_type'  => 'text',
						'input_label' => 'Label',
						'input_name'  => 'rmd_slider_button_label',
						'input_value' => '',
						'input_class' => 'widefat',  
						'input_description' => '',
						'input_display' => 'inline'
					),
					array(
						'input_type'  => 'text',
						'input_label' => 'Link',
						'input_name'  => 'rmd_slider_button_link',
						'input_value' => '',
						'input_class' => 'widefat',  
						'input_description' => '',
						'input_display' => 'inline'
					),					 
			     ),
			    'placement' => 'normal',       // optional [normal|advanced|side]
				'priority'  => 'high',         // optional [high|sorted|core|default|low] 
			    'bottom_text' => '<em>Note: If the button label and link are not provided the button will not be displayed.</em>' //optional
			);
		Wppost\RMD_Wppost_Handler::render($wppost_type, $post_type, $config);

	} 

}  

 