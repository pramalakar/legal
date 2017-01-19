<?php 
namespace theme\rmd\core\database;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
/**
 *	The RMD_Crud_Or_Where will manage to make a sql query with a where clause using OR operator
 */
/***
 * 	HOW TO USE
 *
	global $wpdb;
	$table_name = $wpdb->prefix.'posts';   
	$crud = new RMD_Crud($table_name);
	$crud = new RMD_Crud_Or_Where($crud, array(
		array('field1','=','value1'),
		array('field2','=','value2')
	)); 
	$response = $crud->get();
 
 */
class RMD_Crud_Or_Where extends RMD_Crud_Clause
{

	private $where_clause = '';

	/**
 	 *	@param 	object		$RMD_Crud - the class object that implements this interface RMD_Crud_Interface 
 	 *	@param 	array 		$where_arr - the list of fields with there corresponding value 
 	 */
	public function __construct(RMD_Crud_Interface $RMD_Crud, array $where_arr = array())
	{
		parent::__construct($RMD_Crud);
		$this->set_where($where_arr);
	}

	/**
	 *	set_where - this method will set up where clause 
	 *
	 * 	@param  multi-array  	$where_arr - the list of fields with there corresponding value 
	 *				 			Ex., array( array('field1','=','value1'), array('field2','=','value2') ); 
	 * 	@return object 			current class 
	 */
	private function set_where($where_arr = array()) 
	{
		if(!empty($where_arr)) {
			if(!is_array($where_arr)) {
				exit('Error: RMD_Crud_Or_Where requires an multi dimentional array as its second parameter.');
			}
		} else {
			exit('Error: RMD_Crud_Or_Where requires an multi dimentional array as its second parameter.');
		}
		 
		$ctr = 0;
		$this->where_clause = '';
		foreach ($where_arr as $field => $where) {
			$ctr += 1;
			$this->where_clause .= "$where[0] $where[1] '$where[2]' ";
			if(count($where_arr) != $ctr) {
				$this->where_clause .= "OR ";
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
		    $sql = "$sql WHERE $this->where_clause ";
		} else {
			$sql = "$sql OR $this->where_clause ";
		}  
		return $sql;
 	}


	

}
