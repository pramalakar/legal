<?php
namespace theme\rmd\core\wppost;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 *	RMD_Custompost_Wppost - this class will manage to create a wp custom post.
 */
/***
 *	HOW TO USE:
	
	$wppost_type = 'custompost'; // this will be the basis of loading a specific file.
	$post_type = 'news';
	$config = array(
			'post_label' => 'My News',
			'title_placeholder' => 'Enter news title here',
			'menu_icon' => 'dashicons-admin-appearance',
			'menu_position' => 26,
			'supported_inputs' => array('title', 'editor', 'thumbnail'), 
			'supported_taxonomies' => array('category'),
			'exclude_from_search' => FALSE,
			'post_arguments' => array( 
				'label' => 'My News',
				'labels' => array( 
					'add_new_item' => 'Add New News', //Default is Add New Post/Add New Page.
					'edit_item' => 'Edit News', //Default is Edit Post/Edit Page. 
				), 
			), 
		);
	RMD_Wppost_Handler::render($wppost_type, $post_type, $config);

 *
 */ 
 
class RMD_Custompost_Wppost extends RMD_Wppost 
{	
	/**
	 *	$new_config - this property will be stored all the new config from the user.
	 */
	private $new_config = array();

	/**
	 *	$new_post_arguments - this property will be stored all the new post arguments from the user, 
	 *	which will be used for creating the custom post.
	 */
	private $new_post_arguments = array();

	/**
	 *	$post_title_placeholder - this property will serve as the holder of the input title placeholder.
	 */
	private $post_title_placeholder = '';

	/**
	 *	$default_config - this property will serve as the default config setting.
	 */
	private $default_config = array(
			'post_label' => '',
			'title_placeholder' => 'Enter title here',
			'menu_icon' => 'dashicons-admin-appearance',
			'menu_position' => 26,
			'supported_inputs' => array('title', 'editor', 'comments', 'excerpt','thumbnail'), 
			'supported_taxonomies' => array('category','post_tag'),
			'exclude_from_search' => FALSE,
			'post_arguments' => array(), 
			);

	/**
	 *	$default_post_arguments - this property will serve as the default post arguments setting.
	 */
	private $default_post_arguments  = array(
				'label'  => 'Menu Label', // this will display at the admin panel menu
				'labels' => array(   
					//'name' => '', //general name for the post type, usually plural. The same and overridden by $post_type_object->label. Default is Posts/Pages
					//'singular_name' => '', //name for one object of this post type. Default is Post/Page
					//'add_new' => '', //the add new text. The default is "Add New" for both hierarchical and non-hierarchical post types. When internationalizing this string, please use a gettext context matching your post type. Example: _x('Add New', 'product');
					'add_new_item' => 'Add New Label', //Default is Add New Post/Add New Page.
					'edit_item' => 'Edit Label', //Default is Edit Post/Edit Page.
					//'new_item' => '', //Default is New Post/New Page.
					//'view_item' => '', //Default is View Post/View Page.
					//'search_items' => '', //Default is Search Posts/Search Pages.
					//'not_found' => '', //Default is No posts found/No pages found.
					//'not_found_in_trash' => '', //Default is No posts found in Trash/No pages found in Trash.
					//'parent_item_colon' => '', //This string isn't used on non-hierarchical types. In hierarchical ones the default is 'Parent Page:'.
					//'all_items' => '', //String for the submenu. Default is All Posts/All Pages.
					//'archives' => '', //String for use with archives in nav menus. Default is Post Archives/Page Archives.
					//'insert_into_item' => '', //String for the media frame button. Default is Insert into post/Insert into page.
					//'uploaded_to_this_item' => '', //String for the media frame filter. Default is Uploaded to this post/Uploaded to this page.
					//'featured_image' => '', //Default is Featured Image.
					//'set_featured_image' => '', //Default is Set featured image.
					//'remove_featured_image' => '', //Default is Remove featured image.
					//'use_featured_image' => '', //Default is Use as featured image.
					//'menu_name' => '', //Default is the same as `name`.
					//'filter_items_list' => '', //String for the table views hidden heading.
					//'items_list_navigation' => '', //String for the table pagination hidden heading.
					//'items_list' => '', //String for the table hidden heading.
					//'name_admin_bar' => '', //String for use in New in Admin menu bar. Default is the same as `singular_name`. 
					),
				//'description' 	=> '',
				'public'    	=> true, // boolean //to make it viewable and searchable
				//'exclude_from_search' => false, 
				//'show_ui' 		=> true,
				//'show_in_nav_menus' => true,
				//'show_in_menu' => true,
				//'show_in_admin_bar' => true,
				'menu_position' => 26,
					// 5 - below Posts
					// 10 - below Media
					// 15 - below Links
					// 20 - below Pages
					// 25 - below comments
					// 60 - below first separator
					// 65 - below Plugins
					// 70 - below Users
					// 75 - below Tools
					// 80 - below Settings
					// 100 - below second separator
				//'menu_icon' 		=> '', 
				'has_archive' 	=> true,  
				//'supports'   	=> array('title', 'editor', 'comments', 'excerpt','thumbnail'),
				//'taxonomies' 	=> array('category','post_tag'),  
				//'capability_type' => 'post',
				//'hierarchical' 	=> false, 
			); 
	 
	
	
