<?php
/**
Template Name: Directory Service Search
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Blitzo
 */

get_header(); ?>



<div style="background:url('http://localhost:8888/legal/wp-content/uploads/2017/01/AdobeStock_96445943_WM.jpeg') center center no-repeat; background-size: cover;">
	<div class="container padding-top-160 padding-bottom-80">
		<div class="row">
			<div class="col-md-7">
				<input type="text" name="searchText" placeholder="Keyword, Business Name, Product or Service">
			</div>
			<div class="col-md-3">
				<select>
					<option selected value="NSW">NSW</option>
					<option value="NT">NT</option>
					<option value="ACT">ACT</option>
					<option value="WA">WA</option>
					<option value="SA">SA</option>
					<option value="QLD">QLD</option>
					<option value="TAS">TAS</option>
					<option value="VIC">VIC</option>
				</select>
			</div>
			<div class="col-md-2">
				<input type="button" class="button" name="search" value="Search">
			</div>
		</div>
		<div class="row tablewrap margin-top-50">
			<label class="filter tablecell">
			  <input type="radio" name="fb" value="accountants" />
			  <img src="http://localhost:8888/legal/wp-content/uploads/2017/01/Asset-113x.png" width="80">
			</label>
			<label class="filter tablecell">
			  <input type="radio" name="fb" value="court agents" />
			  <img src="http://localhost:8888/legal/wp-content/uploads/2017/01/Asset-103x.png" width="80">
			</label>
			<label class="filter tablecell">
			  <input type="radio" name="fb" value="court agents" />
			  <img src="http://localhost:8888/legal/wp-content/uploads/2017/01/Asset-93x-1.png" width="80">
			</label>
			<label class="filter tablecell">
			  <input type="radio" name="fb" value="employment" />
			  <img src="http://localhost:8888/legal/wp-content/uploads/2017/01/Asset-83x-1.png" width="80">
			</label>
			<label class="filter tablecell">
			  <input type="radio" name="fb" value="funder & finance" />
			  <img src="http://localhost:8888/legal/wp-content/uploads/2017/01/Asset-73x-1.png" width="80">
			</label>
			<label class="filter tablecell">
			  <input type="radio" name="fb" value="business consultants" />
			  <img src="http://localhost:8888/legal/wp-content/uploads/2017/01/Asset-63x-1.png" width="80">
			</label>
			<label class="filter tablecell">
			  <input type="radio" name="fb" value="it networking consultants" />
			  <img src="http://localhost:8888/legal/wp-content/uploads/2017/01/Asset-53x-1.png" width="80">
			</label>
			<label class="filter tablecell">
			  <input type="radio" name="fb" value="office equipment & services" />
			  <img src="http://localhost:8888/legal/wp-content/uploads/2017/01/Asset-43x-1.png" width="80">
			</label>
			<label class="filter tablecell">
			  <input type="radio" name="fb" value="property services" />
			  <img src="http://localhost:8888/legal/wp-content/uploads/2017/01/Asset-33x-1.png" width="80">
			</label>
			
		</div>
	</div>
</div>

<!-- Search Result -->
<div class="container searchList">
		<div class="col-md-12 padding-top-30 padding-bottom-30">
			<div class="col-md-3">
				<img src="http://localhost:8888/legal/wp-content/uploads/2017/01/c25291a5-41ad-3250-b66f-6a4644f1af6e.jpg">
			</div>
			<div class="col-md-9">
				<div class="col-md-12 title">
					<div class="col-md-8">
						<h3>Cascade Consulting</h3>
					</div>
					<div class="col-md-4">
						<h4><i class="fa fa-map-marker" aria-hidden="true"></i>Location NSW</h4>
					</div>
				</div>
				<div class="col-md-12">
					<p><i class="fa fa-phone" aria-hidden="true"></i>  0409 999 2317</p>
					<p><i class="fa fa-envelope" aria-hidden="true"></i>  cascade@cascadeconsulting.com.au </p>
					<p><i class="fa fa-internet-explorer" aria-hidden="true"></i>  www.cascadeconsulting.com.au</p>
				</div>
			</div>
		</div>
		<div class="col-md-12 padding-top-30 padding-bottom-30">
			<div class="col-md-3">
				<img src="http://localhost:8888/legal/wp-content/uploads/2017/01/c25291a5-41ad-3250-b66f-6a4644f1af6e.jpg">
			</div>
			<div class="col-md-9">
				<div class="col-md-12 title">
					<div class="col-md-8">
						<h3>Cascade Consulting</h3>
					</div>
					<div class="col-md-4">
						<h4><i class="fa fa-map-marker" aria-hidden="true"></i>Location NSW</h4>
					</div>
				</div>
				<div class="col-md-12">
					<p><i class="fa fa-phone" aria-hidden="true"></i>  0409 999 2317</p>
					<p><i class="fa fa-envelope" aria-hidden="true"></i>  cascade@cascadeconsulting.com.au </p>
					<p><i class="fa fa-internet-explorer" aria-hidden="true"></i>  www.cascadeconsulting.com.au</p>
				</div>
			</div>
		</div>
</div>





<div class="container">
	<div class="row">
		<div class="col-md-12" > 
			<header class="main-entry-header entry-header">
				<div class="rmd-background-fluid entry-header-background" ></div> 
				<div class="row" >
					<div class="col-md-9" >  
						<?php if ( have_posts() ) : ?>  
							<?php
								the_archive_title( '<h1 class="page-title">', '</h1>' );
								the_archive_description( '<div class="taxonomy-description">', '</div>' ); 
							?> 
						<?php else: ?> 
							<h1 class="entry-title"><?php esc_html_e( 'Nothing Found', 'blitzo' ); ?></h1>  
						<?php endif; ?> 
					</div>
					<div class="col-md-3" ></div>
				</div>
			</header><!-- .entry-header --> 
		</div>
		<div class="col-md-9">   
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
				<div>
					
					
				</div>




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
