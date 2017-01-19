<?php
namespace theme\rmd\core\adminpage;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * RMD_Submenu_Adminpage - this class will manage to create a submenu admin page.
 */
/***
 *	HOW TO USE:
	
	$adminpage_type = 'submenu';

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
		'tag_title'  	=> 'Sub Tag RMD Settings',
		'menu_title' 	=> 'Sub menu RMD Settings', 
		'page_title' 	=> 'Sub Page RMD Theme Setting',
		'menu_slug'  	=> 'sub-menu-slug',
		'parent_slug'  	=> 'main-menu-slug',  
		'inputs' 		=> $inputs_config
	);
	RMD_Adminpage_Handler::render($adminpage_type, $config);


	RETRIEVING THE VALUE:

	$input_value = esc_attr( get_option($input_name) ); 

 *
 */
 
class RMD_Postsubmenu_Adminpage extends RMD_Adminpage 
{	

	/**
	 *	create_sub_menu - this method will trigger the wp action hook 'admin_menu' and call the '_create_sub_menu' 
	 *								method that manage the actual creating of admin submenu.
	 * 	@return void 
	 */
	private function create_sub_menu()
	{ 
		add_action('admin_menu', array($this, '_create_sub_menu'));
	}

	
	/** 
	 *	_create_sub_menu - this method will manage the creation of admin submenu.
	 *
	 *	@return void
	 */
	public function _create_sub_menu()
	{
		extract($this->new_config);

		if( empty($parent_slug) )
		{
			wp_die(__('RMD_Adminpage_Generator requires a \'parent_slug\' if you are creating an admin page submenu.<br>The parent_slug is the menu_slug of the main menu.'));
		}  
			
			$this->page_title = $page_title;

		//add_submenu_page ( string $parent_slug, string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '' ); 
		add_submenu_page($parent_slug, $tag_title, $menu_title, $capability, $menu_slug,  null);
	
	}  


	/**
	 *	render - this method will manage the rendering process of admin page by calling a particular method.
	 *
	 * 	@return void
	 */
	public function render()
	{	 
		$this->create_sub_menu(); 
		$this->create_section_input_fields();
	}
}
