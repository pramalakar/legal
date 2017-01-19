<?php
namespace theme\rmd\theme\app\facades;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
 
class RMD_Navigations_Facade 
{      
	
	public function create_primary_nav_menu()
	{
		// This theme uses wp_nav_menu() in one location.
		add_action( 'after_setup_theme', function(){
			register_nav_menus( array(
				'primary' => esc_html__( 'Primary Menu', 'blitzo' ),
			) ); 
		} );   
	}  
		 
}  
  

 