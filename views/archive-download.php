<?php

add_filter( 'post_class', 'edd_publications_archive_post_class', 10, 2 );
function edd_publications_archive_post_class( $classes ) {
	global $wp_query;

	if ( ! $wp_query->is_main_query() ) {
		return $classes;
	}

	$term         = $wp_query->get_queried_object();
	$layout       = genesis_site_layout( $term );
	$number       = 2;
	$column_class = 'one-half';

	if ( in_array( $layout, array( __genesis_return_sidebar_content(), __genesis_return_content_sidebar() ) ) ) {
		$number       = 3;
		$column_class = 'one-third';
	}

	elseif ( __genesis_return_full_width_content() === $layout ) {
		$number       = 4;
		$column_class = 'one-fourth';
	}

	$classes[] = 'grid ' . $column_class;

	if ( 0 == $wp_query->current_post % $number ) {
		$classes[] = 'first';
	}

	return $classes;
}

add_filter( 'genesis_options', 'edd_publications_archive_options' );
/**
 * Change number of posts, as well as size and image alignment of featured image
 * on portfolio custom post type
 */
function edd_publications_archive_options( $args ) {
	$args['content_archive_thumbnail'] = 1;
	$args['image_size']                = 'publication';
	$args['image_alignment']           = 'aligncenter';

	return $args;
}

remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

add_action( 'genesis_entry_footer', 'genesis_entry_header_markup_open', 5 );
add_action( 'genesis_entry_footer', 'genesis_do_post_title' );
add_action( 'genesis_entry_footer', 'genesis_entry_header_markup_close', 15 );

add_action( 'genesis_before_loop', 'edd_publications_open_div', 15 );
add_action( 'genesis_after_loop', 'edd_publications_close_div' );
function edd_publications_open_div() {
	echo '<div class="publications">';
}

function edd_publications_close_div() {
	echo '</div>';
}


genesis();
