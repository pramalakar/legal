<?php
namespace theme\rmd\core\adminpage;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * RMD_Mainmenu_Adminpage - this class will manage to create a main menu admin page.
 */ 
/***
 *	HOW TO USE:
	
	$adminpage_type = 'mainmenu';

	$inputs_config = array( 
				array(
					'section_title' => 'Section Title',
					'section_description' => 'Section Description',
					'inputs' => array(
						array(
							'input_label' => 'First Name',
							'input_name'  => 'first_name'
						),
						array(
							'input_label' => 'Last Name',
							'input_name'  => 'last_name'
						)
					)
				)
			);
	
	$config = array(
		'tag_title'  		=> 'Tag RMD Settings',
		'menu_title' 		=> 'Menu RMD Settings',
		'menu_title_alias' 	=> 'Alias RMD Theme Setting',
		'page_title' 		=> 'Page RMD Theme Setting',
		'menu_slug'  		=> 'edit.php?post_type=rmd_cm_four_column',
		'menu_icon'  		=> 'dashicons-admin-tools',
		'menu_position' 	=> 110,
		'inputs' 			=> $inputs_config, 
	);
	RMD_Adminpage_Handler::render($adminpage_type, $config);


	RETRIEVING THE VALUE:

	$input_value = esc_attr( get_option($input_name) ); 

 *
 */ 
 
class RMD_Postmainmenu_Adminpage extends RMD_Adminpage 
{	
	/**
	 *	create_main_menu - this method will trigger the wp action hook 'admin_menu' and call the '_create_main_menu' 
	 *								method that manage the actual creating of admin main menu.
	 * 	@return void 
	 */
	private function create_main_menu()
	{ 
		add_action('admin_menu', array($this, '_create_main_menu'));
	}


	/** 
	 *	_create_main_menu - this method will manage the creation of admin main menu.
	 *
	 *	@return void
	 */
	public function _create_main_menu()
	{
		extract($this->new_config);
			
		if( ! empty($page_title) ) {
			$this->page_title = $page_title;
		} else {
			if( ! empty($menu_title_alias) ) {
				$this->page_title = $menu_title_alias;
			} else {
				$this->page_title = $menu_title;
			}
		}

		//add_menu_page ( string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '', string $icon_url = '', int $position = null )
		add_menu_page($tag_title, $menu_title, $capability, $menu_slug, null, $menu_icon, $menu_position);

		$menu_title_alias = ( ! empty($menu_title_alias) ) ? $menu_title_alias : $menu_title;
		$parent_slug = $menu_slug;  

		//add_submenu_page ( string $parent_slug, string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '' ); 
		add_submenu_page($parent_slug, $tag_title, $menu_title_alias, $capability, $menu_slug,  null);
	
	}  


	/**
	 *	render - this method will manage the rendering process of admin page by calling a particular method.
	 *
	 * 	@return void
	 */
	public function render()
	{	 
		$this->create_main_menu(); 
		$this->create_section_input_fields();
	}
}
