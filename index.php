<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Verbum_Torcular
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) :

			while ( have_posts() ) :
				the_post();
				?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<header class="entry-header">

				<?php
				if ( is_single() ) {
					the_title( '<h1 class="entry-title">', '</h1>' );
				} else {
					the_title( sprintf( '<h2 class="alpha entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
				}
				?>

				</header><!-- .entry-header -->

				<div class="entry-content">

				<?php
				the_content(
					sprintf(
						/* translators: %s: post title */
						__( 'Continue reading %s', 'verbumtorcular' ),
						'<span class="screen-reader-text">' . get_the_title() . '</span>'
					)
				);

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'verbumtorcular' ),
						'after'  => '</div>',
					)
				);
				?>

				</div><!-- .entry-content -->

			</article><!-- #post-## -->

			<?php endwhile; ?>

		<?php else : ?>

			<div class="no-results not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'verbumtorcular' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">

					<?php if ( is_search() ) : ?>

						<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'verbumtorcular' ); ?></p>
						<?php get_search_form(); ?>

					<?php else : ?>

						<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'verbumtorcular' ); ?></p>
						<?php get_search_form(); ?>

					<?php endif; ?>

				</div><!-- .page-content -->
			</div><!-- .no-results -->

			<?php
		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
do_action( 'verbumtorcular_sidebar' );
get_footer();
