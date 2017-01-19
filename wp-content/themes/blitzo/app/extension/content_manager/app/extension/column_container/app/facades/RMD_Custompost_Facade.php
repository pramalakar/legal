<?php
namespace theme\rmd\extension\content_manager\app\extension\column_container\app\facades;

use theme\rmd\extension\content_manager\app as Base;
use theme\rmd\core\wppost as Wppost;
use theme\rmd\core\adminpage as Adminpage;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class RMD_Custompost_Facade extends Base\RMD_Base_Content_Manager
{         

	public function create_metabox_column_type($post_type)
	{ 
		$options = array(
			'1col' => '1 Column',
			'2col' => '2 Columns',
			'3col' => '3 Columns',
			'4col' => '4 Columns',
			'123col' => '1/3 - 2/3 Columns',
			'213col' => '2/3 - 1/3 Columns',
			'134col' => '1/4 - 3/4 Columns',
			'314col' => '3/4 - 1/4 Columns'
			);

		$wppost_type = 'metabox'; 
		$config = array(
					'id' => 'rmd_cc_metabox_column_type_id', 
			    	'header_title' => 'Column Type',  
				    'inputs' => array( 
						array(
							'input_type'  => 'dropdown',
							'input_label' => '',
							'input_name'  => 'rmd_cc_metabox_column_type',
							'input_value' => '',
							'input_option' => $options,
							'input_class' => 'widefat',
							'input_description' => '', 
						), 
				     ),
				    'placement' => 'side',       // optional [normal|advanced|side]
					'priority'  => 'high',         // optional [high|sorted|core|default|low] 
				    'bottom_text' => '' //optional
			);
		Wppost\RMD_Wppost_Handler::render($wppost_type, $post_type, $config);

	}
 
  

	public function create_metabox_column_container_style($post_type, $idnum)
	{ 
		$bgcolor_opacity_options = array( 1 => '-');
		for ($i=1; $i <= 9 ; $i++) { 
			$bgcolor_opacity_options['0.'.$i] = '0.'.$i;
		}
  
		$wppost_type = 'metabox'; 
		$config = array(
					'id' => 'rmd_cc_metabox_column_'.$idnum.'_container_style',
			    	'header_title' => 'Column Content '.$idnum.' - Container Style',  
				    'inputs' => array(   
						array(
							'input_type'  => 'mediauploader',
							'input_label' => 'Background Image',
							'input_name'  => 'rmd_cc_metabox_column_'.$idnum.'_background_image',
							'input_value' => '',
							'input_class' => 'widefat',
							'input_description' => 'If you have background color, make it sure that it is transparent.',
							'input_display' => 'inline', 
						),
						array(
							'input_type'  => 'color',
							'input_label' => 'Background Color',
							'input_name'  => 'rmd_cc_metabox_column_'.$idnum.'_background_color',
							'input_value' => '',
							'input_class' => 'widefat',
							'input_description' => '',
							'input_display' => 'inline', 
						),
						array(
							'input_type'  => 'dropdown',
							'input_label' => 'Background Color Transparency',
							'input_name'  => 'rmd_cc_metabox_column_'.$idnum.'_background_color_opacity',
							'input_value' => '',
							'input_option' => $bgcolor_opacity_options,
							'input_class' => 'widefat',
							'input_description' => 'Lighter (0.1) to Solid (0.9)',
							'input_display' => 'inline', 
							'input_width' => '103px'
						),  	 
				     ),
				    'placement' => 'normal',       // optional [normal|advanced|side]
					'priority'  => 'high',         // optional [high|sorted|core|default|low] 
				    'bottom_text' => '' //optional
			);
		Wppost\RMD_Wppost_Handler::render($wppost_type, $post_type, $config);

	} 
 

	public function create_metabox_wrapper_style($post_type)
	{ 

		$bgcolor_opacity_options = array( 1 => '-');
		for ($i=1; $i <= 9 ; $i++) { 
			$bgcolor_opacity_options['0.'.$i] = '0.'.$i;
		}

		$bgpadding_options = array();
		for ($i=0; $i <= 100 ; $i+=5) { 
			$bgpadding_options[$i.'px'] = $i.'px';
		}
 

		$wppost_type = 'metabox'; 
		$config = array(
					'id' => 'rmd_cc_metabox_wrapper_style_id',
			    	'header_title' => 'Wrapper Style',  
				    'inputs' => array(  
				    	array(
							'input_type'  => 'dropdown',
							'input_label' => 'Background image and color position',
							'input_name'  => 'rmd_cc_metabox_wrapper_bgpos',
							'input_value' => '',
							'input_option' => array(
								'bgpos-image-color' => 'Image (Back) - Color (Front)',
								'bgpos-color-image' => 'Color (Back) - Image (Front)'
								),
							'input_class' => 'widefat',
							'input_description' => ''
						), 
						array(
							'input_type'  => 'dropdown',
							'input_label' => 'Background image size',
							'input_name'  => 'rmd_cc_metabox_wrapper_bgsize',
							'input_value' => '',
							'input_option' => array(
								'bgsize-auto' => 'Auto', // Based on the actual image size and repeat the x anf y axis.
								'bgsize-horizontal' => 'Horizontally 100%', // Horizontally 100% and repeat y axis.
								'bgsize-vertical' => 'Vertically 100%', // Vertically 100% and repeat x axis.
								'bgsize-parallax' => 'Parallax', // Background cover a sort of parallax.
								'bgsize-cover' => 'Cover', // Background cover.
								'bgsize-fixed' => 'Fixed' // 100% height and auto width and can be manipulated its alignment.
								),
							'input_class' => 'widefat',
							'input_description' => 'Choose fixed if you want to manage the alignment of the image.'
						), 
						array(
							'input_type'  => 'color',
							'input_label' => 'Background color',
							'input_name'  => 'rmd_cc_metabox_wrapper_bgcolor',
							'input_value' => '',
							'input_class' => 'widefat',
							'input_description' => ''
						),
						array(
							'input_type'  => 'mediauploader',
							'input_label' => 'Background image',
							'input_name'  => 'rmd_cc_metabox_wrapper_bgimage',
							'input_value' => '',
							'input_class' => 'widefat',
							'input_description' => ''
						), 
						array(
							'input_type'  => 'dropdown',
							'input_label' => 'Image alignment',
							'input_name'  => 'rmd_cc_metabox_wrapper_bgimage_alignment',
							'input_value' => '',
							'input_option' => array(
								'bgalign-left' => 'Left',
								'bgalign-center' => 'Center',
								'bgalign-right' => 'Right'
								),
							'input_class' => 'widefat',
							'input_description' => 'This is intended for the image fixed size.'
						), 
						
						array(
							'input_type'  => 'dropdown',
							'input_label' => 'Background color transparency',
							'input_name'  => 'rmd_cc_metabox_wrapper_bgcolor_opacity',
							'input_value' => '',
							'input_option' => $bgcolor_opacity_options,
							'input_class' => 'widefat',
							'input_description' => 'Lighter (0.1) to Solid (0.9)'
						),
						array(
							'input_type'  => 'dropdown',
							'input_label' => 'Padding top',
							'input_name'  => 'rmd_cc_metabox_wrapper_bgpadding_top',
							'input_value' => '',
							'input_option' => $bgpadding_options,
							'input_class' => 'widefat',
							'input_description' => '', 
						),
						array(
							'input_type'  => 'dropdown',
							'input_label' => 'Padding bottom',
							'input_name'  => 'rmd_cc_metabox_wrapper_bgpadding_bottom',
							'input_value' => '',
							'input_option' => $bgpadding_options,
							'input_class' => 'widefat',
							'input_description' => ''
						), 
						array(
							'input_type'  => 'color',
							'input_label' => 'Border Top color',
							'input_name'  => 'rmd_cc_metabox_wrapper_border_top_color',
							'input_value' => '',
							'input_class' => 'widefat',
							'input_description' => ''
						),
						array(
							'input_type'  => 'color',
							'input_label' => 'Border Bottom color',
							'input_name'  => 'rmd_cc_metabox_wrapper_border_bottom_color',
							'input_value' => '',
							'input_class' => 'widefat',
							'input_description' => ''
						),
						array(
							'input_type'  => 'text',
							'input_label' => 'Minimum height',
							'input_name'  => 'rmd_cc_metabox_wrapper_min_height',
							'input_value' => '', 
							'input_class' => 'widefat',
							'input_description' => 'Please provide a minimum height in pixels. (Ex. 100px)'
						),
										 
				     ),
				    'placement' => 'side',       // optional [normal|advanced|side]
					'priority'  => 'core',         // optional [high|sorted|core|default|low] 
				    'bottom_text' => '' //optional
			);
		Wppost\RMD_Wppost_Handler::render($wppost_type, $post_type, $config);

	} 
    

	public function create_metabox_column($post_type, $idnum)
	{ 
		$wppost_type = 'metabox'; 
		$config = array(
					'id' => 'rmd_cc_column_metabox_id'.$idnum.'',
			    	'header_title' => 'Column Content '.$idnum,  
				    'inputs' => array( 
						array(
							'input_type'  => 'wpeditor',
							'input_label' => '',
							'input_name'  => 'rmd_cc_column_metabox_'.$idnum.'_content',
							'input_value' => '',
							'input_class' => 'widefat',
							'input_description' => '',
							'input_display' => '', 
							'input_wpeditor_height' => '' 
						), 
				     ),
				    'placement' => 'normal',       // optional [normal|advanced|side]
					'priority'  => 'high',         // optional [high|sorted|core|default|low] 
				    'bottom_text' => '' //optional
			);
		Wppost\RMD_Wppost_Handler::render($wppost_type, $post_type, $config);

	} 

		
}  

 
 