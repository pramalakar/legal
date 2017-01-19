<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$have_gallery = FALSE;   
$gallery_ctr = 1;
$item_ctr = 1;
$item_tag = '';
$row_items_tag = '';

// The passed data from the shortcode
extract($attr);

if ( $results->have_posts() ) : 
 	
 	$count = $results->post_count;

  	while ( $results->have_posts() ) : $results->the_post();   
  		  
  		$title = get_the_title();
  		
   		$rmd_gallery_image = get_post_meta(get_the_ID(), 'rmd_gallery_image', true); 
		$rmd_gallery_image = trim($rmd_gallery_image);

		$rmd_gallery_caption = get_post_meta(get_the_ID(), 'rmd_gallery_caption', true);  
		$rmd_gallery_caption = trim($rmd_gallery_caption); 
		$rmd_gallery_caption = do_shortcode($rmd_gallery_caption);

		$rmd_gallery_link = get_post_meta(get_the_ID(), 'rmd_gallery_link', true);   
		$rmd_gallery_link = trim($rmd_gallery_link); 
		$rmd_gallery_link = do_shortcode($rmd_gallery_link); 

		$rmd_gallery_link_target = get_post_meta(get_the_ID(), 'rmd_gallery_link_target', true);
		$rmd_gallery_link_target_tag = '';
		if(!empty($rmd_gallery_link_target) && $rmd_gallery_link_target == 'yes') {
			$rmd_gallery_link_target_tag = 'target="_blank"';
		}   
  
		if(!empty($rmd_gallery_image)) {

			$responsive_class = '';
 			
			switch ($column) {
				case 4:
				default:
					$def_col_xs = 'col-xs-12 ';
					$def_col_sm = 'col-sm-3 ';
					$def_col_md = 'col-md-3 ';
					$def_col_lg = 'col-lg-3 '; 
					break;
				case 3:  
					$def_col_xs = 'col-xs-12 ';
					$def_col_sm = 'col-sm-4 ';
					$def_col_md = 'col-md-4 ';
					$def_col_lg = 'col-lg-4 '; 
					break; 
				case 6:   
					$def_col_xs = 'col-xs-12 ';
					$def_col_sm = 'col-sm-4 ';
					$def_col_md = 'col-md-2 ';
					$def_col_lg = 'col-lg-2 '; 
					break;
				case 2:    
					$def_col_xs = 'col-xs-12 ';
					$def_col_sm = 'col-sm-6 ';
					$def_col_md = 'col-md-6 ';
					$def_col_lg = 'col-lg-6 '; 
					break; 
			}

 			$responsive_class .= (!empty($column_xs))? RMD_Resposive_Helper::get_column_xs_class($column_xs).' ' : $def_col_xs;
			$responsive_class .= (!empty($column_sm))? RMD_Resposive_Helper::get_column_sm_class($column_sm).' ' : $def_col_sm;
			$responsive_class .= (!empty($column_md))? RMD_Resposive_Helper::get_column_md_class($column_md).' ' : $def_col_md;
			$responsive_class .= (!empty($column_lg))? RMD_Resposive_Helper::get_column_lg_class($column_lg).' ' : $def_col_lg; 
 

			if(!empty($show_lightbox)) {
				$show_lightbox = strtolower($show_lightbox);
				if($show_lightbox == 'yes'){
					$rmd_gallery_link = '#';
				} 
			} 
 			

			$foreground_tag = '';
			if(!empty($show_foreground)) {
				$show_foreground = strtolower($show_foreground);
				$foreground_tag = ($show_foreground == 'yes')? '<div style="background-color:'.$foreground_color.'" class="overlay" ></div>' : '';
			}


			$caption_tag = '';
			$caption = '';
			if(!empty($show_caption)) {
				$show_caption = strtolower($show_caption);
				if($show_caption == 'yes') { 	
					if(!empty($rmd_gallery_caption)) {
						$caption = $rmd_gallery_caption;
						$caption_tag = '<div class="button-container">
							<div class="button-label">
								<span>'.$caption .'</span>
								<div style="background-color:'.$foreground_color.'" class="button-label-overlay"></div>
							</div>
						</div>';
					}
				} 
			}
 


			$item_container = '<div class="item-container" data-number="'.$gallery_ctr.'" data-caption="'.$caption.'" data-image="'.$rmd_gallery_image.'"  > 
				 	'.$caption_tag.$foreground_tag.'
				 	<img class="img-responsive" src="'.$rmd_gallery_image.'" alt="'.$caption.'" >
				</div>';

			if(!empty($rmd_gallery_link)) {
				$item_tag .= '<div class="column '.$responsive_class.'">
					<a '.$rmd_gallery_link_target_tag.' class="image-link" href="'.$rmd_gallery_link.'" >'.$item_container.'</a>
				</div>';
			} else {
				$item_tag .= '<div class="column '.$responsive_class.'">'.$item_container.'</div>';
			}
				 

			if( $item_ctr == $column ) {
				$row_items_tag .= '<div class="row" >'.$item_tag.'</div>';
				$item_tag = '';
				$item_ctr = 1;
			} else {
				if( $gallery_ctr == $count ) {
					$row_items_tag .= '<div class="row" >'.$item_tag.'</div>';
					$item_tag = '';
					$item_ctr = 1;
				} else {
					$item_ctr++;
				} 
			} 
 
			$gallery_ctr++;
			$have_gallery = TRUE;
		}

  	endwhile;   
endif;  

wp_reset_postdata();


if($have_gallery): 
  
	$with_lightbox = ''; //lightbox 
	if(!empty($show_lightbox)) {
		$show_lightbox = strtolower($show_lightbox);
		$with_lightbox = ($show_lightbox == 'yes')? 'lightbox' : ''; // this lightbox class is intended for the javascript.
	}

	$with_layout = 'layout-fixed';
	if(!empty($layout)) {
		$layout = strtolower($layout);
		switch ($layout) {
			case 'fixed':
			default:
				$with_layout = 'layout-fixed';
				break;
			case 'fluid':
				$with_layout = 'layout-fluid';
				break;  
		}
	}   

	$shortcode_id = 'rmd_gallery_sh_id'.$rmd_gallery_shortcode_id;

	?>
	<?php ob_start(); ?> 
		<style type="text/css"> 
			.rmd-gallery-wrapper.type-box-gutter.layout-fluid .row {
				margin-left: -3px !important;
				margin-right: -3px !important;
			}
			.rmd-gallery-wrapper.type-box-gutter.layout-fixed .row {
				margin-left: -10px !important;
				margin-right: -10px !important;
			}
			.rmd-gallery-wrapper.type-box-gutter .column {
				padding: 0px 15px 30px;
			}   
		</style>
	<?php 
		$stylesheet = ob_get_clean();  
		$stylesheet = trim(preg_replace('/\s+/', ' ', $stylesheet));
		echo $stylesheet."\n";
	?> 
	<div id="<?php echo $shortcode_id; ?>" class="rmd-gallery-wrapper type-box-gutter <?php echo "$with_lightbox $with_layout"; ?>" >  
		<?php echo $row_items_tag; ?>    
	</div>     
<?php endif; 
