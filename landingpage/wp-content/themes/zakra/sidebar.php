<?php
/**
 * The sidebar containing the main widget area
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package zakra
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$sidebar = apply_filters( 'zakra_get_sidebar', 'sidebar-right' );

// Hide sidebar when sidebar is not present.
if ( in_array( zakra_get_current_layout(), array( 'tg-site-layout--no-sidebar', 'tg-site-layout--default', 'tg-site-layout--stretched' ), true ) ) {
	return '';
}
?>

<aside id="secondary" class="tg-site-sidebar widget-area <?php zakra_sidebar_class(); ?>">
	<?php
	if ( is_active_sidebar( $sidebar ) ) {
		dynamic_sidebar( $sidebar );
	} elseif ( current_user_can( 'edit_theme_options' ) ) {
		?>
		<section class="widget">
			<h2 class="widget-title"><?php echo esc_html( zakra_get_sidebar_name_by_id( $sidebar ) ); ?></h2>
			<a href="<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>"><?php esc_html_e( 'Click here to add widgets for this area', 'zakra' ); ?></a>
		</section>
		<?php
	}
	?>
</aside><!-- #secondary -->
