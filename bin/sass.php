<?php

if ( ! class_exists( 'WP_CLI' ) ) {
	return;
}

/**
 * Compile Sass to CSS.
 *
 * @when before_wp_load
 */
$sass_command = function() {
	passthru( 'sass --watch --no-source-map assets/scss/style.scss style.css' );
};
WP_CLI::add_command( 'sass', $sass_command );
