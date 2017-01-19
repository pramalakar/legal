<?php
namespace theme\rmd\extension\gallery\app\factories\settings;
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
 
class RMD_Shortcode_Descriptive_Setting extends RMD_Setting 
{	   
	protected $shortcode = 'rmd_descriptive_gallery';

	public function render()
	{ 
		return array(
			'section_title' => '',
			'section_description' => '',
			'inputs' => array(
				array(
					'input_label' => 'Descriptive Gallery', 
					'input_type'  => 'none', 
					'input_name'  => $this->shortcode,
					'input_value' => 'Available Shortcode: <code>['.$this->shortcode.' category=""]</code>',
					'input_description' => '<p> Available parameters: <code>category=""</code> <code> text_color=""</code><code> alignment="left / center / right" </code><code>column="6 / 4 / 3 / 2" </code><code>limit="" </code></p>'
				), 
			)
		);
	}

}

 
