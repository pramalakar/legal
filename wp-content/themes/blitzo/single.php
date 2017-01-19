<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Blitzo
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post();?>

<div class="container" >
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
		<div class="col-md-9"> 
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
					
				<?php 

					get_template_part( 'template-parts/content', get_post_format() );
  
					blitzo_post_navigation();

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) : 
						comments_template(); 
					endif; 
				?>

				</main><!-- #main -->
			</div><!-- #primary -->
		</div>
		<div class="col-md-3" >
			<div class="sidebar-container single-sidebar" >
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</div>
<?php endwhile; // End of the loop. ?>

<?php 
get_footer();
