<?php

class EDD_Author_Filters {

	function modify_archive_query( $query ) {
		if ( ! $query->is_main_query() || is_admin() || is_singular() ) {
			return;
		}
		if ( is_post_type_archive( 'download' ) || is_tax( array( 'download_category', 'download_tag' ) ) ) {
			$query->set( 'posts_per_page', 20 );
		}
	}

	function set_default_names( $defaults ) {
		$defaults = array(
			'singular' => __( 'Works', 'edd-author' ),
			'plural'   => __( 'Works', 'edd-author' ),
		);

		return $defaults;
	}

	function set_category_labels( $category_labels ) {
		$singular = __( 'Type', 'edd-author' );
		$plural   = __( 'Types', 'edd-author' );

		$category_labels['name']              = $plural;
		$category_labels['singular_name']     = $singular;
		$category_labels['search_items']      = sprintf( __( 'Search %s', 'edd-author' ), $plural );
		$category_labels['all_items']         = sprintf( __( 'All %s', 'edd-author' ), $plural );
		$category_labels['parent_item']       = sprintf( __( 'Parent %s', 'edd-author' ), $singular );
		$category_labels['parent_item_colon'] = sprintf( __( 'Parent %s:', 'edd-author' ), $singular );
		$category_labels['edit_item']         = sprintf( __( 'Edit %s', 'edd-author' ), $singular );
		$category_labels['update_item']       = sprintf( __( 'Update %s', 'edd-author' ), $singular );
		$category_labels['add_new_item']      = sprintf( __( 'Add New %s', 'edd-author' ), $singular );
		$category_labels['new_item_name']     = sprintf( __( 'New %s Name', 'edd-author' ), $singular );
		$category_labels['menu_name']         = $plural;

		return $category_labels;
	}

	function set_tag_labels( $tag_labels ) {
		$singular = __( 'Series', 'edd-author' );
		$plural   = __( 'Series', 'edd-author' );

		$tag_labels['name']              = $plural;
		$tag_labels['singular_name']     = $singular;
		$tag_labels['search_items']      = sprintf( __( 'Search %s', 'edd-author' ), $plural );
		$tag_labels['all_items']         = sprintf( __( 'All %s', 'edd-author' ), $plural );
		$tag_labels['parent_item']       = sprintf( __( 'Parent %s', 'edd-author' ), $singular );
		$tag_labels['parent_item_colon'] = sprintf( __( 'Parent %s:', 'edd-author' ), $singular );
		$tag_labels['edit_item']         = sprintf( __( 'Edit %s', 'edd-author' ), $singular );
		$tag_labels['update_item']       = sprintf( __( 'Update %s', 'edd-author' ), $singular );
		$tag_labels['add_new_item']      = sprintf( __( 'Add New %s', 'edd-author' ), $singular );
		$tag_labels['new_item_name']     = sprintf( __( 'New %s Name', 'edd-author' ), $singular );
		$tag_labels['menu_name']         = $plural;

		return $tag_labels;
	}

	function set_post_type_args( $download_args ) {

		$download_args['rewrite'] = array( 'slug' => 'works', 'with_front' => false );

		return $download_args;
	}

	function set_category_args( $category_args ) {
		$category_args['rewrite'] = array( 'slug' => 'type' );

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
