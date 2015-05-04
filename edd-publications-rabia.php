<?php

/**
 * EDD Publications is a custom plugin to modify EDD for Rabia.
 *
 * @package   EDD Publications
 * @author    Robin Cornett <hello@robincornett.com>
 * @copyright 2015 Robin Cornett
 * @license   GPL-2.0+
 * @link      http://robincornett.com
 *
 * @wordpress-plugin
 * Plugin Name:       EDD Publications
 * Plugin URI:        https://bitbucket.org/robincornett/edd-publications-rabia
 * Description:       EDD Publications is a custom plugin to modify EDD for Rabia.
 * Version:           1.0.0
 * Author:            Robin Cornett
 * Author URI:        http://robincornett.com
 * Text Domain:       edd-publications-rabia
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require plugin_dir_path( __FILE__ ) . '/includes/edd-publications-customfields.php';

add_action( 'init', 'edd_publications_settings' );
function edd_publications_settings() {

	add_image_size( 'publication', 300, 450, true );
	add_image_size( 'publication_checkout', 40, 60, true );
	add_post_type_support( 'download', 'genesis-cpt-archives-settings' );

}

add_filter( 'edd_download_post_type_args', 'edd_publications_post_type_args', 10, 2 );
function edd_publications_post_type_args( $download_args ) {

	$download_args['rewrite'] = array( 'slug' => 'works', 'with_front' => false );

	return $download_args;
}

add_filter( 'edd_default_downloads_name', 'edd_publications_default_names', 10, 2 );
function edd_publications_default_names( $defaults ) {
	$defaults = array(
		'singular' => __( 'Publication', 'edd-publications-rabia' ),
		'plural'   => __( 'Publications', 'edd-publications-rabia' ),
	);

	return $defaults;
}

add_filter( 'edd_download_tag_labels', 'edd_publications_tag_labels', 10, 2 );
function edd_publications_tag_labels( $tag_labels ) {
	$tag_labels['name']              = 'Series';
	$tag_labels['singular_name']     = 'Series';
	$tag_labels['search_items']      = 'Search Series';
	$tag_labels['all_items']         = 'All Series';
	$tag_labels['parent_item']       = 'Parent Series';
	$tag_labels['parent_item_colon'] = 'Parent Series:';
	$tag_labels['edit_item']         = __( 'Edit Series', 'edd-publications-rabia' );
	$tag_labels['update_item']       = __( 'Update Series', 'edd-publications-rabia' );
	$tag_labels['add_new_item']      = sprintf( __( 'Add New %s Series', 'edd-publications-rabia' ), edd_get_label_singular() );
	$tag_labels['new_item_name']     = 'New Series Name';
	$tag_labels['menu_name']         = 'Series';

	return $tag_labels;
}

add_filter( 'edd_download_category_labels', 'edd_publications_category_labels', 10, 2 );
function edd_publications_category_labels( $category_labels ) {
	$category_labels['name']              = 'Types';
	$category_labels['singular_name']     = 'Type';
	$category_labels['search_items']      = 'Search Types';
	$category_labels['all_items']         = 'All Types';
	$category_labels['parent_item']       = 'Parent Type';
	$category_labels['parent_item_colon'] = 'Parent Type:';
	$category_labels['edit_item']         = __( 'Edit Type', 'edd-publications-rabia' );
	$category_labels['update_item']       = __( 'Update Type', 'edd-publications-rabia' );
	$category_labels['add_new_item']      = sprintf( __( 'Add New %s Type', 'edd-publications-rabia' ), edd_get_label_singular() );
	$category_labels['new_item_name']     = 'New Type Name';
	$category_labels['menu_name']         = 'Types';

	return $category_labels;
}

add_filter( 'edd_checkout_image_size', 'edd_publications_checkout_image_size', 10, 2 );
function edd_publications_checkout_image_size( $size ) {
	$size = 'publication_checkout';

	return $size;
}

add_filter( 'edd_download_category_args', 'edd_publications_category_args', 10, 2 );
function edd_publications_category_args( $category_args ) {
	$category_args['rewrite'] = array( 'slug' => 'works', 'with_front' => false, 'hierarchical' => true );

	return $category_args;
}

add_filter( 'edd_download_tag_args', 'edd_publications_tag_args', 10, 2 );
function edd_publications_tag_args( $tag_args ) {
	$tag_args['rewrite'] = array( 'slug' => 'series' );

	return $tag_args;
}

add_action( 'after_setup_theme', 'edd_publications_templates' );
function edd_publications_templates() {
	$parent = basename( get_template_directory() );
	if ( 'genesis' === $parent ) {
		add_filter( 'archive_template', 'edd_publications_load_archive_template' );
		add_filter( 'single_template', 'edd_publications_load_single_template' );
		add_filter( 'body_class', 'edd_publications_add_body_class' );
	}
}

function edd_publications_load_archive_template( $archive_template ) {
	if ( is_post_type_archive( 'download' ) || is_tax( array( 'download_category', 'download_tag' ) ) ) {
		$archive_template = plugin_dir_path( __FILE__ ) . '/views/archive-download.php';
	}
	return $archive_template;
}

function edd_publications_load_single_template( $single_template ) {
	if ( is_singular( 'download' ) ) {
		$single_template = plugin_dir_path( __FILE__ ) . '/views/single-download.php';
	}
	return $single_template;
}

function edd_publications_add_body_class( $classes ) {
	if ( 'download' === get_post_type() ) {
		$classes[] = 'publication';
	}

	return $classes;
}
