<?php
namespace theme\rmd\extension\courses\app\facades;

use theme\rmd\core\adminpage as Adminpage;
use theme\rmd\core\wpquery as Wpquery;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

 
class RMD_Setting_Facade
{	   
	protected $config = array();


	public function create_shortcode_setting(array $config = array())
	{
		$this->config = array_merge($this->config, $config);    
 
		$inputs_config = array( 
			$this->_get_course_shortcode_config(),
			$this->_get_course_preview_config(),
			$this->_get_course_outline_preview_config()
			);

		$config = array(
			'tag_title'  	=> 'Courses',
			'menu_title' 	=> 'Courses', 
			'page_title' 	=> 'Courses',
			'menu_slug'  	=> 'rmd-courses-setting',
			'parent_slug'  	=> 'rmd-theme-setting',  
			'inputs' 		=> $inputs_config, 
		);
		$adminpage_type = 'submenu';
		Adminpage\RMD_Adminpage_Handler::render($adminpage_type, $config);

	}


	protected function _get_course_outline_preview_config()
	{
		extract($this->config);

		return array(
			'section_title' => 'Course Outline Preview Buttons',
			'section_description' => '',
			'inputs' => array(
				array(
					'input_label' => 'Course Outline Button Label',
					'input_type'  => 'text', 
					'input_value' => 'COURSE OUTLINE',
					'input_name'  => 'rmd_course_outline_btn_lbl'
				),
				array(
					'input_label' => 'Apply Now Button Link',
					'input_type'  => 'text', 
					'input_value' => '',
					'input_name'  => 'rmd_apply_now_btn_link'
				),
				array(
					'input_label' => 'Apply Now Button label',
					'input_type'  => 'text', 
					'input_value' => 'APPLY NOW',
					'input_name'  => 'rmd_apply_now_btn_lbl'
				),
			)
		);
	}


	protected function _get_course_preview_config()
	{
		extract($this->config);

		return array(
			'section_title' => 'Course Preview Buttons',
			'section_description' => '',
			'inputs' => array(
				array(
					'input_label' => 'Read More Button Label',
					'input_type'  => 'text', 
					'input_name'  => 'rmd_read_more_btn_lbl',
					'input_value' => 'Read More'
				),
			)
		);
	}


	protected function _get_course_shortcode_config()
	{
		extract($this->config);

		return array(
			'section_title' => '',
			'section_description' => '',
			'inputs' => array(
				array(
					'input_label' => 'Available Shortcode',
					'input_type'  => 'none', 
					'input_value' => '<code>['.$shortcode.']</code>',
					'input_name'  => 'rmd_course_shortcode'
				),
			)
		);
	}

 
 
}

 
