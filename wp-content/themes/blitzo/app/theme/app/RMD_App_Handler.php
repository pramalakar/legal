<?php   
namespace theme\rmd\theme\app;

use theme\rmd\theme\app\factories as Factory; 


if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 *  This will manage to load the theme assets and necessary methods.
 */
class RMD_App_Handler 
{   

    public function __construct()
    {    
        $this->create_header_filters();
        $this->create_nav_menus();
        $this->create_page_options();
        $this->create_footer_filters();
        $this->create_admin_settings();
        $this->create_widgets();
        $this->create_utilities(); 
    } 


    public function create_utilities()
    {
        $app = RMD_Facade_Loader::load_facade('Utilities'); 
        $app->create_custom_toolbar();
        $app->create_custom_quicktags(); 
        $app->create_shortcode_site_url();
    }


    public function create_widgets()
    {
        $app = RMD_Facade_Loader::load_facade('Widgets'); 
        $app->create_sidebar_widget_area();
        $app->create_side_navmenu_widget_area();
        $app->create_header_top_left_widget_area();     
        $app->create_header_top_right_widget_area(); 
        $app->create_footer_1_widget_area();
        $app->create_footer_2_widget_area();
        $app->create_footer_3_widget_area();
        $app->create_footer_4_widget_area();

        $app->create_site_logo_widget();
    }



    public function create_admin_settings()
    {
        $app = RMD_Facade_Loader::load_facade('Setting_Header'); 
        $app->create_setting();   

        $app = RMD_Facade_Loader::load_facade('Setting_Footer'); 
        $app->create_setting();  

        $app = RMD_Facade_Loader::load_facade('Setting_Login_Page'); 
        $app->create_setting();    
    }



    public function create_page_options()
    {
        $app = RMD_Facade_Loader::load_facade('Page_Options'); 
        $app->create_page_options();   
    }


    public function create_header_filters()
    {
        $app = RMD_Facade_Loader::load_facade('Filter_Header'); 
        $app->create_filter_site_logo(); 
        $app->create_filter_site_favicon();  
    }


    public function create_footer_filters()
    {
        $app = RMD_Facade_Loader::load_facade('Filter_Footer'); 
        $app->create_filter_site_copyright(); 
        $app->create_filter_site_powered_by(); 
        $app->create_filter_site_logo();  
    }


    public function create_nav_menus()
    {
        $app = RMD_Facade_Loader::load_facade('Navigations'); 
        $app->create_primary_nav_menu(); 
    }
    
}


$RMD_App_Handler = new RMD_App_Handler();