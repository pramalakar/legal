<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Blitzo
 */

if ( ! function_exists( 'blitzo_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function blitzo_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>,  <time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'rmd-theme' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'rmd-theme' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<div style="margin-bottom:7px;"><span class="posted-on">' . $posted_on . '</span> <span class="byline"> ' . $byline . '</span></div>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'blitzo_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function blitzo_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'rmd-theme' ) );
		if ( $categories_list && blitzo_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'rmd-theme' ) . '</span><br>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'rmd-theme' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'rmd-theme' ) . '</span><br>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s </span> ', 'rmd-theme' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( ' Edit %s', 'rmd-theme' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function blitzo_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'blitzo_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'blitzo_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so blitzo_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so blitzo_categorized_blog should return false.
		return false;
	}
}


if ( ! function_exists( 'blitzo_posted_by' ) ) :
/**
 * Prints HTML with meta information for the current author.
 */
function blitzo_posted_by() { 
	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'rmd-theme' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;


if ( ! function_exists( 'blitzo_posted_date' ) ) :
/**
 * Prints HTML with meta information for the current post-date 
 */
function blitzo_posted_date() { 
	
	$day   = esc_attr( get_the_date('d') );
	$month = esc_attr( get_the_date('M') );
	$year  = esc_attr( get_the_date('Y') );

 	?> 
 	<div class="rmd-posted-date-container" >
	 	<div class="text-center panel panel-default">
	 		<div class="panel-heading"><?php echo $day; ?></div>
			<div class="panel-body"><?php echo $month; ?></div>
			<div class="panel-footer"><?php echo $year; ?></div>
		</div>  
	</div>
	<?php
}
endif;

 

if ( ! function_exists( 'blitzo_post_navigation' ) ) :
/**
 * Prints HTML with meta information for the current post-date 
 */
function blitzo_post_navigation() { 
	 
	$navigation = '';
	$previous   = get_previous_post_link( '%link', '<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> <div class="title">%title</div>', true );
	$next       = get_next_post_link( '%link', '<div class="title">%title</div> <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>', true );

	$prev_next_container = '<div class="post-navigation-container"><div class="navigation previous">'.$previous.'</div><div class="navigation next">'.$next.'</div> </div>';

	// Only add markup if there's somewhere to navigate to.
	if ( $previous || $next ) {
		$navigation = _navigation_markup( $prev_next_container, 'post-navigation', $screen_reader_text = ' ');
	}

	echo $navigation;
}
endif;




/**
 * Flush out the transients used in blitzo_categorized_blog.
 */
function blitzo_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'blitzo_categories' );
}
add_action( 'edit_category', 'blitzo_category_transient_flusher' );
add_action( 'save_post',     'blitzo_category_transient_flusher' );




if ( ! function_exists( 'blitzo_post_thumbnail' ) ) : 
/**
 * Print HTML the feauted image of a post.
 */
function blitzo_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="post-thumbnail">
		<?php the_post_thumbnail(); ?>
	</div><!-- .post-thumbnail -->

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php
			the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) );
		?>
	</a>

	<?php endif; // End is_singular()
}
endif;



 