<?php

class EDD_Author {

	function __construct( $customfields, $filters ) {
		$this->customfields = $customfields;
		$this->filters      = $filters;
	}

	public function run() {

		if ( ! class_exists( 'Easy_Digital_Downloads' ) ) {
			add_action( 'admin_init', array( $this, 'deactivate' ) );
			add_action( 'admin_notices', array( $this, 'error_message' ) );
			return;
		}

		add_action( 'init', array( $this, 'add_settings' ) );
		add_action( 'after_setup_theme', array( $this, 'load_templates' ) );

		add_action( 'cmb2_init', array( $this->customfields, 'register_fields' ) );
	}

	/**
	 * deactivates the plugin if EDD isn't running
	 *
	 *  @since x.y.z
	 *
	 */
	public function deactivate() {

		$file = plugin_basename( dirname( dirname( __FILE__ ) ) ) . '/edd-author.php';
		if ( version_compare( PHP_VERSION, '5.3', '>=' ) ) {
			$file = plugin_basename( dirname( __DIR__ ) ) . '/edd-author.php'; // __DIR__ is a magic constant introduced in PHP 5.3
		}
		deactivate_plugins( $file );
	}

	/**
	 * Error message if we're not using EDD.
	 *
	 * @since x.y.z
	 */
	public function error_message() {

		$error = sprintf( __( 'Sorry, EDD Author works only if Easy Digital Downloads is active. It has been deactivated.', 'display-featured-image-genesis' ) );

		if ( version_compare( PHP_VERSION, '5.3', '<' ) ) {
			$error = $error . sprintf(
				__( ' But since we\'re talking anyway, did you know that your server is running PHP version %1$s, which is outdated? You should ask your host to update that for you.', 'display-featured-image-genesis' ),
				PHP_VERSION
			);
		}

		echo '<div class="error"><p>' . esc_attr( $error ) . '</p></div>';

		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

	}

	public function add_settings() {

		add_image_size( 'publication', 300, 450, true );
		add_image_size( 'publication_checkout', 40, 60, true );
		add_post_type_support( 'download', 'genesis-cpt-archives-settings' );

	}

	public function load_templates() {
		add_filter( 'body_class', array( $this, 'add_body_class' ) );
		$parent = basename( get_template_directory() );
		if ( 'genesis' === $parent ) {
			add_filter( 'archive_template', array( $this, 'load_archive_template' ) );
			add_filter( 'single_template', array( $this, 'load_single_template' ) );
		}
	}

	public function load_archive_template( $archive_template ) {
		if ( is_post_type_archive( 'download' ) || is_tax( array( 'download_category', 'download_tag' ) ) ) {
			$archive_template = plugin_dir_path( dirname( __FILE__ ) ) . '/views/archive-download.php';
		}
		return $archive_template;
	}

	public function load_single_template( $single_template ) {
		if ( is_singular( 'download' ) ) {
			$single_template = plugin_dir_path( dirname( __FILE__ ) ) . '/views/single-download.php';
		}
		return $single_template;
	}

	public function add_body_class( $classes ) {
		if ( 'download' === get_post_type() ) {
			$classes[] = 'publication';
		}

		return $classes;
	}

}
