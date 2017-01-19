<?php
/**
 * The template for displaying all single posts for courses
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Blitzo
 */

// I set the loop here because there are some metabox setting that I need in the header part like for the slider.
while ( have_posts() ) : the_post();  

get_header();  
	
	$hide_title_class = '';
	$show_title = get_post_meta(get_the_ID(), 'rmd_page_option_show_title', true);   
	$show_title = (!empty($show_title))? $show_title : 'yes';  
	$hide_title_class = ($show_title == 'no')? 'hide-title' : ''; 

	$content_responsive_class = '';
	$layout = get_post_meta(get_the_ID(), 'rmd_page_option_layout', true);  
	$layout = (!empty($layout))? $layout : 'sidebar_right';
	$content_responsive_class = ($layout == 'full_width')? 'col-md-12' : 'col-md-9'; 

	$wrapper_styles = ''; 
	// Padding top and bottom 
	$rmd_crs_metabox_wrapper_bgpadding_top = get_post_meta(get_the_ID(), 'rmd_crs_metabox_wrapper_bgpadding_top', true); 
	if(!empty($rmd_crs_metabox_wrapper_bgpadding_top)) {
		$wrapper_styles .= "padding-top: $rmd_crs_metabox_wrapper_bgpadding_top;";
	} 
	$rmd_crs_metabox_wrapper_bgpadding_bottom = get_post_meta(get_the_ID(), 'rmd_crs_metabox_wrapper_bgpadding_bottom', true); 
	if(!empty($rmd_crs_metabox_wrapper_bgpadding_bottom)) {
		$wrapper_styles .= "padding-bottom: $rmd_crs_metabox_wrapper_bgpadding_bottom;";
	} 
	if(!empty($wrapper_styles)) {
		$wrapper_styles = 'style="'.$wrapper_styles.'"';
	} 

	?> 
	<div class="container <?php echo $hide_title_class; ?>" >
		<div class="row">  
			<div class="col-md-12" > 
				<header class="main-entry-header entry-header">
					<div class="rmd-background-fluid entry-header-background" ></div> 
					<div class="row" >
						<div class="col-md-12" >
							<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
						</div> 
					</div>
				</header><!-- .entry-header --> 
			</div>
			<?php if($layout == 'sidebar_left'): ?>
			<div class="col-md-3" >
				<div class="sidebar-container page-sidebar" >
					<?php get_sidebar(); ?>
				</div>
			</div>
			<?php endif; ?>
			<div class="<?php echo $content_responsive_class; ?>"> 
				<div id="primary" class="content-area">
					<main id="main" class="site-main" role="main">
						
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="row" >  
							<div class="col-sm-12" >  
								<div <?php echo $wrapper_styles; ?> class="rmd-content-page-container" > 
									<div class="entry-content">
										<?php the_content(); ?> 
									</div><!-- .entry-content -->
									<footer class="entry-footer">
										<?php blitzo_entry_footer(); ?>
									</footer><!-- .entry-footer -->
								</div> 
							</div> 
						</div> 
					</article><!-- #post-## -->


					</main><!-- #main -->
				</div><!-- #primary -->
			</div> 
			<?php if($layout == 'sidebar_right'): ?>
			<div class="col-md-3" >
				<div class="sidebar-container page-sidebar" >
					<?php get_sidebar(); ?>
				</div>
			</div>
			<?php endif; ?> 
		</div>
	</div> 
	<?php  


get_footer();

endwhile; // End of the loop.


