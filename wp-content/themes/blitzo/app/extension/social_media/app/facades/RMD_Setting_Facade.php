<?php
namespace theme\rmd\extension\social_media\app\facades;

use theme\rmd\core\adminpage as Adminpage;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

 
class RMD_Setting_Facade
{	   
	protected $config = array(
		'shortcode_social_media' => ''
		);


	public function create_social_media_setting(array $config = array())
	{
		$this->config = array_merge($this->config, $config);    
 
		$inputs_config = array( 
			$this->_get_social_media_config(), 
			$this->_get_social_media_links(), 
			);

		$config = array(
			'tag_title'  	=> 'Social Media Setting',
			'menu_title' 	=> 'Social Media', 
			'page_title' 	=> 'Social Media Setting',
			'menu_slug'  	=> 'rmd-social-media-setting',
			'parent_slug'  	=> 'rmd-theme-setting',  
			'inputs' 		=> $inputs_config, 
		);
		$adminpage_type = 'submenu';
		Adminpage\RMD_Adminpage_Handler::render($adminpage_type, $config);

	}


	protected function _get_social_media_config()
	{
		extract($this->config);

		return array(
			'section_title' => '',
			'section_description' => '',
			'inputs' => array(
				array(
					'input_label' => 'Available Shortcode',
					'input_type'  => 'none', 
					'input_value' => '<code>['.$shortcode_social_media.']</code>'
				),  
				array(
					'input_type'  => 'dropdown',
					'input_label' => 'Show at the footer section',
					'input_name'  => 'rmd_social_media_footer_status', 
					'input_option' => array(
						'no' => 'No',
						'yes' => 'Yes', 
						),
					'input_description' => '',  
					'input_display' => '',
					'input_width' => '120px'
				), 
			)
		);
	}


	protected function _get_social_media_links()
	{
		return array(
			'section_title' => 'Social Media Links',
			'section_description' => '',
			'inputs' => array( 
				array(
					'input_type'  => 'text',
					'input_label' => 'Facebook',  
					'input_name'  => 'rmd_social_media_facebook_link',
					'input_description' => ''
				),
				array(
					'input_type'  => 'text',
					'input_label' => 'YouTube',  
					'input_name'  => 'rmd_social_media_youtube_link',
					'input_description' => ''
				),
				array(
					'input_type'  => 'text',
					'input_label' => 'Twitter',  
					'input_name'  => 'rmd_social_media_twitter_link',
					'input_description' => ''
				),
				array(
					'input_type'  => 'text',
					'input_label' => 'LinkedIn',  
					'input_name'  => 'rmd_social_media_linkedin_link',
					'input_description' => ''
				),
				array(
					'input_type'  => 'text',
					'input_label' => 'Pinterest',  
					'input_name'  => 'rmd_social_media_pinterest_link',
					'input_description' => ''
				),
				array(
					'input_type'  => 'text',
					'input_label' => 'Google Plus+',  
					'input_name'  => 'rmd_social_media_google_plus_link',
					'input_description' => ''
				), 
				array(
					'input_type'  => 'text',
					'input_label' => 'Instagram',  
					'input_name'  => 'rmd_social_media_instagram_link',
					'input_description' => ''
				),
			)
		);
	}
 
}

 
