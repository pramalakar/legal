<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Blitzo
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row" > 
		<div class="col-sm-1 col-md-1 col-lg-1 hidden-xs">
			<?php blitzo_posted_date(); ?>
		</div> 
		<div class="col-sm-11 col-md-11 col-lg-11" >
			<div class="rmd-content-page-container" > 

				<header class="entry-header">
					<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

					<?php if ( 'post' === get_post_type() ) : ?> 
					<div class="entry-meta visible-xs-block">
						<?php blitzo_posted_on(); ?>  
					</div><!-- .entry-meta -->
					<?php endif; ?> 
				</header><!-- .entry-header -->

				<?php blitzo_post_thumbnail(); ?>

				<div class="entry-summary">
					<?php the_excerpt(); ?>
				</div><!-- .entry-summary -->

				<footer class="entry-footer">
					<?php blitzo_entry_footer(); ?>
				</footer><!-- .entry-footer -->
			</div>
		</div>
	</div> 
</article><!-- #post-## -->
 
