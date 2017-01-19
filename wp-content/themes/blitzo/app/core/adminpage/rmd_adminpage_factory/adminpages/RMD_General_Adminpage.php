<?php
namespace theme\rmd\core\adminpage;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
} 
/**
 * RMD_General_Adminpage - this class will manage to create a additional input field within the general setting page.
 */
/***
 *	HOW TO USE:
	
	$adminpage_type = 'general';

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
		'inputs' => $inputs_config
	);
	RMD_Adminpage_Handler::render($adminpage_type, $config);


	RETRIEVING THE VALUE:

	$input_value = esc_attr( get_option($input_name) ); 

 *
 */ 
 
class RMD_General_Adminpage extends RMD_Adminpage 
{	 
	private $menu_slug = 'general';

		/**
	 *	set_new_config - this method will manage the set up the new config for this specific menu slug.
	 *
	 * 	@return void
	 */
	private function set_new_config()
	{
		$this->new_config   = array_merge($this->new_config, array('menu_slug' => $this->menu_slug));
		$this->option_group = $this->menu_slug;
	}

	/**
	 *	render - this method will manage the rendering process of admin page by calling a particular method.
	 *
	 * 	@return void
	 */
	public function render()
	{	 
		$this->set_new_config(); 
		$this->create_section_input_fields();
	}
}
