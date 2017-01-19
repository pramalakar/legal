<?php  
namespace theme\rmd\core\wpquery;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/** 
 *	RMD WPQUERY
 *	===============
 *	This class is intended to make a wp query in much easier way and it use a singleton design pattern kunuhay.
 *
 */ 

/**
 * 	TAXONOMY QUERY 
 *
 *	tax_query (array) - use taxonomy parameters (available since Version 3.1).
 *		relation (string) - The logical relationship between each inner taxonomy array 
 *			when there is more than one. Possible values are 'AND', 'OR'. Do not use with 
 *			a single inner taxonomy array.
 *
 *		taxonomy (string) - Taxonomy.
 *		terms (int/string/array) - Taxonomy term(s). Or the value. 
 *		field (string) - Select taxonomy term by. Possible values are 'term_id', 'name' and 'slug'. 
 *			Default value is 'term_id'. 
 *		operator (string) - Operator to test. Possible values are 'IN', 'NOT IN', 'AND', 'EXISTS' 
 *			and 'NOT EXISTS'. Default value is 'IN'.
 */

/**
 * 	META QUERY 
 *
 *	key (string) - Custom field key.
 *	value (string|array) - Custom field value. It can be an array only when compare is 
 *		'IN', 'NOT IN', 'BETWEEN', or 'NOT BETWEEN'. You don't have to specify a value 
 *		when using the 'EXISTS' or 'NOT EXISTS' comparisons in WordPress 3.9 and up. 
 *		(Note: Due to bug #23268, value is required for NOT EXISTS comparisons to work 
 *		correctly prior to 3.9. You must supply some string for the value parameter. 
 *		An empty string or NULL will NOT work. However, any other string will do the 
 *		trick and will NOT show up in your SQL when using NOT EXISTS. Need inspiration? 
 *		How about 'bug #23268'.)
 *	compare (string) - Operator to test. Possible values are '=', '!=', '>', '>=', '<', 
 *		'<=', 'LIKE', 'NOT LIKE', 'IN', 'NOT IN', 'BETWEEN', 'NOT BETWEEN', 'EXISTS' and 
 *		'NOT EXISTS'. Default value is '='.
 *	type (string) - Custom field type. Possible values are 'NUMERIC', 'BINARY', 'CHAR', 
 *		'DATE', 'DATETIME', 'DECIMAL', 'SIGNED', 'TIME', 'UNSIGNED'. Default value is 'CHAR'.
 *		
 *		- The 'type' DATE works with the 'compare' value BETWEEN only if the date is stored 
 *		  at the format YYYY-MM-DD and tested with this format.
 * 
 */

/***
 * 	HOW TO USE
 *	  
	$mypost = new RMD_Wpquery;
	$mypost->where_post_type('post');
	$query = $mypost->get();

	if ( $query->have_posts() ) :  
	  while ( $query->have_posts() ) : $query->the_post();  
	       the_title();
	  endwhile;   
	endif;  

	wp_reset_postdata();


	>>>>== OTHER EXAMPLES ===============================))>

	$mypost = new RMD_Wpquery;
	$mypost->where_post_type('post');
	$mypost->where_meta_query('rmd_first_name', 'Raymond' );
	$query = $mypost->get();


	$mypost = new RMD_Wpquery;
	$mypost->where_post_type('post');
	$mypost->order_by_random();
	$query = $mypost->get();

 
 */ 			
 
 
class RMD_Wpquery 
{ 	 
	private $post_type           = array('post_type' => 'post');
	private $posts_per_page      = array('posts_per_page' => -1);
	private $offset              = array('offset' => 0);
	private $order_by            = array('orderby' => array('date' => 'ASC')); 
	private $author 		     = array();
	private $category_in         = array();
	private $category_out        = array();
	private $tag_in              = array();
	private $tag_out             = array();
	private $post_in             = array();
	private $post_out            = array(); 
	private $meta_query          = array(); 
	private $search 		     = array(); 
	private $new_args 		     = array(); 
	private $meta_query_relation = 'AND';
	private $tax_query           = array();  
	private $tax_query_relation  = 'AND';


	/** 
	 * 	[ where_search - this will manage the search key, to append in the wpquery. ] 
	 *
	 *	@param 	[string] 			[ $search_key - the search key ]
	 * 	@return [object]			[ Return the current class to be used for chaining ]
	 */ 
	public function where_search($search_key = '')
	{     
		if( !empty($search_key)) {
			$this->search = array('s' => $search_key);
		} 
		return $this;
	}


