<?php
namespace theme\rmd\extension\courses\app\facades;

use theme\rmd\core\wppost as Wppost;
use theme\rmd\core\adminpage as Adminpage;
use theme\rmd\core\wpquery as Wpquery;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class RMD_Custompost_Facade
{         
	protected $banner_config = array(    
        'banner_overlay_bgcolor' => '#525252', 
		);
 

	/** 
	 *	Courses like category
	 */
  	public function create_post_courses($post_type_course, $post_type_course_outline)
	{	  
		$config = array(
				'post_label' => 'Courses', 
				'menu_icon' => 'dashicons-awards',    
				'supported_taxonomies' => array(''), 
				'supported_inputs' => array('title', 'editor'), 
				'post_arguments' => array(   
					'show_in_menu' => FALSE,
					'labels' => array( 
						'add_new_item' => 'Add New Course',  
						'edit_item' => 'Edit Course',  
					), 
				),  
			);
		$wppost_type = 'custompost'; 
		Wppost\RMD_Wppost_Handler::render($wppost_type, $post_type_course, $config);
 
		$this->_create_metabox_preview_content($post_type_course);  
		$this->_create_metabox_page_options($post_type_course);
		$this->_create_metabox_banner($post_type_course); 
		$this->_create_metabox_wrapper_style($post_type_course);
		$this->_create_metabox_assigned_course_outline($post_type_course, $post_type_course_outline);
		$this->_create_post_course_mainmenu($post_type_course);
	}
  

  	public function _create_metabox_assigned_course_outline($post_type_course, $post_type_course_outline)
	{	   
		if(!isset($_GET['post'])) return;

		$course_id = $_GET['post'];

		$assigned_course_outline_str = '';

		$mypost = new Wpquery\RMD_Wpquery;  
        $mypost->where_post_type($post_type_course_outline);  
        $mypost->where_meta_query('rmd_courses_category', $course_id);

        $results = $mypost->get();  
        if ( $results->have_posts() ) : 
        	while ( $results->have_posts() ) : $results->the_post(); 
        		$id = get_the_ID();
        		$title = get_the_title();  
        		$args = array( 'post' => $id, 'action' => 'edit' );
				$href = add_query_arg( $args, admin_url( 'post.php' ));
        		$assigned_course_outline_str .= '- <a target="_blank" href="'.$href.'">'.$title.'</a><br>';
        	endwhile;   
		endif;   
		wp_reset_postdata();


		$assigned_course_outline_str = ($assigned_course_outline_str != '')? $assigned_course_outline_str : 'No assigned course outline';
		
		$config = array(
				'id' => 'rmd_metabox_assigned_course_outline_id',
		    	'header_title' => 'Assigned Course Outline',  
			    'placement' => 'side',       // optional [normal|advanced|side]
				'priority'  => 'high',         // optional [high|sorted|core|default|low] 
			    'bottom_text' => $assigned_course_outline_str //optional
			);

		$wppost_type = 'metabox'; 
		Wppost\RMD_Wppost_Handler::render($wppost_type, $post_type_course, $config);

	}
 
	
	protected function _create_metabox_banner($post_type)
	{ 	
		$banner_config = $this->banner_config;

		add_action('admin_init', function() use($post_type, $banner_config) {

			extract($this->banner_config);

			$overlay_opacity_options = array( 0 => '-');
			for ($i=1; $i <= 9 ; $i++) { 
				$overlay_opacity_options['0.'.$i] = '0.'.$i;
			}

			$config = array(
				'id' => 'page_metabox_banner_setting_id',
		    	'header_title' => 'Banner Options',  
			    'inputs' => array(    
					array(
			            'input_type'  => 'mediauploader',
						'input_label' => 'Image',
						'input_name'  => 'rmd_banner_image',
						'input_media_caption' => array(
							'upload' => 'Upload Image',
							'remove' => 'Remove Image'
						),
						'input_media_modal_heading' => 'Insert Image',
						'input_media_modal_button' => 'Set Image',
						'input_display' => 'inline'
			        ), 
			        array(
						'input_type'  => 'wpeditor',
						'input_label' => 'Text Content',
						'input_name'  => 'rmd_banner_text_content',
						'input_value' => '',
						'input_class' => 'widefat',  
						'input_description' => '',
						'input_display' => 'inline',
						'input_wpeditor_settings'	=> array( 
							'media_buttons' => FALSE
							)
					),
			        array(
						'input_type'  => 'color',
						'input_label' => 'Overlay Color',
						'input_name'  => 'rmd_banner_overlay_bgcolor', 
						'input_value' => $banner_overlay_bgcolor,
						'input_default' => $banner_overlay_bgcolor,
						'input_display' => 'inline',
					), 
					array(
						'input_type'  => 'dropdown',
						'input_label' => 'Overlay Transparency',
						'input_name'  => 'rmd_banner_overlay_opacity', 
						'input_option' => $overlay_opacity_options,
						'input_description' => '<small><em>Lighter (0.1) to Solid (0.9)</em></small>', 
						'input_display' => 'inline', 
						'input_width' => '110px'
					),  
			    ),
			    'placement' => 'normal',       // optional [normal|advanced|side]
				'priority'  => 'high',         // optional [high|sorted|core|default|low] 
			    'bottom_text' => '' //optional
			);
			$wppost_type = 'metabox'; 
			Wppost\RMD_Wppost_Handler::render($wppost_type, $post_type, $config);

		});
 
	} 



	protected function _create_metabox_preview_content($post_type_course)
	{  
		$wppost_type = 'metabox'; 
		$config = array(
				'id' => 'rmd_metabox_preview_content_id',
		    	'header_title' => 'Preview Content Details',  
			    'inputs' => array(  
			    	array(
			            'input_type'  => 'mediauploader',
						'input_label' => 'Image',
						'input_name'  => 'rmd_courses_preview_image',
						'input_media_caption' => array(
							'upload' => 'Upload Image',
							'remove' => 'Remove Image'
						),
						'input_media_modal_heading' => 'Insert Image',
						'input_media_modal_button' => 'Set Image',
						'input_display' => 'inline'
			        ), 
					array(
						'input_type'  => 'wpeditor',
						'input_label' => 'Description',
						'input_name'  => 'rmd_courses_preview_content',
						'input_value' => '',
						'input_class' => 'widefat',  
						'input_description' => '',
						'input_display' => 'inline'
					), 
			     ),
			    'placement' => 'normal',       // optional [normal|advanced|side]
				'priority'  => 'high',         // optional [high|sorted|core|default|low] 
			    'bottom_text' => '' //optional
			);
		Wppost\RMD_Wppost_Handler::render($wppost_type, $post_type_course, $config);

	} 
 
  

	protected function _create_metabox_page_options($post_type)
	{	
		add_action('admin_init', function() use($post_type) {

			global $wp_registered_sidebars;  

			$widget_sidebar_options = array();
			foreach ($wp_registered_sidebars as $key => $widget) {
				$widget_sidebar_options[$widget['id']] = $widget['name'];
			}
 
			$wppost_type = 'metabox'; 
			$config = array(
					'id' => 'rmd_page_options_metabox_id',
			    	'header_title' => 'Page Options',  
				    'inputs' => array(   
				        array(
							'input_type'  => 'dropdown',
							'input_label' => 'Show Title',
							'input_name'  => 'rmd_page_option_show_title',
							'input_value' => 'yes',
							'input_option' => array(
								'yes' => 'Yes',
								'no' => 'No'
								),
							'input_class' => 'widefat',
							'input_description' => '', 
							'input_display' => 'inline'
						),
						array(
							'input_type'  => 'dropdown',
							'input_label' => 'Layout',
							'input_name'  => 'rmd_page_option_layout',
							'input_value' => 'sidebar_right',
							'input_option' => array( 
								'full_width' => 'Full Width',
								'sidebar_left' => 'Sidebar (Left)',
								'sidebar_right' => 'Sidebar (Right)',
								),
							'input_class' => 'widefat',
							'input_description' => '', 
							'input_display' => 'inline'
						),
						array(
							'input_type'  => 'dropdown',
							'input_label' => 'Widget Sidebar',
							'input_name'  => 'rmd_page_option_widget_sidebar',
							'input_value' => 'sidebar',
							'input_option' =>  $widget_sidebar_options,
							'input_class' => 'widefat',
							'input_description' => '', 
							'input_display' => 'inline',
							'input_description' => 'This is intended the for Sidebar (Left) and Sidebar (Right) layout.'
						) 
				     ),
				    'placement' => 'normal',       // optional [normal|advanced|side]
					'priority'  => 'high',         // optional [high|sorted|core|default|low] 
				 );
			Wppost\RMD_Wppost_Handler::render($wppost_type, $post_type, $config);
		});
	
	}



	public function _create_post_course_mainmenu($post_type)
	{ 
		$config = array(
			'tag_title'  		=> 'Courses',
			'menu_title' 		=> 'Courses',
			'menu_title_alias' 	=> 'Courses',
			'page_title' 		=> 'Courses', 
			'menu_icon'  		=> 'dashicons-awards',
			'menu_slug' 		=> 'edit.php?post_type='.$post_type,
			'menu_position' 	=> 26, 
			);

		$adminpage_type = 'postmainmenu';
		Adminpage\RMD_Adminpage_Handler::render($adminpage_type, $config);
	}


	/** 
	 *	Course Outline
	 */
  	public function create_post_course_outline($post_type_course, $post_type_course_outline)
	{	  
		$config = array(
				'post_label' => 'Course Outline', 
				'menu_icon' => 'dashicons-awards',    
				'supported_taxonomies' => array(''), 
				'supported_inputs' => array('title','editor'), 
				'post_arguments' => array(   
					'show_in_menu' => FALSE,
					'labels' => array( 
						'add_new_item' => 'Add New Course Outline',  
						'edit_item' => 'Edit Course Outline',  
					), 
				),  
			);
		$wppost_type = 'custompost'; 
		Wppost\RMD_Wppost_Handler::render($wppost_type, $post_type_course_outline, $config);
 
		$this->_create_metabox_preview_content($post_type_course_outline);  
		$this->_create_metabox_page_options($post_type_course_outline);
		$this->_create_metabox_banner($post_type_course_outline); 
		$this->_create_metabox_dropdown_courses($post_type_course, $post_type_course_outline);
		$this->_create_metabox_wrapper_style($post_type_course_outline);
		$this->_create_post_course_outline_submenu($post_type_course, $post_type_course_outline);

	}


	public function _create_metabox_dropdown_courses($post_type_course, $post_type_course_outline)
	{	  
		$input_options = array();

		$mypost = new Wpquery\RMD_Wpquery;  
        $mypost->where_post_type($post_type_course);  
        $results = $mypost->get();  
        if ( $results->have_posts() ) : 
        	while ( $results->have_posts() ) : $results->the_post(); 
        		$id = get_the_ID();
        		$title = get_the_title(); 
        		$input_options[$id] = $title;
        	endwhile;   
		endif;   
		wp_reset_postdata();

		
		$config = array(
				'id' => 'rmd_metabox_dropdown_courses_id',
		    	'header_title' => 'Available Courses',  
			    'inputs' => array(   
					array(
						'input_type'  => 'dropdown',
						'input_label' => '',
						'input_name'  => 'rmd_courses_category',
						'input_value' => '',
						'input_class' => 'widefat',  
						'input_description' => '',
						'input_display' => '',
						'input_option' => $input_options
					), 
			     ),
			    'placement' => 'side',       // optional [normal|advanced|side]
				'priority'  => 'high',         // optional [high|sorted|core|default|low] 
			    'bottom_text' => '' //optional
			);

		$wppost_type = 'metabox'; 
		Wppost\RMD_Wppost_Handler::render($wppost_type, $post_type_course_outline, $config);

	}



	public function _create_post_course_outline_submenu($post_type_course, $post_type_course_outline)
	{ 
		$config = array(
			'tag_title'  		=> 'Course Outline',
			'menu_title' 		=> 'Course Outline',
			'menu_title_alias' 	=> 'Course Outline',
			'page_title' 		=> 'Course Outline', 
			'menu_icon'  		=> 'dashicons-awards',
			'menu_slug'		=> 'edit.php?post_type='.$post_type_course_outline, 
			'parent_slug'  	=> 'edit.php?post_type='.$post_type_course, 
			'menu_position' 	=> 26, 
			); 
 
		$adminpage_type = 'postsubmenu';
		Adminpage\RMD_Adminpage_Handler::render($adminpage_type, $config);
	}


	public function _create_metabox_wrapper_style($post_type)
	{ 
		$bgcolor_opacity_options = array( 1 => '-');
		for ($i=1; $i <= 9 ; $i++) { 
			$bgcolor_opacity_options['0.'.$i] = '0.'.$i;
		}

		$bgpadding_options = array();
		for ($i=0; $i <= 100 ; $i+=5) { 
			$bgpadding_options[$i.'px'] = $i.'px';
		}
 
		$config = array(
					'id' => 'rmd_crs_metabox_wrapper_style_id',
			    	'header_title' => 'Wrapper Style',  
				    'inputs' => array(   
						array(
							'input_type'  => 'dropdown',
							'input_label' => 'Padding top',
							'input_name'  => 'rmd_crs_metabox_wrapper_bgpadding_top',
							'input_value' => '',
							'input_option' => $bgpadding_options,
							'input_class' => 'widefat',
							'input_description' => '', 
						),
						array(
							'input_type'  => 'dropdown',
							'input_label' => 'Padding bottom',
							'input_name'  => 'rmd_crs_metabox_wrapper_bgpadding_bottom',
							'input_value' => '',
							'input_option' => $bgpadding_options,
							'input_class' => 'widefat',
							'input_description' => ''
						),  
										 
				     ),
				    'placement' => 'side',       // optional [normal|advanced|side]
					'priority'  => 'core',         // optional [high|sorted|core|default|low] 
				    'bottom_text' => '' //optional
			);

		$wppost_type = 'metabox'; 
		Wppost\RMD_Wppost_Handler::render($wppost_type, $post_type, $config);

	} 


}  

 