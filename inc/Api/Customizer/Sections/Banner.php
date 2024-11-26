<?php
/**
 * Theme Customizer - Header
 *
 * @package fasheno
 */

namespace RT\Fasheno\Api\Customizer\Sections;

use RT\Fasheno\Api\Customizer;
use RT\Fasheno\Helpers\Fns;
use RTFramework\Customize;

/**
 * Customizer class
 */
class Banner extends Customizer {

	protected $section_breadcrumb = 'rt_breadcrumb_section';

	/**
	 * Register controls
	 * @return void
	 */
	public function register() {
		Customize::add_section( [
			'id'          => $this->section_breadcrumb,
			'title'       => __( 'Banner - Breadcrumb', 'fasheno' ),
			'description' => __( 'Banner Section', 'fasheno' ),
			'priority'    => 23
		] );

		Customize::add_controls( $this->section_breadcrumb, $this->get_controls() );
	}

	/**
	 * Get controls
	 * @return array
	 */
	public function get_controls() {

		return apply_filters( 'rt_top_bar_controls', [

			'rt_banner' => [
				'type'    => 'switch',
				'label'   => __( 'Banner Visibility', 'fasheno' ),
				'default' => 1
			],

			'rt_banner_style' => [
				'type'      => 'image_select',
				'label'     => __( 'Banner Style', 'fasheno' ),
				'default'   => 1,
				'choices'   => Fns::image_placeholder( 'banner', 1 ),
				'condition' => [ 'rt_banner' ]
			],

			'rt_breadcrumb_alignment' => [
				'type'    => 'select',
				'label'   => __( 'Banner Alignment', 'fasheno' ),
				'default' => 'align-items-center',
				'choices' => [
					'default'               => __( 'Alignment Default', 'fasheno' ),
					'align-items-center'    => __( 'Alignment Center', 'fasheno' ),
					'align-items-end'       => __( 'Alignment right', 'fasheno' ),
				],
				'condition' => [ 'rt_banner' ]
			],

			'rt_banner_image' => [
				'type'         => 'image',
				'label'        => __( 'Banner Background Image', 'fasheno' ),
				'description'  => __( 'Upload Banner Image', 'fasheno' ),
				'button_label' => __( 'Banner', 'fasheno' ),
				'condition'    => [ 'rt_banner' ]
			],

			'rt_banner_color' => [
				'type'         => 'alfa_color',
				'label'        => __( 'Banner Background Color', 'fasheno' ),
				'description'  => __( 'Inter Banner Color', 'fasheno' ),
				'condition'    => [ 'rt_banner' ]
			],

			'rt_banner_image_attr' => [
				'type'      => 'bg_attribute',
				'condition' => [ 'rt_banner' ],
				'default'   => json_encode(
					[
						'position'   => 'center center',
						'attachment' => 'scroll',
						'repeat'     => 'no-repeat',
						'size'       => 'cover',
					]
				)
			],

			'rt_banner_color_opacity' => [
				'type'         => 'number',
				'label'        => __( 'Background Opacity', 'fasheno' ),
				'description'  => __( 'Inter Banner Opacity', 'fasheno' ),
				'condition'    => [ 'rt_banner' ]
			],

			'rt_banner_padding_top' => [
				'type'        => 'number',
				'label'       => __( 'Banner Padding Top (px)', 'fasheno' ),
				'default'     => '',
				'condition'   => [ 'rt_banner' ]
			],

			'rt_banner_padding_bottom' => [
				'type'        => 'number',
				'label'       => __( 'Banner Padding Bottom (px)', 'fasheno' ),
				'default'     => '',
				'condition'   => [ 'rt_banner' ]
			],

			'rt_banner_color_mode' => [
				'type'    => 'select',
				'label'   => __( 'Banner Color Mode', 'fasheno' ),
				'default' => 'banner-dark',
				'choices' => [
					'banner-dark'    => __( 'Dark Color', 'fasheno' ),
					'banner-light'   => __( 'Light Color', 'fasheno' ),
				],
				'condition' => [ 'rt_banner' ]
			],

			'rt_banner1' => [
				'type'      => 'heading',
				'label'     => __( 'Breadcrumb Settings', 'fasheno' ),
				'condition' => [ 'rt_banner' ]
			],

			'rt_breadcrumb_title' => [
				'type'      => 'switch',
				'label'     => __( 'Banner Title', 'fasheno' ),
				'default'   => 1,
				'condition' => [ 'rt_banner' ]
			],

			'rt_breadcrumb' => [
				'type'      => 'switch',
				'label'     => __( 'Banner Breadcrumb', 'fasheno' ),
				'condition' => [ 'rt_banner' ]
			],

			'rt_breadcrumb_border' => [
				'type'      => 'switch',
				'label'     => __( 'Breadcrumb Border', 'fasheno' ),
				'default'   => 0,
				'condition' => [ 'rt_banner' ]
			],

		] );

	}

}
