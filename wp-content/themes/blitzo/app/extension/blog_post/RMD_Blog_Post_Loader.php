<?php    
namespace theme\rmd\extension\blog_post;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class RMD_Blog_Post_Loader 
{    
    public function __construct()
    {   
        $this->load_assets();
        $this->load_app();  
    }

    public function load_assets()
    {  
        require_once(dirname(__FILE__).'/assets/RMD_Assets_Handler.php');  
    } 

    public function load_app()
    {  
        require_once(dirname(__FILE__).'/app/RMD_Facade_Loader.php');  
        require_once(dirname(__FILE__).'/app/RMD_App_Handler.php');  
    }  
}

$RMD_Blog_Post_Loader = new RMD_Blog_Post_Loader();
