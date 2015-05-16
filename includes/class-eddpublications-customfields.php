<?php

class EDD_Publications_Custom_Fields {

	public function register_fields() {

		// Start with an underscore to hide fields from custom fields list
		$prefix = '_eddpublications_';

		$eddpublications_box = new_cmb2_box( array(
			'id'            => $prefix . 'works_fields',
			'title'         => __( 'Purchasing Links', 'edd-publications-rabia' ),
			'object_types'  => array( 'download', ), // Post type
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true, // Show field names on the left
		) );

		$eddpublications_box->add_field( array(
			'name'      => __( 'Amazon', 'edd-publications-rabia' ),
			'id'        => $prefix . 'amazon',
			'type'      => 'text_url',
			'protocols' => array( 'http', 'https' ), // Array of allowed protocols
		) );

		$eddpublications_box->add_field( array(
			'name'      => __( 'Barnes & Noble', 'edd-publications-rabia' ),
			'id'        => $prefix . 'barnesnoble',
			'type'      => 'text_url',
			'protocols' => array( 'http', 'https' ), // Array of allowed protocols
		) );

		$eddpublications_box->add_field( array(
			'name'      => __( 'Smashwords', 'edd-publications-rabia' ),
			'id'        => $prefix . 'smashwords',
			'type'      => 'text_url',
			'protocols' => array( 'http', 'https' ), // Array of allowed protocols
		) );

		$eddpublications_box->add_field( array(
			'name'      => __( 'Kobo', 'edd-publications-rabia' ),
			'id'        => $prefix . 'kobo',
			'type'      => 'text_url',
			'protocols' => array( 'http', 'https' ), // Array of allowed protocols
		) );

	}

}
