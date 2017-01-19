<?php 
namespace theme\rmd\core\database;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
} 

/**
 *	The RMD_Crud_Limit will manage to make a sql query with a limit and offset clause.
 */
/***
 * 	HOW TO USE
 *
	global $wpdb;
	$table_name = $wpdb->prefix.'posts';   
	$crud = new RMD_Crud($table_name);
	$crud = new RMD_Crud_Limit($crud, 10, 0); 
	$response = $crud->get();
 
 */
class RMD_Crud_Limit extends RMD_Crud_Clause
{

	private $limit_clause  = 0;
	private $offset_clause = 0; 

	/**
 	 *	@param 	object	  	$RMD_Crud - the class object that implements this interface RMD_Crud_Interface
 	 *	@param 	integer 	$limit - the limit for the sql results.
 	 *	@param 	integer 	$offset - the offset for the sql results.
 	 */
	public function __construct(RMD_Crud_Interface $RMD_Crud, $limit = 0, $offset = 0)
	{
		parent::__construct($RMD_Crud);
		$this->set_limit($limit, $offset);
	}



	/**
	 *	set_limit - this method will set up the limit and offset clause
	 *
	 *	@param 	integer 	$limit - the limit for the sql results.
 	 *	@param 	integer 	$offset - the offset for the sql results.
 	 * 	@return object 		current class
	 */
	private function set_limit($limit = 0, $offset = 0) 
	{  
		if(!is_int($limit) || !is_int($offset)) {
			exit('Error: RMD_Crud_Limit requires an integer as its second and third parameter.');			
		}  

		$this->limit_clause  = $limit; 
		$this->offset_clause = $offset; 
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

 		if($this->limit_clause != 0) {
			$sql = "$sql LIMIT $this->offset_clause, $this->limit_clause";
		}  
		return $sql;
 	}

}
