<?php

/**
 * EDD Author is a custom plugin to modify EDD for Rabia.
 *
 * @package   EDD Author
 * @author    Robin Cornett <hello@robincornett.com>
 * @copyright 2015 Robin Cornett
 * @license   GPL-2.0+
 * @link      http://robincornett.com
 *
 * @wordpress-plugin
 * Plugin Name:       EDD Author
 * Plugin URI:        https://bitbucket.org/robincornett/edd-author
 * Description:       EDD Author is a custom plugin to modify Easy Digital Downloads for authors.
 * Version:           1.0.0
 * Author:            Robin Cornett
 * Author URI:        http://robincornett.com
 * Text Domain:       edd-author
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

function edd_author_require() {
	$files = array(
		'class-eddauthor',
		'class-eddauthor-customfields',
		'class-eddauthor-filters',
		'class-tgm-plugin-activation',
		'template-functions',
	);

	foreach ( $files as $file ) {
		require plugin_dir_path( __FILE__ ) . 'includes/' . $file . '.php';
	}
}
edd_author_require();

// Instantiate dependent classes
$eddauthor_customfields = new EDD_Author_Custom_Fields();
$eddauthor_filters = new EDD_Author_Filters();

$eddauthor = new EDD_Author(
	$eddauthor_customfields,
	$eddauthor_filters
);
$eddauthor->run();
