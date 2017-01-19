<?php
namespace theme\rmd\extension\gallery\app\factories\settings;
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
 
class RMD_Shortcode_Card_Gutter_Setting extends RMD_Setting 
{	   
	protected $shortcode = 'rmd_card_gutter_gallery';

	public function render()
	{ 
		return array(
			'section_title' => '',
			'section_description' => '',
			'inputs' => array(
				array(
					'input_label' => 'Card gallery', 
					'input_type'  => 'none', 
					'input_name'  => $this->shortcode,
					'input_value' => 'Available Shortcode: <code>['.$this->shortcode.' category=""]</code>',
					'input_description' => '<p> Available parameters: <code>category=""</code><code> background_color=""</code><code> text_color=""</code><code> alignment="left / center / right" </code><code>layout="fixed" </code><code>column="6 / 4 / 3 / 2" </code><code>limit="" </code></p>'
				), 
			)
		);
	}

}

 
