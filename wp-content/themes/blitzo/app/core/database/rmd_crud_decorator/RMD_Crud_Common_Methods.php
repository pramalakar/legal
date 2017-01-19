<?php 
namespace theme\rmd\core\database;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 *	I created this php trait to set up the common methods for the RMD_Crud.
 *
 * 	As of PHP 5.4.0, PHP implements a method of code reuse called Traits. 
 */
trait RMD_Crud_Common_Methods
{
	/**
	 *	insert - the insert method for the wp crud 
	 *
	 * 	@param [array]  	the data that you want to insert using array value pair
	 *				   		Ex., array('field1'=>'value1', 'field2'=>'value2');
	 * 	@return This method returns false if the row could not be inserted. 
	 *			Otherwise, it returns the last inserted ID.
	 */
	public function insert(array $data = array())
	{
		$table_name = $this->get_table_name();

		global $wpdb;   
		$response = $wpdb->insert($table_name, $data); 
		if($response === FALSE) {
			return FALSE;
		} else {
			return $wpdb->insert_id;
		}
	}



	/**
	 *	update - the update method for the wp crud 
	 *
	 * 	@param [array]   	the data that you want to update using array value pair.
	 *				  		Ex., array('field1'=>'value1', 'field2'=>'value2');
	 * 	@param [array]  	this will be appended on the part of where clause using array value pair.
	 *				 		Ex., array('field1'=>'value1');
	 *  @return This method returns the number of rows updated, or false if there is an error. 
	 *			Keep in mind that if the $data matches what is already in the database, no rows will be updated, 
	 *			so 0 will be returned. Because of this, you should probably check the return with false === $result.
	 */
	public function update(array $data = array(), array $where = array())
	{
		$table_name = $this->get_table_name();

		global $wpdb;       
		return $wpdb->update($table_name, $data, $where); 
	}


	/**
	 *	delete - the delete method for the wp crud
	 *
	 * 	@param [string] 	specify the table name.
	 * 	@param [array]   	this will be appended on the part of where clause using array value pair.
	 *				 		[Ex., array('field1'=>'value1');
	 *	@return It returns the number of rows updated, or false on error.
	 */
	public function delete(array $where = array())
	{
		$table_name = $this->get_table_name(); 

		global $wpdb;       
		return $wpdb->delete($table_name, $where); 

	}

}

