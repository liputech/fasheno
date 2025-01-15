<?php
/**
 * Shopbuilder exist or not.
 */
use RadiusTheme\SB\Helpers\BuilderFns;
if ( ! function_exists( 'rtsb' ) ) {
	return;
}

use RadiusTheme\SB\Traits\SingletonTrait;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * ShopBuilder Theme Support
 */
class ThemeSupport {
	/**
	 * Singleton
	 */
	use SingletonTrait;

	/**
	 * Construct function
	 */
	private function __construct() {
		add_filter( 'rtsb/elementor/render/meta_dataset_final', [ $this, 'fasheno_meta_dataset' ], 10, 2 );
		add_filter( 'rtsb/elementor/render/archive_meta_dataset_final', [ $this, 'fasheno_meta_dataset' ], 10, 2 );
	}

	/**
	 * Meta Dataset.
	 *
	 * @param array $data Data array.
	 * @param array $settings Settings array.
	 *
	 * @return array
	 */
	public static function fasheno_meta_dataset( $data, $settings ) {
		if ( ! ( BuilderFns::is_shop() || BuilderFns::is_archive() ) ) {
			return $data;
		}

		$data['posts_per_page'] = ! empty( fasheno_option('products_per_page') ) ? absint( fasheno_option('products_per_page') ) : $data['posts_per_page'];

		return $data;
	}

}
