<?php

add_action( 'genesis_entry_content', 'edd_publications_image', 5 );
function edd_publications_image() {
	if ( ! has_post_thumbnail() ) {
		return;
	}

	$attributes = array(
		'class' => 'aligncenter',
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

	echo '<h2>Purchase Online:</h2>';
	foreach ( $custom_fields as $key => $value ) {
		$url = get_post_meta( get_the_ID(), $value[1], true );
		printf( '<a href="%s" target="_blank" class="button vendor">%s</a>',
			esc_url( $url ),
			esc_attr( $value[0] )
		);
	}

}

genesis();
