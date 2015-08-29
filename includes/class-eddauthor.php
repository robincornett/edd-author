<?php

class EDD_Author {

	function __construct( $customfields, $filters ) {
		$this->customfields = $customfields;
		$this->filters      = $filters;
	}

	public function run() {

		add_action( 'init', array( $this, 'add_settings' ) );
		add_action( 'after_setup_theme', array( $this, 'load_templates' ) );
		add_action( 'tgmpa_register', array( $this, 'require_plugins' ) );

		add_action( 'cmb2_init', array( $this->customfields, 'register_fields' ) );

		// Query
		add_filter( 'pre_get_posts', array( $this->filters, 'modify_archive_query' ), 9999 );

		// Labels
		add_filter( 'edd_default_downloads_name', array( $this->filters, 'set_default_names' ), 10, 2 );
		add_filter( 'edd_download_category_labels', array( $this->filters, 'set_category_labels' ), 10, 2 );
		add_filter( 'edd_download_tag_labels', array( $this->filters, 'set_tag_labels' ), 10, 2 );

		// Args
		add_filter( 'edd_download_post_type_args', array( $this->filters, 'set_post_type_args' ), 10, 2 );
		add_filter( 'edd_download_category_args', array( $this->filters, 'set_category_args' ), 10, 2 );
		add_filter( 'edd_download_tag_args', array( $this->filters, 'set_tag_args' ), 10, 2 );

		// Other
		add_filter( 'edd_checkout_image_size', array( $this->filters, 'change_checkout_image' ), 10, 2 );

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

	public function add_settings() {

		add_image_size( 'publication', 300, 450, true );
		add_image_size( 'publication_checkout', 40, 60, true );
		add_post_type_support( 'download', 'genesis-cpt-archives-settings' );

	}

	public function load_templates() {
		add_filter( 'body_class', array( $this, 'add_body_class' ) );
		add_filter( 'archive_template', array( $this, 'load_archive_template' ) );
		add_filter( 'single_template', array( $this, 'load_single_template' ) );
	}

	public function load_archive_template( $archive_template ) {
		if ( is_post_type_archive( 'download' ) || is_tax( array( 'download_category', 'download_tag' ) ) ) {
			$parent = basename( get_template_directory() );
			if ( 'genesis' === $parent ) {
				$archive_template = plugin_dir_path( dirname( __FILE__ ) ) . '/views/archive-download.php';
			}
		}
		return $archive_template;
	}

	public function load_single_template( $single_template ) {
		if ( ! is_singular( 'download' ) ) {
			return $single_template;
		}
		$parent = basename( get_template_directory() );
		if ( 'genesis' === $parent ) {
			$single_template = plugin_dir_path( dirname( __FILE__ ) ) . '/views/single-download.php';
		}
		add_action( 'edd_before_download_content', 'edd_author_image', 5 );
		add_action( 'edd_after_download_content', 'edd_author_links', 5 );
		return $single_template;
	}

	public function add_body_class( $classes ) {
		if ( 'download' === get_post_type() ) {
			$classes[] = 'publication';
		}

		return $classes;
	}

	public function require_plugins() {
		/*
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(

			array(
				'name'      => 'CMB2',
				'slug'      => 'cmb2',
				'required'  => true,
			),
			array(
				'name'      => 'Easy Digital Downloads',
				'slug'      => 'easy-digital-downloads',
				'required'  => true,
			),

		);

		/*
		 * Array of configuration settings. Amend each line as needed.
		 *
		 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
		 * strings available, please help us make TGMPA even better by giving us access to these translations or by
		 * sending in a pull-request with .po file(s) with the translations.
		 *
		 * Only uncomment the strings in the config array if you want to customize the strings.
		 */
		$config = array(
			'id'           => 'tgmpa-eddauthor',       // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'parent_slug'  => 'themes.php',            // Parent menu slug.
			'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.

			'strings'      => array(
				'notice_can_install_required'  => _n_noop(
					'EDD Author requires the following plugin: %1$s.',
					'EDD Author requires the following plugins: %1$s.',
					'theme-slug'
				), // %1$s = plugin name(s).
				'notice_can_activate_required' => _n_noop(
					'EDD Author requires the following plugin, which is currently inactive: %1$s.',
					'EDD Author requires the following plugins, which are currently inactive: %1$s.',
					'theme-slug'
				), // %1$s = plugin name(s).
			),

		);

		tgmpa( $plugins, $config );
	}
}
