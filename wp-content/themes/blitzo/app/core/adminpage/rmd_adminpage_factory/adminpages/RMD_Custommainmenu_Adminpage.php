<?php
namespace theme\rmd\core\adminpage;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * RMD_Custommainmenu_Adminpage - this class will manage to create a custom main menu admin page.
 */
/***
 *	HOW TO USE:
	
	$adminpage_type = 'custommainmenu';
	
	$config = array(
		'tag_title'  	=> 'Custom Tag RMD Settings',
		'menu_title' 	=> 'Custom Menu RMD Settings', 
		'page_title' 	=> 'Custom Page RMD Theme Setting', 
		'menu_slug'  	=> 'custom-main-menu-slug',   
		'template_path' => RMDEXTENSIONPATH.'views/sample.php',
		'page_data' 	=> array('name'=>'raymond')
		);
	RMD_Adminpage_Handler::render($adminpage_type, $config);


	RETRIEVING THE VALUE:

	$input_value = esc_attr( get_option($input_name) ); 

 *
 */

 
class RMD_Custommainmenu_Adminpage extends RMD_Adminpage 
{	 
	/**
	 *	create_custom_admin_main_menu - this method will trigger the wp action hook 'admin_menu' and call the '_create_custom_admin_main_menu' 
	 *								method that manage the actual creating of admin main menu. 
	 * 	@return void
	 */
	private function create_custom_admin_main_menu()
	{ 
		add_action('admin_menu', array($this, '_create_custom_admin_main_menu'));
	}

	/** 
	 *	_create_custom_admin_main_menu - this method will manage the creation of admin main menu.
	 *
	 *	@return void
	 */
	public function _create_custom_admin_main_menu()
	{
		extract($this->new_config);

		//add_menu_page ( string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '', string $icon_url = '', int $position = null )
		add_menu_page($tag_title, $menu_title, $capability, $menu_slug, array($this, '_create_custom_admin_main_menu_page'), $menu_icon, $menu_position);

		$menu_title_alias = ( ! empty($menu_title_alias) ) ? $menu_title_alias : $menu_title;
		$parent_slug = $menu_slug;   

		add_submenu_page($parent_slug, $tag_title, $menu_title_alias, $capability, $menu_slug, array($this, '_create_custom_admin_main_menu_page'));
	}  

	/** 
	 *	_create_custom_admin_main_menu_page - this method will manage the creation of admin main menu page.
	 *
	 *	@return void
	 */
	public function _create_custom_admin_main_menu_page()
	{ 	  
		extract($this->new_config); 

		if(!current_user_can($capability))
		{
			wp_die(__('You do not have sufficient permissions to access this page.'));
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
		$this->create_custom_admin_main_menu(); 
	}

}

