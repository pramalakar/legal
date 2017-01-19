<?php    
namespace theme\rmd\extension\social_media;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class RMD_Social_Media_Loader 
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

$RMD_Social_Media_Loader = new RMD_Social_Media_Loader();
