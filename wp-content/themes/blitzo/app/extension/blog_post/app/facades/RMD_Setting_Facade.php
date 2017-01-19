<?php
namespace theme\rmd\extension\blog_post\app\facades;

use theme\rmd\core\adminpage as Adminpage;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

 
class RMD_Setting_Facade
{	   
	protected $config = array(
		'shortcode_blog_post' => ''
		);


	public function create_blog_post_setting(array $config = array())
	{
		$this->config = array_merge($this->config, $config);    
 
		$inputs_config = array( 
			$this->_get_blog_post_config(), 
			);

		$config = array(
			'tag_title'  	=> 'Blog Post Setting',
			'menu_title' 	=> 'Blog Post', 
			'page_title' 	=> 'Blog Post Setting',
			'menu_slug'  	=> 'rmd-blog-post-setting',
			'parent_slug'  	=> 'rmd-theme-setting',  
			'inputs' 		=> $inputs_config, 
		);
		$adminpage_type = 'submenu';
		Adminpage\RMD_Adminpage_Handler::render($adminpage_type, $config);

	}


	protected function _get_blog_post_config()
	{
		extract($this->config);

		$num_col_options = array();
		for ($i=3; $i <= 4 ; $i++) { 
			$num_col_options[$i] = $i;
		}

		$num_post_options = array();
		for ($i=1; $i <= 10 ; $i++) { 
			$num_post_options[$i] = $i;
		}


		return array(
			'section_title' => '',
			'section_description' => '<p><em>This setting is only intended for the blog post shortcode.</em></p>',
			'inputs' => array(
				array(
					'input_label' => 'Available Shortcode',
					'input_type'  => 'none', 
					'input_value' => '<code>['.$shortcode_blog_post.']</code>' 
				), 
				array(
					'input_type'  => 'dropdown',
					'input_label' => 'Number of column(s)',
					'input_name'  => 'rmd_setting_blog_post_num_column', 
					'input_value' => 3,
					'input_option' => $num_col_options,
					'input_description' => '',  
					'input_display' => '',
					'input_width' => '120px'
				),
				array(
					'input_type'  => 'dropdown',
					'input_label' => 'Number of post(s)',
					'input_name'  => 'rmd_setting_blog_post_num_post', 
					'input_value' => 3,
					'input_option' => $num_post_options,
					'input_description' => '',  
					'input_display' => '',
					'input_width' => '120px'
				) 
			)
		);
	}

 
}

 
