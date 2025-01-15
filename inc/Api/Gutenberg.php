<?php
/**
 * Build Gutenberg Blocks
 *
 * @package fasheno
 */

namespace RT\Fasheno\Api;

use RT\Fasheno\Traits\SingletonTraits;

/**
 * Customizer class
 */
class Gutenberg {
	use SingletonTraits;

	/**
	 * Register default hooks and actions for WordPress
	 *
	 * @return WordPress add_action()
	 */
	public function __construct() {
		if ( ! function_exists( 'register_block_type' ) ) {
			return;
		}

		add_action( 'init', [ $this, 'gutenberg_init' ] );

	}

	/**
	 * Custom Gutenberg settings
	 * @return
	 */
	public function gutenberg_init() {
		add_theme_support( 'gutenberg', [
			// Theme supports responsive video embeds
			'responsive-embeds' => true,
			// Theme supports wide images, galleries and videos.
			'wide-images'       => true,
		] );

		add_theme_support( 'editor-color-palette', [
			[
				'name' => esc_html__( 'Primary Color', 'fasheno' ),
				'slug' => 'fasheno-primary',
				'color' => '#ff6c23',
			],
			[
				'name' => esc_html__( 'Secondary Color', 'fasheno' ),
				'slug' => 'fasheno-secondary',
				'color' => '#ff0000',
			],
			[
				'name' => esc_html__( 'Yellow Color', 'fasheno' ),
				'slug' => 'fasheno-tertiary',
				'color' => '#f99a1e',
			],
			[
				'name' => esc_html__( 'Black Color', 'fasheno' ),
				'slug' => 'fasheno-black',
				'color' => '#010101',
			],
			[
				'name' => esc_html__( 'Gray Color', 'fasheno' ),
				'slug' => 'fasheno-gray',
				'color' => '#f8f8f8',
			],
			[
				'name' => esc_html__( 'White Color', 'fasheno' ),
				'slug' => 'fasheno-white',
				'color' => '#ffffff',
			],
		] );

		add_theme_support( 'editor-font-sizes', [
			[
				'name' => esc_html__( 'Small', 'fasheno' ),
				'size' => 15,
				'slug' => 'small'
			],
			[
				'name' => esc_html__( 'Normal', 'fasheno' ),
				'size' => 24,
				'slug' => 'normal'
			],
			[
				'name' => esc_html__( 'Large', 'fasheno' ),
				'size' => 36,
				'slug' => 'large'
			],
			[
				'name' => esc_html__( 'Huge', 'fasheno' ),
				'size' => 44,
				'slug' => 'huge'
			]
		] );
	}
}
