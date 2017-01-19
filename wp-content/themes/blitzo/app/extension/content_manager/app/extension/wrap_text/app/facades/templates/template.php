<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

extract($attr);

$image_tag = '';
$rmd_cm_wrap_text_image = get_post_meta($post_id, 'rmd_cm_wrap_text_image', true);  
if(!empty($rmd_cm_wrap_text_image)) {
    $image_tag = '<div class="rmd-image-container" ><img class="rmd-image-content" alt="'.$title.'" src="'.$rmd_cm_wrap_text_image.'" ></div>';
}

$rmd_cm_wrap_text_content = get_post_meta($post_id, 'rmd_cm_wrap_text_content', true); 
$rmd_cm_wrap_text_image_alignment = get_post_meta($post_id, 'rmd_cm_wrap_text_image_alignment', true); 
    
?>

<div class="rmd-wrap-text-wrapper <?php echo $rmd_cm_wrap_text_image_alignment; ?>" >  
    <div class="row"> 
        <div class="col-sm-12" >
            <div class="rmd-content-container">  
                <?php echo $image_tag; ?>
                <?php echo do_shortcode($rmd_cm_wrap_text_content); ?>
            </div>
        </div> 
    </div>  
</div>


 