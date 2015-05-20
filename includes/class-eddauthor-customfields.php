<?php

class EDD_Author_Custom_Fields {

	public function register_fields() {

		// Start with an underscore to hide fields from custom fields list
		$prefix = '_eddauthor_';

		$eddpublications_box = new_cmb2_box( array(
			'id'            => $prefix . 'works_fields',
			'title'         => __( 'Purchasing Links', 'edd-author' ),
			'object_types'  => array( 'download', ), // Post type
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true, // Show field names on the left
		) );

		$eddpublications_box->add_field( array(
			'name'      => __( 'Amazon', 'edd-author' ),
			'id'        => $prefix . 'amazon',
			'type'      => 'text_url',
			'protocols' => array( 'http', 'https' ), // Array of allowed protocols
		) );

		$eddpublications_box->add_field( array(
			'name'      => __( 'Barnes & Noble', 'edd-author' ),
			'id'        => $prefix . 'barnesnoble',
			'type'      => 'text_url',
			'protocols' => array( 'http', 'https' ), // Array of allowed protocols
		) );

		$eddpublications_box->add_field( array(
			'name'      => __( 'Smashwords', 'edd-author' ),
			'id'        => $prefix . 'smashwords',
			'type'      => 'text_url',
			'protocols' => array( 'http', 'https' ), // Array of allowed protocols
		) );

		$eddpublications_box->add_field( array(
			'name'      => __( 'Kobo', 'edd-author' ),
			'id'        => $prefix . 'kobo',
			'type'      => 'text_url',
			'protocols' => array( 'http', 'https' ), // Array of allowed protocols
		) );

	}

}
