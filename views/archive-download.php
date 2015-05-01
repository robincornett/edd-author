<?php

add_filter( 'post_class', 'edd_publications_archive_post_class', 10, 2 );
function edd_publications_archive_post_class( $classes ) {
	$classes[] = 'one-third';

	return $classes;
}


genesis();
