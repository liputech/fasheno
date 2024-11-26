<?php
namespace RT\Fasheno\Api\Customizer\Sections;

use RT\Fasheno\Api\Customizer;
use RTFramework\Customize;
/**
 * Customizer class
 */
class WooArchiveSettings extends Customizer {
	protected $section_wooarchive_settins = 'fasheno_woo_archive_settings';
	/**
	 * Register controls
	 * @return void
	 */
	public function register() {
		Customize::add_section( [
			'id'          => $this->section_wooarchive_settins,
			'title'       => __( 'Woocommerce Settings', 'fasheno' ),
			'description' => __( 'fasheno Woocommerce Archive Settings', 'fasheno' ),
			'priority'    => 1,
			'panel' => 'woocommerce',
		] );

		Customize::add_controls( $this->section_wooarchive_settins, $this->get_controls() );
	}

	/**
	 * Get controls
	 * @return array
	 */
	public function get_controls() {
		return apply_filters( 'fasheno_service_controls', [

			'rt_woo_archive_heading' => [
				'type'  => 'heading',
				'label' => __( 'Woocommerce Archive Option', 'fasheno' ),
			],

			'products_cols_width' => [
				'type'    => 'number',
				'label'   => __( 'Products Per Column', 'fasheno' ),
				'description' => __('Use product per col default 4', 'fasheno'),
				'default' => '4',
			],

			'products_per_page' => [
				'type'    => 'number',
				'label'   => __( 'Number of items per page', 'fasheno' ),
				'description' => __( 'Effect only for Shop custom page template', 'fasheno' ),
				'default' => '12',
			],

			'wc_woo_cat' => [
				'type'    => 'switch',
				'label'   => __( 'Category', 'fasheno' ),
				'default' => 1
			],

			'wc_woo_cart' => [
				'type'    => 'switch',
				'label'   => __( 'Cart', 'fasheno' ),
				'default' => 0
			],

			'wc_shop_quickview_icon' => [
				'type'    => 'switch',
				'label'   => __( 'QuickView', 'fasheno' ),
				'default' => 0
			],

			'wc_shop_compare_icon' => [
				'type'    => 'switch',
				'label'   => __( 'Compare', 'fasheno' ),
				'default' => 0
			],

			'wc_shop_wishlist_icon' => [
				'type'    => 'switch',
				'label'   => __( 'Wishlist', 'fasheno' ),
				'default' => 0
			],

			'wc_shop_qcheckout_icon' => [
				'type'    => 'switch',
				'label'   => __( 'Quick Checkout', 'fasheno' ),
				'default' => 0
			],

			'wc_shop_rating' => [
				'type'    => 'switch',
				'label'   => __( 'Rating', 'fasheno' ),
				'default' => 1
			],

			'rt_woo_variation_attr' => [
				'type'    => 'switch',
				'label'   => __( 'Variation Attribute', 'fasheno' ),
				'default' => 0
			],

			'wc_shop_sale_flash' => [
				'type'    => 'switch',
				'label'   => __( 'Sale Flash', 'fasheno' ),
				'default' => 1
			],

			'wc_sale_label' => [
				'type'    => 'select',
				'default' => 'text',
				'label'   => __( 'Sale Product Label', 'fasheno' ),
				'condition' => [ 'wc_shop_sale_flash' ],
				'choices' => [
					'percentage'       => __( 'Percentage', 'fasheno' ),
					'text'       => __( 'Text', 'fasheno' ),
				],
			],

			'rt_shop_banner_single_title' => [
				'type'    => 'text',
				'label'   => __( 'Shop Banner Title', 'fasheno' ),
				'default' => __( 'Shop Page', 'fasheno' ),
			],

			'rt_product_banner_single_title' => [
				'type'    => 'text',
				'label'   => __( 'Product Banner Title', 'fasheno' ),
				'default' => __( 'Product Page', 'fasheno' ),
			],

		] );
	}
}
