<?php 
namespace theme\rmd\core\adminpage;

use theme\rmd\core\input as Input;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

 
abstract class RMD_Adminpage 
{	
	/**
	 *	$new_config - this property will serve as the new config based on the default and user config setting.
	 */
	protected $new_config = array();
 	
 	/**
	 *	$default_config - this property will serve as the default config setting.
	 */
 	protected $default_config = array( 
 				'tag_title'  		=> 'Custom Menu',
				'menu_title' 		=> 'Custom Menu',
				'menu_title_alias' 	=> '',
				'page_title' 		=> 'Custom Menu',
				'menu_slug'  		=> 'custom-menu-slug',
				'parent_slug'		=> '',
				'menu_icon'  		=> 'dashicons-admin-tools',
				'menu_position' 	=> 110, 
				'capability' 		=> 'manage_options',
				'inputs' 			=> array(),
				'template_path' 	=> null,
				'page_data' 		=> array()
			);

 	/**
	 *	$option_group - this property will serve as the option group for the admin page.
	 */
 	protected $option_group = '';


 	/**
	 *	$page_title - this will serve as the final page title.
 	 */ 
 	protected $page_title = ''; 



	public function __construct( array $config = array())
	{ 	
		$this->new_config = array_merge($this->default_config, $config);
		extract($this->new_config);

		$this->option_group = $menu_slug.'-group'; 
	}


	/**
	 *	_create_form_admin_page - this method will manage to create a form admin page, where we can set our custom site setting. 
	 *
	 * 	@return void
	 */
	public function _create_form_admin_page()
	{ 
		extract($this->new_config);

		if(!current_user_can($capability))
		{
			wp_die(__('You do not have sufficient permissions to access this page.'));
		}   

		global $submenu;   
 
		$current_page = '';
		if(isset($_GET['page'])) {
			$current_page = $_GET['page'];
		}

		if(!empty($parent_slug)) {
			$main_menu_slug = $parent_slug;
		} else {
			$main_menu_slug = $menu_slug;
		}

		?>
			<style type="text/css">.notice { display: none; } .rmd-admin-alert .notice { display: block; } </style>
			<form method="post" action="options.php" >
				<div class="rmdwp-admin-setting-container" >
					<header><div class="logo"></div></header>
					<aside>
					<?php

						if(isset($submenu[$main_menu_slug])) {
							$li = '';
							foreach ($submenu[$main_menu_slug] as $key => $value) { 
								$url = add_query_arg( 
								    array( 
								        'page' => $value[2]
								    ), 
								    admin_url('admin.php')
								);   
								$active = ($current_page == $value[2])? 'active' : '';
								$li .= '<li class="'.$active.'"><a class="menu" href="'.$url.'">'.$value[0].'</a></li>';
							}
							echo '<ul class="side-menu">'.$li.'</ul>';
						} else { 
							$url = add_query_arg( 
							    array( 
							        'page' => $main_menu_slug
							    ), 
							    admin_url('admin.php')
							);
							$active = ($current_page == $main_menu_slug)? 'active' : '';
							$li = '<li class="'.$active.'"><a class="menu" href="'.$url.'">'.$menu_title.'</a></li>';;
							echo '<ul class="side-menu">'.$li.'</ul>';
						}
					?>
					</aside>
					<div class="content" >
						<div class="rmd-admin-alert"><?php settings_errors(); ?></div> 
						<h3><?php echo $this->page_title; ?></h3>  
						<?php settings_fields($this->option_group); ?>
						<?php do_settings_sections($menu_slug); ?> 
					</div>
					<footer><?php submit_button(); ?></footer>
				</div>
			</form>
			
		<?php
	}


	/**
	 *	create_section_input_fields - this method will manage to trigger a wp action hook 'admin_init'
	 *								to call a specifef call function for creating the input fields. 
	 *	@return void
	 */
	protected function create_section_input_fields()
	{
		add_action('admin_init', array($this, '_create_section_input_fields') );
	}


	/**
	 *	_create_section_input_fields - this method will manage to create the section input fields for the admin page. 
	 *
	 *	@return void
	 */
	public function _create_section_input_fields()
	{	 
		extract($this->new_config); 

		$section_input_fields = $inputs;

		foreach ($section_input_fields as $key => $section) 
		{ 	
			$ctr = $key + 1;
			$section_id 		 = $menu_slug.'-section-'.$ctr;
			$section_title 		 = $section['section_title'];
			$section_description = $section['section_description'];

			// Setting up the section group for a particular inputs
			add_settings_section($section_id, $section_title, function() use($section_description) {
				echo $section_description;
			}, $menu_slug);
			//add_settings_section($id, $title, $callback, $page);

			$inputs = $section['inputs']; 
			
			foreach ($inputs as $key => $new_input) 
			{ 	  
				$input_name  = isset($new_input['input_name']) ? $new_input['input_name'] : ''; 
				$input_label = isset($new_input['input_label']) ? $new_input['input_label'] : '';  
				$input_value = isset($new_input['input_value']) ? $new_input['input_value'] : '';

				
				// This manage the part of saving the input setting.
				register_setting($this->option_group, $input_name, function( $new_input ) {
					return $new_input; //sanitize_text_field( $new_input );
				});
				//register_setting($option_group, $option_name, $sanitize_callback);


				// Setting up the input field to be part of the wp database and set it to a particular section group.
				add_settings_field($input_name, $input_label, function() use($new_input, $input_name, $input_value) {
					$new_input_value = esc_attr( get_option($input_name) ); 
					$new_input_value = ( ! empty($new_input_value))? $new_input_value : $input_value; 
					$new_input 		= array_merge($new_input, array('input_value' => $new_input_value));

					$this->create_input_field($new_input);

				}, $menu_slug, $section_id); 
				//add_settings_field($id, $title, $callback, $page, $section, $args);
			}

		}

	}


	/**
	 *	create_input_field - this method will manage to generate the specific input type with the help of RMD_Input_Handler.
	 *
	 *	@return void
	 */
	public function create_input_field($input_attr)
	{ 	 
		$input_attr = array_merge($input_attr, array('input_label'=>''));
 
		echo Input\RMD_Input_Handler::render($input_attr); 
	}



	abstract public function render();

}

