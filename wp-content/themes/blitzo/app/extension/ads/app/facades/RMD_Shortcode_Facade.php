<?php
namespace theme\rmd\extension\ads\app\facades;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
 
class RMD_Shortcode_Facade  
{	 

	public function create_header_ads_shortcode($shortcode) 
	{ 
		add_shortcode($shortcode, function($atts = array(), $content = null){
			$rmd_setting_header_ads = get_option('rmd_setting_header_ads');
        	return $rmd_setting_header_ads;
		});
	}

	public function create_sidebar_ads_shortcode($shortcode) 
	{ 
		add_shortcode($shortcode, function($atts = array(), $content = null){
			$rmd_setting_sidebar_ads = get_option('rmd_setting_sidebar_ads');
        	return $rmd_setting_sidebar_ads;
		});
	}

}
	
 