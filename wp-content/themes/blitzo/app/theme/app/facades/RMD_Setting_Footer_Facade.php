<?php
namespace theme\rmd\theme\app\facades;

use theme\rmd\core\adminpage as Adminpage; 


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
class RMD_Setting_Footer_Facade
{     
	
	public function create_setting()
	{
		$inputs_config = array(
			$this->_get_footer_section_config()
			);  
		
		$config = array(
			'tag_title'  		=> 'Footer Setting',
			'menu_title' 		=> 'Footer', 
			'page_title' 		=> 'Footer Setting',
			'menu_slug'			=> 'rmd-theme-footer-setting',
			'parent_slug'  		=> 'rmd-theme-setting',  
			'inputs' 			=> $inputs_config
		);

		$adminpage_type = 'submenu'; 
		Adminpage\RMD_Adminpage_Handler::render($adminpage_type, $config);
	}
 

	protected function _get_footer_section_config()
	{
		return array(
			'section_title' => '',
			'section_description' => '',
			'inputs' => array( 
				array(
					'input_type'  => 'text',
					'input_label' => 'Copyright Text',
					'input_name'  => 'rmd_setting_footer_copyright',
					'input_value' => '',
					'input_class' => '',
					'input_description' => 'You can set a HTML code in the input field, usually copyright text. <br>Ex. <code>Copyright © 2016 All Rights Reserved</code>'
				),
				array(
					'input_type'  => 'dropdown',
					'input_label' => 'Footer Widget Column(s)',
					'input_name'  => 'rmd_setting_footer_widget_column', 
					'input_option' => array(
						'four' => 'Four Columns',
						'three' => 'Three Columns',
						'two' => 'Two Columns',
						'one' => 'One Column',
						'123' => '1/3 - 2/3 Columns',
						'213' => '2/3 - 1/3 Columns',
						'134' => '1/4 - 3/4 Columns',
						'314' => '3/4 - 1/4 Columns'
						),
					'input_description' => 'Please set the footer widget column(s) that you want to display in the site:<br>
					- Four Columns use all the footer widgets.<br>
					- Three Columns use 1, 2 and 3 footer widgets.<br>
					- Two Columns use 1 and 2 footer widgets.<br>
					- One Column use the footer widget 1.<br>
					- 1/3 - 2/3 Columns use 1 and 2 footer widgets.<br>
					- 2/3 - 1/3 Columns use 1 and 2 footer widgets.<br>
					- 1/4 - 3/4 Columns use 1 and 2 footer widgets.<br>
					- 3/4 - 1/4 Columns use 1 and 2 footer widgets.<br>'
				),
			)
		);
	} 
	

}  
  

 