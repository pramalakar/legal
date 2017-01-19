<?php
namespace theme\rmd\extension\google_map\app\facades;

use theme\rmd\core\adminpage as Adminpage;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

 
class RMD_Setting_Facade
{	   
	protected $config = array(
		'shortcode_google_map' => ''
		);


	public function create_google_map_setting(array $config = array())
	{
		$this->config = array_merge($this->config, $config);    
 
		$inputs_config = array( 
			$this->_get_google_code_config(), 
			$this->_get_map_button_config(),
			$this->_get_page_template_config(),
			$this->_get_responsive_map_height_config()
			);

		$config = array(
			'tag_title'  	=> 'Google Map Setting',
			'menu_title' 	=> 'Google Map', 
			'page_title' 	=> 'Google Map Setting',
			'menu_slug'  	=> 'rmd-google-map-setting',
			'parent_slug'  	=> 'rmd-theme-setting',  
			'inputs' 		=> $inputs_config, 
		);
		$adminpage_type = 'submenu';
		Adminpage\RMD_Adminpage_Handler::render($adminpage_type, $config);

	}


	protected function _get_map_button_config()
	{
		extract($this->config);

		return array(
			'section_title' => 'Map Button Details',
			'section_description' => '<em>This is intended for the small devices.</em>',
			'inputs' => array(  
				array(
					'input_type'  => 'text',
					'input_label' => 'Map Link',
					'input_name'  => 'rmd_setting_map_link',
					'input_description' => 'If the map link is not provided then the map button will not display.'
				),
				array(
					'input_type'  => 'text',
					'input_label' => 'Map Button Label',
					'input_name'  => 'rmd_setting_map_button_label',
					'input_description' => 'This will be used if the map button is enabled<br>Ex., Map or &lt;span class="glyphicon glyphicon-map-marker"&gt;&lt;/span&gt;'
				),		
				array(
					'input_type'  => 'dropdown',
					'input_label' => 'Show at Map Button',
					'input_name'  => 'rmd_setting_contact_map_status',
					'input_option' => array(
						'yes' => 'Yes',
						'no' => 'No'
						),
					'input_description' => ''
				),	  
			)
		);
	} 


	protected function _get_google_code_config()
	{
		extract($this->config);

		return array(
			'section_title' => '',
			'section_description' => '',
			'inputs' => array(
				array(
					'input_label' => 'Available Shortcode',
					'input_type'  => 'none', 
					'input_value' => '<code>['.$shortcode_google_map.' width="100%" height="400px"]</code>'
				), 
				array(
					'input_type'  => 'textarea',
					'input_label' => 'Google Map Embeded Code',
					'input_name'  => 'rmd_setting_google_map_code',
					'input_value' => '',
					'input_class' => 'widefat',
					'input_description' => '', 
				)
			)
		);
	}


	protected function _get_page_template_config()
	{
		return array(
			'section_title' => 'Page Template Setting',
			'section_description' => '',
			'inputs' => array( 
				array(
					'input_type'  => 'dropdown',
					'input_label' => 'Map Type',
					'input_name'  => 'rmd_setting_google_map_type', 
					'input_option' => array(
						'fixed' => 'Fixed',
						'fluid' => 'Fluid',
						'cover' => 'Cover'
						),
					'input_description' => '',  
					'input_display' => '',
				),  
				array(
					'input_type'  => 'dropdown',
					'input_label' => 'Transparent Header',
					'input_name'  => 'rmd_setting_google_map_transparent_header', 
					'input_option' => array(
						'no' => 'No',
						'yes' => 'Yes', 
						),
					'input_description' => '<p><em>Make header transparent and pull up the map.</em></p>', 
					'input_display' => '',
				),  
			)
		);
	}


	protected function _get_responsive_map_height_config()
	{
		return array(
			'section_title' => 'Responsive Map Height Setting',
			'section_description' => '<em>This is intended for the page template and for fixed and fluid map type. Please provide the number of height in pixels.</em>',
			'inputs' => array(  
				array(
					'input_type'  => 'text',
					'input_label' => 'For large devices like desktop computer',  
					'input_name'  => 'rmd_setting_google_map_height_lg',
					'input_description' => ''
				),
				array(
					'input_type'  => 'text',
					'input_label' => 'For medium devices like laptop',
					'input_name'  => 'rmd_setting_google_map_height_md',  
					'input_description' => ''
				),
				array(
					'input_type'  => 'text',
					'input_label' => 'For small devices like tablet',
					'input_name'  => 'rmd_setting_google_map_height_sm',  
					'input_description' => ''
				),
				array(
					'input_type'  => 'text',
					'input_label' => 'For extra small devices like smartphone',
					'input_name'  => 'rmd_setting_google_map_height_xs',  
					'input_description' => ''
				), 
			)
		);
	}
}

 
