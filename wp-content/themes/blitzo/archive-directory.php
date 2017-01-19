<?php get_header(); ?>

	<section id="blog" class="section">
		<div class="container">
			<div class="row">
				<section id="blog-posts" class="col-sm-8">
					<article class="card">
						<div class="card-content">
							<h1>Directories</h1>

							<select name="cat" class="postform">
								<option value="3">Tax A</option>
								<option value="14">Tax B</option>
								<option value="26">Tax C</option>
								<option value="29">Tax D</option>
							</select>


							<?php fjarrett_custom_taxonomy_dropdown( 'my_custom_taxonomy', 'date', 'DESC', '5', 'my_custom_taxonomy', 'Select All', 'Select None' ); ?>

							<?php

							function fjarrett_custom_taxonomy_dropdown( $taxonomy, $orderby = 'date', $order = 'DESC', $limit = '-1', $name, $show_option_all = null, $show_option_none = null ) {
								$args = array(
									'orderby' => $orderby,
									'order' => $order,
									'number' => $limit,
								);
								$terms = get_terms( $taxonomy, $args );
								$name = ( $name ) ? $name : $taxonomy;
								if ( $terms ) {
									printf( '<select name="%s" class="postform">', esc_attr( $name ) );
									if ( $show_option_all ) {
										printf( '<option value="0">%s</option>', esc_html( $show_option_all ) );
									}
									if ( $show_option_none ) {
										printf( '<option value="-1">%s</option>', esc_html( $show_option_none ) );
									}
									foreach ( $terms as $term ) {
										printf( '<option value="%s">%s</option>', esc_attr( $term->slug ), esc_html( $term->name ) );
									}
									print( '</select>' );
								}
							}
							?>





















							<?php 
							$query				=	new WP_Query(array(
								'post_type'		=>	'directory',
								'posts_per_page'=>	3,
								'orderby'		=>	'rand'

							));
							if( $query->have_posts() ){
								while( $query->have_posts() ){
									$query->the_post();

									?>
							
								 	<a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a><br>
								 	<?php 

								 	WP_reset_postdata();

								}
							}

							?>
						</div>
					</article>




				</section>
			</div>
		</div>

	</section>