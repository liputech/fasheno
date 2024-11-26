<?php
/**
 * Theme Customizer - Header
 *
 * @package fasheno
 */

namespace RT\Fasheno\Api\Customizer\Sections;

use RT\Fasheno\Api\Customizer;
use RTFramework\Customize;
use RT\Fasheno\Traits\LayoutControlsTraits;

/**
 * Customizer class
 */
class LayoutsWooArchive extends Customizer {

	use LayoutControlsTraits;

	protected $section_woocommerce_archive_layout = 'rt_woocommerce_archive_layout_section';

	/**
	 * Register controls
	 * @return void
	 */
	public function register() {
		Customize::add_section( [
			'id'    => $this->section_woocommerce_archive_layout,
			'title' => __( 'Woocommerce Archive', 'fasheno' ),
			'panel' => 'rt_layouts_panel',
		] );
		Customize::add_controls( $this->section_woocommerce_archive_layout, $this->get_controls() );
	}

	public function get_controls() {
		return $this->get_layout_controls( 'woo-archive' );
	}

}
