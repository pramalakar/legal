<?php
namespace theme\rmd\core\wppost;

use theme\rmd\core\input as Input;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 *	RMD_Metabox_Wppost - this class will manage to create a custom metabox for a particular post type.
 */
/***
 *	HOW TO USE:
	
	$wppost_type = 'metabox';
	$post_type = 'news'; 
	$config = array(
				'id' => 'myfirstmetaboxid',
		    	'header_title' => 'Extra Information',  
			    'inputs' => array( 
				    array(
						'input_type'  => 'text',
						'input_label' => 'My Extra Title',
						'input_name'  => 'my_extra_title',
						'input_value' => 'Default value',
						'input_class' => 'my-class-name widefat',
						'input_description' => 'This is a sample description for the input'
						),
			        array(
			            'input_type'  => 'mediauploader',
						'input_label' => 'Sample Image',
						'input_name'  => 'sample_image',
						'input_media_caption' => array(
							'upload' => 'Upload Image',
							'remove' => 'Remove Image'
						),
						'input_media_modal_heading' => 'Insert Image',
						'input_media_modal_button' => 'Set Image'
			            ) 
			       ),
			    'placement' => 'normal',       // optional [normal|advanced|side]
				'priority'  => 'high',         // optional [high|sorted|core|default|low] 
			    'bottom_text' => 'This is a reminder for the bottom text' //optional
		);
	RMD_Wppost_Generator::render($wppost_type, $post_type, $config);

 */ 

 
class RMD_Metabox_Wppost extends RMD_Wppost 
{	
	/**
	 *	These properties is used for the nonce input fields.
	 */
	private $wp_nonce_field_name	= 'rmd_wp_meta_box_nonce_name';
	private $wp_nonce_field_action	= 'rmd_wp_meta_box_nonce_action';
		
	/**
	 *	$new_meta_box_args - this property will store the new metabox args.
	 */
	private $new_meta_box_args 		= array();

	/**
	 *	$default_meta_box_args - this property holds the default metabox args.
	 */
	private $default_meta_box_args 	= array(  
				'id'				=> 'meta_box_id',
				'header_title'    	=> 'Meta Box Title',
				'placement'     	=> 'normal', 	// optional //array ( 'normal', 'advanced', 'side' )
				'priority'      	=> 'high',		// optional //array ( 'high', 'sorted', 'core', 'default', 'low' ) 
				'bottom_text'   	=> '',  
				'inputs'			=> array(),
				'content_before'	=> '',
				'content_after'		=> ''
			);



	/**
	 * 	[ create_meta_box - this will create the specific meta box for a post ]
	 *
	 * 	@param 	[array]		[ $meta_box_args - the metabox arguments or setting ]
	 *	@return [void]
	 */
	private function create_meta_box( $meta_box_args = array() )
	{     
		$post_type = $this->post_type;

		add_action('add_meta_boxes', function() use($meta_box_args, $post_type) {  

			/** 
			 * 	[add_meta_box - this will manage the specific meta box]
			 * 	@param [string]		[id - a unique ID that will be appended on you meta box]
			 * 	@param [string] 	[title - the header title or label that will display on your meta box panel]
			 * 	@param [function]	[callback - a function that will be call for creating the tmpl form for your meta box]
			 * 	@param [string|array] 	[screen - like post, page, attachment and a custom one like snippet and it should be lowercase]
			 * 	@param [string]		[context|placement - normal|advanced|side where the meta box should be displayed]
			 * 	@param [string]		[priority - high|core|default|low]
			 * 	@param [array] 		[callback_args - used for passing the specific parameter for the callback function]
			 */ 
			add_meta_box(
				$meta_box_args['id'],
				__( $meta_box_args['header_title'] ), 
				array( $this, 'create_meta_box_panel' ), 
				$post_type, 
				$meta_box_args['placement'],
				$meta_box_args['priority'],
				array(
					'input_fields'   => $meta_box_args['inputs'],  
					'bottom_text' 	 => $meta_box_args['bottom_text'],
					'content_before' => $meta_box_args['content_before'],
					'content_after'  => $meta_box_args['content_after']
					)
				);

		});

	} // end of create_meta_box
	

