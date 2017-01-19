<?php 
namespace theme\rmd\core\database;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/** 
 *	The RMD_Crud_Count will manage to create a wp query where it has as count function on it.
 */
/***
 * 	HOW TO USE
 *
	global $wpdb;
	$table_name = $wpdb->prefix.'posts';   
	$crud = new RMD_Crud($table_name);
	$crud = new RMD_Crud_Count($crud, array('ID'=>'countid')); 
	$response = $crud->get();
 
 */
class RMD_Crud_Count extends RMD_Crud_Clause
{

	private $count_clause = '';

	/**
 	 *	@param 	object		$RMD_Crud - the class object that implements this interface RMD_Crud_Interface
 	 *	@param 	array 		$fields - the list of fields you want to get its total number of result
 	 *						Ex., array('field_name'=>'alias_name')
 	 */
	public function __construct(RMD_Crud_Interface $RMD_Crud, array $fields = array())
	{
		parent::__construct($RMD_Crud);
		$this->set_count($fields);
	}


	/**
	 *	set_count - this method set up for the count clause
	 *
	 * 	@param  array		$fields - the list of fields you want to get its total number of results
	 *				 		Ex., array('field1' => 'alias_name');
	 * 	@return object	current class
	 */
	private function set_count($fields = array()) 
	{ 
		if(!empty($fields)) {
			if(!is_array($fields)) {
				exit('Error: RMD_Crud_Count requires an array as its second parameter.');
			}
		} else {
			exit('Error: RMD_Crud_Count requires an array as its second parameter.');
		}

		$ctr = 0;
		$this->count_clause = '';
		foreach ($fields as $field => $alias) {
			$ctr += 1; 
			$this->count_clause .= "COUNT($field) AS $alias";
			if(count($fields) != $ctr) {
				$this->count_clause .= ", ";
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
		    $str_to_replace = ", $this->count_clause FROM";
			$sql = str_replace($str_to_search, $str_to_replace, $sql); 
		} else { 
			$str_to_replace = "SELECT $this->count_clause FROM";
			$sql = str_replace($str_to_search, $str_to_replace, $sql); 
		}    
		return $sql;
 	}

}
