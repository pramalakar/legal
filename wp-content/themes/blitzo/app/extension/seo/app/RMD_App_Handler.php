<?php   
namespace theme\rmd\extension\seo\app;

use theme\rmd\extension\seo\app\factories as Factory; 


if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}


class RMD_App_Handler 
{     
    public function __construct()
    {      
        $this->create_setting(); 
        $this->create_filter();   
    } 
 

    public function create_setting()
    { 
        $app = RMD_Facade_Loader::load_facade('Setting'); 
        $app->create_seo_setting(); 
    }


    public function create_filter()
    { 
        $app = RMD_Facade_Loader::load_facade('Filter'); 
        $app->create_site_meta_keywords_filter(); 
        $app->create_site_meta_description_filter(); 
        $app->create_site_google_analytics_filter(); 
    }
   
    
}


$RMD_App_Handler = new RMD_App_Handler();
