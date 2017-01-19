<?php 
namespace theme\rmd\core\database;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 *	The RMD_Crud_Clause was set as abstract class to be extended by subclass for sql clauses.
 */ 
abstract class RMD_Crud_Clause implements RMD_Crud_Interface
{
 	use RMD_Crud_Common_Methods;
 	
 	protected $RMD_Crud;


 	/**
 	 *	@param 	object 		$RMD_Crud - the class object that implements this interface RMD_Crud_Interface
 	 */
 	public function __construct(RMD_Crud_Interface $RMD_Crud) 
 	{
		$this->RMD_Crud = $RMD_Crud;  
 	}


 	/**
	 *	get_table_name - retrieve the table name.
	 *
	 *	@return  string  	Return the table name
	 */
 	public function get_table_name()
 	{
 		return $this->RMD_Crud->get_table_name();
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


 	abstract public function get_sql_string();

}

