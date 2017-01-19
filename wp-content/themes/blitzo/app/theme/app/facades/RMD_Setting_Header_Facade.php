<?php
namespace theme\rmd\theme\app\facades;

use theme\rmd\core\adminpage as Adminpage;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
class RMD_Setting_Header_Facade
{      

	public function create_setting()
	{
		$inputs_config = array(
			$this->_get_header_logo_config(),
			$this->_get_header_top_widget_config()
			);  
		
		$config = array(
			'tag_title'  		=> 'Header Setting',
			'menu_title'		=> '<em>BLITZO</em>',
			'menu_title_alias' 	=> 'Header', 
			'page_title' 		=> 'Header Setting',
			'menu_slug'			=> 'rmd-theme-setting', 
			'menu_icon'  		=> 'dashicons-admin-tools',
			'inputs' 			=> $inputs_config
		);

		$adminpage_type = 'mainmenu'; 
		Adminpage\RMD_Adminpage_Handler::render($adminpage_type, $config);
 
	}

	
	protected function _get_header_logo_config()
	{
		return array(
			'section_title' => '',
			'section_description' => '',
			'inputs' => array( 
				array(
					'input_type'  => 'mediauploader',
					'input_label' => 'Site Logo',
					'input_name'  => 'rmd_setting_site_logo',
					'input_media_caption' => array('upload'=>'Please Upload Image','remove'=>'Please Remove Image'),
					'input_media_modal_heading' => 'Insert Image',
					'input_media_modal_button' => 'Set it now'
				),
				array(
					'input_type'  => 'mediauploader',
					'input_label' => 'Site Logo for small devices',
					'input_name'  => 'rmd_setting_site_logo_xs',
					'input_media_caption' => array('upload'=>'Please Upload Image','remove'=>'Please Remove Image'),
					'input_media_modal_heading' => 'Insert Image',
					'input_media_modal_button' => 'Set it now'
				),
				array(
					'input_type'  => 'mediauploader',
					'input_label' => 'Site Favicon',
					'input_name'  => 'rmd_setting_site_favicon',
					'input_media_caption' => array('upload'=>'Please Upload Image','remove'=>'Please Remove Image'),
					'input_media_modal_heading' => 'Insert Image',
					'input_media_modal_button' => 'Set it now'
				)
			)
		);
	}


	protected function _get_header_top_widget_config()
	{
		return array(
			'section_title' => 'Header Top Widget',
			'section_description' => '',
			'inputs' => array(  
				array(
					'input_type'  => 'dropdown',
					'input_label' => 'Enable Widget',
					'input_name'  => 'rmd_setting_header_top_widget_status', 
					'input_option' => array( 
						'no' => 'No',  
						'yes' => 'Yes',
						), 
				),
				array(
					'input_type'  => 'dropdown',
					'input_label' => 'Column Layout',
					'input_name'  => 'rmd_setting_header_top_widget_column_layout', 
					'input_option' => array( 
						'112' => '1/2 - 1/2 Columns', 
						'123' => '1/3 - 2/3 Columns',
						'213' => '2/3 - 1/3 Columns',
						'134' => '1/4 - 3/4 Columns',
						'314' => '3/4 - 1/4 Columns'
						),
					'input_description' => 'Please set the header top widget column layout.'
				),
			)
		);
	}
  

}  
  

 