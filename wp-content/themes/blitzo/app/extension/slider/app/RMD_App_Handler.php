<?php    
namespace theme\rmd\extension\slider\app;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class RMD_App_Handler 
{   
    protected $post_type = 'rmd_slider';  
    protected $taxonomy = 'rmd_slider_cat';  
 
    public function __construct()
    {    
        $this->create_custompost(); 
        $this->create_page_setting(); 
        $this->create_tablelist();    
        $this->create_shortcode();
        $this->create_filter();        
    }

    
    public function create_filter()
    {   
        $app = RMD_Facade_Loader::load_facade('Filter'); 
        $app->create_slider_filter($this->post_type); 
    }


    public function create_shortcode()
    {   
        $app = RMD_Facade_Loader::load_facade('Shortcode'); 
        $app->create_slider_shortcode($this->post_type, $this->taxonomy); 
    } 



    public function create_custompost()
    {  
        $app = RMD_Facade_Loader::load_facade('Custompost'); 
        $app->create_post($this->post_type);
        $app->create_metabox_image_detail($this->post_type);
        $app->create_metabox_caption_details($this->post_type);
        $app->create_metabox_button_details($this->post_type);
        $app->create_category($this->post_type, $this->taxonomy);
    } 


    public function create_page_setting()
    {  
        $app = RMD_Facade_Loader::load_facade('Page_Setting'); 
        $app->create_page_setting();
    } 


    public function create_tablelist()
    {    
        $app = RMD_Facade_Loader::load_facade('Tablelist'); 
        $app->manage_title_column($this->post_type);
        $app->create_image_column($this->post_type);
    } 
 
}


$RMD_App_Handler = new RMD_App_Handler();
