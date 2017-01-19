<?php   
namespace theme\rmd\extension\social_media\app; 

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}


class RMD_App_Handler 
{   

    protected $shortcode_social_media = 'rmd_social_media';

    public function __construct()
    {     
        $this->create_setting(); 
        $this->create_shortcode(); 
        $this->create_filter();   
    }  
    

    public function create_shortcode()
    {  
        $app = RMD_Facade_Loader::load_facade('Shortcode'); 
        $app->create_social_media_shortcode($this->shortcode_social_media);
    }


    public function create_setting()
    { 
        $shortcode_social_media = $this->shortcode_social_media;

        $app = RMD_Facade_Loader::load_facade('Setting'); 
        $app->create_social_media_setting(compact('shortcode_social_media'));
    }


    public function create_filter()
    {  
        $app = RMD_Facade_Loader::load_facade('Filter'); 
        $app->create_footer_section_filter($this->shortcode_social_media);
    }

  
}


$RMD_App_Handler = new RMD_App_Handler();
