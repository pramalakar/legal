<?php 
namespace theme\rmd\core\database;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
} 

/**
 *	The RMD_Crud_Select will manage to make a sql query to select a particular fields.
 */
/***
 * 	HOW TO USE
 *
	global $wpdb;
	$table_name = $wpdb->prefix.'posts';   
	$crud = new RMD_Crud($table_name);
	$crud = new RMD_Crud_Select($crud, array('ID','post_title')); 
	$response = $crud->get();
 
 */
class RMD_Crud_Select extends RMD_Crud_Clause
{
	private $select_clause = '';

	/**
 	 *	@param 	object		$RMD_Crud - the class object that implements this interface RMD_Crud_Interface
 	 *	@param 	array 		$fields - the list of fields
 	 */
	public function __construct(RMD_Crud_Interface $RMD_Crud, array $fields = array('*'))
	{
		parent::__construct($RMD_Crud);
		$this->set_select($fields);
	}


	/**
	 *	set_select - the method will set up the selec clause
	 *
	 * 	@param  array		$fields - the list of fields
	 *				 		Ex., array('field1','field2','field3');
	 * 	@return object		current class
	 */
	private function set_select($fields = array('*')) 
	{ 
		if(!empty($fields)) {
			if(!is_array($fields)) {
				exit('Error: RMD_Crud_Select requires an array as its second parameter.');
			}
		} else {
			exit('Error: RMD_Crud_Select requires an array as its second parameter.');
		}

		$ctr = 0;
		$this->select_clause = '';
		foreach ($fields as $key => $field) {
			$ctr += 1;
			$this->select_clause .= $field;
			if(count($fields) != $ctr) {
				$this->select_clause .= ", ";
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

 		$str_to_search = 'SELECT * FROM';

 		$pos = strripos($sql, $str_to_search);
		if ($pos === false) {
			$str_to_search = 'FROM';
		    $str_to_replace = ", $this->select_clause FROM";
			$sql = str_replace($str_to_search, $str_to_replace, $sql); 
		} else { 
			$str_to_replace = "SELECT $this->select_clause FROM";
			$sql = str_replace($str_to_search, $str_to_replace, $sql); 
		}    
		return $sql;
 	}

}
