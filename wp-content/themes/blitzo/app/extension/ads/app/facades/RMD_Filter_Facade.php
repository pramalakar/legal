<?php
namespace theme\rmd\extension\ads\app\facades;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
class RMD_Filter_Facade
{      

	public function create_menu_header_ads_filter()
	{  
		add_filter('rmd_sidebar_ads', array($this, '_create_sidebar_ads_filter'));
	}
  	

  	public function _create_sidebar_ads_filter($content)
  	{	  

    }
}  
  

 