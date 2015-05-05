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

function edd_publications_require() {
	$files = array(
		'class-eddpublications',
		'class-eddpublications-customfields',
		'class-eddpublications-filters',
	);

	foreach ( $files as $file ) {
		require plugin_dir_path( __FILE__ ) . 'includes/' . $file . '.php';
	}
}
edd_publications_require();

// Instantiate dependent classes
$eddpublications_customfields = new EDD_Publications_Custom_Fields();
$eddpublications_filters = new EDD_Publications_Filters();

$eddpublications = new EDD_Publications(
	$eddpublications_customfields,
	$eddpublications_filters
);
$eddpublications->run();
