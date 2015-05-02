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
		'singular' => __( 'Publication', 'edd' ),
		'plural'   => __( 'Publications', 'edd' ),
	);

	return $defaults;
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

add_filter( 'edd_download_category_labels', 'edd_publicatios_category_labels', 10, 2 );
function edd_publicatios_category_labels( $category_labels ) {
	$category_labels['name'] = 'Types';
	$category_labels['singular_name'] = 'Type';

	return $category_labels;
}

add_filter( 'edd_checkout_image_size', 'edd_publications_checkout_image_size', 10, 2 );
function edd_publications_checkout_image_size( $size ) {
	$size = 'publication_checkout';

	return $size;
}

