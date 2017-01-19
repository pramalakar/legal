<?php   
namespace theme\rmd\extension\google_map\app; 

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}


class RMD_App_Handler 
{   

    protected $shortcode_google_map = 'rmd_google_map';

    public function __construct()
    {     
        $this->create_setting(); 
        $this->create_shortcode(); 
        $this->create_filter();   
    }  
    

    public function create_shortcode()
    {  
        $app = RMD_Facade_Loader::load_facade('Shortcode'); 
        $app->create_google_map_shortcode($this->shortcode_google_map);
    }


    public function create_setting()
    { 
        $shortcode_google_map = $this->shortcode_google_map;

        $app = RMD_Facade_Loader::load_facade('Setting'); 
        $app->create_google_map_setting(compact('shortcode_google_map'));
    }


    public function create_filter()
    {  
        $app = RMD_Facade_Loader::load_facade('Filter'); 
        $app->create_google_map_filter($this->shortcode_google_map);
    }

  
}


$RMD_App_Handler = new RMD_App_Handler();
