<?php
namespace theme\rmd\extension\contacts\app\facades;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
class RMD_Filter_Facade
{      

	public function create_menu_contacts_filter()
	{  
		add_filter('rmd_menu_contacts', array($this, '_create_menu_contacts_filter'));

	}
  	

  	public function _create_menu_contacts_filter($content)
  	{	  
        $rmd_setting_contact_navbar_menu_status = get_option('rmd_setting_contact_navbar_menu_status');

        if(empty($rmd_setting_contact_navbar_menu_status) || $rmd_setting_contact_navbar_menu_status == 'no') return $content;
        
        ob_start(); 
        include(dirname(__FILE__).'/templates/template_filter.php'); 
        $new_content = ob_get_clean(); 

        if(!empty($new_content)) return $new_content;

        return $content;		
  	}
  	

}  
  

 