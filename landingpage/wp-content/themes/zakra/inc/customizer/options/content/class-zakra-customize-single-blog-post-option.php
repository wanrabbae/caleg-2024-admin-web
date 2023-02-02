<?php
/**
 * Single blog post options.
 *
 * @package     zakra
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*========================================== CONTENT > SINGLE POST ==========================================*/
if ( ! class_exists( 'Zakra_Customize_Single_Blog_Post_Option' ) ) :

	/**
	 * Single Blog Post option.
	 */
	class Zakra_Customize_Single_Blog_Post_Option extends Zakra_Customize_Base_Option {

		/**
		 * Include customize options.
		 *
		 * @param array                 $options      Customize options provided via the theme.
		 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
		 *
		 * @return mixed|void Customizer options for registering panels, sections as well as controls.
		 */
		public function register_options( $options, $wp_customize ) {

			$configs = array(

				array(
					'name'        => 'zakra_single_post_content_structure_heading',
					'type'        => 'control',
					'control'     => 'zakra-title',
					'label'       => esc_html__( 'Single Post Content Order', 'zakra' ),
					'description' => esc_html__( 'Drag & Drop items to re-arrange the order', 'zakra' ),
					'section'     => 'zakra_single_blog_post',
					'priority'    => 5,
				),

				array(
					'name'     => 'zakra_single_post_content_structure',
					'default'  => array(
						'featured_image',
						'title',
						'meta',
						'content',
					),
					'type'     => 'control',
					'control'  => 'zakra-sortable',
					'section'  => 'zakra_single_blog_post',
					'choices'  => array(
						'featured_image' => esc_attr__( 'Featured Image', 'zakra' ),
						'title'          => esc_attr__( 'Title', 'zakra' ),
						'meta'           => esc_attr__( 'Meta Tags', 'zakra' ),
						'content'        => esc_attr__( 'Content', 'zakra' ),
					),
					'priority' => 10,
				),

				array(
					'name'        => 'zakra_single_blog_post_meta_structure_heading',
					'type'        => 'control',
					'control'     => 'zakra-title',
					'label'       => esc_html__( 'Meta Tags Order', 'zakra' ),
					'description' => esc_html__( 'Drag & Drop items to re-arrange the order', 'zakra' ),
					'section'     => 'zakra_single_blog_post',
					'priority'    => 15,
				),

				array(
					'name'     => 'zakra_single_blog_post_meta_structure',
					'default'  => array(
						'author',
						'date',
						'categories',
						'tags',
						'comments',
					),
					'type'     => 'control',
					'control'  => 'zakra-sortable',
					'section'  => 'zakra_single_blog_post',
					'choices'  => array(
						'comments'   => esc_attr__( 'Comments', 'zakra' ),
						'categories' => esc_attr__( 'Categories', 'zakra' ),
						'author'     => esc_attr__( 'Author', 'zakra' ),
						'date'       => esc_attr__( 'Date', 'zakra' ),
						'tags'       => esc_attr__( 'Tags', 'zakra' ),
					),
					'priority' => 20,
				),

			);

			$options = array_merge( $options, $configs );


			if ( ! zakra_is_zakra_pro_active() ) {

				$configs[] = array(
					'name'        => 'zakra_single_blog_post_upgrade',
					'type'        => 'control',
					'control'     => 'zakra-upgrade',
					'label'       => esc_html__( 'Learn more', 'zakra' ),
					'description' => esc_html__( 'Unlock more features available for this section.', 'zakra' ),
					'url'         => esc_url( 'https://zakratheme.com/pricing/?utm_source=zakra-customizer&utm_medium=view-pro-link&utm_campaign=zakra-pricing' ),
					'section'     => 'zakra_single_blog_post',
					'priority'    => 30,
				);

				$options = array_merge( $options, $configs );
			}

			return $options;
		}



	}

	new Zakra_Customize_Single_Blog_Post_Option();

endif;
