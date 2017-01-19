<?php
namespace theme\rmd\extension\testimonial\app\factories\settings;
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
 
class RMD_Shortcode_Carousel_Setting extends RMD_Setting 
{	   
	protected $shortcode = 'rmd_testimonial_carousel';

	public function render()
	{ 
		return array(
			'section_title' => '',
			'section_description' => '',
			'inputs' => array(
				array(
					'input_label' => 'Carousel kind of testimonial', 
					'input_type'  => 'none', 
					'input_name'  => $this->shortcode,
					'input_value' => 'Available shortcode: <code>['.$this->shortcode.' category=""]</code>',
					'input_description' => '<p>Available parameters: <code>show_prev_next="yes / no"</code> <code>show_indicator="yes / no"</code><code> color="#000" </code><code>limit=""</code></p>'
				), 
			)
		);
	}

}
 