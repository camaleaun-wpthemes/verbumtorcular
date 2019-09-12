<?php

if ( ! class_exists( 'WP_CLI' ) ) {
	return;
}

/**
 * Create a POT file.
 *
 * @when before_wp_load
 */
$pot_command = function() {
	WP_CLI::runcommand( 'i18n make-pot .' );
};
WP_CLI::add_command( 'pot', $pot_command );
