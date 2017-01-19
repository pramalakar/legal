<?php 
namespace theme\rmd\core\database;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
/**
 *	The RMD_Crud_Like will manage to make a sql query with a like clause using AND operator
 */
/***
 * 	HOW TO USE
 *
	global $wpdb;
	$table_name = $wpdb->prefix.'posts';   
	$crud = new RMD_Crud($table_name);
	$crud = new RMD_Crud_Like($crud, array('ID'=>1)); 
	$response = $crud->get();
 
 */
class RMD_Crud_Like extends RMD_Crud_Clause
{

	private $like_clause = '';

	/**
 	 *	@param 	object		$RMD_Crud - the class object that implements this interface RMD_Crud_Interface
 	 *	@param 	array 		$like_arr - the list of fields with there corresponding value
 	 */
	public function __construct(RMD_Crud_Interface $RMD_Crud, array $like_arr = array())
	{
		parent::__construct($RMD_Crud);
		$this->set_like($like_arr);
	}


	/**
	 *	set_like - this method will set up like clause
	 *
	 * 	@param  array  		$like_arr - the list of fields with there corresponding value
	 *				 		Ex., array('field1'=>'value1', 'field2'=>'value2');
	 * 	@return object 		current class
	 */
	private function set_like($like_arr = array()) 
	{
		if(!empty($like_arr)) {
			if(!is_array($like_arr)) {
				exit('Error: RMD_Crud_Like requires an array as its second parameter.');
			}
		} else {
			exit('Error: RMD_Crud_Like requires an array as its second parameter.');
		}

		$ctr = 0;
		$this->like_clause = '';
		foreach ($like_arr as $field => $value) {
			$ctr += 1;
			$this->like_clause .= "$field LIKE '%$value%' ";
			if(count($like_arr) != $ctr) {
				$this->like_clause .= "AND ";
			} 
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

		$pos = strripos($sql, 'WHERE');
		if ($pos === false) {
		    $sql = "$sql WHERE $this->like_clause ";
		} else {
			$sql = "$sql AND $this->like_clause ";
		}   
		return $sql;
 	}

}
