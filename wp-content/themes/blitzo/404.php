<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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
							<h1 class="entry-title"> </h1> 
						</div>
						<div class="col-md-3" ></div>
					</div>
				</header><!-- .entry-header --> 
			</div>  
			<div class="col-md-12">   
				<section class="error-404 not-found">
					<p class="text-center caption-404">404</p>
					<p class="description text-center"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'blitzo' ); ?></p>
				</section><!-- .error-404 -->
			</div>
		</div>
	</div>

<?php
get_footer();