	/**
	 *	[ set_post_arguments - this method will manage to overwrite the default post arguments with the new post arguments base on the config 
	 *						   and store it in the $new_post_arguments property. ]
	 *
	 *	@param 	[array] 	[ $post_arguments - the new set of post arguments ]
	 *	@return [object]	[ current class ]
	 */
	private function set_post_arguments(array $post_arguments = array())
	{
		$this->new_post_arguments = array_merge($this->default_post_arguments, $this->new_post_arguments, $post_arguments);
		return $this;
	}



	/**
	 *	[ set_default_post_label - this method will manage to set the default post label like 'Add New News', 'Edit News', 
	 *							 	and 'News' where it usually placed in the admin menu ]
	 *
	 *	@param 	[string] 	[ $post_type - the post type ]
	 *	@return [object]	[ current class ]
	 */
	private function set_default_post_label($post_type)
	{ 
		$label = ucwords(str_replace('_', ' ', $post_type));
		$this->new_post_arguments = array_merge($this->new_post_arguments, array(
				'label'  => $label, // this will display at the admin panel menu
				'labels' => array( 
					'add_new_item' => "Add New $label",
					'edit_item'    => "Edit $label"
					),
			)); 
		return $this;
	} 


	/**
	 *	[ set_post_label - this method will manage to set the new post label like 'Add New News', 'Edit News', 
	 *						and 'News' where it usually placed in the admin menu ]
	 *
	 *	@param 	[string]	[ $post_label - your preferred post label] 
	 *	@return [object]	[ current class ]
	 */
	private function set_post_label($post_label = '')
	{ 
		$new_label = ( empty($post_label) )? $this->post_type : $post_label;

		$label = ucwords(str_replace('_', ' ', $new_label));
		$this->new_post_arguments = array_merge($this->new_post_arguments, array(
				'label'  => $label, // this will display at the admin panel menu
				'labels' => array( 
					'add_new_item' => "Add New $label",
					'edit_item'    => "Edit $label"
					),
			)); 
		return $this;
	} 



	/**
	 *	[ set_post_menu_icon - the icon will display at beside the menu label ] 
	 *
	 *	@param 	[string] 	[ $icon - the icon that will display beside the menu title ] 
	 *						[ - Ex., get_template_directory_uri().'/img/icon.png'; (20px)x(20px) ]
	 *						[ - available icons can be acquire thru this link - https://developer.wordpress.org/resource/dashicons/ - Ex., dashicons-admin-customizer ]
	 *	@return [object]	[ current class ]
	 */
	private function set_post_menu_icon($icon = '')
	{  
		if( ! empty($icon)) {
			$this->new_post_arguments = array_merge($this->new_post_arguments, array(
					'menu_icon'  => $icon
				));
		} 
		return $this;
	}


	/**
	 *	[ set_post_menu_position - setting up the post menu position that will place on the sidebar admin menu ]
	 *
	 *	@param 	[integer]	[ $position - your preferred numeric position like 26 ]
	 *	@return [object]	[ current class ]
	 */
	private function set_post_menu_position($position = 26)
	{  
		$this->new_post_arguments = array_merge($this->new_post_arguments, array(
				'menu_position'  => $position
			)); 
		return $this;
	} 


