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
class Labels extends Customizer {
	protected $section_labels = 'rt_labels_section';

	/**
	 * Register controls
	 * @return void
	 */
	public function register() {
		Customize::add_section( [
			'id'          => $this->section_labels,
			'title'       => __( 'Modify Static Text', 'fasheno' ),
			'description' => __( 'You can change all static text of the theme.', 'fasheno' ),
			'priority'    => 999
		] );
		Customize::add_controls( $this->section_labels, $this->get_controls() );
	}

	/**
	 * Get controls
	 * @return array
	 */
	public function get_controls() {

		return apply_filters( 'rt_labels_controls', [

			'rt_header_labels' => [
				'type'  => 'heading',
				'label' => __( 'Header Labels', 'fasheno' ),
			],

			'rt_get_phone_label' => [
				'type'        => 'text',
				'label'       => __( 'Phone Label', 'fasheno' ),
				'default'     => __( 'Call Us Now', 'fasheno' ),
				'description' => __( 'Content: Phone Label', 'fasheno' ),
			],

			'rt_get_login_label' => [
				'type'        => 'text',
				'label'       => __( 'Log In', 'fasheno' ),
				'default'     => __( 'My Account', 'fasheno' ),
				'description' => __( 'Content: My Account Button', 'fasheno' ),
				'condition' => [ 'rt_header_login' ],
			],

			'rt_get_cart_label' => [
				'type'        => 'text',
				'label'       => __( 'Cart', 'fasheno' ),
				'default'     => __( 'Cart', 'fasheno' ),
				'description' => __( 'Content: Cart Button', 'fasheno' ),
			],

			'rt_get_wishlist_label' => [
				'type'        => 'text',
				'label'       => __( 'Wishlist', 'fasheno' ),
				'default'     => __( 'Wishlist', 'fasheno' ),
				'description' => __( 'Content: Wishlist Button', 'fasheno' ),
			],

			'rt_get_compare_label' => [
				'type'        => 'text',
				'label'       => __( 'Compare', 'fasheno' ),
				'default'     => __( 'Compare', 'fasheno' ),
				'description' => __( 'Content: Compare Button', 'fasheno' ),
			],

			'rt_get_delivery_label' => [
				'type'        => 'text',
				'label'       => __( 'Free delivery', 'fasheno' ),
				'default'     => __( 'Free delivery !', 'fasheno' ),
				'description' => __( 'Content: Free delivery !', 'fasheno' ),
				'condition' => [ 'rt_get_started_button' ],
			],

			'rt_get_sale_offer_label' => [
				'type'        => 'text',
				'label'       => __( 'Sale Offer', 'fasheno' ),
				'default'     => __( 'Sale $20 Off Your First Order', 'fasheno' ),
				'description' => __( 'Content: Sale Offer !', 'fasheno' ),
				'condition' => [ 'rt_get_sale_offer_button' ],
			],

			'rt_contact_info_label' => [
				'type'        => 'text',
				'label'       => __( 'Contact Info', 'fasheno' ),
				'default'     => __( 'Contact Info', 'fasheno' ),
				'description' => __( 'Content: Contact Info', 'fasheno' ),
			],

			'rt_follow_us_label' => [
				'type'        => 'text',
				'label'       => __( 'Follow Us On', 'fasheno' ),
				'description' => __( 'Content: Follow Us On', 'fasheno' ),
			],

			'rt_about_label' => [
				'type'        => 'text',
				'label'       => __( 'About Us', 'fasheno' ),
				'description' => __( 'Content: About Us', 'fasheno' ),
			],

			'rt_about_text' => [
				'type'        => 'textarea',
				'label'       => __( 'About Text', 'fasheno' ),
				'description' => __( 'Enter about text here.', 'fasheno' ),
			],

			'rt_footer_labels' => [
				'type'  => 'heading',
				'label' => __( 'Footer Labels', 'fasheno' ),
			],

			'rt_ready_label' => [
				'type'        => 'text',
				'label'       => __( 'Are You Ready', 'fasheno' ),
				'default'     => __( 'ARE YOU READY TO GET STARTED?', 'fasheno' ),
				'description' => __( 'Content: Footer Are You Ready', 'fasheno' ),
			],

			'rt_contact_button_text' => [
				'type'        => 'text',
				'label'       => __( 'Contact Us', 'fasheno' ),
				'default'     => __( 'Contact Us', 'fasheno' ),
				'description' => __( 'Content: Footer contact button', 'fasheno' ),
			],

			'rt_blog_labels' => [
				'type'  => 'heading',
				'label' => __( 'Blog Labels', 'fasheno' ),
			],
			'rt_author_prefix' => [
				'type'        => 'text',
				'label'       => __( 'By', 'fasheno' ),
				'default'     => 'by',
				'description' => __( 'Content: Meta Author Prefix', 'fasheno' ),
			],
			'rt_tags'         => [
				'type'        => 'text',
				'label'       => __( 'Tags:', 'fasheno' ),
				'default'     => __( 'Tags:', 'fasheno' ),
				'description' => __( 'Content: Single blog footer tags label', 'fasheno' ),
			],
			'rt_social' => [
				'type'        => 'text',
				'label'       => __( 'Socials:', 'fasheno' ),
				'default'     => __( 'Socials:', 'fasheno' ),
				'description' => __( 'Content: Single blog footer Socials label', 'fasheno' ),
			],
			'rt_blog_read_more' => [
				'type'        => 'text',
				'label'       => __( 'Blog Read More:', 'fasheno' ),
				'default'     => __( 'Read More', 'fasheno' ),
				'description' => __( 'Content: Single blog footer read more text', 'fasheno' ),
			],

		] );
	}


}
