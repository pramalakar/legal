<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Blitzo
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row" > 

		<?php if ( is_single() ): ?>

		<div class="col-sm-12" >
  
			<div class="rmd-content-page-container" >
				<?php if ( 'post' === get_post_type() ) : ?> 
					<div class="entry-meta">
						<?php blitzo_posted_on(); ?>  
					</div><!-- .entry-meta --> 
				<?php endif; ?>

				<?php blitzo_post_thumbnail(); ?>

				<div class="entry-content">
					<?php
						the_content( sprintf(
							/* translators: %s: Name of current post. */
							wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'rmd-theme' ), array( 'span' => array( 'class' => array() ) ) ),
							the_title( '<span class="screen-reader-text">"', '"</span>', false )
						) );

						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'rmd-theme' ),
							'after'  => '</div>',
						) );
					?> 
				</div><!-- .entry-content -->

				<footer class="entry-footer">
					<?php blitzo_entry_footer(); ?>
				</footer><!-- .entry-footer -->
			</div>
		</div>

		<?php else: ?>
		
			<div class="col-sm-1 col-md-1 col-lg-1 hidden-xs">
				<?php blitzo_posted_date(); ?>
			</div>
			<div class="col-sm-11 col-md-11 col-lg-11" >
				<div class="rmd-content-page-container" > 

					<header class="entry-header">
						<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
						?>
						<?php if ( 'post' === get_post_type() ) : ?> 
							<div class="entry-meta visible-xs-block">
								<?php blitzo_posted_on(); ?>  
							</div><!-- .entry-meta -->
						<?php endif; ?>
					</header>

					<?php blitzo_post_thumbnail(); ?>
					
					<div class="entry-content">
						<?php
							the_excerpt();

							wp_link_pages( array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'rmd-theme' ),
								'after'  => '</div>',
							) );
						?>
					</div><!-- .entry-content -->

					<footer class="entry-footer">
						<?php blitzo_entry_footer(); ?>
					</footer><!-- .entry-footer -->
				</div> 
			</div> 

		<?php endif; ?>
 
	</div> 
</article><!-- #post-## -->
