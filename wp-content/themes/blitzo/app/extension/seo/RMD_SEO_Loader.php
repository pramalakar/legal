<?php    
namespace theme\rmd\extension\seo;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class RMD_SEO_Loader 
{    
    public function __construct()
    {    
        $this->load_app();  
    } 
    
    public function load_app()
    {  
        require_once(dirname(__FILE__).'/app/RMD_Facade_Loader.php');  
        require_once(dirname(__FILE__).'/app/RMD_App_Handler.php'); 
    }  
}

$RMD_SEO_Loader = new RMD_SEO_Loader();
