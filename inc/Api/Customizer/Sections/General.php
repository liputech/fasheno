<?php
/**
 * Theme Customizer - Header
 *
 * @package fasheno
 */

namespace RT\Fasheno\Api\Customizer\Sections;

use RT\Fasheno\Api\Customizer;
use RTFramework\Customize;

/**
 * Customizer class
 */
class General extends Customizer {
	protected $section_general = 'rt_general_section';

	/**
	 * Register controls
	 * @return void
	 */
	public function register() {
		Customize::add_section( [
			'id'          => $this->section_general,
			'title'       => __( 'General', 'fasheno' ),
			'description' => __( 'General Section', 'fasheno' ),
			'priority'    => 20
		] );
		Customize::add_controls( $this->section_general, $this->get_controls() );
	}

	/**
	 * Get controls
	 * @return array
	 */
	public function get_controls() {

		return apply_filters( 'rt_general_controls', [

			'rt_svg_enable' => [
				'type'  => 'switch',
				'label' => __( 'Enable SVG Upload', 'fasheno' ),
				'default' => 1,
			],

			'rt_preloader' => [
				'type'  => 'switch',
				'label' => __( 'Preloader', 'fasheno' ),
			],

			'rt_preloader_text' => [
				'type'        => 'text',
				'label'       => __( 'Preloader Text', 'fasheno' ),
				'default'     => __( 'Fasheno...', 'fasheno' ),
				'description' => __( 'Content: Change Preloader text', 'fasheno' ),
				'condition' => [ 'rt_preloader' ]
			],

			'rt_preloader_logo' => [
				'type'         => 'image',
				'label'        => __( 'Preloader Logo', 'fasheno' ),
				'description'  => __( 'Upload preloader logo for your site.', 'fasheno' ),
				'button_label' => __( 'Logo', 'fasheno' ),
				'condition' => [ 'rt_preloader' ]
			],

			'preloader_bg_color' => [
				'type'    => 'color',
				'label'   => __( 'Preloader Background Color', 'fasheno' ),
				'condition' => [ 'rt_preloader' ]
			],

			'rt_back_to_top' => [
				'type'  => 'switch',
				'label' => __( 'Back to Top', 'fasheno' ),
			],

			'rt_rtl_mode' => [
				'type'  => 'switch',
				'label' => __( 'RTL Mode', 'fasheno' ),
			],

			'rt_color_mode' => [
				'type'  => 'switch',
				'label' => __( 'Color Mode', 'fasheno' ),
			],

			'code_mode_type' => [
				'type'    => 'select',
				'label'   => __( 'Select Color Mode', 'fasheno' ),
				'default' => 'light-mode',
				'choices' => [
					'light-mode' => esc_html__( 'Light Mode', 'fasheno' ),
					'dark-mode' => esc_html__( 'Dark Mode', 'fasheno' ),
				],
				'condition' => [ 'rt_color_mode' ]
			],

			'rt_remove_admin_bar' => [
				'type'        => 'switch',
				'label'       => __( 'Remove Admin Bar', 'fasheno' ),
				'description' => __( 'This option not work for administrator role.', 'fasheno' ),
			],

			'container_width' => [
				'type'    => 'select',
				'label'   => __( 'Container Width', 'fasheno' ),
				'default' => '1344',
				'choices' => [
					'1554' => esc_html__( '1554px', 'fasheno' ),
					'1344' => esc_html__( '1344px', 'fasheno' ),
					'1240' => esc_html__( '1240px', 'fasheno' ),
					'1200' => esc_html__( '1200px', 'fasheno' ),
					'1140' => esc_html__( '1140px', 'fasheno' ),
				]
			],

			'rt_blend' => [
				'type'        => 'switch',
				'label'       => __( 'Image Blend', 'fasheno' ),
				'default' => 0,
				'description' => __( 'This option for use all image blend mode.', 'fasheno' ),
			],

		] );

	}

}
