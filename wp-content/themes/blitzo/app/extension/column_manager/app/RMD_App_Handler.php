<?php    
namespace theme\rmd\extension\column_manager\app;
  
use theme\rmd\core\wpquery as Wpquery;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

 
class RMD_App_Handler
{   
    protected $post_type = 'page';
    protected $parent_shortcode = 'rmd_column_manager';
    protected $child_shortcode = 'rmd_column_manager_page_children';


    public function __construct()
    {     
        $this->create_custompost(); 
        $this->create_shortcode();
        $this->manage_tablelist();   
    }
        
        
    public function manage_tablelist()
    {   
        $post_type = $this->post_type;
        $app = RMD_Facade_Loader::load_facade('Tablelist'); 
        $app->create_child_page_identifier_column($post_type);
    }


    public function create_custompost()
    {
        $post_type = $this->post_type;
        $app = RMD_Facade_Loader::load_facade('Custompost'); 

        $app->create_metabox_column_type($post_type);
        $app->create_metabox_child_page_identifier($post_type);
        $app->create_metabox_wrapper_style($post_type);
        
        // the metabox column 1 will be the default editor of wp
        $app->create_metabox_column_container_style($post_type, 1);

        $app->create_metabox_column($post_type, 2);
        $app->create_metabox_column_container_style($post_type, 2);

        $app->create_metabox_column($post_type, 3);
        $app->create_metabox_column_container_style($post_type, 3);

        $app->create_metabox_column($post_type, 4); 
        $app->create_metabox_column_container_style($post_type, 4);

    }
 
    
    public function create_shortcode()
    {
        $post_type = $this->post_type;
        $app = RMD_Facade_Loader::load_facade('Shortcode'); 

        $app->create_parent_shortcode($this->parent_shortcode);
        $app->create_child_shortcode($this->child_shortcode);
        
    }

}
 
$RMD_App_Handler = new RMD_App_Handler();
 
