<?php
namespace theme\rmd\core\wplist;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/** 
 * 	RMD_Headertitle_Wplist - this class will manage to customize the wp list column header title.
 */
/***
 *	HOW TO USE:

	$wplist_type = 'removecolumn';

	$config = array(
		'post_type' => 'product',
		'args' => array('sku','title','date'), // to get the field name of a column you can just refer to its ID hmtl attr. 
	);
	
	RMD_Wplist_Handler::render($wplist_type, $config);	
 *
 */  
 
class RMD_Removecolumn_Wplist extends RMD_Wplist 
{	 

	public function render()
	{	   
		extract($this->new_config);
		$this->remove_table_column($post_type, $args);
	}

	/**
	 *	This will manage to remove a column in a table list.
	 *
	 *	@param 	string 		$post_type - the type of post.
	 *	@param 	array 		$args - a list of field name which also refer to the column ID html attr. 
	 *						Ex., array('title', 'date');
	 *	@return void 		The return within the method is intended for the add_filter hook.
	 */
	private function remove_table_column($post_type, $args)
	{  
		if( ! is_array($args) ) return;

		/**
		 *	This filter hook is use for managing the table list header.
		 */
		foreach ($args as $key => $field_name) 
		{ 	 
			add_filter('manage_'.$post_type.'_posts_columns', function($columns) use($field_name) {
				unset( $columns[$field_name] );
				return $columns;
			}); 
		} 

	}

}

