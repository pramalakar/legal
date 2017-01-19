<?php
namespace theme\rmd\extension\banner\app\facades;

use theme\rmd\core\wpquery as Wpquery;
use theme\rmd\core\wppost as Wppost;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class RMD_Page_Setting_Facade 
{        
	protected $config = array(    
        'banner_overlay_bgcolor' => '#525252', 
		);

	public function create_page_setting()
	{ 
		add_action('admin_init', array($this, '_create_page_setting'), 10);  
	}

		
	public function _create_page_setting()
	{ 
		extract($this->config);

		$overlay_opacity_options = array( 0 => '-');
		for ($i=1; $i <= 9 ; $i++) { 
			$overlay_opacity_options['0.'.$i] = '0.'.$i;
		}

		$config = array(
				'id' => 'page_metabox_banner_setting_id',
		    	'header_title' => 'Banner Options',  
			    'inputs' => array(    
					array(
			            'input_type'  => 'mediauploader',
						'input_label' => 'Image',
						'input_name'  => 'rmd_banner_image',
						'input_media_caption' => array(
							'upload' => 'Upload Image',
							'remove' => 'Remove Image'
						),
						'input_media_modal_heading' => 'Insert Image',
						'input_media_modal_button' => 'Set Image',
						'input_display' => 'inline'
			        ), 
			        array(
						'input_type'  => 'wpeditor',
						'input_label' => 'Text Content',
						'input_name'  => 'rmd_banner_text_content',
						'input_value' => '',
						'input_class' => 'widefat',  
						'input_description' => '',
						'input_display' => 'inline',
						'input_wpeditor_settings'	=> array( 
							'media_buttons' => FALSE
							)
					),
			        array(
						'input_type'  => 'color',
						'input_label' => 'Overlay Color',
						'input_name'  => 'rmd_banner_overlay_bgcolor', 
						'input_value' => $banner_overlay_bgcolor,
						'input_default' => $banner_overlay_bgcolor,
						'input_display' => 'inline',
					), 
					array(
						'input_type'  => 'dropdown',
						'input_label' => 'Overlay Transparency',
						'input_name'  => 'rmd_banner_overlay_opacity', 
						'input_option' => $overlay_opacity_options,
						'input_description' => '<small><em>Lighter (0.1) to Solid (0.9)</em></small>', 
						'input_display' => 'inline',
						'input_width' => '105px'
					),  
			    ),
			    'placement' => 'normal',       // optional [normal|advanced|side]
				'priority'  => 'high',         // optional [high|sorted|core|default|low] 
			    'bottom_text' => '' //optional
			);
		$wppost_type = 'metabox'; 
		Wppost\RMD_Wppost_Handler::render($wppost_type, 'page', $config);

	} 
  
}  
 