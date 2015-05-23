<?php

remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_before_post_content', 'genesis_post_info' );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_after_post_content', 'genesis_post_meta' );

add_action( 'genesis_entry_content', 'edd_author_image', 5 );
add_action( 'genesis_post_content', 'edd_author_image', 5 );
function edd_author_image() {
	if ( ! has_post_thumbnail() ) {
		return;
	}

	$attributes = array(
		'class' => 'alignright',
		'alt'   => the_title_attribute( 'echo=0' ),
		'width' => 300,
	);
	$image = get_the_post_thumbnail( get_the_ID(), 'publication', $attributes );
	echo wp_kses_post( $image );
}

add_action( 'genesis_entry_content', 'edd_author_links', 50 );
add_action( 'genesis_post_content', 'edd_author_links', 50 );
function edd_author_links() {

	$prefix        = '_eddauthor_';
	$custom_fields = array(
		'amazon'      => __( 'Amazon', 'edd-author' ),
		'barnesnoble' => __( 'Barnes & Noble', 'edd-author' ),
		'kobo'        => __( 'Kobo', 'edd-author' ),
		'smashwords'  => __( 'Smashwords', 'edd-author' ),
	);

	foreach ( $custom_fields as $key => $value ) {
		$url = get_post_meta( get_the_ID(), $prefix . $key, true );

		if ( $url ) {
			$links[] = sprintf( '<a href="%s" target="_blank" class="button vendor">%s</a>',
				esc_url( $url ),
				esc_attr( $value )
			);
		}
	}

	if ( ! empty( $links ) ) {
		echo '<h2 class="vendors">Purchase Online:</h2>';
		echo '<div class="vendor-buttons">';
		foreach ( $links as $link ) {
		 	echo wp_kses_post( $link );
		}
		echo '</div>';
	}

}

genesis();
