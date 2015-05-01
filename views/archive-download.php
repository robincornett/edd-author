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

remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );

add_action( 'genesis_entry_header', 'edd_publications_archive_thumbnail', 5 );
function edd_publications_archive_thumbnail() {

	$img = genesis_get_image( array(
		'format'  => 'html',
		'size'    => 'publication',
		'context' => 'archive',
		'attr'    => array( 'alt' => get_the_title(), 'class' => 'aligncenter entry-image' ),
	) );

	if ( ! empty( $img ) ) {
		printf( '<a href="%s" aria-hidden="true">%s</a>', get_permalink(), $img );
	}
}

genesis();
