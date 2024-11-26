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
class HeaderMobile extends Customizer {
	protected $section_header = 'rt_mobile_header_section';

	/**
	 * Register controls
	 * @return void
	 */
	public function register() {
		Customize::add_section( [
			'id'          => $this->section_header,
			'panel'       => 'rt_header_panel',
			'title'       => __( 'Header Mobile Option', 'fasheno' ),
			'description' => __( 'Header Section', 'fasheno' ),
			'priority'    => 3,
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

			'rt_mobile_header_add_to_cart' => [
				'type'    => 'switch',
				'label'   => __( 'Cart ?', 'fasheno' ),
				'default' => 1,
			],

			'rt_mobile_header_wishlist' => [
				'type'    => 'switch',
				'label'   => __( 'Wishlist ?', 'fasheno' ),
				'default' => 1,
			],

			'rt_mobile_header_compare' => [
				'type'    => 'switch',
				'label'   => __( 'Compare ?', 'fasheno' ),
				'default' => 0,
			],

			'rt_mobile_header_search' => [
				'type'    => 'switch',
				'label'   => __( 'Search ?', 'fasheno' ),
				'default' => 0,
			],

			'rt_mobile_header_ajax_search' => [
				'type'    => 'switch',
				'label'   => __( 'Ajax Search ?', 'fasheno' ),
				'default' => 1,
			],

			'rt_mobile_header_bar' => [
				'type'        => 'switch',
				'label'       => __( 'Hamburger Menu', 'fasheno' ),
				'description' => __( 'It will be hide only for mobile.', 'fasheno' ),
				'default'     => 1,
			],

			'rt_mobile_header_info' => [
				'type'    => 'switch',
				'label'   => __( 'Header Info', 'fasheno' ),
				'default' => 0,
			],

			'rt_mobile_header_login' => [
				'type'    => 'switch',
				'label'   => __( 'User Login ?', 'fasheno' ),
				'default' => 0,
			],

			'rt_mobile_delivery_button' => [
				'type'    => 'switch',
				'label'   => __( 'Free Delivery Button ?', 'fasheno' ),
				'default' => 0
			],

			'rt_mobile_sale_offer_button' => [
				'type'    => 'switch',
				'label'   => __( 'Sale Offer Button ?', 'fasheno' ),
				'default' => 0,
			],
			'rt_mobile_social' => [
				'type'    => 'switch',
				'label'   => __( 'Social ?', 'fasheno' ),
				'default' => 0,
			],

		] );

	}
}
