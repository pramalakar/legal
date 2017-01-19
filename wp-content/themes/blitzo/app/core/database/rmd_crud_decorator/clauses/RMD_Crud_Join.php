<?php 
namespace theme\rmd\core\database;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
} 

/**
 *	The RMD_Crud_Join will manage to make a sql query with a join clause.
 */
/***
 * 	HOW TO USE
 *
	global $wpdb;
	$table_name1 = $wpdb->prefix.'posts';
	$table_name2 = $wpdb->prefix.'postmeta';
	$rel_fields  = "$table_name1.ID = $table_name2.post_id";

	$crud = new RMD_Crud($table_name1);
	$crud = new RMD_Crud_Join($crud, array(
		$table_name2 => $rel_fields
	)); 
	$response = $crud->get();
 
 */
class RMD_Crud_Join extends RMD_Crud_Clause
{

	private $join_clause = '';

	/**
 	 *	@param 	object		$RMD_Crud - the class object that implements this interface RMD_Crud_Interface
 	 *	@param 	array 		$join_arr - a list of related tables with the corresponding related fields
 	 */
	public function __construct(RMD_Crud_Interface $RMD_Crud, array $join_arr = array())
	{
		parent::__construct($RMD_Crud);
		$this->set_join($join_arr);
	}


	/**
	 *	set_join - this method will set up the join clause
	 *
	 * 	@param  array 		$join_arr - a list of related tables with the corresponding related fields 
	 *						Ex., array( 'table_name1' => 'table_name1.ID = table_name2.post_id', 'table_name2' => 'table_name2.ID = table_name3.post_id' )
 	 * 	@return object 		current class
	 */ 
	private function set_join($join_arr = array()) 
	{	
		if(!empty($join_arr)) {
			if(!is_array($join_arr)) {
				exit('Error: RMD_Crud_Join requires an array as its second parameter.');
			}
		} else {
			exit('Error: RMD_Crud_Join requires an array as its second parameter.');
		}
 
		$ctr = 0;
		$this->join_clause = '';
		foreach ($join_arr as $rel_table_name => $rel_fields) {
			$ctr += 1;
			$this->join_clause .= "JOIN $rel_table_name ON $rel_fields ";  
		} 
		return $this;  
	}


	/**
 	 *	get_sql_string - set up and retrieve the sql string
 	 *
 	 * 	@return  string 	Return the sql string
 	 */
 	public function get_sql_string()
 	{ 
 		$sql = $this->RMD_Crud->get_sql_string();
 		$sql = trim($sql);

		if(!empty($this->join_clause)) {
			$sql = "$sql $this->join_clause";
		}  
		return $sql;
 	}

}
