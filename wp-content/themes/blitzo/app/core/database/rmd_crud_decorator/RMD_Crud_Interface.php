<?php 
namespace theme\rmd\core\database;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 *	The interface for the RMD_Crud.
 */
interface RMD_Crud_Interface 
{ 
 	public function insert(array $data = array());
 	public function update(array $data = array(), array $where = array());
 	public function delete(array $where = array());  
 	public function get_table_name();
 	public function get_sql_string();
 	public function get_row();
 	public function get();
}

