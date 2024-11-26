<?php
/**
 * LayoutControls
 */

namespace RT\Fasheno\Traits;

// Do not allow directly accessing this file.
use RT\Fasheno\Helpers\Fns;

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

trait LayoutControlsTraits {
	public function get_layout_controls( $prefix = '' ) {

		$_left_text  = __( 'Left Sidebar', 'fasheno' );
		$_right_text = __( 'Right Sidebar', 'fasheno' );
		$left_text   = $_left_text;
		$right_text  = $_right_text;
		$image_left  = 'sidebar-left.png';
		$image_right = 'sidebar-right.png';

		if ( is_rtl() ) {
			$left_text   = $_right_text;
			$right_text  = $_left_text;
			$image_left  = 'sidebar-right.png';
			$image_right = 'sidebar-left.png';
		}

		return apply_filters( "fasheno_{$prefix}_layout_controls", [

			$prefix . '_layout' => [
				'type'    => 'image_select',
				'label'   => __( 'Choose Layout', 'fasheno' ),
				'default' => 'right-sidebar',
				'choices' => [
					'left-sidebar'  => [
						'image' => fasheno_get_img( $image_left ),
						'name'  => $left_text,
					],
					'full-width'    => [
						'image' => fasheno_get_img( 'sidebar-full.png' ),
						'name'  => __( 'Full Width', 'fasheno' ),
					],
					'right-sidebar' => [
						'image' => fasheno_get_img( $image_right ),
						'name'  => $right_text,
					],
				]
			],

			$prefix . '_sidebar' => [
				'type'    => 'select',
				'label'   => __( 'Choose a Sidebar', 'fasheno' ),
				'default' => 'default',
				'choices' => Fns::sidebar_lists()
			],

			$prefix . '_page_bg_image' => [
				'type'         => 'image',
				'label'        => __( 'Page Background Image', 'fasheno' ),
				'description'  => __( 'Upload Background Image', 'fasheno' ),
				'button_label' => __( 'Background Image', 'fasheno' ),
			],

			$prefix . '_page_bg_color' => [
				'type'         => 'color',
				'label'        => __( 'Page Background Color', 'fasheno' ),
				'description'  => __( 'Inter Background Color', 'fasheno' ),
			],

			$prefix . '_header_heading' => [
				'type'  => 'heading',
				'label' => __( 'Header Settings', 'fasheno' ),
			],

			$prefix . '_header_style' => [
				'type'    => 'select',
				'default' => 'default',
				'label'   => __( 'Header Layout', 'fasheno' ),
				'choices' => [
					'default' => __( '--Default--', 'fasheno' ),
					'1'       => __( 'Layout 1', 'fasheno' ),
					'2'       => __( 'Layout 2', 'fasheno' ),
					'3'       => __( 'Layout 3', 'fasheno' ),
				],
			],

			$prefix . '_top_bar' => [
				'type'    => 'select',
				'label'   => __( 'Top Bar', 'fasheno' ),
				'default' => 'default',
				'choices' => [
					'default' => __( '--Default--', 'fasheno' ),
					'on'      => __( 'On', 'fasheno' ),
					'off'     => __( 'Off', 'fasheno' ),
				]
			],

			$prefix . '_banner_heading' => [
				'type'  => 'heading',
				'label' => __( 'Banner Settings', 'fasheno' ),
			],

			$prefix . '_banner' => [
				'type'    => 'select',
				'default' => 'default',
				'label'   => __( 'Banner Visibility', 'fasheno' ),
				'choices' => [
					'default' => __( '--Default--', 'fasheno' ),
					'on'      => __( 'On', 'fasheno' ),
					'off'     => __( 'Off', 'fasheno' ),
				],
			],

			$prefix . '_breadcrumb_title' => [
				'type'    => 'select',
				'default' => 'default',
				'label'   => __( 'Banner Title', 'fasheno' ),
				'choices' => [
					'default' => __( '--Default--', 'fasheno' ),
					'on'      => __( 'On', 'fasheno' ),
					'off'     => __( 'Off', 'fasheno' ),
				],
			],

			$prefix . '_breadcrumb' => [
				'type'    => 'select',
				'default' => 'default',
				'label'   => __( 'Banner Breadcrumb', 'fasheno' ),
				'choices' => [
					'default' => __( '--Default--', 'fasheno' ),
					'on'      => __( 'On', 'fasheno' ),
					'off'     => __( 'Off', 'fasheno' ),
				],
			],

			$prefix . '_banner_image' => [
				'type'         => 'image',
				'label'        => __( 'Banner Image', 'fasheno' ),
				'description'  => __( 'Upload Banner Image', 'fasheno' ),
				'button_label' => __( 'Banner Image', 'fasheno' ),
			],

			$prefix . '_banner_color' => [
				'type'         => 'color',
				'label'        => __( 'Banner Background Color', 'fasheno' ),
				'description'  => __( 'Inter Background Color', 'fasheno' ),
			],

			$prefix . '_footer_heading' => [
				'type'  => 'heading',
				'label' => __( 'Footer Settings', 'fasheno' ),
			],

			$prefix . '_footer_style'  => [
				'type'    => 'select',
				'default' => 'default',
				'label'   => __( 'Footer Layout', 'fasheno' ),
				'choices' => [
					'default' => __( '--Default--', 'fasheno' ),
					'1'       => __( 'Layout 1', 'fasheno' ),
					'2'       => __( 'Layout 2', 'fasheno' ),
				],
			],

		] );


	}


}
