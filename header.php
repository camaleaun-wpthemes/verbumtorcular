<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package verbumtorcular
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<div id="page" class="hfeed site">

	<nav class="navbar navbar-expand-md navbar-light bg-light">
		<div class="container">
			<?php verbumtocular_site_title_or_logo(); ?>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'fallback_cb'    => false,
						'menu_class'     => 'navbar-nav mr-auto',
					)
				);
				get_search_form();
				?>
			</div>
		</div>
	</nav>

	<div id="content" class="site-content" tabindex="-1">

		<div class="col-full">
