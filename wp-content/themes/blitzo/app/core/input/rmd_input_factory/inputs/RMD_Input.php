<?php 
namespace theme\rmd\core\input;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/***
 *	WP Editor Toolbar 1
	Array
	(
	    [0] => bold
	    [1] => italic
	    [2] => strikethrough
	    [3] => bullist
	    [4] => numlist
	    [5] => blockquote
	    [6] => hr
	    [7] => alignleft
	    [8] => aligncenter
	    [9] => alignright
	    [10] => link
	    [11] => unlink
	    [12] => wp_more
	    [13] => spellchecker
	    [14] => fullscreen
	    [15] => wp_adv
	)
 */

/***
 *	WP Editor Toolbar 2
	Array
	(
	    [0] => formatselect
	    [1] => underline
	    [2] => alignjustify
	    [3] => forecolor
	    [4] => pastetext
	    [5] => removeformat
	    [6] => charmap
	    [7] => outdent
	    [8] => indent
	    [9] => undo
	    [10] => redo
	    [11] => wp_help
	)
 */
 
abstract class RMD_Input 
{	
	protected $input_attr = array(
				'input_type'  				=> 'text',
				'input_name'  				=> '',
				'input_value' 				=> '',
				'input_default' 			=> '', // this is usefull in the color picker which has a default button for resetting to its default color.
				'input_label' 				=> '',
				'input_class' 				=> '',
				'input_description' 		=> '',
				'input_media_caption' 		=> array('upload'=>'Upload Image','remove'=>'Remove Image'),
				'input_media_modal_heading' => 'Insert Image',
				'input_media_modal_button'  => 'Set Image',
				'input_data' 				=> array(),
				'input_option' 				=> array(),
				'input_width'				=> '100%', // it can be px or %,
				'input_display'				=> 'block', //block, inline
				'input_wpeditor_settings'	=> array( 
							'media_buttons' => true,
							'quicktags'     => true, 
							// 'tinymce' => array(
							//	'toolbar' => true, // set it to false if you intent to remove all the toolbars.
							// 	'toolbar1' => '',  // set it to false if you intent to remove all the toolbars.
							//	'toolbar2' => '',  // set it to false if you intent to remove all the toolbars.
							// 	'toolbar1' => 'bold, italic, alignleft, aligncenter, alignright, alignjustify, link, unlink, forecolor, fontsizeselect',
							// 	'toolbar2' => false
							// 	),
						) 
			);	
 

	public function __construct(array $input_attr = array())
	{ 
		$this->input_attr = array_merge($this->input_attr, $input_attr);
	}

	abstract public function render();

}
 