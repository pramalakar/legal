<?php
namespace theme\rmd\core\input;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 *	RMD_Mediauploader_Input - this class will manage to create media uploader input field.
 */
/***
 *	HOW TO USE:
	
	$input_attr = array(
	        'input_type'  => 'mediauploader',
			'input_label' => 'Sample Image',
			'input_name'  => 'sample_image',
			'input_media_caption' => array(
				'upload' => 'Upload Image',
				'remove' => 'Remove Image'
			),
			'input_media_modal_heading' => 'Insert Image',
			'input_media_modal_button' => 'Set Image'
	    ),  
	echo RMD_Input_Handler::render($input_attr);

 *
 */ 

 
class RMD_Mediauploader_Input extends RMD_Input 
{  
	public function render()
	{
		ob_start();   
		echo $this->uploader_input();
		return ob_get_clean(); 
	}


	protected function uploader_input()
	{ 
		$input = $this->input_attr; 

		$input_media_caption_remove = (isset($input['input_media_caption']['remove']) && !empty($input['input_media_caption']['remove']))? $input['input_media_caption']['remove'] : 'Remove Image';
		$input_media_caption_upload = (isset($input['input_media_caption']['upload']) && !empty($input['input_media_caption']['upload']))? $input['input_media_caption']['upload'] : 'Upload Image';
		
		ob_start();  ?>
		<div class="input-container <?php echo $input['input_display']; ?>" > 
			<div class="rmdwp-media-wrapper">
			<?php if( ! empty($input['input_label'])): ?>
				<div class="label-column" >
					<label style="display:block; margin-top:5px; margin-bottom:5px" for="<?php echo $input['input_name']; ?>" ><?php echo $input['input_label']; ?></label> 
				</div>
			<?php endif;  ?>
			<div class="input-column">
				<div class="rmdwp-media-container">
					<?php if( ! empty($input['input_value'])): ?>
						<img src="<?php echo $input['input_value']; ?>" />
					<?php endif; ?>
				</div> 
				<?php if( ! empty($input['input_value'])): ?>
					<a href="#" class="rmdwp-remove-media"><?php echo $input_media_caption_remove; ?></a>  
				<?php else: ?>
					<a href="#" class="rmdwp-upload-media"><?php echo $input_media_caption_upload; ?></a>  
				<?php endif; ?> 

				<input type="hidden" name="<?php echo $input['input_name']; ?>" value="<?php echo $input['input_value']; ?>" class="rmdwp-hidden-input <?php echo $input['input_class']; ?>" >
				<input type="hidden" class="rmdwp-media-modal-heading" value="<?php echo $input['input_media_modal_heading']; ?>" >
				<input type="hidden" class="rmdwp-media-modal-button" value="<?php echo $input['input_media_modal_button']; ?>" >
				<input type="hidden" class="rmdwp-hidden-input-upload-caption" value="<?php echo $input_media_caption_upload; ?>" >
				<input type="hidden" class="rmdwp-hidden-input-remove-caption" value="<?php echo $input_media_caption_remove; ?>" >

			<?php if( ! empty($input['input_description'])): ?>
				<em style="display: block;" class="input-description"><?php echo $input['input_description']; ?></em> 
			<?php endif; ?>
			</div>
			</div>
		</div>
		<?php
		return ob_get_clean(); 
	}
 
 
}
