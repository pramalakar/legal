<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

extract($attr);

$rmd_cm_image_half_content_image = get_post_meta($post_id, 'rmd_cm_image_half_content_image', true); 
$rmd_cm_image_half_content_image_style = (!empty($rmd_cm_image_half_content_image))? 'style="background-image:url('.$rmd_cm_image_half_content_image.')"' : '';

$rmd_cm_image_half_content_content_bgcolor = get_post_meta($post_id, 'rmd_cm_image_half_content_content_bgcolor', true); 
$rmd_cm_image_half_content_content_bgcolor = (!empty($rmd_cm_image_half_content_content_bgcolor))? $rmd_cm_image_half_content_content_bgcolor : '#fff';
$rmd_cm_image_half_content_content_bgcolor_style = 'style="background-color:'.$rmd_cm_image_half_content_content_bgcolor.'"';

$rmd_cm_image_half_content_content = get_post_meta($post_id, 'rmd_cm_image_half_content_content', true); 
$rmd_cm_image_half_content_image_alignment = get_post_meta($post_id, 'rmd_cm_image_half_content_image_alignment', true); 
 
?>

<div class="rmd-image-half-content-wrapper <?php echo $rmd_cm_image_half_content_image_alignment; ?>" > 
    <div class="rmd-image-bgimage-container" <?php echo $rmd_cm_image_half_content_image_style; ?> ></div> 
    <div class="rmd-content-bgcolor-container" <?php echo $rmd_cm_image_half_content_content_bgcolor_style; ?> ></div> 
    <div class="row"> 
        <div class="col-sm-6" >
            <div class="rmd-left-content-container">  
                <?php echo do_shortcode($rmd_cm_image_half_content_content); ?>
            </div>
        </div>
        <div class="col-sm-6" >
            <div class="rmd-right-content-container">  
                <?php echo do_shortcode($rmd_cm_image_half_content_content); ?>
            </div>
        </div> 
    </div>  
</div>


 