<?php
namespace theme\rmd\extension\content_manager\app;

use theme\rmd\core\wppost as Wppost;
use theme\rmd\core\adminpage as Adminpage;
use theme\rmd\core\wplist as Wplist;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 

abstract class RMD_Base_Content_Manager
{	 
	
	protected $parent_post_type = 'rmd_column_container';


	public function create_menu($post_type, $label)
	{  
		$config = array(
				'tag_title'  	=> $label,
				'menu_title' 	=> $label, 
				'menu_title_alias' => $label,
				'page_title' 	=> $label
			);

		if( $this->parent_post_type == $post_type) {
			$menu_type = 'mainmenu';
		} else {
			$menu_type = 'submenu';
		}

		if($menu_type == 'mainmenu') {
			$new_config = array( 
				'menu_icon'		=> 'dashicons-tickets',
				'menu_title' 	=> 'Content Manager',   
				'menu_slug'  	=> 'edit.php?post_type='.$post_type,
				'menu_position' => 26 
			);
			$config = array_merge($config, $new_config); 
			$adminpage_type = 'postmainmenu';
		} else {
			$new_config = array( 
				'menu_slug'		=> 'edit.php?post_type='.$post_type, 
				'parent_slug'  	=> 'edit.php?post_type='.$this->parent_post_type, 
			);
			$config = array_merge($config, $new_config);
			$adminpage_type = 'postsubmenu';
		} 
 
		Adminpage\RMD_Adminpage_Handler::render($adminpage_type, $config);

	}


	public function create_post($post_type, $label)
	{	 
		$config = array( 
				'post_label' => $label, 
				'menu_icon' => 'dashicons-editor-paragraph', 
				'supported_inputs' => array('title'), 
				'supported_taxonomies' => array(''), 
				'exclude_from_search' => TRUE, 
				'post_arguments' => array(  
					'show_in_menu' => FALSE,
					'labels' => array( 
						'add_new_item' => 'Add New '.$label,  
						'edit_item' => 'Edit '.$label,  
					), 
				),  
			);
		$wppost_type = 'custompost'; 
		Wppost\RMD_Wppost_Handler::render($wppost_type, $post_type, $config);

	}



	public function create_metabox_available_shortcode($post_type)
	{  
		if(isset($_GET['post'])) {
			$post_title = get_the_title( $_GET['post'] );
			$input_value = '['.$post_type.' title="'.$post_title.'" post_id="'.$_GET['post'].'"]';
		} else {
			$input_value = 'No available shortcode yet.';
		}

		$wppost_type = 'metabox'; 
		$config = array(
					'id' => 'rmd_cm_metabox_available_shortcode',
			    	'header_title' => 'Available Shortcode',  
				    'inputs' => array(   
						array(
							'input_type'  => 'none',
							'input_label' => '',
							'input_name'  => $post_type.'_shortcode',
							'input_value' => $input_value,
							'input_class' => 'widefat',
							'input_description' => ''
						), 
				     ),
				    'placement' => 'side',       // optional [normal|advanced|side]
					'priority'  => 'high',         // optional [high|sorted|core|default|low] 
				    'bottom_text' => '' //optional
			);
		Wppost\RMD_Wppost_Handler::render($wppost_type, $post_type, $config);

	} 
  	

  	public function create_shortcode_column($post_type)
	{   
		$config = array(
			'post_type' => $post_type,
			'args' => array(
				array(
					'data_type'   => 'shortcode',
					'field_name'  => $post_type.'_shortcode',
					'header_title' => 'Shortcode', 
					'position' => 2,  
					) 
			)
		);

		$wplist_type = 'Addcolumn';
		Wplist\RMD_Wplist_Handler::render($wplist_type, $config);
	} 

}
