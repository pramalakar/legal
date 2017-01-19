<?php 
namespace theme\rmd\core\wppost;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

abstract class RMD_Wppost 
{	
	protected $post_type = '';
	protected $config 	 = array();
 
	public function __construct($post_type, $config)
	{ 	
		$this->post_type = $post_type;
		$this->config = $config;
	}

	abstract public function render();

}