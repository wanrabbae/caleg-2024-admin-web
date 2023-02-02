<?php
/**
 * The template for displaying archive pages
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package zakra
 */

get_header();
?>

	<div id="primary" class="content-area">
		<?php echo apply_filters( 'zakra_after_primary_start_filter', false ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

		<?php if ( have_posts() ) : ?>

			<?php if ( 'page-header' !== zakra_is_page_title_enabled() ) : ?>
				<header class="page-header">
					<h1 class="page-title tg-page-content__title">
					 <?php echo wp_kses_post( zakra_get_title() ); ?>
					</h1>

					<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
				</header><!-- .page-header -->
			<?php endif; ?>

			<?php
			do_action( 'zakra_before_posts_the_loop' );

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			do_action( 'zakra_after_posts_the_loop' );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		<?php echo apply_filters( 'zakra_after_primary_end_filter', false ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
