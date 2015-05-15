<?php

class EDD_Publications_Custom_Fields {

	public function register_fields() {

		// Start with an underscore to hide fields from custom fields list
		$prefix = '_eddpublications_';

		$eddpublications_box = new_cmb2_box( array(
			'id'            => $prefix . 'works_fields',
			'title'         => __( 'CMB2 Links for Works', 'cmb2' ),
			'object_types'  => array( 'download', ), // Post type
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true, // Show field names on the left
		) );

		$eddpublications_box->add_field( array(
			'name' => __( 'Amazon', 'cmb2' ),
			'id'   => $prefix . 'amazon',
			'type' => 'text_url',
			'protocols' => array( 'http', 'https' ), // Array of allowed protocols
		) );

		$eddpublications_box->add_field( array(
			'name' => __( 'Barnes & Noble', 'cmb2' ),
			'id'   => $prefix . 'barnesnoble',
			'type' => 'text_url',
			'protocols' => array( 'http', 'https' ), // Array of allowed protocols
		) );

		$eddpublications_box->add_field( array(
			'name' => __( 'Smashwords', 'cmb2' ),
			'id'   => $prefix . 'smashwords',
			'type' => 'text_url',
			'protocols' => array( 'http', 'https' ), // Array of allowed protocols
		) );

		$eddpublications_box->add_field( array(
			'name' => __( 'Kobo', 'cmb2' ),
			'id'   => $prefix . 'kobo',
			'type' => 'text_url',
			'protocols' => array( 'http', 'https' ), // Array of allowed protocols
		) );

	}

}
