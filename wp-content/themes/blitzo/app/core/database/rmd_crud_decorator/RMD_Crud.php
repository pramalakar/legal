<?php 
namespace theme\rmd\core\database;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
/**
 *	The RMD_Crud was set as the base class and this is where we set up the table name.
 */
/***
 * 	HOW TO USE
 *
	global $wpdb;
	$table_name = $wpdb->prefix.'posts';   
	$crud = new RMD_Crud($table_name);
	$response = $crud->get();
 
 */
class RMD_Crud implements RMD_Crud_Interface
{
 	use RMD_Crud_Common_Methods;

 	private $table_name = '';

 	/**
 	 *	@param 	string 		$table_name - the table name from the database.
 	 */
 	public function __construct($table_name = '') 
 	{
 		$this->set_table_name($table_name);
 	}


 	/**
	 *	set_table_name - set up the table name
	 *
	 * 	@param 	string 		$table_name - the table name from the database.
	 *				  		Ex., wp_prefix_table_name
	 * 	@return object  	current class
	 */
	private function set_table_name($table_name = '') 
	{ 
		if(!is_string($table_name)) {
			exit('Error: RMD_Crud requires a table name parameter as string.');
		} else {
			if(empty($table_name)) {
				exit('Error: RMD_Crud requires a table name as a parameter.');
			}
		} 
		$this->table_name = $table_name; 
		return $this; 
	}


	/**
	 *	get_table_name - retrieve the table name.
	 *
	 *	@return  string  	Return the table name
	 */
 	public function get_table_name()
 	{
 		return $this->table_name;
 	}

 	

 	/**
 	 *	get_sql_string - set up and retrieve the sql string
 	 *
 	 * 	@return  string  	Return the sql string
 	 */
 	public function get_sql_string()
 	{
 		$table_name = $this->get_table_name();
		if(empty($table_name)) {
			exit('Error: Missing database table.');
		} 
 		
		return "SELECT * FROM $table_name";
 	}



 	/**
	 *	get_row - the get_row method for the wp crud
	 * 	No required parameter.
	 *
	 * 	@return The function can return the row as an associative array. 
	 *			If more than one row is returned by the query, only the specified row is returned 
	 *			by the function, but all rows are cached for later use. 
	 *			Returns NULL if no result is found.
	 */
	public function get_row() 
	{
		$sql = $this->get_sql_string();
		$sql = trim($sql);

		global $wpdb;  
		return $wpdb->get_row($sql, ARRAY_A);
	
	}


	/**
	 *	get - the get method for the wp crud
	 * 	No required parameter.
	 *
	 * 	@return The method returns the entire query result as an array. 
	 *			Each element of this array corresponds to one row of the query result and an associative array.
	 *			If no matching rows are found, or if there is a database error, the return value will be 
	 *			an empty array. If your $query string is empty, or you pass an invalid $output_type, 
	 *			NULL will be returned.
	 */
	public function get() 
	{
		$sql = $this->get_sql_string();
		$sql = trim($sql);

		global $wpdb;  
		return $wpdb->get_results($sql, ARRAY_A);
	
	}


}
