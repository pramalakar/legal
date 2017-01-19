<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Blitzo
 */

get_header(); ?>

<div class="container" >
	<div class="row">
		<div class="col-md-12" > 
			<header class="main-entry-header entry-header">
				<div class="rmd-background-fluid entry-header-background" ></div> 
				<div class="row" >
					<div class="col-md-9" > 
						<h1 class="entry-title"><?php esc_html_e( 'Careers', 'blitzo' ); ?></h1> 
					</div>
					<div class="col-md-3" ></div>
				</div>
			</header><!-- .entry-header --> 
		</div>  
		<div class="col-md-9">   
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
				 
				<?php
				if ( have_posts() ) : ?> 

					<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();
						
						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_format() );
						
					endwhile;

					the_posts_pagination(array(
						'screen_reader_text' => ' ',
					    'mid_size' => 4,
					    'prev_text' => __( '&lt;' ),
    					'next_text' => __( '&gt;' ),
					));

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>

				</main><!-- #main -->
			</div><!-- #primary -->
		</div>
		<div class="col-md-3" >
			<div class="sidebar-container archive-sidebar" >
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</div>

<?php 
get_footer();
