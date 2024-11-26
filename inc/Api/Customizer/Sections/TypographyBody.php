<?php
/**
 * Theme Customizer - Body Typography
 *
 * @package fasheno
 */

namespace RT\Fasheno\Api\Customizer\Sections;

use RT\Fasheno\Api\Customizer;
use RTFramework\Customize;

/**
 * Customizer class
 */
class TypographyBody extends Customizer {

	protected $section_id = 'rt_body_typo_section';

	/**
	 * Register controls
	 * @return void
	 */
	public function register() {
		Customize::add_section( [
			'id'          => $this->section_id,
			'title'       => __( 'Body Typography', 'fasheno' ),
			'description' => __( 'Body Typography Section', 'fasheno' ),
			'panel'       => 'rt_typography_panel',
			'priority'    => 1
		] );

		Customize::add_controls( $this->section_id, $this->get_controls() );
	}

	/**
	 * Get controls
	 * @return array
	 */
	public function get_controls() {

		return apply_filters( 'rt_body_typo_section', [

			'rt_body_typo' => [
				'type'    => 'typography',
				'label'   => __( 'Body Typography', 'fasheno' ),
				'default' => json_encode(
					[
						'font'          => 'Outfit',
						'regularweight' => '400',
						'size'          => '15',
						'lineheight'    => '26',
					]
				)
			],

		] );

	}

}
