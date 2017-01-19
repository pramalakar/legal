<?php
namespace theme\rmd\core\input;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 *	RMD_Fileuploader_Input - this class will manage to create file uploader input field.
 */
/***
 *	HOW TO USE:
	
	$input_attr = array(
	        'input_type'  => 'fileuploader',
			'input_label' => 'Sample File',
			'input_name'  => 'sample_file',
			'input_media_caption' => array(
				'upload' => 'Upload File',
				'remove' => 'Remove File'
			),
			'input_media_modal_heading' => 'Insert File',
			'input_media_modal_button' => 'Set File'
	    ),  
	echo RMD_Input_Handler::render($input_attr);

 *
 */ 

 
class RMD_Fileuploader_Input extends RMD_Input 
{  
	public function render()
	{
		ob_start();  
		echo $this->uploader_css();
		echo $this->uploader_input();
		return ob_get_clean(); 
	}


	protected function uploader_input()
	{ 
		$input = $this->input_attr; 

		$input_file_caption_remove = (isset($input['input_file_caption']['remove']) && !empty($input['input_file_caption']['remove']))? $input['input_file_caption']['remove'] : 'Remove File';
		$input_file_caption_upload = (isset($input['input_file_caption']['upload']) && !empty($input['input_file_caption']['upload']))? $input['input_file_caption']['upload'] : 'Upload File';
		
		ob_start();  ?>
		<div class="input-container" style="width:<?php echo $input['input_width']; ?>" >
		<?php if( ! empty($input['input_label'])): ?>
			<label style="display:block; margin-top:5px; margin-bottom:5px" for="<?php echo $input['input_name']; ?>" ><?php echo $input['input_label']; ?></label> 
		<?php endif;  ?>
			<div class="rmdwp-file-container">
				<?php if( ! empty($input['input_value'])): ?>
					<div><?php echo $input['input_value']; ?></div> 
				<?php endif; ?>
			</div> 
			<?php if( ! empty($input['input_value'])): ?>
				<a href="#" class="rmdwp-remove-file btn btn-danger btn-block"><?php echo $input_file_caption_remove; ?></a>  
			<?php else: ?>
				<a href="#" class="rmdwp-upload-file btn btn-success btn-block"><?php echo $input_file_caption_upload; ?></a>  
			<?php endif; ?> 

			<input type="hidden" name="<?php echo $input['input_name']; ?>" value="<?php echo $input['input_value']; ?>" class="rmdwp-hidden-input <?php echo $input['input_class']; ?>" >
			<input type="hidden" class="rmdwp-file-modal-heading" value="<?php echo $input['input_file_modal_heading']; ?>" >
			<input type="hidden" class="rmdwp-file-modal-button" value="<?php echo $input['input_file_modal_button']; ?>" >
			<input type="hidden" class="rmdwp-hidden-input-upload-caption" value="<?php echo $input_file_caption_upload; ?>" >
			<input type="hidden" class="rmdwp-hidden-input-remove-caption" value="<?php echo $input_file_caption_remove; ?>" >

		<?php if( ! empty($input['input_description'])): ?>
			<em style="display: block;" class="input-description"><?php echo $input['input_description']; ?></em> 
		<?php endif;  ?>
		</div>
		<?php return ob_get_clean();
	}


	protected function uploader_css()
	{
		ob_start(); ?>
		<style type="text/css">
			.rmdwp-file-container { padding-bottom: 5px; }
			.rmdwp-file-container div { 
				position: relative;
				width: 100%;
				padding: 1em 1.5em;
				margin: 10px auto;
				color: #fff;
				background: #97C02F;
				overflow: hidden;
			}
			.rmdwp-file-container div:before {
				content: "";
				position: absolute;
				top: 0;
				right: 0;
				border-width: 0 16px 16px 0;
				border-style: solid;
				border-color: #fff #fff #658E15 #658E15;
				background: #658E15;
				-webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.3), -1px 1px 1px rgba(0,0,0,0.2);
				-moz-box-shadow: 0 1px 1px rgba(0,0,0,0.3), -1px 1px 1px rgba(0,0,0,0.2);
				box-shadow: 0 1px 1px rgba(0,0,0,0.3), -1px 1px 1px rgba(0,0,0,0.2);
				/* Firefox 3.0 damage limitation */
				display: block; width: 0;
			}
		</style>
		<?php
		return ob_get_clean(); 
	}
 
}
