<?php   
namespace theme\rmd\extension\blog_post\app;
  

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}


class RMD_App_Handler 
{   

    protected $shortcode_blog_post = 'rmd_latest_blog_post';

    public function __construct()
    {     
        $this->create_setting(); 
        $this->create_shortcode();  
    }  
    

    public function create_shortcode()
    {  
        $app = RMD_Facade_Loader::load_facade('Shortcode'); 
        $app->create_blog_post_shortcode($this->shortcode_blog_post);
    }


    public function create_setting()
    { 
        $shortcode_blog_post = $this->shortcode_blog_post;

        $app = RMD_Facade_Loader::load_facade('Setting'); 
        $app->create_blog_post_setting(compact('shortcode_blog_post'));
    } 
  
}


$RMD_App_Handler = new RMD_App_Handler();
