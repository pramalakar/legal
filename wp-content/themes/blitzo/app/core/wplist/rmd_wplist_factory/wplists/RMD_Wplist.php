<?php 
namespace theme\rmd\core\wplist;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
abstract class RMD_Wplist 
{	 
	protected $new_config = array();

	protected $default_config = array(
		'post_type' => '',
		'args' => array()
		);

	protected $default_args = array(
		'field_name' => '',
		'header_title' => '',
		'content_wrapper_before' => '',
		'content_wrapper_after' => '',
		'position' => 0,
		'like_thumbnail' => FALSE,
		'data_type' => 'metabox', // metabox | taxonomy | thumbnail |,
		'replacement_value' => array()
		);

 
	public function __construct(array $config = array())
	{ 	
		$this->new_config = array_merge($this->default_config, $config); 
		extract($this->new_config);

		if( empty($post_type) ) 
		{
			wp_die(__('RMD_Wplist_Handler requires a config data of a valid post type.'));
		}

		add_image_size( 'my-extra-small-thumbnail', 'auto', 50, true ); 
	}


	protected function set_column($post_type, $args)
	{
		extract($args); 

		// Setting the new column area
		add_filter('manage_'.$post_type.'_posts_columns', function($columns) use($field_name, $header_title) {

			$columns[$field_name] = __( $header_title );
			return $columns;
		}, 9 ); 
	}


	protected function set_position($post_type, $args)
	{
		extract($args); 

		add_filter('manage_'.$post_type.'_posts_columns', function($columns) use($field_name, $position) {
			
			$new_columns = array();
			$counter = 0;
			foreach ($columns as $column_name => $value) {
				if($counter == $position) {
					$new_columns[$field_name] = $columns[$field_name];
					$new_columns[$column_name] = $value;
				} else {
					$new_columns[$column_name] = $value;
				}
				$counter++;
			} 
			return $new_columns;

		}, 10 ); 
	}


	protected function set_content($post_type, $args)
	{	
		extract($args);

		add_action('manage_'.$post_type.'_posts_custom_column', function($column, $post_id) use($post_type, $field_name, $data_type, $args) {
				
			if($column == $field_name) { 
				$customized_wplist_column = RMD_Wplist_Column_Factory::customize_wplist_column($data_type, compact('post_id', 'field_name', 'post_type', 'args')); 
				if( $customized_wplist_column !== false ) { 
					$customized_wplist_column->render(); 
				} else {
					echo '---';
				}  
			} 

		}, 9, 2);
	}
 

	abstract public function render();

}

