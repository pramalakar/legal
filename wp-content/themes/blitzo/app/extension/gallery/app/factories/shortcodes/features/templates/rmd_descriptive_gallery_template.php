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
		
		$rmd_gallery_description = get_post_meta(get_the_ID(), 'rmd_gallery_description', true);  
		$rmd_gallery_description = trim($rmd_gallery_description);
 		$rmd_gallery_description = do_shortcode($rmd_gallery_description);

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
					$def_col_sm = 'col-sm-6 ';
					$def_col_md = 'col-md-3 ';
					$def_col_lg = 'col-lg-3 '; 
					break;
				case 3:  
					$def_col_xs = 'col-xs-12 ';
					$def_col_sm = 'col-sm-4 ';
					$def_col_md = 'col-md-4 ';
					$def_col_lg = 'col-lg-4 '; 
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


 			// Caption of gallery
			$title_tag = (!empty($rmd_gallery_caption))? '<h3 style="color:'.$text_color.'" ">'.$rmd_gallery_caption.'</h3>' : '';
			$description_tag = (!empty($rmd_gallery_description))? '<div class="description" style="color:'.$text_color.'" ">'.$rmd_gallery_description.'</div>' : '';


			// Caption container of the gallery 
			$caption_container = '';
			if(!empty($title_tag) || !empty($description_tag)) {
				$caption_container =  '<div class="caption-container text-'.$alignment.'" >'.$title_tag.$description_tag.'</div>';
			}
 			

 			// The image gallery item
 			if(!empty($rmd_gallery_link)) {
 				$item_container = '<div class="item-container" >  
				 	<a '.$rmd_gallery_link_target_tag.' href="'.$rmd_gallery_link.'"><div class="image-container"><img class="img-responsive" src="'.$rmd_gallery_image.'" alt="'.$rmd_gallery_caption.'" ></div></a>
				 	'.$caption_container.'
				</div>'; 
 			} else {
 				$item_container = '<div class="item-container" >  
				 	<div class="image-container"><img class="img-responsive" src="'.$rmd_gallery_image.'" alt="'.$rmd_gallery_caption.'" ></div>
				 	'.$caption_container.'
				</div>';
 			}
			
			$item_tag .= '<div class="column '.$responsive_class.'">'.$item_container.'</div>';

			 
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
			.rmd-gallery-wrapper.type-descriptive .item-container {
				display: block; 
				margin-bottom: 20px;
			}
			.rmd-gallery-wrapper.type-descriptive .item-container .image-container {
				overflow: hidden; 
				position: relative; 
			}
			.rmd-gallery-wrapper.type-descriptive .item-container .image-container img { 
				margin:0px; 
			} 
			.rmd-gallery-wrapper.type-descriptive .item-container .image-container:before {
				content: '';
				display: block;
				width: 100%;
				height:100%;
				top:0px;
				left:0px;
				background-color: #fff;
				position: absolute;
				opacity: 0; 
				-moz-transition: all 0.6s;
				-webkit-transition: all 0.6s;
				transition: all 0.6s;
			}
			.rmd-gallery-wrapper.type-descriptive .item-container .image-container:hover:before {
				opacity: 0.3;
				-moz-transform: scale(1.1);
				-webkit-transform: scale(1.1);
				transform: scale(1.1);
			}
			.rmd-gallery-wrapper.type-descriptive .caption-container {
				overflow: hidden; 
				bottom: 0; 
			}   
			.rmd-gallery-wrapper.type-descriptive .caption-container h3 { 
				line-height: 1.3em; 
				font-weight: 400;
				padding: 15px;
			} 
			.rmd-gallery-wrapper.type-descriptive .caption-container .description { 
				opacity: 0.8;
			} 
			.rmd-gallery-wrapper.type-descriptive.layout-fluid .row {
				margin-left: -3px !important;
				margin-right: -3px !important;
			}
			.rmd-gallery-wrapper.type-descriptive.layout-fixed .row {
				margin-left: -10px !important;
				margin-right: -10px !important;
			}
			.rmd-gallery-wrapper.type-descriptive .column {
				padding: 0px 15px 30px;
			}   
		</style>
	<?php 
		$stylesheet = ob_get_clean();  
		$stylesheet = trim(preg_replace('/\s+/', ' ', $stylesheet));
		echo $stylesheet."\n";
	?> 
	<div id="<?php echo $shortcode_id; ?>" class="rmd-gallery-wrapper type-descriptive <?php echo "$with_layout"; ?>" >  
		<?php echo $row_items_tag; ?>    
	</div>     
<?php endif; 