	/** 
	 * 	[ where_args - this will overwrite the previous args that will be used in the wpquery. ] 
	 *
	 *	@param 	[array] 			[ $new_args - the new args for the wpquery process ]
	 * 	@return [object]			[ Return the current class to be used for chaining ]
	 */ 
	public function where_args(array $new_args = array())
	{      
		if( empty($new_args)) return $this; 

		$this->new_args = $new_args; 
		return $this;
	}



	/** 
	 * 	[ where_tax_query - this method will manage to set up value that will filter the taxonomy within the wp query ]
	 *
	 *	@param 	[string] 			[ $taxonomy - the taxonomy like 'category' and 'post_tag' ]
	 *	@param 	[int|string|array] 	[ $terms - a value a list that will be used for filtering ]  
	 *	@param 	[string] 			[ $field - this is the field name that you can see at the wp_terms like 'term_id', 'name' and 'slug']
	 *								[ please also check the above documentation. ] 
	 *	@param 	[string] 			[ $operator - please check the above documentation. ]
	 * 	@return [object]			[ Return the current class to be used for chaining ]
	 */ 
	public function where_tax_query($taxonomy, $terms, $field = 'slug', $operator = 'IN')
	{   
		$this->tax_query[] = array(
						'taxonomy' => $taxonomy,
						'field'    => $field,
						'terms'    => $terms,
						'operator' => $operator
					);

		return $this;
	}

	/** 
	 * 	[ where_tax_query_relation - this method will set up the taxonomy query relation ]
	 *
	 *	@param  [string] 	[ $relation - the relation to be set for tax_query, if 'AND' or 'OR' ]
	 *						[ please also check the above documentation. ] 
	 *	@return [void]
	 */ 
	public function where_tax_query_relation($relation = 'AND')
	{
		$this->tax_query_relation = $relation;
	}



	/** 
	 * 	[ where_meta_query - this method will manage to set up value that will filter the post meta within the wp query ]
	 *
	 *	@param 	[string] 		[ $meta_key - meta_key value that you can see at the wp_postmeta ]
	 *	@param 	[string|array] 	[ $meta_value - the value that we're going to filter with. ]
	 *	@param 	[string] 		[ $meta_compare - please check the above documentation about "compare". ]
	 *	@param 	[string] 		[ $meta_type - please check the above documentation about "type". ]
	 * 	@return [object]		[ Return the current class to be used for chaining ]
	 */
	public function where_meta_query($meta_key, $meta_value, $meta_compare = '=', $meta_type = 'CHAR')
	{   
		$this->meta_query[] = array(
						'key'     => $meta_key,
						'value'   => $meta_value,
						'compare' => $meta_compare,
						'type'    => $meta_type,
					);

		return $this;
	}

	 
	/** 
	 * 	[ where_meta_query_relation - this method will set up the meta query relation ]
	 *
	 *	@param  [string] 	[ $relation - the relation to be set for meta_query, if 'AND' or 'OR'. ] 
	 *	@return [void]
	 */
	public function where_meta_query_relation($relation = 'AND')
	{
		$this->meta_query_relation = $relation;
	}
 	

	/**
	 *	[ where_category_in - this method will manage to filter the results of posts within this array of category slug. ]
	 *
	 *	@param 	[array] 		[ $array_slug - an array of category slug. ]
	 * 	@return [object]		[ Return the current class to be used for chaining ]
	 */
 	public function where_category_in(array $array_slug = array())
	{
		if(empty($array_slug)) return $this;

		$term_id_arr = array();
		foreach ($array_slug as $key => $slug) {
			$term_id = $this->get_term_id($slug);
			$term_id_arr[] = $term_id;
		} 
		$this->category_in = array('category__in' => $term_id_arr);

		return $this;
	}

 	
 	/** 
	 *	[ where_category_out - this method will manage to filter the results of posts by excluding the post within this array of category slug. ]
	 *
	 *	@param 	[array] 		[ $array_slug - an array of category slug. ]
	 * 	@return [object]		[ Return the current class to be used for chaining ]
	 */
	public function where_category_out(array $array_slug = array())
	{
		if(empty($array_slug)) return $this;

		$term_id_arr = array();
		foreach ($array_slug as $key => $slug) {
			$term_id = $this->get_term_id($slug);
			$term_id_arr[] = $term_id;
		} 
		$this->category_out = array('category__not_in' => $term_id_arr);

		return $this;
	}


