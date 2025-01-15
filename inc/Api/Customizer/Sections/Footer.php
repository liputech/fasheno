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
class Footer extends Customizer {
	protected $section_footer = 'rt_footer_section';

	/**
	 * Register controls
	 * @return void
	 */
	public function register() {
		Customize::add_section( [
			'id'          => $this->section_footer,
			'title'       => __( 'Footer', 'fasheno' ),
			'description' => __( 'Footer Section', 'fasheno' ),
			'priority'    => 38
		] );

		Customize::add_controls( $this->section_footer, $this->get_controls() );
	}

	/**
	 * Get controls
	 * @return array
	 */
	public function get_controls() {

		return apply_filters( 'rt_footer_controls', [

			'rt_footer_display' => [
				'type'        => 'switch',
				'label'       => __( 'Footer Display', 'fasheno' ),
				'description' => __( 'Show footer display', 'fasheno' ),
				'default' => 1,
			],

			'rt_footer_style' => [
				'type'    => 'image_select',
				'label'   => __( 'Choose Layout', 'fasheno' ),
				'default' => 1,
				'choices' => Fns::image_placeholder( 'footer', 2 )
			],

			'rt_footer_width' => [
				'type'    => 'select',
				'label'   => __( 'Footer Width', 'fasheno' ),
				'default' => '',
				'choices' => [
					''       => __( 'Box Width', 'fasheno' ),
					'-fluid' => __( 'Full Width', 'fasheno' ),
				]
			],

			'rt_footer_max_width' => [
				'type'        => 'number',
				'label'       => __( 'Footer Max Width (PX)', 'fasheno' ),
				'description' => __( 'Enter a number greater than 992.', 'fasheno' ),
				'condition'   => [ 'rt_footer_width', '==', '-fluid' ]
			],

			'rt_sticky_footer' => [
				'type'        => 'switch',
				'label'       => __( 'Sticky Footer', 'fasheno' ),
				'description' => __( 'Show footer at the top when scrolling down', 'fasheno' ),
			],

			'rt_footer_copyright' => [
				'type'        => 'tinymce',
				'label'       => __( 'Footer Copyright Text', 'fasheno' ),
				'default'     => __( 'Copyright© [y] Fasheno by RadiusTheme', 'fasheno' ),
				'description' => __( 'Add [y] flag anywhere for dynamic year.', 'fasheno' ),
			],

			'rt_footer_heading1' => [
				'type'  => 'heading',
				'label' => __( 'Payment Cart', 'fasheno' ),
			],
			'rt_footer_payment_display' => [
				'type'        => 'switch',
				'label'       => __( 'Payment Display', 'fasheno' ),
				'description' => __( 'Show Payment Cart Display, This options available for only Footer layout.', 'fasheno' ),
				'default' => 0,
			],
			'rt_footer_payment_cart' => [
				'type'         => 'image',
				'label'        => __( 'Payment Cart', 'fasheno' ),
				'description'  => __( 'Upload Payment cart. This options available for only Footer layout.', 'fasheno' ),
				'button_label' => __( 'Payment Cart', 'fasheno' ),
				'condition' => [ 'rt_footer_payment_display' ],
			],

		] );

	}

}
