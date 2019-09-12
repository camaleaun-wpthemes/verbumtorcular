<?php
/**
 * Engine room.
 *
 * @package verbumtorcular
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980; /* pixels */
}

/**
 * Head html tags.
 */
function verbumtocular_head() {
	?>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php
}
add_action( 'wp_header', 'verbumtorcular_head', -1 );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function verbumtorcular_setup() {
	/**
	 * Add default posts and comments RSS feed links to head.
	 */
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * Enable support for site logo.
	 */
	add_theme_support(
		'custom-logo',
		apply_filters(
			'verbumtorcular_custom_logo_args',
			array(
				'height'      => 110,
				'width'       => 470,
				'flex-width'  => true,
				'flex-height' => true,
			)
		)
	);

	/**
	 * Register menu locations.
	 */
	register_nav_menus(
		apply_filters(
			'verbumtorcular_register_nav_menus',
			array(
				'primary' => 'Menu Principal',
			)
		)
	);

	/*
	 * Switch default core markup for search form, comment form, comments, galleries, captions and widgets
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		apply_filters(
			'verbumtorcular_html5_args',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'widgets',
			)
		)
	);

	/**
	 * Declare support for title theme feature.
	 */
	add_theme_support( 'title-tag' );

	/**
	 * Declare support for selective refreshing of widgets.
	 */
	add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action( 'after_setup_theme', 'verbumtorcular_setup' );

/**
 * Enqueue scripts and styles.
 */
function verbumtorcular_enqueues() {
	verbumtorcular_register_twbs(
		array(
			'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css',
			'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js',
			'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js',
		)
	);

	/**
	 * Styles
	 */
	$deps = array();

	if ( wp_style_is( 'twbs', 'registered' ) ) {
		$deps[] = 'twbs';
	}

	wp_enqueue_style( 'verbumtorcular', get_theme_file_uri( 'style.css' ), $deps, wp_get_theme( 'verbumtorcular' )->version );

	/**
	 * Scripts
	 */
	wp_enqueue_script( 'twbs' );
}
add_action( 'wp_enqueue_scripts', 'verbumtorcular_enqueues' );

if ( ! function_exists( 'verbumtorcular_register_twbs' ) ) {
	/**
	 * Twitter Bootstrap
	 *
	 * @param array $remote_urls URL of style and scripts.
	 */
	function verbumtorcular_register_twbs( $remote_urls ) {
		$remote_urls = array_map( 'wp_http_validate_url', $remote_urls );

		$remotes = array();
		$locals  = array();
		foreach ( $remote_urls as $url ) {
			preg_match( '/(\w+)\.?(min)?\.(\w{2,3})$/', $url, $output );
			unset( $output[0] );
			$output = array_filter( array_values( $output ) );

			$type = end( $output );
			$name = $output[0];

			$key = $type;
			if ( 'bootstrap' !== $name ) {
				$key = $name;
			}
			$remotes[ $key ] = $url;

			$file    = implode( '.', $output );
			$version = false;
			preg_match( '$/([\d\.]+)/$', $url, $output );
			if ( isset( $output[1] ) ) {
				$version = $output[1];
			}
			$locals[ $key ] = array(
				'path'    => get_theme_file_uri( "assets/$type/$file" ),
				'version' => $version,
			);
		}
		wp_register_style( 'twbs', $remotes['css'], array(), $locals['css']['version'] );
		wp_register_script( 'popper', $remotes['popper'], array(), $locals['popper']['version'], true );
		wp_register_script( 'twbs', $remotes['js'], array( 'jquery', 'popper' ), $locals['js']['version'], true );
	}
}

if ( ! function_exists( 'verbumtocular_site_title_or_logo' ) ) {
	/**
	 * Display the site title or logo
	 *
	 * @param bool $echo Echo the string or return it.
	 * @return string
	 */
	function verbumtocular_site_title_or_logo( $echo = true ) {
		if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
			$html = get_custom_logo();
		} else {
			$html = sprintf(
				'<a class="custom-logo-link" href="%1$s" rel="home" itemprop="url">%2$s</a>',
				esc_url( home_url( '/' ) ),
				esc_html( get_bloginfo( 'name' ) )
			);
		}
		$html = str_replace( 'custom-logo-link', 'navbar-brand', $html );

		if ( ! $echo ) {
			return $html;
		}

		echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

/**
 * Menu classes for Bootstrap 4
 *
 * @param string $nav_menu HTML output.
 */
function verbumtocular_menu_classes( $nav_menu ) {
	$nav_menu = str_replace( 'menu-item ', 'nav-item menu-item ', $nav_menu );
	$nav_menu = str_replace( '<a ', '<a class="nav-link"', $nav_menu );

	return $nav_menu;
}
add_filter( 'wp_nav_menu', 'verbumtocular_menu_classes' );
add_filter( 'wp_page_menu', 'verbumtocular_menu_classes' );

/**
 * Menu arguments
 *
 * @param array $args Menu arguments.
 */
function verbumtocular_menu_args( $args ) {
	$args['container'] = false;
	return $args;
}
add_filter( 'wp_nav_menu_args', 'verbumtocular_menu_args' );

/**
 * Template Hooks
 */
