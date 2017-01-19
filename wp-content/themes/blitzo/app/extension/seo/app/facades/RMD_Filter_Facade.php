<?php
namespace theme\rmd\extension\seo\app\facades;

use theme\rmd\core\adminpage as Adminpage;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

 
class RMD_Filter_Facade
{       
	public function create_site_meta_keywords_filter()
	{ 
		add_filter('rmd_site_meta_keywords', function($content) {
			$rmd_setting_meta_keywords = get_option('rmd_setting_meta_keywords');  
			if( ! empty($rmd_setting_meta_keywords )):  
				$content = "\n".'<meta name="keywords" content="'.$rmd_setting_meta_keywords.'">';   
			endif;   
			return $content; 
		});   
	}	


	public function create_site_meta_description_filter()
	{ 
		add_filter('rmd_site_meta_description', function($content) {
			$rmd_setting_meta_description = get_option('rmd_setting_meta_description');  
			if( ! empty($rmd_setting_meta_description )):  
				$content = "\n".'<meta name="description" content="'.$rmd_setting_meta_description.'">';   
			endif;   
			return $content; 
		});   
	}


	public function create_site_google_analytics_filter()
	{ 
		add_filter('rmd_site_google_analytics', function($content) {
			$rmd_setting_google_analytics_code = get_option('rmd_setting_google_analytics_code');  
			if( ! empty($rmd_setting_google_analytics_code )):  
				$content = $rmd_setting_google_analytics_code;  
			endif;   
			return $content; 
		});   
	}	 
  
}  
  

 