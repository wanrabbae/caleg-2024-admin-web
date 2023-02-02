<?php

namespace WPForms\Lite\Admin\Education\Builder;

use WPForms\Admin\Education\EducationInterface;
use WPForms_Builder_Panel_Settings;

/**
 * Notifications Education feature.
 *
 * @since 1.7.7
 */
class Notifications implements EducationInterface {

	/**
	 * Init.
	 *
	 * @since 1.7.7
	 */
	public function init() {

		if ( ! $this->allow_load() ) {
			return;
		}

		$this->hooks();
	}

	/**
	 * Indicate if current Education feature is allowed to load.
	 *
	 * @since 1.7.7
	 *
	 * @return bool
	 */
	public function allow_load() {

		return wpforms_is_admin_page( 'builder' );
	}

	/**
	 * Load hooks.
	 *
	 * @since 1.7.7
	 */
	private function hooks() {

		add_action( 'wpforms_lite_form_settings_notifications_block_content_after', [ $this, 'advanced_section' ], 10, 2 );
	}

	/**
	 * Output Notification Advanced section.
	 *
	 * @since 1.7.7
	 *
	 * @param WPForms_Builder_Panel_Settings $settings Builder panel settings.
	 * @param int                            $id       Notification id.
	 *
	 * @return void
	 */
	public function advanced_section( $settings, $id ) {

		$panel = wpforms_panel_field(
			'toggle',
			'notifications',
			'entry_csv_attachment_enable',
			$settings->form_data,
			esc_html__( 'Enable Entry CSV Attachment', 'wpforms-lite' ),
			[
				'input_class' => 'notifications_enable_entry_csv_attachment_toggle education-modal',
				'parent'      => 'settings',
				'subsection'  => $id,
				'pro_badge'   => true,
				'data'        => [
					'action'  => 'upgrade',
					'name'    => esc_html__( 'Entry CSV Attachment', 'wpforms-lite' ),
					'licence' => 'pro',
				],
				'attrs'       => [
					'disabled' => 'disabled',
				],
				'value'       => false,
			],
			false
		);

		// Wrap advanced settings to the unfoldable group.
		wpforms_panel_fields_group(
			$panel,
			[
				'borders'    => [ 'top' ],
				'class'      => 'wpforms-builder-notifications-advanced',
				'default'    => 'opened',
				'group'      => 'settings_notifications_advanced',
				'title'      => esc_html__( 'Advanced', 'wpforms-lite' ),
				'unfoldable' => true,
			]
		);
	}
}
