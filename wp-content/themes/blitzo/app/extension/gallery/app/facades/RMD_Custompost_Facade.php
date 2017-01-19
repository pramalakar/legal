<?php
namespace theme\rmd\extension\gallery\app\facades;

use theme\rmd\core\wppost as Wppost;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class RMD_Custompost_Facade
{        
	
	public function create_category($post_type, $taxonomy)
 	{   
 		$label = 'Gallery';
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


	public function create_post($post_type)
	{	 
		$config = array(
				'post_label' => 'Gallery', 
				'menu_icon' => 'dashicons-format-gallery', 
				'supported_inputs' => array('title'), 
				'supported_taxonomies' => array(''), 
				'exclude_from_search' => TRUE,
				'post_arguments' => array(  
					'labels' => array( 
						'add_new_item' => 'Add New Gallery',  
						'edit_item' => 'Edit Gallery',  
					), 
				),  
			);
		$wppost_type = 'custompost'; 
		Wppost\RMD_Wppost_Handler::render($wppost_type, $post_type, $config);

	}


	public function create_metabox_gallery_details($post_type)
	{  
		$wppost_type = 'metabox'; 
		$config = array(
				'id' => 'rmd_gallery_id',
		    	'header_title' => 'Gallery Details',  
			    'inputs' => array(  
			    	array(
			            'input_type'  => 'mediauploader',
						'input_label' => 'Image',
						'input_name'  => 'rmd_gallery_image',
						'input_media_caption' => array(
							'upload' => 'Upload Image',
							'remove' => 'Remove Image'
						),
						'input_media_modal_heading' => 'Insert Image',
						'input_media_modal_button' => 'Set Image',
						'input_display' => 'inline'
			        ),
			        array(
						'input_type'  => 'text',
						'input_label' => 'Caption Title',
						'input_name'  => 'rmd_gallery_caption',
						'input_value' => '',
						'input_class' => 'widefat',  
						'input_description' => '',
						'input_display' => 'inline'
					),
					array(
						'input_type'  => 'wpeditor',
						'input_label' => 'Caption Description',
						'input_name'  => 'rmd_gallery_description',
						'input_value' => '',
						'input_class' => 'widefat',  
						'input_description' => '',
						'input_display' => 'inline'
					),
					array(
						'input_type'  => 'text',
						'input_label' => 'Link',
						'input_name'  => 'rmd_gallery_link',
						'input_value' => '',
						'input_class' => 'widefat',  
						'input_description' => '',
						'input_display' => 'inline'
					),	
					array(
						'input_type'  => 'dropdown',
						'input_label' => 'Open New Tab',
						'input_name'  => 'rmd_gallery_link_target',
						'input_value' => '',
						'input_class' => 'widefat', 
						'input_option' => array(
							'no' => 'No',
							'yes' => 'Yes'
							), 
						'input_description' => '',
						'input_display' => 'inline'
					),	
			     ),
			    'placement' => 'normal',       // optional [normal|advanced|side]
				'priority'  => 'high',         // optional [high|sorted|core|default|low] 
			    'bottom_text' => '' //optional
			);
		Wppost\RMD_Wppost_Handler::render($wppost_type, $post_type, $config);

	} 

}  

 