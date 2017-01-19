<?php 
namespace theme\rmd\core\wppost;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 *	RMD_Taxonomy_Wppost - this class will manage to create a custom taxonomy for a particular post type.
 */ 
/***
 *	HOW TO USE:

	$wppost_type = 'taxonomy';
	$post_type = 'news';

	$config = array(
			'taxonomy'  	=> 'my_category', 
			'args' 			=> array(),
			'like_category' => TRUE,
			'placement' 	=> 'side',       // optional [normal|advanced|side]
			'priority'  	=> 'core',       // optional [high|sorted|core|default|low] 
		);
	RMD_Wppost_Handler::render($wppost_type, $post_type, $config);

	$config = array(
			'taxonomy'  	=> 'my_tag', 
			'args' 			=> array(),
			'like_category' => FALSE,
			'placement' 	=> 'side',       // optional [normal|advanced|side]
			'priority'  	=> 'core',       // optional [high|sorted|core|default|low] 
		);
	RMD_Wppost_Handler::render($wppost_type, $post_type, $config);

 */ 

 
class RMD_Taxonomy_Wppost extends RMD_Wppost 
{	
	/**
		 *	$default_config - this property will be the default config.
	 */
	private $default_config = array(
		'taxonomy'  	=> '', 
		'args' 			=> array(),
		'like_category' => TRUE,
		'placement' 	=> 'side',       // optional [normal|advanced|side]
		'priority'  	=> 'core',       // optional [high|sorted|core|default|low] 
		);


		/**
	 * 	[ create_taxonomy - this will create a menu like category and tag ]
	 *
	 * 	@param 	[string]	[ $taxonomy - the taxonomy name like category, tag, language, difficulty ]
	 * 	@param 	[string]	[ $post_type - like post, page, attachment, custom post type like snippet ]
	 * 	@param 	[array]		[ $args - you can refer to the _create_taxonomy_like_categories and _create_taxonomy_like_tags methods ]
	 *	@param 	[boolean]	[ $like_category - true for taxonomy that looks like the category, otherwise it will looks like the tags ]
	 *	@return [void]
	 */
	private function create_taxonomy($taxonomy, $post_type, array $args = array(), $like_category = TRUE) 
	{	   
		$label_taxonomy = $this->get_label_taxonomy($taxonomy, $args);
		$taxonomy       = $this->get_taxonomy_name($taxonomy);
 		
		if( $like_category ) {
			$this->_create_taxonomy_like_categories($post_type, $args, $taxonomy, $label_taxonomy);
		} else {
			$this->_create_taxonomy_like_tags($post_type, $args, $taxonomy, $label_taxonomy);
		} 

	}



	/**
	 * 	[ _create_taxonomy_like_categories - this will create a taxonomy like categories ]
	 *
	 * 	@param 	[string]	[ $post_type - like post, page, attachment, custom post type like snippet ]
	 * 	@param 	[array]		[ $args - the arguments or setting of the taxonomy ]
	 * 	@param 	[string]	[ $taxonomy - the taxonomy name like category, language, difficulty ]
	 *	@param 	[string]	[ $label_taxonomy - the label that can be use for every label setting ]
	 *	@return [void]
	 */
	private function _create_taxonomy_like_categories($post_type, $args, $taxonomy, $label_taxonomy)
	{
		// To create a hierarchical custom taxonomy like categories
		// Add new taxonomy, make it hierarchical like categories 
		// First do the translations part for GUI 
		$labels = array( 
		    'name' => _x( $label_taxonomy, 'taxonomy general name' ), 
		    'singular_name' => _x( $label_taxonomy, 'taxonomy singular name' ), 
		    'search_items' =>  __( 'Search '.$label_taxonomy ), 
		    'all_items' => __( 'All '.$label_taxonomy ), 
		    'parent_item' => __( 'Parent '.$label_taxonomy ), 
		    'parent_item_colon' => __( 'Parent '.$label_taxonomy.':' ), 
		    'edit_item' => __( 'Edit '.$label_taxonomy ), 
		    'update_item' => __( 'Update '.$label_taxonomy ), 
		    'add_new_item' => __( 'Add New '.$label_taxonomy ), 
		    'new_item_name' => __( 'New '.$label_taxonomy.' Name' ), 
		    'menu_name' => __( $label_taxonomy ), 
		  );    
 
		$new_args = array_merge( 
					array( 
						'label' 			=> $label_taxonomy,
						'labels' 			=> $labels,
					    'hierarchical' 		=> true,  
					    'show_ui' 			=> true, 
					    'show_admin_column' => true, 
					    'query_var' 		=> true
					  ),
					$args 
				);
		 
		add_action('init', function() use($post_type, $new_args, $taxonomy) {  
			//name of taxonomy, asssociated post type, options
			register_taxonomy($taxonomy, $post_type, $new_args);
		});

	}