	/** 
	 *	[ where_tag_in - this method will manage to filter the results of posts within this array of tag slug. ]
	 *
	 *	@param 	[array] 		[ $array_slug - an array of tag slug. ]
	 * 	@return [object]		[ Return the current class to be used for chaining ]
	 */ 
	public function where_tag_in(array $array_slug = array())
	{
		if(empty($array_slug)) return $this;

		$term_id_arr = array();
		foreach ($array_slug as $key => $slug) {
			$term_id = $this->get_term_id($slug);
			$term_id_arr[] = $term_id;
		} 
		$this->tag_in = array('tag__in' => $term_id_arr);

		return $this;
	}


	/** 
	 *	[ where_tag_out - this method will manage to filter the results of posts by excluding the post within this array of tag slug. ]
	 *
	 *	@param 	[array] 		[ $array_slug - an array of tag slug. ]
	 * 	@return [object]		[ Return the current class to be used for chaining ]
	 */ 
	public function where_tag_out(array $array_slug = array())
	{
		if(empty($array_slug)) return $this;

		$term_id_arr = array();
		foreach ($array_slug as $key => $slug) {
			$term_id = $this->get_term_id($slug);
			$term_id_arr[] = $term_id;
		} 
		$this->tag_out = array('tag__not_in' => $term_id_arr);

		return $this;
	}


	/** 
	 *	[ where_post_in - this method will manage to filter the results of posts within this array of post id. ]
	 *
	 *	@param 	[array] 		[ $array_post_ids - an array of post id. ]
	 * 	@return [object]		[ Return the current class to be used for chaining ]
	 */ 
	public function where_post_in(array $array_post_ids = array())
	{
		if(empty($array_post_ids)) return $this;

		$post_ids_arr = array();
		foreach ($array_post_ids as $key => $post_id) { 
			$post_ids_arr[] = $post_id;
		} 
		$this->post_in = array('post__in' => $post_ids_arr);

		return $this;
	}


	/** 
	 *	[ where_post_out - this method will manage to filter the results of posts by excluding the post within this array of post id. ]
	 *
	 *	@param 	[array] 		[ $array_post_ids - an array of post id. ]
	 * 	@return [object]		[ Return the current class to be used for chaining ]
	 */ 
	public function where_post_out(array $array_post_ids = array())
	{
		if(empty($array_post_ids)) return $this;

		$post_ids_arr = array();
		foreach ($array_post_ids as $key => $post_id) { 
			$post_ids_arr[] = $post_id;
		} 
		$this->post_out = array('post__not_in' => $post_ids_arr);

		return $this;
	}

  
	/** 
	 *	[ where_author - this method will manage to filter the results of posts by author, using author 'user_nicename'. ]
	 *
	 *	@param 	[string] 		[ $author_name - author_name - use 'user_nicename' - NOT name. ]
	 * 	@return [object]		[ Return the current class to be used for chaining ]
	 */ 
	public function where_author($author_name = null)
	{
		if(!empty($author_name)) {
			$this->author = array('author_name' => $author_name);
		} 

		return $this;
	}
  

	/** 
	 *	[ where_post_type - this method will manage to filter the results of posts base on its post type ]
	 *
	 *	@param 	[string] 		[ $post_type - single post type. ]
	 *	 		[array] 		[ $post_type - ultiple post type. Ex. array( 'post', 'page', 'movie', 'book' ) ]
	 * 	@return [object]		[ Return the current class to be used for chaining ]
	 */ 
	public function where_post_type($post_type = 'post')
	{
	 	$this->post_type = array('post_type' => $post_type);

	 	return $this;
	}


