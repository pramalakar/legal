<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
  
extract($attr);

// Start of the children pages ...
$args = array(
    'post_type'      => 'page',
    'posts_per_page' => -1,
    'post_parent'    => $parent_id,
    'order'          => 'ASC',
    'orderby'        => 'menu_order'
 ); 
$parent = new WP_Query( $args );

if ( $parent->have_posts() ) : ?>

    <?php while ( $parent->have_posts() ) : $parent->the_post(); ?> 
        <div id="child-<?php the_ID(); ?>" class="child-container"> 
         	<?php 
				$title = get_the_title();
				$page_id = get_the_ID();
                $content = get_the_content();

                $rmd_cm_metabox_child_page_identifier = get_post_meta($page_id, 'rmd_cm_metabox_child_page_identifier', TRUE);

                if( $rmd_cm_metabox_child_page_identifier == 'child_section' )  {
                    if ( shortcode_exists( 'rmd_column_manager' ) ) {
                        echo do_shortcode('[rmd_column_manager title="'.$title.'" id="'.$page_id.'" ]'.$content.'[/rmd_column_manager]'); 
                    } 
                } 
				
         	?>  
        </div> 
    <?php endwhile; ?>

<?php endif; 

wp_reset_query();  
