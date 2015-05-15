<?php

class EDD_Publications {

	function __construct( $customfields, $filters ) {
		$this->customfields = $customfields;
		$this->filters      = $filters;
	}

	public function run() {
		add_action( 'init', array( $this, 'add_settings' ) );
		add_action( 'after_setup_theme', array( $this, 'load_templates' ) );

		add_action( 'cmb2_init', array( $this->customfields, 'register_fields' ) );
	}

	public function add_settings() {

		add_image_size( 'publication', 300, 450, true );
		add_image_size( 'publication_checkout', 40, 60, true );
		add_post_type_support( 'download', 'genesis-cpt-archives-settings' );

	}

	public function load_templates() {
		$parent = basename( get_template_directory() );
		if ( 'genesis' === $parent ) {
			add_filter( 'archive_template', array( $this, 'load_archive_template' ) );
			add_filter( 'single_template', array( $this, 'load_single_template' ) );
			add_filter( 'body_class', array( $this, 'add_body_class' ) );
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
