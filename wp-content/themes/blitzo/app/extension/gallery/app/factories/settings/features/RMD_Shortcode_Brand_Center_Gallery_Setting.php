<?php
namespace theme\rmd\extension\gallery\app\factories\settings;
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
 
class RMD_Shortcode_Brand_Center_Gallery_Setting extends RMD_Setting 
{	   
	protected $shortcode = 'rmd_brand_center_gallery';

	public function render()
	{ 
		return array(
			'section_title' => '',
			'section_description' => '',
			'inputs' => array(
				array(
					'input_label' => 'Brand center gallery', 
					'input_type'  => 'none', 
					'input_name'  => $this->shortcode,
					'input_value' => 'Available Shortcode: <code>['.$this->shortcode.' category=""]</code>',
					'input_description' => '<p>Available parameters: <code>category=""</code> <code>show_lightbox="no / yes"</code> <code> layout="fixed / fluid"</code> <code>  limit=""</code> </p>'
				), 
			)
		);
	}

}

 
