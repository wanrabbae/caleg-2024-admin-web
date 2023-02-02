<?php
/**
 * Archive/ blog layout.
 *
 * @package     zakra
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*== POST/PAGE/BLOG > ARCHIVE/ BLOG ==*/
if ( ! class_exists( 'Zakra_Customize_Blog_Archive_Option' ) ) :

	/**
	 * Archive/Blog option.
	 */
	class Zakra_Customize_Blog_Archive_Option extends Zakra_Customize_Base_Option {

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
					'name'     => 'zakra_blog_archive_post_heading',
					'type'     => 'control',
					'control'  => 'zakra-title',
					'label'    => esc_html__( 'Post', 'zakra' ),
					'section'  => 'zakra_archive_blog',
					'priority' => 50,
				),

				array(
					'name'     => 'zakra_post_content_archive_blog',
					'default'  => 'excerpt',
					'type'     => 'control',
					'control'  => 'radio',
					'label'    => esc_html__( 'Post Content', 'zakra' ),
					'section'  => 'zakra_archive_blog',
					'choices'  => array(
						'excerpt' => esc_html__( 'Excerpt', 'zakra' ),
						'content' => esc_html__( 'Full Content', 'zakra' ),
					),
					'priority' => 55,
				),

				array(
					'name'        => 'zakra_structure_archive_blog',
					'default'     => array(
						'featured_image',
						'title',
						'meta',
						'content',
					),
					'type'        => 'control',
					'control'     => 'zakra-sortable',
					'label'       => esc_html__( 'Post Content Order', 'zakra' ),
					'description' => esc_html__( 'Drag & Drop items to re-arrange the order', 'zakra' ),
					'section'     => 'zakra_archive_blog',
					'choices'     => array(
						'featured_image' => esc_attr__( 'Featured Image', 'zakra' ),
						'title'          => esc_attr__( 'Title', 'zakra' ),
						'meta'           => esc_attr__( 'Meta Tags', 'zakra' ),
						'content'        => esc_attr__( 'Content', 'zakra' ),
					),
					'dependency'  => apply_filters( 'zakra_structure_archive_blog_order', false ),
					'priority'    => 70,
				),

				array(
					'name'        => 'zakra_meta_structure_archive_blog',
					'default'     => array(
						'author',
						'date',
						'categories',
						'tags',
						'comments',
					),
					'type'        => 'control',
					'control'     => 'zakra-sortable',
					'label'       => esc_html__( 'Meta Tags Order', 'zakra' ),
					'description' => esc_html__( 'Drag & Drop items to re-arrange the order', 'zakra' ),
					'section'     => 'zakra_archive_blog',
					'choices'     => array(
						'comments'   => esc_attr__( 'Comments', 'zakra' ),
						'categories' => esc_attr__( 'Categories', 'zakra' ),
						'author'     => esc_attr__( 'Author', 'zakra' ),
						'date'       => esc_attr__( 'Date', 'zakra' ),
						'tags'       => esc_attr__( 'Tags', 'zakra' ),
					),
					'dependency'  => apply_filters( 'zakra_structure_archive_blog_order', false ),
					'priority'    => 75,
				),

				array(
					'name'       => 'zakra_blog_archive_read_more_heading',
					'type'       => 'control',
					'control'    => 'zakra-title',
					'label'      => esc_html__( 'Read More', 'zakra' ),
					'section'    => 'zakra_archive_blog',
					'priority'   => 85,
					'dependency' => array(
						'zakra_post_content_archive_blog',
						'==',
						'excerpt',
					),
				),

				array(
					'name'       => 'zakra_enable_read_more_archive_blog',
					'default'    => true,
					'type'       => 'control',
					'control'    => 'zakra-toggle',
					'label'      => esc_html__( 'Enable Read More', 'zakra' ),
					'section'    => 'zakra_archive_blog',
					'priority'   => 90,
					'dependency' => array(
						'zakra_post_content_archive_blog',
						'==',
						'excerpt',
					),
				),

				array(
					'name'       => 'zakra_read_more_align_archive_blog',
					'default'    => 'left',
					'type'       => 'control',
					'control'    => 'zakra-radio-image',
					'label'      => esc_html__( 'Read More Style', 'zakra' ),
					'section'    => 'zakra_archive_blog',
					'priority'   => 105,
					'image_col'  => 2,
					'choices'    => apply_filters(
						'zakra_read_more_style',
						array(
							'left'  => array(
								'label' => '',
								'url'   => ZAKRA_PARENT_INC_ICON_URI . '/read-more-left.png',
							),
							'right' => array(
								'label' => '',
								'url'   => ZAKRA_PARENT_INC_ICON_URI . '/read-more-right.png',
							),
						)
					),
					'dependency' => array(
						'conditions' => apply_filters(
							'zakra_read_more_align_dependency',
							array(
								array(
									'zakra_post_content_archive_blog',
									'==',
									'excerpt',
								),
								array(
									'zakra_enable_read_more_archive_blog',
									'==',
									true,
								),
							)
						),
						'operator'   => 'AND',
					),
				),

				array(
					'name'       => 'zakra_typography_blog_archive_heading',
					'type'       => 'control',
					'control'    => 'zakra-title',
					'label'      => esc_html__( 'Typography', 'zakra' ),
					'section'    => 'zakra_archive_blog',
					'priority'   => 285,
					'dependency' => array(
						'zakra_post_content_archive_blog',
						'==',
						'excerpt',
					),
				),

				array(
					'name'     => 'zakra_typography_blog_post_title_group',
					'type'     => 'control',
					'control'  => 'zakra-group',
					'label'    => esc_html__( 'Blog/Archive Post Title', 'zakra' ),
					'section'  => 'zakra_archive_blog',
					'priority' => 286,
				),

				array(
					'name'        => 'zakra_typography_blog_post_title',
					'default'     => array(
						'font-family'    => 'default',
						'font-weight'    => '500',
						'subsets'        => array( 'latin' ),
						'font-size'      => array(
							'desktop' => '2.25rem',
							'tablet'  => '',
							'mobile'  => '',
						),
						'line-height'    => array(
							'desktop' => '1.3',
							'tablet'  => '',
							'mobile'  => '',
						),
						'font-style'     => 'normal',
						'text-transform' => 'none',
					),
					'input_attrs' => array(
						'desktop' => array(
							'font-size'   => array(
								'step' => 0.1,
								'min'  => 0.5,
								'max'  => 4,
							),
							'line-height' => array(
								'step' => 0.1,
								'min'  => 0,
								'max'  => 3,
							),
						),
						'tablet'  => array(
							'font-size'   => array(
								'step' => 0.1,
								'min'  => 0.5,
								'max'  => 3,
							),
							'line-height' => array(
								'step' => 0.1,
								'min'  => 0,
								'max'  => 3,
							),
						),
						'mobile'  => array(
							'font-size'   => array(
								'step' => 0.1,
								'min'  => 0.5,
								'max'  => 2,
							),
							'line-height' => array(
								'step' => 0.1,
								'min'  => 0,
								'max'  => 3,
							),
						),
					),
					'type'        => 'sub-control',
					'control'     => 'zakra-typography',
					'parent'      => 'zakra_typography_blog_post_title_group',
					'section'     => 'zakra_archive_blog',
					'transport'   => 'postMessage',
					'priority'    => 286,
				),

			);

			$options = array_merge( $options, $configs );

			if ( ! zakra_is_zakra_pro_active() ) {

				$configs[] = array(
					'name'        => 'zakra_archive_blog_upgrade',
					'type'        => 'control',
					'control'     => 'zakra-upgrade',
					'label'       => esc_html__( 'Learn more', 'zakra' ),
					'description' => esc_html__( 'Unlock more features available for this section.', 'zakra' ),
					'url'         => esc_url( 'https://zakratheme.com/pricing/?utm_source=zakra-customizer&utm_medium=view-pro-link&utm_campaign=zakra-pricing' ),
					'section'     => 'zakra_archive_blog',
					'priority'    => 290,
				);

				$options = array_merge( $options, $configs );
			}

			return $options;
		}

	}

	new Zakra_Customize_Blog_Archive_Option();

endif;
