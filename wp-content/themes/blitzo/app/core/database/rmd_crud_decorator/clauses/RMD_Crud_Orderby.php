<?php 
namespace theme\rmd\core\database;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
} 

/**
 *	The RMD_Crud_Orderby will manage to make a sql query with a order clause
 */
/***
 * 	HOW TO USE
 *
	global $wpdb;
	$table_name = $wpdb->prefix.'posts';   
	$crud = new RMD_Crud($table_name);
	$crud = new RMD_Crud_Orderby($crud, array('ID'=>'DESC')); 
	$response = $crud->get();
 
 */
class RMD_Crud_Orderby extends RMD_Crud_Clause
{

	private $order_clause  = '';

	/**
 	 *	@param 	object		$RMD_Crud - the class object that implements this interface RMD_Crud_Interface
 	 *	@param 	array 		$order_arr - the list of fields with there corresponding value of its direction
 	 */
	public function __construct(RMD_Crud_Interface $RMD_Crud, array $order_arr = array())
	{
		parent::__construct($RMD_Crud);
		$this->set_orderby($order_arr);
	}


	/**
	 *	set_orderby - the method will set up the order clause
	 *
	 *	@param 	array 		$order_arr - the list of fields with there corresponding value of its direction
	 *				 		Ex., array('field1'=>'DESC', 'field2'=>'ASC');
	 * 	@return object 		current class
	 */
	private function set_orderby($order_arr = array()) 
	{   
		if(!empty($order_arr)) {
			if(!is_array($order_arr)) {
				exit('Error: RMD_Crud_Orderby requires an array as its second parameter.');
			}
		} else {
			exit('Error: RMD_Crud_Orderby requires an array as its second parameter.');
		}

		$direction_arr = array('ASC','DESC');

		$ctr = 0;
		$this->order_clause = '';
		foreach ($order_arr as $field => $direction) {
			$ctr += 1;

			$direction = strtoupper($direction);
			if(!in_array($direction, $direction_arr)) {
				$direction = 'DESC';
			} 
			$this->order_clause .= "$field $direction";
			if(count($order_arr) != $ctr) {
				$this->order_clause .= ", ";
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

 		if(!empty($this->order_clause)) {
			$sql = "$sql ORDER BY $this->order_clause";
		}  

		return $sql;
 	}

}
