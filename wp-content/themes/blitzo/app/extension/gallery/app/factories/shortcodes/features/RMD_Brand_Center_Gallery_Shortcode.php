<?php
namespace theme\rmd\extension\gallery\app\factories\shortcodes;

use theme\rmd\core\wplist as Wplist;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
class RMD_Brand_Center_Gallery_Shortcode extends RMD_Shortcode
{    
	public function render()
	{ 
		$this->set_template('rmd_brand_center_gallery_template');
		$this->set_shortcode_name('rmd_brand_center_gallery'); 
		$this->set_shortcode_attr(array( 
			'category' => '',
			'show_lightbox' => 'no', 
			'layout' => 'fixed',  
			'limit'  => -1
			));   
		
 		$this->create_shortcode();
	}  

}   

 