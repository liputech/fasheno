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
class HeaderTopbar extends Customizer {
	protected $section_topbar = 'rt_top_bar_section';

	/**
	 * Register controls
	 * @return void
	 */
	public function register() {
		Customize::add_section( [
			'id'          => $this->section_topbar,
			'panel'       => 'rt_header_panel',
			'title'       => __( 'Header Top Bar', 'fasheno' ),
			'description' => __( 'Top Bar Section', 'fasheno' ),
			'priority'    => 1
		] );

		Customize::add_controls( $this->section_topbar, $this->get_controls() );
	}

	/**
	 * Get controls
	 * @return array
	 */
	public function get_controls() {

		return apply_filters( 'rt_top_bar_controls', [

			'rt_top_bar' => [
				'type'      => 'switch',
				'label'     => __( 'Topbar Visibility', 'fasheno' ),
				'default'   => 0,
				'edit-link' => '.topbar-row',
			],
			'rt_top_bar_style' => [
				'type'      => 'image_select',
				'label'     => __( 'Topbar Style', 'fasheno' ),
				'default'   => '1',
				'choices'   => Fns::image_placeholder( 'topbar', 2 ),
				'condition' => [ 'rt_top_bar' ]
			],
			'rt_top_bar_address' => [
				'type'    => 'switch',
				'label'   => __( 'Topbar Address ?', 'fasheno' ),
				'default' => 1,
				'condition' => [ 'rt_top_bar' ]
			],
			'rt_top_bar_phone' => [
				'type'    => 'switch',
				'label'   => __( 'Topbar Phone ?', 'fasheno' ),
				'default' => 1,
				'condition' => [ 'rt_top_bar' ]
			],
			'rt_top_bar_email' => [
				'type'    => 'switch',
				'label'   => __( 'Topbar Email ?', 'fasheno' ),
				'default' => 1,
				'condition' => [ 'rt_top_bar' ]
			],
			'rt_top_bar_website' => [
				'type'    => 'switch',
				'label'   => __( 'Topbar Website ?', 'fasheno' ),
				'default' => 1,
				'condition' => [ 'rt_top_bar' ]
			],
			'rt_top_bar_social' => [
				'type'    => 'switch',
				'label'   => __( 'Topbar Social ?', 'fasheno' ),
				'default' => 1,
				'condition' => [ 'rt_top_bar' ]
			],
			'rt_top_bar_menu' => [
				'type'    => 'switch',
				'label'   => __( 'Topbar menu ?', 'fasheno' ),
				'default' => 1,
				'condition' => [ 'rt_top_bar' ]
			],
			'rt_top_bar_currency' => [
				'type'    => 'switch',
				'label'   => __( 'Topbar currency ?', 'fasheno' ),
				'default' => 1,
				'condition' => [ 'rt_top_bar' ]
			],

		] );

	}

}
