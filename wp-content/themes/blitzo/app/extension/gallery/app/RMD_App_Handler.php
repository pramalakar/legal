<?php    
namespace theme\rmd\extension\gallery\app;
  
use theme\rmd\core\wpquery as Wpquery;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class RMD_App_Handler 
{   
    protected $post_type = 'rmd_gallery';  
    protected $taxonomy = 'rmd_gallery_cat'; 
  
    public function __construct()
    {      
        $this->create_custompost();
        $this->create_tablelist();
        $this->create_settings();
        $this->create_shortcodes();
         
        add_action( 'wp_footer', array($this, 'load_lightbox_template'));
    }


    public function create_shortcodes()
    {
        $post_type = $this->post_type;  
        $taxonomy = $this->taxonomy;
        
        $app = RMD_Factory_Loader::load_factory('shortcodes'); 
        if($app) {
            $app->render(compact('post_type','taxonomy'));
        } 
    }


    public function create_settings()
    {
        $post_type = $this->post_type;  
        $taxonomy = $this->taxonomy;
        
        $app = RMD_Factory_Loader::load_factory('settings'); 
        if($app) {
            $app->render(compact('post_type','taxonomy'));
        } 
    }


    public function create_tablelist()
    {
        $app = RMD_Facade_Loader::load_facade('Tablelist');  
        if($app) {
            $app->create_image_column($this->post_type); 
        }
    }


    public function create_custompost()
    {
        $app = RMD_Facade_Loader::load_facade('Custompost'); 
        if($app) {
            $app->create_post($this->post_type);
            $app->create_metabox_gallery_details($this->post_type);
            $app->create_category($this->post_type, $this->taxonomy);
        }  
    }
            

    public function load_lightbox_template()
    {
        ?>
        <div class="ligtbox-modal"> 
            <div class="content-container">  
                
                <div class="image-contaner">
                    <div class="number-text"></div>
                    <img class="image" alt="" src="" >
                </div> 

                <a class="prev">&#10094;</a>
                <a class="next">&#10095;</a>

                <div class="caption-container">
                    <p class="caption"></p>
                </div>  
            </div>
        </div>
        <div class="ligtbox-modal-backdrop">
            <span class="close cursor" >&times;</span>
        </div>
        <?php
    } 
 
}


$RMD_App_Handler = new RMD_App_Handler();
