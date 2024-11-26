<?php
/**
 * Theme Customizer Pannels
 *
 * @package fasheno
 */

namespace RT\Fasheno\Api\Customizer;

use RT\Fasheno\Traits\SingletonTraits;
use RTFramework\Customize;

/**
 * Customizer class
 */
class Pannels {
	use SingletonTraits;

	/**
	 * register default hooks and actions for WordPress
	 * @return
	 */
	public function __construct() {
		$this->add_panels();
	}

	/**
	 * Add Panels
	 * @return void
	 */
	public function add_panels() {
		Customize::add_panels(
			[
				[
					'id'          => 'rt_header_panel',
					'title'       => esc_html__( 'Header - Topbar - Menu', 'fasheno' ),
					'description' => esc_html__( 'Fasheno Header', 'fasheno' ),
					'priority'    => 22,
				],
				[
					'id'          => 'rt_typography_panel',
					'title'       => esc_html__( 'Typography', 'fasheno' ),
					'description' => esc_html__( 'Fasheno Typography', 'fasheno' ),
					'priority'    => 24,
				],
				[
					'id'          => 'rt_color_panel',
					'title'       => esc_html__( 'Colors', 'fasheno' ),
					'description' => esc_html__( 'Fasheno Color Settings', 'fasheno' ),
					'priority'    => 28,
				],
				[
					'id'          => 'rt_layouts_panel',
					'title'       => esc_html__( 'Layout Settings', 'fasheno' ),
					'description' => esc_html__( 'Fasheno Layout Settings', 'fasheno' ),
					'priority'    => 34,
				],
				[
					'id'          => 'rt_contact_social_panel',
					'title'       => esc_html__( 'Contact & Socials', 'fasheno' ),
					'description' => esc_html__( 'Fasheno Contact & Socials', 'fasheno' ),
					'priority'    => 24,
				],

			]
		);
	}

}
