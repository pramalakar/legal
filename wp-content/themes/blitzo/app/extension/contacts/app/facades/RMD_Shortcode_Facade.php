<?php
namespace theme\rmd\extension\contacts\app\facades;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
 
class RMD_Shortcode_Facade  
{	 

	public function create_contact_address_shortcode($shortcode) 
	{ 
		add_shortcode($shortcode, function($atts = array(), $content = null){
			$rmd_setting_contact_address = get_option('rmd_setting_contact_address');
        	return $rmd_setting_contact_address;
		});
	}
 
    
    public function create_contact_email_1_shortcode($shortcode) 
	{ 
		add_shortcode($shortcode, function($atts = array(), $content = null){
			$rmd_setting_contact_email_address_1 = get_option('rmd_setting_contact_email_address_1');
        	return $rmd_setting_contact_email_address_1;
		});
	}


    public function create_contact_email_2_shortcode($shortcode) 
	{ 
		add_shortcode($shortcode, function($atts = array(), $content = null){
			$rmd_setting_contact_email_address_2 = get_option('rmd_setting_contact_email_address_2');
        	return $rmd_setting_contact_email_address_2;
		});
	}

 	
 	public function create_contact_phone_1_shortcode($shortcode) 
	{ 
		add_shortcode($shortcode, function($atts = array(), $content = null){
			$rmd_setting_contact_phone_number_1 = get_option('rmd_setting_contact_phone_number_1');
        	return $rmd_setting_contact_phone_number_1;
		});
	}

 
	public function create_contact_phone_2_shortcode($shortcode) 
	{ 
		add_shortcode($shortcode, function($atts = array(), $content = null){
			$rmd_setting_contact_phone_number_2 = get_option('rmd_setting_contact_phone_number_2');
        	return $rmd_setting_contact_phone_number_2;
		});
	} 
	
}
	
 