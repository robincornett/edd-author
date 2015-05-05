<?php

class EDD_Publications_Filters {

	public function __construct() {

		// Labels
		add_filter( 'edd_default_downloads_name', array( $this, 'edd_publications_default_names' ), 10, 2 );
		add_filter( 'edd_download_tag_labels', array( $this, 'edd_publications_tag_labels' ), 10, 2 );
		add_filter( 'edd_download_category_labels', array( $this, 'edd_publications_category_labels' ), 10, 2 );

		// Args
		add_filter( 'edd_download_post_type_args', array( $this, 'edd_publications_post_type_args' ), 10, 2 );
		add_filter( 'edd_download_category_args', array( $this, 'edd_publications_category_args' ), 10, 2 );
		add_filter( 'edd_download_tag_args', array( $this, 'edd_publications_tag_args' ), 10, 2 );

		// Other
		add_filter( 'edd_checkout_image_size', array( $this, 'edd_publications_checkout_image_size' ), 10, 2 );
	}

	function edd_publications_default_names( $defaults ) {
		$defaults = array(
			'singular' => __( 'Publication', 'edd-publications-rabia' ),
			'plural'   => __( 'Publications', 'edd-publications-rabia' ),
		);

		return $defaults;
	}

	function edd_publications_category_labels( $category_labels ) {
		$singular_label = 'Type';
		$plural_label   = 'Types';

		$category_labels['name']              = $plural_label;
		$category_labels['singular_name']     = $singular_label;
		$category_labels['search_items']      = sprintf( 'Search %s', $plural_label );
		$category_labels['all_items']         = sprintf( 'All %s', $plural_label );
		$category_labels['parent_item']       = sprintf( 'Parent %s', $singular_label );
		$category_labels['parent_item_colon'] = sprintf( 'Parent %s:', $singular_label );
		$category_labels['edit_item']         = sprintf( __( 'Edit %s', 'edd-publications-rabia' ), $singular_label );
		$category_labels['update_item']       = sprintf( __( 'Update %s', 'edd-publications-rabia' ), $singular_label );
		$category_labels['add_new_item']      = sprintf( __( 'Add New %s Type', 'edd-publications-rabia' ), $singular_label );
		$category_labels['new_item_name']     = sprintf( 'New %s Name', $singular_label );
		$category_labels['menu_name']         = $plural_label;

		return $category_labels;
	}

	function edd_publications_tag_labels( $tag_labels ) {
		$singular_label = 'Series';
		$plural_label   = 'Series';

		$tag_labels['name']              = $plural_label;
		$tag_labels['singular_name']     = $singular_label;
		$tag_labels['search_items']      = sprintf( 'Search %s', $plural_label );
		$tag_labels['all_items']         = sprintf( 'All %s', $plural_label );
		$tag_labels['parent_item']       = sprintf( 'Parent %s', $singular_label );
		$tag_labels['parent_item_colon'] = sprintf( 'Parent %s:', $singular_label );
		$tag_labels['edit_item']         = sprintf( __( 'Edit %s', 'edd-publications-rabia' ), $singular_label );
		$tag_labels['update_item']       = sprintf( __( 'Update %s', 'edd-publications-rabia' ), $singular_label );
		$tag_labels['add_new_item']      = sprintf( __( 'Add New %s Series', 'edd-publications-rabia' ), $singular_label );
		$tag_labels['new_item_name']     = sprintf( 'New Series Name', $singular_label );
		$tag_labels['menu_name']         = $plural_label;

		return $tag_labels;
	}

	function edd_publications_post_type_args( $download_args ) {

		$download_args['rewrite'] = array( 'slug' => 'works', 'with_front' => false );

		return $download_args;
	}

	function edd_publications_category_args( $category_args ) {
		$category_args['rewrite'] = array( 'slug' => 'works', 'with_front' => false, 'hierarchical' => true );

		return $category_args;
	}

	function edd_publications_tag_args( $tag_args ) {
		$tag_args['rewrite'] = array( 'slug' => 'series' );

		return $tag_args;
	}

	function edd_publications_checkout_image_size( $size ) {
		$size = 'publication_checkout';

		return $size;
	}

}