	/**
	 *	[ set_post_supports - setting up the post supports like title, editor, excerpts, etc... ]
	 *
	 *	@param 	[array]		[ $supported_inputs - supported inputs like 'title', 'editor', 'comments', 'excerpt','thumbnail' ]
	 *	@return [object]	[ current class ]	
	 */
	private function set_post_supported_inputs($supported_inputs = array('title', 'editor', 'comments', 'excerpt','thumbnail'))
	{  
		$this->new_post_arguments = array_merge($this->new_post_arguments, array(
				'supports'  => $supported_inputs
			));
		return $this;
	} 


	/**
	 *	[ set_post_title_placeholder - setting up the post title that will display in the add or edit post title field ]
	 *
	 *	@param 	[string]	[ $post_title_placeholder - your preferred post title placeholder ]
	 *	@return [object]	[ current class ]
	 */
	private function set_post_title_placeholder($post_title_placeholder = 'Enter title here') 
	{
		$this->post_title_placeholder = $post_title_placeholder;
		return $this;
	}


	/**
	 *	[ set_supported_taxonomies - this will set the supprted taxonomies that willbe part of the post ]
	 *
	 *	@param 	[array] 	[ $supported_taxonomies - this content the taxonomy that you to be part of the post ]
	 *	@return [object]	[ current class ]
	 */
  	private function set_post_supported_taxonomies($supported_taxonomies = array())
  	{
  		if( ! empty($supported_taxonomies)) {
  			$this->new_post_arguments = array_merge($this->new_post_arguments, array(
					'taxonomies'  => $supported_taxonomies
				));
  		} 
  		return $this;
  	}


  	/**
	 * 	[ set_post_exclude_from_search - this method will manage to exclude a post from search results if it is set to TRUE. ]
	 * 
	 *	@param 	[boolean] 	[ $value - if TRUE, it will exclude the post from search results otherwise it will be included ]
	 *	@return [object]	[ current class ]
	 */
  	private function set_post_exclude_from_search($value = false)
	{ 
		if( empty($value) ) return;

		$this->new_post_arguments = array_merge($this->new_post_arguments, array(
				'exclude_from_search'  => $value,  
			)); 
		return $this;
	} 


	/**
	 * 	[ create_custom_post - this method will manage to create the custom post where it automaticaaly generate a admin menu 
	 *							and also it manage the filtering of its title placeholder ]
	 * 
	 *	@return [void]
	 */ 
	private function create_custom_post() 
	{	  
 		$post_type 		= $this->post_type;
 		$post_arguments = $this->new_post_arguments; 

 		add_filter('enter_title_here',array($this,'replace_post_title_placeholder'));

		add_action('init', function() use($post_type, $post_arguments) {  
			register_post_type($post_type,$post_arguments);  
		});
	}


	/**
	 * 	[ replace_post_title_placeholder - this will replace the default post title placeholder base on what you have set ]
	 *
	 *	@param 	[string]	[ $title - the post title placeholder the will replace the default one ]
	 *	@return [string]	[ Return a customizes title placeholder to the wp filter hook 'enter_title_here' ]
	 */ 
	public function replace_post_title_placeholder($title)
	{
		$screen = get_current_screen();
		if($screen->post_type == $this->post_type) {
			$title = $this->post_title_placeholder;
		}
		return $title;
	} 
  	

	/**
	 * 	[ render - this method will manage to set all the necessary config setting then call the appropriate method 
	 *				that manage for the creating of custom post.]
	 *
	 * 	@return [void]
	 */
	public function render()
	{	 
		$this->new_config = array_merge($this->default_config, $this->config);
		extract($this->new_config);
			 
		$this->set_default_post_label($this->post_type); 
		$this->set_post_label($post_label);  
		$this->set_post_menu_icon($menu_icon);
		$this->set_post_menu_position($menu_position);
		$this->set_post_supported_inputs($supported_inputs); 
		$this->set_post_supported_taxonomies($supported_taxonomies);
 		$this->set_post_exclude_from_search($exclude_from_search);
 		$this->set_post_title_placeholder($title_placeholder); 

 		// the post arguments will be the main priority for the config setting.
 		// therefore it will overwrite the previous settings if it exist in the post arguments.
		$this->set_post_arguments($post_arguments);   

 		$this->create_custom_post();

	}

}
