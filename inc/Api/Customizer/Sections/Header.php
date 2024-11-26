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
class Header extends Customizer {
	protected $section_header = 'rt_header_section';

	/**
	 * Register controls
	 * @return void
	 */
	public function register() {
		Customize::add_section( [
			'id'          => $this->section_header,
			'panel'       => 'rt_header_panel',
			'title'       => __( 'Header Menu', 'fasheno' ),
			'description' => __( 'Header Section', 'fasheno' ),
			'priority'    => 2,
			'edit-point'  => ''
		] );
		Customize::add_controls( $this->section_header, $this->get_controls() );
	}

	/**
	 * Get controls
	 * @return array
	 */
	public function get_controls() {

		return apply_filters( 'rt_header_controls', [

			'rt_header_style' => [
				'type'      => 'image_select',
				'label'     => __( 'Choose Layout', 'fasheno' ),
				'default'   => '1',
				'edit-link' => '.site-branding',
				'choices'   => Fns::image_placeholder( 'header', 3 )
			],

			'rt_menu_alignment' => [
				'type'    => 'select',
				'label'   => __( 'Menu Alignment', 'fasheno' ),
				'default' => 'justify-content-center',
				'choices' => [
					''                       => __( 'Menu Alignment', 'fasheno' ),
					'justify-content-start'  => __( 'Left Alignment', 'fasheno' ),
					'justify-content-center' => __( 'Center Alignment', 'fasheno' ),
					'justify-content-end'    => __( 'Right Alignment', 'fasheno' ),
				]
			],

			'rt_header_width' => [
				'type'    => 'select',
				'label'   => __( 'Header Width', 'fasheno' ),
				'default' => 'box',
				'choices' => [
					'box'       => __( 'Box Width', 'fasheno' ),
					'full' => __( 'Full Width', 'fasheno' ),
				]
			],

			'rt_header_max_width' => [
				'type'        => 'number',
				'label'       => __( 'Header Max Width (PX)', 'fasheno' ),
				'description' => __( 'Enter a number greater than 1440. Remove value for 100%', 'fasheno' ),
				'condition'   => [ 'rt_header_width', '==', 'full' ]
			],

			'rt_sticky_header' => [
				'type'        => 'switch',
				'label'       => __( 'Sticky Header', 'fasheno' ),
				'description' => __( 'Show header at the top when scrolling down', 'fasheno' ),
			],

			'rt_tr_header' => [
				'type'  => 'switch',
				'label' => __( 'Transparent Header', 'fasheno' ),
			],

			'rt_tr_header_color' => [
				'type'    => 'select',
				'label'   => __( 'Transparent color', 'fasheno' ),
				'default' => 'tr-header-dark',
				'choices' => [
					'tr-header-light'   => __( 'Light Color', 'fasheno' ),
					'tr-header-dark'    => __( 'Dark Color', 'fasheno' ),
				],
				'condition' => [ 'rt_tr_header' ]
			],

			'rt_tr_header_shadow' => [
				'type'  => 'switch',
				'label' => __( 'Header Dark Shadow', 'fasheno' ),
				'condition' => [ 'rt_tr_header' ]
			],

			'rt_header_border' => [
				'type'    => 'switch',
				'label'   => __( 'Header Border', 'fasheno' ),
				'default' => 0
			],
			'rt_header_sep1'   => [
				'type' => 'separator',
				'edit-link' => '.menu-icon-wrapper',
			],

			'rt_header_add_to_cart' => [
				'type'    => 'switch',
				'label'   => __( 'Cart ?', 'fasheno' ),
				'default' => 0,
			],

			'rt_header_wishlist' => [
				'type'    => 'switch',
				'label'   => __( 'Wishlist ?', 'fasheno' ),
				'default' => 0,
			],

			'rt_header_compare' => [
				'type'    => 'switch',
				'label'   => __( 'Compare ?', 'fasheno' ),
				'default' => 0,
			],

			'rt_header_search' => [
				'type'    => 'switch',
				'label'   => __( 'Search ?', 'fasheno' ),
				'default' => 1,
			],

			'rt_header_phone' => [
				'type'    => 'switch',
				'label'   => __( 'Phone ?', 'fasheno' ),
				'description' => __( 'Header style one no use phone.', 'fasheno' ),
				'default' => 0,
			],

			'rt_header_separator' => [
				'type'    => 'switch',
				'label'   => __( 'Icon Separator', 'fasheno' ),
				'default' => 0,
			],

			'rt_header_sep2' => [
				'type' => 'separator',
			],

			'rt_header_login' => [
				'type'    => 'switch',
				'label'   => __( 'User Login ?', 'fasheno' ),
				'default' => 0,
			],

			'rt_header_login_link' => [
				'type'    => 'text',
				'label'   => __( 'Login Link', 'fasheno' ),
				'condition' => [ 'rt_header_login' ],
			],

			'rt_header_sep3' => [
				'type' => 'separator',
			],

			'rt_get_delivery_button' => [
				'type'    => 'switch',
				'label'   => __( 'Free Delivery Button ?', 'fasheno' ),
				'default' => 0
			],

			'rt_get_delivery_button_url' => [
				'type'    => 'text',
				'label'   => __( 'Button Link', 'fasheno' ),
				'condition' => [ 'rt_get_delivery_button' ],
			],

			'rt_header_sep4' => [
				'type' => 'separator',
			],

			'rt_get_sale_offer_button' => [
				'type'    => 'switch',
				'label'   => __( 'Sale Offer Button ?', 'fasheno' ),
				'default' => 0,
			],

			'rt_get_sale_offer_button_url' => [
				'type'    => 'text',
				'label'   => __( 'Sale Offer Link', 'fasheno' ),
				'condition' => [ 'rt_get_sale_offer_button' ],
			],

		] );

	}
}
