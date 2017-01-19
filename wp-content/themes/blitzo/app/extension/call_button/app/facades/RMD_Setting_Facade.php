<?php
namespace theme\rmd\extension\call_button\app\facades;

use theme\rmd\core\adminpage as Adminpage;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 

class RMD_Setting_Facade
{         
	protected $config = array(
		'background_color' => '#272727', 
		'border_color' => '#646464',
		'text_color' => '#fff'
		);


	public function create_setting(array $config = array())
	{  
		$this->config = array_merge($this->config, $config);

		$inputs_config = array(    
			$this->_get_input_config(), 
			);  
		 
		$config = array(
			'tag_title'  	=> 'Call / Map Button Setting',
			'menu_title' 	=> 'Call / Map Button',  
			'page_title' 	=> 'Call / Map Button Setting',
			'menu_slug'  	=> 'rmd-call-map-button-setting', 
			'parent_slug'	=> 'rmd-theme-setting',
			'inputs' 		=> $inputs_config
		);

		$adminpage_type = 'submenu'; 
		Adminpage\RMD_Adminpage_Handler::render($adminpage_type, $config);  
		 
	} 
	  

	protected function _get_input_config()
	{
		extract($this->config);

		return array(
			'section_title' => '',
			'section_description' => '',
			'inputs' => array(  
				array(
					'input_type'  => 'dropdown',
					'input_label' => 'Enable Call/Map Button',
					'input_name'  => 'rmd_setting_call_button_status',
					'input_option' => array(
						'yes' => 'Yes',
						'no' => 'No'
						),
					'input_description' => ''
				),  
				array(
					'input_type'  => 'color',
					'input_label' => 'Background Color',
					'input_name'  => 'rmd_setting_call_button_background_color',
					'input_value' => $background_color,
					'input_default' => $background_color
				), 
				array(
					'input_type'  => 'color',
					'input_label' => 'Border Color',
					'input_name'  => 'rmd_setting_call_button_border_color',
					'input_value' => $border_color,
					'input_default' => $border_color
				),  
				array(
					'input_type'  => 'color',
					'input_label' => 'Text Color',
					'input_name'  => 'rmd_setting_call_button_text_color',
					'input_value' => $text_color,
					'input_default' => $text_color
				),
				array(
					'input_type'  => 'textarea',
					'input_label' => 'Custom CSS',
					'input_name'  => 'rmd_setting_call_button_custom_css',
					'input_description' => 'You can set your custom CSS here.'
				)
			)
		);
	} 
 
		 
}  
