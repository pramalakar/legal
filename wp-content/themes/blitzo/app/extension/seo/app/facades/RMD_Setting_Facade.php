<?php
namespace theme\rmd\extension\seo\app\facades;

use theme\rmd\core\adminpage as Adminpage;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
 
class RMD_Setting_Facade
{      

	public function create_seo_setting()
	{
		$inputs_config = array( 
			$this->_get_google_analytics_config(),
			$this->_get_meta_tags_config() 
			);  
		
		$config = array(
			'tag_title'  		=> 'SEO Setting',
			'menu_title' 		=> 'SEO', 
			'page_title' 		=> 'SEO Setting',
			'menu_slug'  		=> 'rmd-theme-seo-setting',  
			'parent_slug'  		=> 'rmd-theme-setting',  
			'inputs' 			=> $inputs_config
		);

		$adminpage_type = 'submenu'; 
		Adminpage\RMD_Adminpage_Handler::render($adminpage_type, $config);

	}


	protected function _get_google_analytics_config()
	{
		return array(
			'section_title' => 'Google Analytics',
			'section_description' => '',
			'inputs' => array(
				array(
					'input_type'  => 'textarea',
					'input_label' => 'Google Analytics Code',
					'input_name'  => 'rmd_setting_google_analytics_code',
					'input_value' => '',
					'input_class' => '',
					'input_description' => 'Set your site google analytics code here.'
				)
			)
		);
	} 



	protected function _get_meta_tags_config()
	{
		return array(
			'section_title' => 'Meta Tags',
			'section_description' => '',
			'inputs' => array(
				array(
					'input_type'  => 'textarea',
					'input_label' => 'Description',
					'input_name'  => 'rmd_setting_meta_description',
					'input_value' => '',
					'input_class' => '',
					'input_description' => 'This will be used by the search engines on settins up the site\'s description on its search results.'
				),
				array(
					'input_type'  => 'textarea',
					'input_label' => 'Keywords',
					'input_name'  => 'rmd_setting_meta_keywords',
					'input_value' => '',
					'input_class' => '',
					'input_description' => 'This will be the keywords of the site that may help for the SEO. Separate keywords with commas.'
				)
			)
		);
	}  
		
	

}  
  

 