	private function get_term_id($slug)
	{
		global $wpdb;
		$table_name = $wpdb->prefix.'terms';
		$sql = "SELECT * FROM $table_name WHERE slug = '$slug'";
		$response = $wpdb->get_row($sql, ARRAY_A);

		if(!empty($response)) {
			return $response['term_id'];
		} else {
			return 0;
		}
			
	}
 

	
	/**
	 *	orderby (string | array) 
	 *		- Sort retrieved posts by parameter. 
	 *		- Defaults to 'date (post_date)'. One or more options can be passed.
	 *	'none' - No order (available since Version 2.8).
	 *	'ID' - Order by post id. Note the capitalization.
	 *	'author' - Order by author.
	 *	'title' - Order by title.
	 *	'name' - Order by post name (post slug).
	 *	'type' - Order by post type (available since Version 4.0).
	 *	'date' - Order by date.
	 *	'modified' - Order by last modified date.
	 *	'parent' - Order by post/page parent id.
	 *	'rand' - Random order.
	 *	'comment_count' - Order by number of comments (available since Version 2.9).
	 *	'menu_order' - Order by Page Order. Used most often for Pages (Order field in the Edit Page Attributes box) and for Attachments (the integer fields in the Insert / Upload Media Gallery dialog), but could be used for any post type with distinct 'menu_order' values (they all default to 0).
	 *	'meta_value' - Note that a 'meta_key=keyname' must also be present in the query. Note also that the sorting will be alphabetical which is fine for strings (i.e. words), but can be unexpected for numbers (e.g. 1, 3, 34, 4, 56, 6, etc, rather than 1, 3, 4, 6, 34, 56 as you might naturally expect). Use 'meta_value_num' instead for numeric values. You may also specify 'meta_type' if you want to cast the meta value as a specific type. Possible values are 'NUMERIC', 'BINARY', 'CHAR', 'DATE', 'DATETIME', 'DECIMAL', 'SIGNED', 'TIME', 'UNSIGNED', same as in '$meta_query'.
	 *	'meta_value_num' - Order by numeric meta value (available since Version 2.8). Also note that a 'meta_key=keyname' must also be present in the query. This value allows for numerical sorting as noted above in 'meta_value'.
	 *	'post__in' - Preserve post ID order given in the post__in array (available since Version 3.5).
	 */
	/*
	 *	order (string | array) 
	 *		- Designates the ascending or descending order of the 'orderby' parameter. 
	 *		- Defaults to 'DESC'. An array can be used for multiple order/orderby sets.
	 *	'ASC' - ascending order from lowest to highest values (1, 2, 3; a, b, c).
	 *	'DESC' - descending order from highest to lowest values (3, 2, 1; c, b, a).
	 */
	/*
	 	Example 1: Setting up for multiple sort, the first value will be priority.
	 		$args = array( 'title' => 'DESC', 'menu_order' => 'ASC' );

	 	Example 2: Setting up for multiple sort, the first value will be priority. 
	 			   The sorting also depends on the meta key.
	 		$args = array( 
	 			'meta_key' => 'first_name',
	 			'orderby'  => array('meta_value' => 'ASC', 'title' => 'DESC' )  
	 			);
	 */
	/**
	 * 	[ order_by - this method will manage the ordering of posts]
	 *
	 *	@param 	[array] 		[ $args - you can base the values on the examples above. ]
	 * 	@return [object]		[ Return the current class to be used for chaining ]
	 */
	public function order_by(array $args = array())
	{ 
		if( empty($args)) return $this;

		$this->order_by = $args; 
		return $this;
	}


	/**
	 * 	[ order_by_meta_value - this method will manage the ordering of posts base on its meta data ]
	 *	
	 *	@param 	[string] 		[ $meta_key - specify the meta_key of the post that you want to sort. ]
	 *	@param 	[string] 		[ $direction - specify the direction of the post, if ASC or DESC. ]
	 * 	@return [object]		[ Return the current class to be used for chaining ]
	 */
	public function order_by_meta_value($meta_key, $direction = 'DESC')
	{
		$this->order_by = array(
			'meta_key'   => $meta_key,
			'orderby'    => array('meta_value' => $direction)  
			);
		return $this;
	}


	/**
	 * 	[ order_by_author - this method will manage the ordering of posts base on its author ]
	 *	 
	 *	@param 	[string] 		[ $direction - specify the direction of the post, if ASC or DESC. ]
	 * 	@return [object]		[ Return the current class to be used for chaining ]
	 */
	public function order_by_author($direction = 'DESC')
	{
		$this->order_by = array(
			'orderby' => array( 'author' => $direction)  
			);

		return $this;
	}


	/**
	 * 	[ order_by_title - this method will manage the ordering of posts base on its title ]
	 *	 
	 *	@param 	[string] 		[ $direction - specify the direction of the post, if ASC or DESC. ]
	 * 	@return [object]		[ Return the current class to be used for chaining ]
	 */
	public function order_by_title($direction = 'DESC')
	{
		$this->order_by = array(
			'orderby' => array( 'title' => $direction)    
			);

		return $this;
	}


