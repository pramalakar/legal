<?php
namespace theme\rmd\extension\testimonial\app\factories\settings;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

abstract class RMD_Setting
{	 
	protected $data = array();
	
	abstract public function render();
 }