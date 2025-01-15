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
class ColorSite extends Customizer {
	protected $section_site_color = 'rt_site_color_section';

	/**
	 * Register controls
	 * @return void
	 */
	public function register() {
		Customize::add_section( [
			'id'          => $this->section_site_color,
			'panel'       => 'rt_color_panel',
			'title'       => __( 'Site Colors', 'fasheno' ),
			'description' => __( 'Site Color Section', 'fasheno' ),
			'priority'    => 2
		] );
		Customize::add_controls( $this->section_site_color, $this->get_controls() );
	}

	/**
	 * Get controls
	 * @return array
	 */
	public function get_controls() {

		return apply_filters( 'rt_site_color_controls', [

			'rt_site_color1'   => [
				'type'  => 'heading',
				'label' => __( 'Site Ascent Color', 'fasheno' ),
			],
			'rt_primary_color' => [
				'type'    => 'color',
				'label'   => __( 'Primary Color', 'fasheno' ),
			],

			'rt_color_separator2' => [
				'type' => 'separator',
			],

			'rt_secondary_color' => [
				'type'    => 'color',
				'label'   => __( 'Secondary Color', 'fasheno' ),
			],

			'rt_color_separator3' => [
				'type' => 'separator',
			],

			'rt_tertiary_color' => [
				'type'    => 'color',
				'label'   => __( 'Tertiary Color', 'fasheno' ),
			],

			'rt_site_color2' => [
				'type'  => 'heading',
				'label' => __( 'Others Color', 'fasheno' ),
			],

			'rt_body_bg_color' => [
				'type'    => 'color',
				'label'   => __( 'Body BG Color', 'fasheno' ),
			],

			'rt_body_color' => [
				'type'    => 'color',
				'label'   => __( 'Body Color', 'fasheno' ),
			],

			'rt_border_color' => [
				'type'    => 'color',
				'label'   => __( 'Border Color', 'fasheno' ),
			],

			'rt_heading_color' => [
				'type'    => 'color',
				'label'   => __( 'Title Color', 'fasheno' ),
			],

			'rt_button_color' => [
				'type'    => 'color',
				'label'   => __( 'Button Color', 'fasheno' ),
			],

			'rt_button_text_color' => [
				'type'    => 'color',
				'label'   => __( 'Button Text Color', 'fasheno' ),
			],

			'rt_button_bg_color' => [
				'type'    => 'color',
				'label'   => __( 'Button Background Color', 'fasheno' ),
			],

			'rt_white_bg_color' => [
				'type'    => 'color',
				'label'   => __( 'White Background Color', 'fasheno' ),
			],

			'rt_red_color' => [
				'type'    => 'color',
				'label'   => __( 'Red Color', 'fasheno' ),
			],

			'rt_meta_color' => [
				'type'    => 'color',
				'label'   => __( 'Meta Color', 'fasheno' ),
			],

			'rt_gray_color' => [
				'type'    => 'color',
				'label'   => __( 'Gray Color', 'fasheno' ),
			],

		] );


	}

}
