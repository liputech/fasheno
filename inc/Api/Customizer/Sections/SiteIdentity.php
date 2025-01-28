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
class SiteIdentity extends Customizer {

	/**
	 * Register controls
	 * @return void
	 */
	public function register() {
		Customize::add_controls( 'title_tagline', $this->get_controls() );
	}

	/**
	 * Get controls
	 * @return array
	 */
	public function get_controls() {

		return apply_filters( 'rt_title_tagline_controls', [

			'rt_logo' => [
				'type'         => 'image',
				'label'        => __( 'Main Logo', 'fasheno' ),
				'description'  => __( 'Upload main logo for your site.', 'fasheno' ),
				'button_label' => __( 'Logo', 'fasheno' ),
			],

			'rt_logo_light' => [
				'type'         => 'image',
				'label'        => __( 'Light Logo', 'fasheno' ),
				'description'  => __( 'Upload light logo for transparent header. It should a white logo', 'fasheno' ),
				'button_label' => __( 'Light Logo', 'fasheno' ),
			],

			'rt_logo_width_height' => [
				'type'      => 'text',
				'label'     => __( 'Main Logo Dimension', 'fasheno' ),
				'description'     => __( 'Enter the width and height value separate by comma (,). Eg. 120px,45px', 'fasheno' ),
				'transport' => '',
			],

		] );

	}

}
