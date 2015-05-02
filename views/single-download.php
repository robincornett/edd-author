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
	echo $image;
}

add_action( 'genesis_entry_content', 'edd_publications_links', 50 );
function edd_publications_links() {

	$custom_fields = array(
		'amazon_us'   => array(
			'Amazon US',
			'_rabia_amazon_us',
		),
		'amazon_uk'   => array(
			'Amazon UK',
			'_rabia_amazon_uk',
		),
		'barnesnoble' => array(
			'Barnes & Noble',
			'_rabia_barnesnoble',
		),
		'kobo'        => array(
			'Kobo',
			'_rabia_kobo',
		),
		'smashwords'  => array(
			'Smashwords',
			'_rabia_smashwords',
		),
	);

	foreach ( $custom_fields as $key => $value ) {
		$url = get_post_meta( get_the_ID(), $value[1], true );

		if ( $url ) {
			$links[] = sprintf( '<a href="%s" target="_blank" class="button vendor">%s</a>',
				esc_url( $url ),
				esc_attr( $value[0] )
			);
		}
	}

	if ( ! empty( $links ) ) {
		echo '<h2>Purchase Online:</h2>';
		foreach ( $links as $link ) {
		 	echo $link;
		}
	}

}

genesis();
