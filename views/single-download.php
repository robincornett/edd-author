<?php

add_action( 'genesis_entry_content', 'edd_publications_image', 5 );
function edd_publications_image() {
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

add_action( 'genesis_entry_content', 'edd_publications_links', 50 );
function edd_publications_links() {

	$prefix        = '_eddpublications_';
	$custom_fields = array(
		'amazon'      => __( 'Amazon', 'edd-publications-rabia' ),
		'barnesnoble' => __( 'Barnes & Noble', 'edd-publications-rabia' ),
		'kobo'        => __( 'Kobo', 'edd-publications-rabia' ),
		'smashwords'  => __( 'Smashwords', 'edd-publications-rabia' ),
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
		echo '<h2>Purchase Online:</h2>';
		foreach ( $links as $link ) {
		 	echo wp_kses_post( $link );
		}
	}

}

genesis();
