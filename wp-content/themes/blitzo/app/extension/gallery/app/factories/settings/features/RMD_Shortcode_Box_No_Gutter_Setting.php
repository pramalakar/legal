<?php
namespace theme\rmd\extension\gallery\app\factories\settings;
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
 
class RMD_Shortcode_Box_No_Gutter_Setting extends RMD_Setting 
{	   
	protected $shortcode = 'rmd_box_no_gutter_gallery';

	public function render()
	{ 
		return array(
			'section_title' => '',
			'section_description' => '',
			'inputs' => array(
				array(
					'input_label' => 'Box gallery with no gutter', 
					'input_type'  => 'none', 
					'input_name'  => $this->shortcode,
					'input_value' => 'Available Shortcode: <code>['.$this->shortcode.' category=""]</code>',
					'input_description' => '<p>Available parameters: <code> category=""</code> <code>show_lightbox="no / yes"</code>  <code>show_caption="yes / no"</code>  <code>layout="fixed / fluid"</code>  <code>foreground_color="transparent"</code>  <code>show_foreground="no / yes"</code>  <code>column="6 / 4 / 3 / 2"</code>  <code>limit=""</code> </p>'
				), 
			)
		);
	}

}

 
