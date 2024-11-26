<?php
/**
 * Theme Customizer - Heading Typography
 *
 * @package fasheno
 */

namespace RT\Fasheno\Api\Customizer\Sections;

use RT\Fasheno\Api\Customizer;
use RTFramework\Customize;

/**
 * Customizer class
 */
class TypographyHeading extends Customizer {

	protected $section_id = 'rt_heading_typo_section';

	/**
	 * Register controls
	 * @return void
	 */
	public function register() {
		Customize::add_section( [
			'id'          => $this->section_id,
			'title'       => __( 'Heading Typography', 'fasheno' ),
			'description' => __( 'Heading Typography Section', 'fasheno' ),
			'panel'       => 'rt_typography_panel',
			'priority'    => 2
		] );

		Customize::add_controls( $this->section_id, $this->get_controls() );
	}

	/**
	 * Get controls
	 * @return array
	 */
	public function get_controls() {

		return apply_filters( 'rt_heading_typo_section', [

			'rt_all_heading_typo' => [
				'type'    => 'typography',
				'label'   => __( 'All Headings Typography', 'fasheno' ),
				'default' => json_encode(
					[
						'font'          => 'Outfit',
						'regularweight' => '600',
						'size'          => '44',
						'lineheight'    => '54',
					]
				)
			],

			'rt_heading_h1_typo' => [
				'type'    => 'typography',
				'label'   => __( 'H1 Typography', 'fasheno' ),
				'default' => json_encode(
					[
						'font'          => '',
						'regularweight' => '',
						'size'          => '',
						'lineheight'    => '',
					]
				)
			],

			'rt_heading_h2_typo' => [
				'type'    => 'typography',
				'label'   => __( 'H2 Typography', 'fasheno' ),
				'default' => json_encode(
					[
						'font'          => '',
						'regularweight' => '',
						'size'          => '',
						'lineheight'    => '',
					]
				)
			],

			'rt_heading_h3_typo' => [
				'type'    => 'typography',
				'label'   => __( 'H3 Typography', 'fasheno' ),
				'default' => json_encode(
					[
						'font'          => '',
						'regularweight' => '',
						'size'          => '',
						'lineheight'    => '',
					]
				)
			],

			'rt_heading_h4_typo' => [
				'type'    => 'typography',
				'label'   => __( 'H4 Typography', 'fasheno' ),
				'default' => json_encode(
					[
						'font'          => '',
						'regularweight' => '',
						'size'          => '',
						'lineheight'    => '',
					]
				)
			],

			'rt_heading_h5_typo' => [
				'type'    => 'typography',
				'label'   => __( 'H5 Typography', 'fasheno' ),
				'default' => json_encode(
					[
						'font'          => '',
						'regularweight' => '',
						'size'          => '',
						'lineheight'    => '',
					]
				)
			],

			'rt_heading_h6_typo' => [
				'type'    => 'typography',
				'label'   => __( 'H6 Typography', 'fasheno' ),
				'default' => json_encode(
					[
						'font'          => '',
						'regularweight' => '',
						'size'          => '',
						'lineheight'    => '',
					]
				)
			],

		] );

	}

}
