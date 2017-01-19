<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Blitzo
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php blitzo_post_thumbnail(); ?>
	
	<div class="entry-content"> 
		<?php
			$content = get_the_content();
			$title = get_the_title();
			$id = get_the_ID();

			if ( shortcode_exists( 'rmd_column_manager' ) ) {
				echo do_shortcode('[rmd_column_manager title="'.$title.'" id="'.$id.'" ]'.$content.'[/rmd_column_manager]'); 
			} else {
				echo $content;
			}

			if ( shortcode_exists( 'rmd_column_manager_page_children' ) ) {
				echo do_shortcode('[rmd_column_manager_page_children parent_id="'.$id.'"]'); 
			} 


			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'rmd-theme' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content --> 
	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'rmd-theme' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->


 
