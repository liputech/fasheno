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
class ColorBanner extends Customizer {

	protected $section_banner_color = 'rt_banner_color_section';

	/**
	 * Register controls
	 * @return void
	 */
	public function register() {
		Customize::add_section( [
			'id'          => $this->section_banner_color,
			'panel'       => 'rt_color_panel',
			'title'       => __( 'Banner / Breadcrumb Colors', 'fasheno' ),
			'description' => __( 'Banner Color Section', 'fasheno' ),
			'priority'    => 6
		] );

		Customize::add_controls( $this->section_banner_color, $this->get_controls() );
	}

	/**
	 * Get controls
	 * @return array
	 */
	public function get_controls() {

		return apply_filters( 'rt_site_color_controls', [

			'rt_breadcrumb_heading_color' => [
				'type'    => 'color',
				'label'   => __( 'Title Color', 'fasheno' ),
			],
			'rt_breadcrumb_color' => [
				'type'    => 'color',
				'label'   => __( 'Link Color', 'fasheno' ),
			],
			'rt_breadcrumb_hover' => [
				'type'    => 'color',
				'label'   => __( 'Link Hover Color', 'fasheno' ),
			],
			'rt_breadcrumb_active' => [
				'type'    => 'color',
				'label'   => __( 'Link Active Color', 'fasheno' ),
			],
		] );
	}
}
