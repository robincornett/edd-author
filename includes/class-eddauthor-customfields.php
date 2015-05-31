<?php

class EDD_Author_Custom_Fields {

	public static function register_fields() {

		$fields = new stdClass();

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

		$fields = apply_filters( 'eddauthor_third_party_vendors', array(
			array(
				'name' => __( 'Amazon', 'edd-author' ),
				'id'   => 'amazon',
			),
			array(
				'name' => __( 'Barnes & Noble', 'edd-author' ),
				'id'   => 'barnesnoble',
			),
			array(
				'name' => __( 'Smashwords', 'edd-author' ),
				'id'   => 'smashwords',
			),
			array(
				'name' => __( 'Kobo', 'edd-author' ),
				'id'   => 'kobo',
			),
		) );

		foreach ( $fields as $field ) {
			$eddpublications_box->add_field( array(
				'name'      => $field['name'],
				'id'        => $prefix . $field['id'],
				'type'      => 'text_url',
				'protocols' => array( 'http', 'https' ), // Array of allowed protocols
			) );
		}

		return $fields;

	}

}
