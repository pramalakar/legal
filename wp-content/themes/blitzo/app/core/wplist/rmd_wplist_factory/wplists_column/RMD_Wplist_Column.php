<?php 
namespace theme\rmd\core\wplist;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
abstract class RMD_Wplist_Column
{	 
	protected $config = array(
		'post_id' => '',
		'field_name' => '',
		'post_type' => '',
		'args' => array()
		);	


	public function __construct(array $config = array())
	{
		$this->config = array_merge($this->config, $config);
	}
	

	abstract public function render();

}

