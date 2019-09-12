<?php
/**
 * The search form template.
 *
 * @package verbumtorcular
 */

?>

<form role="search" method="get" class="search-form form-inline" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input class="form-control" type="search" placeholder="<?php esc_attr_e( 'Serch', 'verbumtorcular' ); ?>" aria-label="<?php esc_attr_e( 'Serch', 'verbumtorcular' ); ?>">
	<button class="btn btn-outline-success" type="submit"><?php esc_html_e( 'Serch', 'verbumtorcular' ); ?></button>
</form>
