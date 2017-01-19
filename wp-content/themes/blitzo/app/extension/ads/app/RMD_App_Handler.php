<?php   
namespace theme\rmd\extension\ads\app;
  

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}


class RMD_App_Handler
{    
    protected $shortcode_header_ads = 'rmd_header_ads';
    protected $shortcode_sidebar_ads = 'rmd_sidebar_ads';
    

    public function __construct()
    {    
        $this->create_setting();
        $this->create_fitler(); 
        $this->create_shortcode(); 
    } 
    

    public function create_shortcode()
    { 
        $app = RMD_Facade_Loader::load_facade('Shortcode'); 

        $app->create_header_ads_shortcode($this->shortcode_header_ads);
        $app->create_sidebar_ads_shortcode($this->shortcode_sidebar_ads);
      
    }
 

    public function create_fitler()
    { 
        $app = RMD_Facade_Loader::load_facade('Filter'); 
        // $app->create_menu_header_ads_filter();
    }



    public function create_setting()
    { 
        $shortcode_header_ads = $this->shortcode_header_ads;
        $shortcode_sidebar_ads = $this->shortcode_sidebar_ads;
       
        $app = RMD_Facade_Loader::load_facade('Setting'); 
        $app->create_ads_setting(compact(
            'shortcode_header_ads',
            'shortcode_sidebar_ads'
            ));

    }

 
}


$RMD_App_Handler = new RMD_App_Handler();
