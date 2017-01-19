<?php
namespace theme\rmd\extension\gallery\app\factories\shortcodes;

use theme\rmd\core\wplist as Wplist;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
class RMD_Card_Gutter_Gallery_Shortcode extends RMD_Shortcode
{   
	public function render()
	{ 
		$this->set_template('rmd_card_gutter_gallery_template');
		$this->set_shortcode_name('rmd_card_gutter_gallery'); 
		$this->set_shortcode_attr(array( 
			'category' => '',   
			'background_color' => '',
			'text_color' => '#fff',  
			'alignment' => 'center',
			'layout' => 'fixed',
			'column' => 2, // 6, 4, 3, 2,
			'column_xs' => '', // 6, 4, 3, 2,
			'column_sm' => '', // 6, 4, 3, 2,
			'column_md' => '', // 6, 4, 3, 2,
			'column_lg' => '', // 6, 4, 3, 2,
			'limit'  => -1, 
			)); 
		
 		$this->create_shortcode();
	}  

}   

 