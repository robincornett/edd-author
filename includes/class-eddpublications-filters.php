<?php

class EDD_Publications_Filters {

	public function __construct() {

		// Labels
		add_filter( 'edd_default_downloads_name', array( $this, 'set_default_names' ), 10, 2 );
		add_filter( 'edd_download_category_labels', array( $this, 'set_category_labels' ), 10, 2 );
		add_filter( 'edd_download_tag_labels', array( $this, 'set_tag_labels' ), 10, 2 );

		// Args
		add_filter( 'edd_download_post_type_args', array( $this, 'set_post_type_args' ), 10, 2 );
		add_filter( 'edd_download_category_args', array( $this, 'set_category_args' ), 10, 2 );
		add_filter( 'edd_download_tag_args', array( $this, 'set_tag_args' ), 10, 2 );

		// Other
		add_filter( 'edd_checkout_image_size', array( $this, 'change_checkout_image' ), 10, 2 );
	}

	function set_default_names( $defaults ) {
		$defaults = array(
			'singular' => __( 'Works', 'edd-publications-rabia' ),
			'plural'   => __( 'Works', 'edd-publications-rabia' ),
		);

		return $defaults;
	}

	function set_category_labels( $category_labels ) {
		$singular = __( 'Type', 'edd-publications-rabia' );
		$plural   = __( 'Types', 'edd-publications-rabia' );

		$category_labels['name']              = $plural;
		$category_labels['singular_name']     = $singular;
		$category_labels['search_items']      = sprintf( __( 'Search %s', 'edd-publications-rabia' ), $plural );
		$category_labels['all_items']         = sprintf( __( 'All %s', 'edd-publications-rabia' ), $plural );
		$category_labels['parent_item']       = sprintf( __( 'Parent %s', 'edd-publications-rabia' ), $singular );
		$category_labels['parent_item_colon'] = sprintf( __( 'Parent %s:', 'edd-publications-rabia' ), $singular );
		$category_labels['edit_item']         = sprintf( __( 'Edit %s', 'edd-publications-rabia' ), $singular );
		$category_labels['update_item']       = sprintf( __( 'Update %s', 'edd-publications-rabia' ), $singular );
		$category_labels['add_new_item']      = sprintf( __( 'Add New %s Type', 'edd-publications-rabia' ), $singular );
		$category_labels['new_item_name']     = sprintf( __( 'New %s Name', 'edd-publications-rabia' ), $singular );
		$category_labels['menu_name']         = $plural;

		return $category_labels;
	}

	function set_tag_labels( $tag_labels ) {
		$singular = __( 'Series', 'edd-publications-rabia' );
		$plural   = __( 'Series', 'edd-publications-rabia' );

		$tag_labels['name']              = $plural;
		$tag_labels['singular_name']     = $singular;
		$tag_labels['search_items']      = sprintf( __( 'Search %s', 'edd-publications-rabia' ), $plural );
		$tag_labels['all_items']         = sprintf( __( 'All %s', 'edd-publications-rabia' ), $plural );
		$tag_labels['parent_item']       = sprintf( __( 'Parent %s', 'edd-publications-rabia' ), $singular );
		$tag_labels['parent_item_colon'] = sprintf( __( 'Parent %s:', 'edd-publications-rabia' ), $singular );
		$tag_labels['edit_item']         = sprintf( __( 'Edit %s', 'edd-publications-rabia' ), $singular );
		$tag_labels['update_item']       = sprintf( __( 'Update %s', 'edd-publications-rabia' ), $singular );
		$tag_labels['add_new_item']      = sprintf( __( 'Add New %s Series', 'edd-publications-rabia' ), $singular );
		$tag_labels['new_item_name']     = sprintf( __( 'New Series Name', 'edd-publications-rabia' ), $singular );
		$tag_labels['menu_name']         = $plural;

		return $tag_labels;
	}

	function set_post_type_args( $download_args ) {

		$download_args['rewrite'] = array( 'slug' => 'works', 'with_front' => false );

		return $download_args;
	}

	function set_category_args( $category_args ) {
		$category_args['rewrite'] = array( 'slug' => 'works', 'with_front' => false, 'hierarchical' => true );

		return $category_args;
	}

	function set_tag_args( $tag_args ) {
		$tag_args['rewrite'] = array( 'slug' => 'series' );

		return $tag_args;
	}

	function change_checkout_image( $size ) {
		$size = 'publication_checkout';

		return $size;
	}

}
