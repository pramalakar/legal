<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
  
extract($attr);
  
$additional_classes = '';
$wrapper_styles = '';
$bgimage_styles = '';
$bgcolor_styles = '';

$page_title = strtolower($title);  
$exp_page_title = explode(' ', $page_title);
$new_page_title = '';
foreach ($exp_page_title as $key => $value) {
	if (ctype_alnum($value)) {
		$new_page_title .= trim($value);
		if($key < ( count($exp_page_title) -1 ) ) {
			$new_page_title .= '-';
		}
	}  
} 
$container_id = $new_page_title;

$rmd_cc_metabox_column_type = get_post_meta($post_id, 'rmd_cc_metabox_column_type', true); 
 
switch ($rmd_cc_metabox_column_type) {
	case '1col':
	default:
		$num_column = 1;
		break;
	case '2col':
	case '123col':
	case '213col':
	case '134col': 
	case '314col': 
		$num_column = 2;
		break; 
	case '3col':
		$num_column = 3;
		break; 
	case '4col':
		$num_column = 4;
		break;   
}


// Background image and color position
$rmd_cc_metabox_wrapper_bgpos = get_post_meta($post_id, 'rmd_cc_metabox_wrapper_bgpos', true); 
if(!empty($rmd_cc_metabox_wrapper_bgpos)) {
	$additional_classes .= "$rmd_cc_metabox_wrapper_bgpos ";
}

// Background image size
$rmd_cc_metabox_wrapper_bgsize = get_post_meta($post_id, 'rmd_cc_metabox_wrapper_bgsize', true); 
if(!empty($rmd_cc_metabox_wrapper_bgsize)) {
	$additional_classes .= "$rmd_cc_metabox_wrapper_bgsize ";
}

// Background color
$rmd_cc_metabox_wrapper_bgcolor = get_post_meta($post_id, 'rmd_cc_metabox_wrapper_bgcolor', true); 
if(!empty($rmd_cc_metabox_wrapper_bgcolor)) {
	$bgcolor_styles .= "background-color: $rmd_cc_metabox_wrapper_bgcolor;";
} 

// Background image 
$rmd_cc_metabox_wrapper_bgimage = get_post_meta($post_id, 'rmd_cc_metabox_wrapper_bgimage', true); 
if(!empty($rmd_cc_metabox_wrapper_bgimage)) {
	$bgimage_styles .= "background-image: url($rmd_cc_metabox_wrapper_bgimage);";
} 

// Image Alignment
$rmd_cc_metabox_wrapper_bgimage_alignment = get_post_meta($post_id, 'rmd_cc_metabox_wrapper_bgimage_alignment', true); 
if(!empty($rmd_cc_metabox_wrapper_bgimage_alignment)) {
	$additional_classes .= "$rmd_cc_metabox_wrapper_bgimage_alignment ";
}

// Background color opacity
$rmd_cc_metabox_wrapper_bgcolor_opacity = get_post_meta($post_id, 'rmd_cc_metabox_wrapper_bgcolor_opacity', true); 
if(!empty($rmd_cc_metabox_wrapper_bgcolor_opacity)) {
	$bgcolor_styles .= "opacity: $rmd_cc_metabox_wrapper_bgcolor_opacity;";
}  

// Padding top and bottom 
$rmd_cc_metabox_wrapper_bgpadding_top = get_post_meta($post_id, 'rmd_cc_metabox_wrapper_bgpadding_top', true); 
if(!empty($rmd_cc_metabox_wrapper_bgpadding_top)) {
	$wrapper_styles .= "padding-top: $rmd_cc_metabox_wrapper_bgpadding_top;";
} 
$rmd_cc_metabox_wrapper_bgpadding_bottom = get_post_meta($post_id, 'rmd_cc_metabox_wrapper_bgpadding_bottom', true); 
if(!empty($rmd_cc_metabox_wrapper_bgpadding_bottom)) {
	$wrapper_styles .= "padding-bottom: $rmd_cc_metabox_wrapper_bgpadding_bottom;";
} 

// Border top and bottom color
$rmd_cc_metabox_wrapper_border_top_color = get_post_meta($post_id, 'rmd_cc_metabox_wrapper_border_top_color', true); 
if(!empty($rmd_cc_metabox_wrapper_border_top_color)) {
	$wrapper_styles .= "border-top:1px solid $rmd_cc_metabox_wrapper_border_top_color;";
} 
$rmd_cc_metabox_wrapper_border_bottom_color = get_post_meta($post_id, 'rmd_cc_metabox_wrapper_border_bottom_color', true); 
if(!empty($rmd_cc_metabox_wrapper_border_bottom_color)) {
	$wrapper_styles .= "border-bottom:1px solid $rmd_cc_metabox_wrapper_border_bottom_color;";
} 

