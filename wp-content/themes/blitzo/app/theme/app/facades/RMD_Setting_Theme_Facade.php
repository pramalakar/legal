<?php
namespace theme\rmd\theme\app\facades;

use theme\rmd\core\adminpage as Adminpage;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
class RMD_Setting_Theme_Facade
{     
	
	public function create_setting()
	{
		$inputs_config = array(
			$this->_get_theme_options_config()
			);  
		
		$config = array(
			'tag_title'  		=> 'Theme Styling Setting',
			'menu_title'		=> '<em>BLITZO</em>',
			'menu_title_alias' 	=> 'Theme Styling', 
			'page_title' 		=> 'Theme Styling Setting',
			'menu_slug'  		=> 'rmd-theme-setting',
			'menu_icon'  		=> 'dashicons-admin-tools',
			//'menu_position' 	=> 110,
			'inputs' 			=> $inputs_config, 
		);

		$adminpage_type = 'mainmenu'; 
		Adminpage\RMD_Adminpage_Handler::render($adminpage_type, $config);

	}


	protected function _get_theme_options_config()
	{
		return array(
			'section_title' => '',
			'section_description' => '',
			'inputs' => array(
				array(
					'input_type'  => 'themecolor',
					'input_label' => 'Theme Color',
					'input_name'  => 'rmd_setting_theme_color',
					'input_value' => '',
					'input_class' => '',
					'input_option' => array(
						'rmd-theme-color-1-css' => array('#0f202e','#354a55','#ed1c24','#ffffff', '#485c67'), 
						),
					'input_description' => ''
				)
			)
		);
	} 
 
  

}  
  

 