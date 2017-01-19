<?php
namespace theme\rmd\core\adminpage;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * RMD_Customsubmenu_Adminpage - this class will manage to create a custom submenu admin page.
 */
/***
 *	HOW TO USE:
	
	$adminpage_type = 'customsubmenu';
	
	$config = array(
		'tag_title'  	=> 'Custom Tag RMD Settings',
		'menu_title' 	=> 'Custom Menu RMD Settings', 
		'page_title' 	=> 'Custom Page RMD Theme Setting', 
		'menu_slug'  	=> 'custom-sub-menu-slug',
		'parent_slug'  	=> 'custom-main-menu-slug',   
		'template_path' => RMDEXTENSIONPATH.'views/sample.php',
		'page_data' 	=> array('name'=>'raymond')
		);
	RMD_Adminpage_Handler::render($adminpage_type, $config);


	RETRIEVING THE VALUE:

	$input_value = esc_attr( get_option($input_name) ); 

 *
 */   
 
class RMD_Customsubmenu_Adminpage extends RMD_Adminpage 
{	
	/**
	 *	create_custom_admin_submenu - this method will trigger the wp action hook 'admin_menu' and call the '_create_custom_admin_submenu' 
	 *								method that manage the actual creating of admin submenu. 
	 * 	@return void 
	 */
	private function create_custom_admin_submenu()
	{ 
		add_action('admin_menu', array($this, '_create_custom_admin_submenu'));
	}

	
	/** 
	 *	_create_custom_admin_submenu - this method will manage the creation of admin submenu.
	 *
	 *	@return void
	 */
	public function _create_custom_admin_submenu()
	{
		extract($this->new_config);

		if( empty($parent_slug) )
		{
			wp_die(__('RMD_Adminpage_Generator requires a \'parent_slug\' if you are creating an admin page submenu.<br>The parent_slug is the menu_slug of the main menu.'));
		}  
			
			$this->page_title = $page_title;

			//add_submenu_page ( string $parent_slug, string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '' ); 
		add_submenu_page($parent_slug, $tag_title, $menu_title, $capability, $menu_slug,  array($this, '_create_custom_admin_submenu_page'));
	
	}  


	/** 
	 *	_create_custom_admin_submenu_page - this method will manage the creation of admin submenu page.
	 *
	 *	@return void
	 */
	public function _create_custom_admin_submenu_page()
	{ 	  
		extract($this->new_config); 

		if(!current_user_can($capability))
		{
			wp_die(__('You do not have sufficient permissions to access this page.'));
		}  

		if( empty($parent_slug) )
		{
			wp_die(__('RMD_Adminpage_Generator requires a \'parent_slug\' if you are creating an admin page submenu.<br>The parent_slug is the menu_slug of the main menu.'));
		} 

		if( ! isset($template_path)) 
		{
			wp_die(__('RMD_Adminpage_Generator requires a \'template_path\' if you are creating a custom admin page.'));
		} 

		extract($page_data);
		require_once($template_path);

	}


	/**
	 *	render - this method will manage the rendering process of admin page by calling a particular method.
	 *
	 * 	@return void
	 */
	public function render()
	{	 
		$this->create_custom_admin_submenu(); 
	}
}

