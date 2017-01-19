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

			if(!empty($show_lightbox)) {
				$show_lightbox = strtolower($show_lightbox);
				if($show_lightbox == 'yes'){
					$rmd_gallery_link = '#';
				} 
			} 
 			 
			$caption = $rmd_gallery_caption;

			$item_container = '<div class="item-container" data-number="'.$gallery_ctr.'" data-caption="'.$caption.'" data-image="'.$rmd_gallery_image.'" > 
				 	<img class="img-responsive" src="'.$rmd_gallery_image.'" alt="'.$caption.'" >
				</div>';

			if(!empty($rmd_gallery_link)) {
				$item_tag = '<div class="column">
					<a '.$rmd_gallery_link_target_tag.' class="image-link" href="'.$rmd_gallery_link.'" >'.$item_container.'</a>
				</div>'; 
			} else {
				$item_tag = '<div class="column">'.$item_container.'</div>';
			}
				 

			$row_items_tag .= $item_tag;
			
 
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
			.rmd-gallery-wrapper.type-brand-center {
				text-align: center;
			}
			.rmd-gallery-wrapper.type-brand-center .column {
				padding:15px 20px;
				background-color: transparent;
				display: inline-block; 
				overflow: hidden;
			}
			.rmd-gallery-wrapper.type-brand-center .item-container { 
				height: auto;
				width: auto;
				float: left;
			}
			.rmd-gallery-wrapper.type-brand-center .item-container img{ 
				max-height: 50px;
			    width: auto;
			} 
		</style>
	<?php 
		$stylesheet = ob_get_clean();  
		$stylesheet = trim(preg_replace('/\s+/', ' ', $stylesheet));
		echo $stylesheet."\n";
	?> 
	<div id="<?php echo $shortcode_id; ?>" class="rmd-gallery-wrapper type-brand-center <?php echo "$with_lightbox $with_layout"; ?>" >  
		<?php echo $row_items_tag; ?>    
	</div>     
<?php endif; 