// Wrapper Min Height 
$rmd_cc_metabox_wrapper_min_height = get_post_meta($post_id, 'rmd_cc_metabox_wrapper_min_height', true); 
if(!empty($rmd_cc_metabox_wrapper_min_height)) {
	$wrapper_styles .= "min-height: $rmd_cc_metabox_wrapper_min_height;";
} 

 
// Responsive Class
// -------------------
switch ($num_column) {
	case 1:
	default:
		$responsive_col_class = 'col-md-12';
		break;
	case 2:
		$responsive_col_class = 'col-md-6';
		break;
	case 3:
		$responsive_col_class = 'col-md-4';
		break;
	case 4:
		$responsive_col_class = 'col-md-3';
		break; 
}


$column_content = '';
for ($i=1; $i <= $num_column; $i++) { 
	 
	$content_status = FALSE;

	switch ($rmd_cc_metabox_column_type) {
		case '123col':
			$responsive_col_class = ($i == 1)? 'col-md-4' : 'col-md-8';
			break;
		case '213col':
			$responsive_col_class = ($i == 1)? 'col-md-8' : 'col-md-4';
			break;
		case '134col':
			$responsive_col_class = ($i == 1)? 'col-md-3' : 'col-md-9';
			break;
		case '314col':
			$responsive_col_class = ($i == 1)? 'col-md-9' : 'col-md-3';
			break; 
	} 

	$new_content = get_post_meta($post_id, 'rmd_cc_column_metabox_'.$i.'_content', true);  
 	
	// Column Background Style
	// -------------------------
	$col_background_image = get_post_meta($post_id, 'rmd_cc_metabox_column_'.$i.'_background_image', true);  

	$col_wrapper_style = ''; 
	if(!empty($col_background_image)) {
		$col_wrapper_style .= "background-image:url($col_background_image);";
	}   
	if(!empty($col_wrapper_style)) {
		$col_wrapper_style = 'style="'.$col_wrapper_style.'"';
	}
	

	// Column Overlay Style
	// -----------------------
	$col_background_color = get_post_meta($post_id, 'rmd_cc_metabox_column_'.$i.'_background_color', true); 
	$col_background_color_opacity = get_post_meta($post_id, 'rmd_cc_metabox_column_'.$i.'_background_color_opacity', true); 
	
	$col_overlay_style = '';
	if(!empty($col_background_color)) {
		$col_overlay_style .= "background-color:$col_background_color;";
	}
	if(!empty($col_background_color_opacity)) {
		$col_overlay_style .= "opacity:$col_background_color_opacity;";
	}
	if(!empty($col_overlay_style)) {
		$col_overlay_style = 'style="'.$col_overlay_style.'"';
	}

 
 
	// Column Content Tags
	// ---------------------- 
	$content_tag = '';
	if($new_content):
		$content_status = TRUE;
		$content_tag = '<div class="content" >'.$new_content.'</div>';
	endif;

	  
	if($content_status === FALSE) {
		$column_content .= '';
	} else {
		$column_content .= '<div class="column '.$responsive_col_class.'">
								<div '.$col_wrapper_style.' class="column-wrapper '.$rmd_cc_metabox_column_type.'">
									<div class="column-overlay" '.$col_overlay_style.' ></div>
									<div class="column-content-container" >'.$content_tag.'</div> 
								</div>
							</div>';
	} 

}     
?> 
<?php
	if(!empty($wrapper_styles)) {
		$wrapper_styles = 'style="'.$wrapper_styles.'"';
	} 
	if(!empty($bgimage_styles)) {
		$bgimage_styles = 'style="'.$bgimage_styles.'"';
	} 
	if(!empty($bgcolor_styles)) {
		$bgcolor_styles = 'style="'.$bgcolor_styles.'"';
	} 
?> 
<div <?php echo $wrapper_styles; ?> id="<?php echo $container_id; ?>" class="rmd-column-container-wrapper <?php echo $additional_classes; ?>" >
	<div <?php echo $bgimage_styles; ?> class="rmd-cc-background-image rmd-background-fluid"></div>
	<div <?php echo $bgcolor_styles; ?> class="rmd-cc-overlay rmd-background-fluid"></div>
	<div class="row" > 
		<?php echo do_shortcode($column_content); ?>
	</div> 
</div>



