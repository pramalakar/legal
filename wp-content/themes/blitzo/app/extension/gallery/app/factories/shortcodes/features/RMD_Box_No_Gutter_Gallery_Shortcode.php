<?php
namespace theme\rmd\extension\gallery\app\factories\shortcodes;

use theme\rmd\core\wplist as Wplist;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
class RMD_Box_No_Gutter_Gallery_Shortcode extends RMD_Shortcode
{    
	public function render()
	{ 
		$this->set_template('rmd_box_no_gutter_gallery_template');
		$this->set_shortcode_name('rmd_box_no_gutter_gallery'); 
		$this->set_shortcode_attr(array( 
			'category' => '',
			'show_lightbox' => 'no',
			'show_caption' => 'yes',
			'layout' => 'fixed',
			'foreground_color' => 'transparent',
			'show_foreground' => 'no',
			'column' => 4, // 6, 4, 3, 2,
			'column_xs' => '', // 6, 4, 3, 2,
			'column_sm' => '', // 6, 4, 3, 2,
			'column_md' => '', // 6, 4, 3, 2,
			'column_lg' => '', // 6, 4, 3, 2,
			'limit'  => -1
			));
		
 		$this->create_shortcode();
	}  

}   

 