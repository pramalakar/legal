<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
						<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'rmd-theme' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
					</div>
					<div class="col-md-3" ></div>
				</div>
			</header><!-- .entry-header --> 
		</div>
		<div class="col-md-9"> 
			<section id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
 

				<?php if ( have_posts() ) : ?>
 
					<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'template-parts/content', 'search' );

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
			</section><!-- #primary -->
		</div>
		<div class="col-md-3" >
			<div class="sidebar-container search-sidebar" >
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</div>
<?php 
get_footer();