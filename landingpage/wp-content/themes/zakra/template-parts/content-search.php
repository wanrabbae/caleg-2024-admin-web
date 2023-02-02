<?php
/**
 * Template part for displaying results in search pages
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package zakra
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	/**
	 * Hook - zakra_action_search_content
	 *
	 * Functions hooked into zakra_action_search_content action
	 *
	 * @hooked zakra_action_search_content - 10
	 */
	do_action( 'zakra_action_search_content' );
	?>

</article><!-- #post-<?php the_ID(); ?> -->
