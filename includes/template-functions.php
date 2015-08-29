<?php

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

function edd_author_links() {

	$prefix       = '_eddauthor_';
	$customfields = new EDD_Author_Custom_Fields();
	$fields       = $customfields->register_fields();

	foreach ( $fields as $field ) {
		$url = get_post_meta( get_the_ID(), $prefix . $field['id'], true );

		if ( $url ) {
			$links[] = sprintf( '<a href="%s" target="_blank" class="button vendor">%s</a>',
				esc_url( $url ),
				esc_attr( $field['name'] )
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
