<?php
/**
 * 	Template part for the page templates
 * 
 * 	@package Blitzo
 */
 

$hide_title_class = '';
$show_title = get_post_meta(get_the_ID(), 'rmd_page_option_show_title', true);   
$show_title = (!empty($show_title))? $show_title : 'yes';  
$hide_title_class = ($show_title == 'no')? 'hide-title' : ''; 

$content_responsive_class = '';
$layout = get_post_meta(get_the_ID(), 'rmd_page_option_layout', true);  
$layout = (!empty($layout))? $layout : 'sidebar_right';
$content_responsive_class = ($layout == 'full_width')? 'col-md-12' : 'col-md-9'; 

?> 
<div class="container <?php echo $hide_title_class; ?>" >
	<div class="row">  
		<?php if($layout == 'sidebar_left'): ?>
		<div class="col-md-3 margin-top-30" >
			<div class="sidebar-container page-sidebar" >
				<?php get_sidebar(); ?>
			</div>
		</div>
		<?php endif; ?>
		<div class="<?php echo $content_responsive_class; ?>"> 
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main"> 
				<?php  get_template_part( 'template-parts/content', 'page' ); ?> 
				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif; 
				?> 
				</main><!-- #main -->
			</div><!-- #primary --> 
		</div> 
		<?php if($layout == 'sidebar_right'): ?>
		<div class="col-md-3 bg-lightgray" >
			<div class="sidebar-container page-sidebar" >
				<?php get_sidebar(); ?>
			</div>
		</div>
		<?php endif; ?> 

		<div class="row">
			<div class="col-md-12" >
				<div class="sidebar-container page-sidebar" >
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
		


	</div>
</div> 
<?php  