	/**
	 * 	[ _create_taxonomy_like_tags - this will create a taxonomy like tags ]
	 *
	 * 	@param 	[string]	[ $post_type - like post, page, attachment, custom post type like snippet ]
	 * 	@param 	[array]		[ $args - the arguments or setting of the taxonomy ]
	 * 	@param 	[string]	[ $taxonomy - the taxonomy name like tag, language, difficulty ]
	 *	@param 	[string]	[ $label_taxonomy - the label that can be use for every label setting ]
	 *	@return [none]
	 */
	private function _create_taxonomy_like_tags($post_type, $args, $taxonomy, $label_taxonomy)
	{
		// To create a non-hierarchical custom taxonomy like Tags 
		// First do the translations part for GUI  
 		 $labels = array( 
		    'name' => _x( ''.$label_taxonomy.'', 'taxonomy general name' ), 
		    'singular_name' => _x( $label_taxonomy, 'taxonomy singular name' ), 
		    'search_items' =>  __( 'Search '.$label_taxonomy ), 
		    'popular_items' => __( 'Popular '.$label_taxonomy ), 
		    'all_items' => __( 'All '.$label_taxonomy ), 
		    'parent_item' => null, 
		    'parent_item_colon' => null, 
		    'edit_item' => __( 'Edit '.$label_taxonomy ), 
		    'update_item' => __( 'Update '.$label_taxonomy ), 
		    'add_new_item' => __( 'Add New '.$label_taxonomy ), 
		    'new_item_name' => __( 'New '.$label_taxonomy.' Name' ), 
		    'separate_items_with_commas' => __( 'Separate '.$label_taxonomy.' with commas' ), 
		    'add_or_remove_items' => __( 'Add or remove '.$label_taxonomy.'' ), 
		    'choose_from_most_used' => __( 'Choose from the most used '.$label_taxonomy ), 
		    'menu_name' => __( $label_taxonomy ), 
		  ); 
  
		$new_args = array_merge( 
					array( 
						'label' 				=> $label_taxonomy,
						'labels' 				=> $labels,
					    'hierarchical' 			=> false,  
					    'show_ui' 				=> true, 
					    'show_admin_column' 	=> true, 
					    'update_count_callback' => '_update_post_term_count', 
					    'query_var' 			=> true,  
					  ),
					$args 
				);
		 
		add_action('init', function() use($post_type, $new_args, $taxonomy) {  
			//name of taxonomy, asssociated post type, options
			register_taxonomy($taxonomy, $post_type, $new_args);
		});

	}


	/**
	 * 	[ get_taxonomy_name - this will return a taxonomy name base on the specified taxonomy ]
	 *
	 * 	@param 	[string]	[ $taxonomy - the taxonomy name like category, tag, language, difficulty ]
	 *	@return [string]	[ Return a lowercased of taxnomy name ]
	 */
	private function get_taxonomy_name($taxonomy) 
	{
		return strtolower(str_replace(' ', '_', $taxonomy));
	}



	/**
	 * 	[ get_label_taxonomy - this will return a label taxonomy base on the specified taxonomy ]
	 *
	 * 	@param 	[string]	[ $taxonomy - the taxonomy name like category, tag, language, difficulty ]
	 * 	@param 	[array]		[ $args - this will get the $args['label'] ]  
	 *	@return [string]	[ Return a capitalized taxonomy label ]
	 */
	private function get_label_taxonomy($taxonomy, $args)
	{
		if(isset($args['label'])) {
			$label = ($args['label'] != '')? $args['label'] : $taxonomy;
		} else {
			$label = $taxonomy;
		}
		return ucwords(str_replace('_', ' ', $label));
	}



	public function set_taxonomy_placement($post_type, $taxonomy, $placement, $priority, $like_category)
	{	
		$metabox_key = '';
		if( $like_category === TRUE ) {
			$metabox_key = $taxonomy.'div';  
		} else {
			$metabox_key = 'tagsdiv-'.$taxonomy;
		}

		add_action('add_meta_boxes', function() use($post_type, $metabox_key, $placement, $priority) {
			global $wp_meta_boxes;

			if ( isset( $wp_meta_boxes[$post_type]['side']['core'][$metabox_key] ) ) { 
		        $metabox = $wp_meta_boxes[$post_type]['side']['core'][$metabox_key]; 
		        unset( $wp_meta_boxes[$post_type]['side']['core'][$metabox_key] );

		        // set the new placement and priority of the metabox.
		        $wp_meta_boxes[$post_type][$placement][$priority][$metabox_key] = $metabox;
		    }

		}); 

	}


	/**
	 * 	[ render - this method will manage on rendering a custom taxonomy based on its taxonomy arguments ]
	 *
	 * 	@return [void]
	 */
	public function render()
	{	   
		$new_config = array_merge($this->default_config, $this->config);
		extract($new_config);

		if( empty($taxonomy) ) return;

		$this->create_taxonomy($taxonomy, $this->post_type, $args, $like_category); 
		$this->set_taxonomy_placement($this->post_type, $taxonomy, $placement, $priority, $like_category);
		 
	}

}

