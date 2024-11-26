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
class ColorHeader extends Customizer {
	protected $section_header_color = 'rt_header_color_section';

	/**
	 * Register controls
	 * @return void
	 */
	public function register() {

		Customize::add_section( [
			'id'          => $this->section_header_color,
			'panel'       => 'rt_color_panel',
			'title'       => __( 'Header Colors', 'fasheno' ),
			'description' => __( 'Header Color Section', 'fasheno' ),
			'priority'    => 4
		] );

		Customize::add_controls( $this->section_header_color, $this->get_controls() );
	}

	/**
	 * Get controls
	 * @return array
	 */
	public function get_controls() {

		return apply_filters( 'rt_header_color_controls', [

			'rt_menu_heading1' => [
				'type'  => 'heading',
				'label' => __( 'Default Menu', 'fasheno' ),
			],

			'rt_menu_color' => [
				'type'  => 'alfa_color',
				'label' => __( 'Menu Color', 'fasheno' ),
			],

			'rt_menu_active_color' => [
				'type'  => 'alfa_color',
				'label' => __( 'Menu Hover & Active Color', 'fasheno' ),
			],

			'rt_menu_bg_color' => [
				'type'  => 'alfa_color',
				'label' => __( 'Menu Background Color', 'fasheno' ),
			],

			'rt_sub_menu_bg_color' => [
				'type'  => 'alfa_color',
				'label' => __( 'Sub Menu Background Color', 'fasheno' ),
			],

			'rt_menu_heading2' => [
				'type'  => 'heading',
				'label' => __( 'Transparent Menu', 'fasheno' ),
			],

			'rt_tr_menu_color' => [
				'type'  => 'alfa_color',
				'label' => __( 'TR Menu Color', 'fasheno' ),
			],

			'rt_tr_menu_active_color' => [
				'type'  => 'alfa_color',
				'label' => __( 'TR Menu Hover & Active Color', 'fasheno' ),
			],

			'rt_menu_heading4' => [
				'type'  => 'heading',
				'label' => __( 'Others Style', 'fasheno' ),
			],

			'rt_menu_border_color' => [
				'type'  => 'alfa_color',
				'label' => __( 'Menu Border Color', 'fasheno' ),
			],


		] );


	}

}