	/**
	 *	[ create_meta_box_panel - this will manage to create a metabox panel ]
	 *
	 *	@param 	[object] 	[ $post - an object containing the current post (as a $post object) ]
	 *	@param 	[array]		[ $metabox - an array with metabox id, title, callback, and args elements ]
	 *						[ The args element is an array containing your passed $callback_args variables ]
	 *	@return [void]
	 */
	public function create_meta_box_panel($post, $metabox) 
	{   
		$input_fields  		= $metabox['args']['input_fields']; 
		$bottom_text 		= $metabox['args']['bottom_text'];
		$content_before 	= $metabox['args']['content_before'];
		$content_after 		= $metabox['args']['content_after'];

		// display the content before the input fields.
		if(!empty($content_before)) { echo $content_before; }

		if(!empty($input_fields)) {

			foreach ($input_fields as $key => $new_input) { 

				$input_name  = isset( $new_input['input_name'] ) ? $new_input['input_name'] : '';
				$input_value = isset( $new_input['input_value'] ) ? $new_input['input_value'] : '';
 

				/** 
				 *	[get_post_meta - getting the meta box value]
				 * 	@param [integer]	[post id - it is the ID of the current displayed post, where you can access through global variable $post]
				 * 	@param [string]		[input_name - the input name / reference id that you specified as ID in the input field]
				 * 	@param [boolean]    [true returns array | false returns string]
				 */  
				$new_input_value = get_post_meta($post->ID, $input_name, true);
				$new_input_value = ( ! empty($new_input_value))? $new_input_value : $input_value;
				$new_input_value = esc_attr( $new_input_value );
 

				$new_input = array_merge($new_input, array(
					'input_value' => $new_input_value, 
					)); 

				$this->create_input_field($new_input);
			} 

			/* 
			The nonce field is used to validate that the contents of the form request 
			came from the current site and not somewhere else. A nonce does not offer 
			absolute protection, but should protect against most cases. It is very 
			important to use nonce fields in forms.
			*/
			wp_nonce_field( $this->wp_nonce_field_action, $this->wp_nonce_field_name);
 			
		} 

		// display a content after the inut fields.
		if(!empty($content_after)) { echo $content_after; }

		// display a text content at the bottom of the metabox panel.
		$this->display_metabox_bottom_text($bottom_text);

	}



	/**
	 *	[ create_input_field - this method will manage to create a metabox input field with the help of RMD_Input_Handler ]
	 *
	 *	@param 	[array]		[ $input_attr - the input attibutes ] 
	 * 	@return [void]
	 */
	private function create_input_field($input_attr)
	{ 	  
		$input_attr = array_merge($input_attr, array('input_class'=>'widefat')); 
		echo Input\RMD_Input_Handler::render($input_attr); 
	}


	/**
	 *	[ display_metabox_bottom_text - a content text that will be placed at the bottom of the matabox panel ]
	 *
	 *	@param 	[string]	[ $bottom_text - a content text ]
	 *	@return [void]
	 */
	private function display_metabox_bottom_text($bottom_text = null)
	{ 
		if( ! empty($bottom_text)):  ?>
			<p><?php echo $bottom_text; ?></p>
		<?php  endif;   
	}


	/**
	 *	[ save_meta_box - this method will manage to save the matabox data ]
	 *	
	 *	@return [void]
	 */
	public function save_meta_box()
	{	 
		global $post;

		if( ! isset( $_POST[$this->wp_nonce_field_name] )) {
			return; // checking if the nonce field is set otherwise just return
		}

		if( ! wp_verify_nonce($_POST[$this->wp_nonce_field_name], $this->wp_nonce_field_action ) ) {
			return; // verifying if the generated nonce field is valid otherwise just return
		}

		if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
			return; // to prevent autosave
		}

		if( ! current_user_can('edit_post', $post->ID) ) {
			return; // checking if the current user has the capacity to edit post.
		}

		// sanitize_text_field(); // this is use to escaped value and also clean up html tags

		$meta_box = $this->new_meta_box_args;

		$input_fields = isset( $meta_box['inputs'] ) ? $meta_box['inputs'] : array();


		if($this->post_type !== get_post_type() ) return;

		foreach ($input_fields as $key => $input) {  

			$input_name = isset( $input['input_name'] ) ? $input['input_name'] : '';
			
			if( !empty($input_name)) {
				$this->save_post_meta($input_name);
			} 
		}   

	} // end of save_meta_box.


	/**
	 *	[save_post_meta - saving the actual metabox data using 'update_post_meta' of wp ]
	 *
	 *	@param 	[string]	[ $input_name - the input of the metabox ]
	 *	@return [void]
	 */
	public function save_post_meta($input_name)
	{
		global $post;

		if(isset($post)) {
			if(isset($_POST[$input_name])) {
				// post ID, input name, value 
				update_post_meta($post->ID,$input_name,$_POST[$input_name]); 
			} else {
				update_post_meta($post->ID,$input_name,'');
			}
		} 
		  
	}


	/**
	 * 	[ render - this method will manage on rendering a custom metabox based on its metabox arguments ]
	 *
	 * 	@return [void]
	 */
	public function render()
	{	  
		$this->new_meta_box_args = array_merge($this->default_meta_box_args, $this->config);
		$this->create_meta_box($this->new_meta_box_args); 
		
		add_action( 'save_post', array( $this, 'save_meta_box' ) );
	}

}
