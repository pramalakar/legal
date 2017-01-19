<?php    
namespace theme\rmd\extension\banner\app;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class RMD_App_Handler 
{    
    protected $shortcode = 'rmd_banner';    
 
    public function __construct()
    {     
        $this->create_page_setting(); 
        $this->create_filter();     
        $this->create_shortcode();
    }

    
    public function create_page_setting()
    {  
        $app = RMD_Facade_Loader::load_facade('Page_Setting'); 
        $app->create_page_setting();
    } 
 

    public function create_filter()
    {   
        $app = RMD_Facade_Loader::load_facade('Filter'); 
        $app->create_banner_filter($this->shortcode); 
    }


    public function create_shortcode()
    {   
        $app = RMD_Facade_Loader::load_facade('Shortcode'); 
        $app->create_banner_shortcode($this->shortcode); 
    } 
 
}


$RMD_App_Handler = new RMD_App_Handler();