	/**
	 * 	[ order_by_date - this method will manage the ordering of posts base on its date ]
	 *	 
	 *	@param 	[string] 		[ $direction - specify the direction of the post, if ASC or DESC. ]
	 * 	@return [object]		[ Return the current class to be used for chaining ]
	 */
	public function order_by_date($direction = 'DESC')
	{
		$this->order_by = array(
			'orderby' => array( 'date' => $direction)  
			); 
		return $this;
	}


	/**
	 * 	[ order_by_random - this method will manage the ordering of posts randomly ]
	 *	  
	 * 	@return [object]		[ Return the current class to be used for chaining ]
	 */
	public function order_by_random()
	{
		$this->order_by = array(
			'orderby' => 'rand'
			);
		return $this;
	}


	/**
	 * 	[ order_by_comment_count - this method will manage the ordering of posts base on its comment count]
	 *	 
	 *	@param 	[string] 		[ $direction - specify the direction of the post, if ASC or DESC. ]
	 * 	@return [object]		[ Return the current class to be used for chaining ]
	 */
	public function order_by_comment_count($direction = 'DESC')
	{
		$this->order_by = array(
			'orderby' => array( 'comment_count' => $direction)   
			); 
		return $this;
	}


	/**
	 * 	[ limit - this method will manage to limit the number pof posts ]
	 *	 
	 *	@param 	[integer] 		[ $limit - number of post that you want to display. ]
	 * 	@return [object]		[ Return the current class to be used for chaining ]
	 */
	public function limit($limit)
	{
	 	$this->posts_per_page = array('posts_per_page' => $limit);
	 	return $this;
	}


	/**
	 * 	[ offset - this method will manage to the offset of retrieving the results. ]
	 *	 
	 *	@param 	[integer] 		[ $offset - number of offset ]
	 * 	@return [object]		[ Return the current class to be used for chaining ]
	 */
	public function offset($offset)
	{
	 	$this->offset = array('offset' => $offset);
	 	return $this;
	}


	/**
	 * 	[ get - this method will manage to compile all the query clause and call the WP_Query ]
	 *	  
	 * 	@return [object]		[ Return the wp query object. ]
	 */
	public function get()
	{
	 	$args = array_merge(
	 		$this->post_type,
	 		$this->posts_per_page,
	 		$this->offset,
	 		$this->order_by
	 		); 

	 	if(!empty($this->author)) {
	 		$args = array_merge($args, $this->author);
	 	}

	 	if(!empty($this->category_in)) {
	 		$args = array_merge($args, $this->category_in);
	 	}

	 	if(!empty($this->category_out)) {
	 		$args = array_merge($args, $this->category_out);
	 	} 

	 	if(!empty($this->tag_in)) {
	 		$args = array_merge($args, $this->tag_in);
	 	}

	 	if(!empty($this->tag_out)) {
	 		$args = array_merge($args, $this->tag_out);
	 	} 

	 	if(!empty($this->post_in)) {
	 		$args = array_merge($args, $this->post_in);
	 	}

	 	if(!empty($this->post_out)) {
	 		$args = array_merge($args, $this->post_out);
	 	} 

	 	if(!empty($this->meta_query)) {
	 		$count_meta_query = count($this->meta_query);
	 		if($count_meta_query > 1) {
	 			$meta_query = array( 
					'meta_query' => array_merge( 
						array( 'relation'   => $this->meta_query_relation ), 
						$this->meta_query
						)
				); 
	 		} else {
	 			$meta_query = array(
					'meta_query' => $this->meta_query
				); 
	 		}  
	 		$args = array_merge($args, $meta_query);
	 	}  

	 	if(!empty($this->tax_query)) {
	 		$count_tax_query = count($this->tax_query);
	 		if($count_tax_query > 1) {
	 			$tax_query = array( 
					'tax_query' => array_merge( 
						array( 'relation'   => $this->tax_query_relation ), 
						$this->tax_query
						)
				); 
	 		} else {
	 			$tax_query = array(
					'tax_query' => $this->tax_query
				); 
	 		}  
	 		$args = array_merge($args, $tax_query);
	 	}  

	 	if(!empty($this->search)) {
	 		$args = array_merge($args, $this->search);
	 	} 
	 	

	 	if(!empty($this->new_args)) {
	 		$args = array_merge($args, $this->new_args);
	 	} 
	 	

	 	$query = new \WP_Query($args);

	 	return $query;

	}

}
 

/* Created by: Raymond M. Daylo */

