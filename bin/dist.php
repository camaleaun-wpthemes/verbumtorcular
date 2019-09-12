<?php

if ( ! class_exists( 'WP_CLI' ) ) {
	return;
}

/**
 * Create a distribution archive.
 *
 * @when before_wp_load
 */
$dist_command = function() {
	if ( ! is_array( WP_CLI::get_runner()->find_command_to_run( array( 'dist-archive' ) ) ) ) {
		WP_CLI::runcommand( 'package install wp-cli/dist-archive-command', array( 'return' => true ) );
	}
	WP_CLI::runcommand( 'dist-archive .' );
};
WP_CLI::add_command( 'dist', $dist_command );
