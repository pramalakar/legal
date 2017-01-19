<?php
namespace theme\rmd\extension\slider\app\facades;

use theme\rmd\core\wpquery as Wpquery;
use theme\rmd\core\wppost as Wppost;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class RMD_Page_Setting_Facade 
{      

	protected $config = array(   
        'slider_bgcolor' => '#131313',
        'slider_overlay_bgcolor' => '#000', 
		);


	public function create_page_setting()
	{ 
		add_action('admin_init', array($this, '_create_page_setting'), 10);  
	}

		
	public function _create_page_setting()
	{
		extract($this->config);

		$slider_options = array( 'all' => 'All' );

		$taxononomy = 'rmd_slider_cat';
		$terms = get_terms( $taxononomy );
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		    foreach ( $terms as $term ) {
		        $slider_options[$term->slug] = $term->name;
		    }
		} 

		wp_reset_postdata();


		$overlay_opacity_options = array( 0 => '-');
		for ($i=1; $i <= 9 ; $i++) { 
			$overlay_opacity_options['0.'.$i] = '0.'.$i;
		}

		$config = array(
				'id' => 'page_metabox_slider_setting',
		    	'header_title' => 'Slider Options',  
			    'inputs' => array(   
					array(
						'input_type'  => 'dropdown',
						'input_label' => 'Slider Category',
						'input_name'  => 'rmd_setting_slider_category', 
						'input_option' => $slider_options,
						'input_class' => 'widefat',
						'input_description' => '',
						'input_display' => 'inline',
					),
					array(
						'input_type'  => 'dropdown',
						'input_label' => 'Slider Type',
						'input_name'  => 'rmd_setting_slider_type', 
						'input_option' => array(
							'fixed' => 'Fixed',
							'fluid' => 'Fluid',
							'cover' => 'Cover'
							),
						'input_description' => '',  
						'input_display' => 'inline',
						'input_width' => '105px'
					), 
					array(
						'input_type'  => 'color',
						'input_label' => 'Background Color',
						'input_name'  => 'rmd_setting_slider_bgcolor', 
						'input_value' => $slider_bgcolor,
						'input_default' => $slider_bgcolor,
						'input_display' => 'inline',
					), 
					array(
						'input_type'  => 'color',
						'input_label' => 'Overlay Color',
						'input_name'  => 'rmd_setting_slider_overlay_bgcolor', 
						'input_value' => $slider_overlay_bgcolor,
						'input_default' => $slider_overlay_bgcolor,
						'input_display' => 'inline',
					), 
					array(
						'input_type'  => 'dropdown',
						'input_label' => 'Overlay Transparency',
						'input_name'  => 'rmd_setting_slider_overlay_opacity', 
						'input_option' => $overlay_opacity_options,
						'input_description' => '<small><em>Lighter (0.1) to Solid (0.9)</em></small>', 
						'input_display' => 'inline',
						'input_width' => '105px'
					),   
					array(
						'input_type'  => 'dropdown',
						'input_label' => 'Show Navigation',
						'input_name'  => 'rmd_setting_slider_navigation_status', 
						'input_option' => array(
							'yes' => 'Yes',
							'no' => 'No',
							),
						'input_description' => '<small><em>(The arrows at the sides of the slider)</em></small>',  
						'input_display' => 'inline',
						'input_width' => '105px'
					), 
					array(
						'input_type'  => 'dropdown',
						'input_label' => 'Show Indicator',
						'input_name'  => 'rmd_setting_slider_indicator_status', 
						'input_option' => array(
							'yes' => 'Yes',
							'no' => 'No',
							),
						'input_description' => '<small><em>(The circle at the bottom part of the slider)</em></small>', 
						'input_display' => 'inline', 
						'input_width' => '105px'
					),
					array(
						'input_type'  => 'dropdown',
						'input_label' => 'Transparent Header',
						'input_name'  => 'rmd_setting_slider_transparent_header', 
						'input_option' => array(
							'no' => 'No',
							'yes' => 'Yes',
							),
						'input_description' => '<small><em>Make header transparent and pull up the slider.</em></small>', 
						'input_display' => 'inline', 
						'input_width' => '105px'
					),
					 
			    ),
			    'placement' => 'normal',       // optional [normal|advanced|side]
				'priority'  => 'high',         // optional [high|sorted|core|default|low] 
			    'bottom_text' => '<em>The slider options is only intended for the "Page - Slider" template.</em>' //optional
			);
		$wppost_type = 'metabox'; 
		Wppost\RMD_Wppost_Handler::render($wppost_type, 'page', $config);

	} 
  
}  
 