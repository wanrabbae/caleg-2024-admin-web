<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package zakra
 */

$content_orders = get_theme_mod(
	'zakra_page_content_structure',
	array(
		'title',
		'featured_image',
		'content',
	)
);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	foreach ( $content_orders as $key => $content_order ) :

		if ( 'title' === $content_order ) :

			if ( 'page-header' !== zakra_is_page_title_enabled() ) : ?>
				<header class="entry-header">
					<h1 class="entry-title tg-page-content__title">
						<?php echo wp_kses_post( zakra_get_title() ); ?>
					</h1>
				</header><!-- .entry-header -->
			<?php endif;
		elseif ( 'featured_image' === $content_order ) :
			zakra_post_thumbnail();
		elseif ( 'content' === $content_order ) :
			?>
			<div class="entry-content">
				<?php
				the_content();

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'zakra' ),
						'after'  => '</div>',
					)
				);
				?>
			</div><!-- .entry-content -->
			<?php
		endif;
	endforeach;

	if ( get_edit_post_link() ) :
		?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'zakra' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
		<?php
	endif;
	?>
</article><!-- #post-<?php the_ID(); ?> -->
