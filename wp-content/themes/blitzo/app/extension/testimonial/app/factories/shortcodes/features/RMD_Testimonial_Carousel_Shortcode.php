<?php 
namespace theme\rmd\extension\testimonial\app\factories\shortcodes;

use theme\rmd\core\wplist as Wplist;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class RMD_Testimonial_Carousel_Shortcode extends RMD_Shortcode
{     
	public function render()
	{  
		$this->set_template('rmd_testimonial_carousel_template');
		$this->set_shortcode_name('rmd_testimonial_carousel'); 
		$this->set_shortcode_attr(array(  
			'show_prev_next' => 'yes',
			'show_indicator' => 'yes',  
			'color' => '#000',  
			'limit' => -1 
			));
 
 		$this->create_shortcode();
	}  

}   

 