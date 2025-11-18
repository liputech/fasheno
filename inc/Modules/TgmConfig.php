<?php
/**
 * @author  RadiusTheme
 * @since   1.0.0
 * @version 1.1.0
 */

namespace RT\Fasheno\Modules;
use RT\Fasheno\Traits\SingletonTraits;

require_once get_template_directory() . '/inc/Lib/class-tgm-plugin-activation.php';
class TgmConfig {

	use SingletonTraits;

	public $base;
	public $path;

	public function __construct() {
		$this->base = 'fasheno';
		$this->path = get_template_directory() . '/plugin-bundle/';

		add_action( 'tgmpa_register', [ $this, 'register_required_plugins' ] );
	}

	public function register_required_plugins() {
		$plugins = [
			// Bundled
			[
				'name'     => 'Fasheno Core',
				'slug'     => 'fasheno-core',
				'source'   => 'fasheno-core.zip',
				'required' => true,
				'version'  => '1.0.4'
			],
			[
				'name'     => 'RT Framework',
				'slug'     => 'rt-framework',
				'source'   => 'rt-framework.zip',
				'required' => true,
				'version'  => '3.0.3'
			],
			[
				'name'          => esc_html__('ShopBuilder - Elementor WooCommerce Builder Addons','fasheno'),
				'slug'          => 'shopbuilder',
				'required'      => false,
			],
			[
				'name'         => 'ShopBuilder Pro',
				'slug'         => 'shopbuilder-pro',
				'source'       => 'shopbuilder-pro.zip',
				'required'     => true,
				'version'      => '2.1.5'
			],
			[
				'name'          => 'Variation Swatches for WooCommerce',
				'slug'          => 'woo-product-variation-swatches',
				'required'      => false,
			],
			[
				'name'         => 'WooCommerce Variation Swatches Pro',
				'slug'         => 'woo-product-variation-swatches-pro',
				'source'       => 'woo-product-variation-swatches-pro.zip',
				'required'     => false,
				'version'      => '2.2.9'
			],
			[
				'name'          => 'Variation Images Gallery for WooCommerce',
				'slug'          => 'woo-product-variation-gallery',
				'required'      => false,
			],
			[
				'name'         => 'WooCommerce Variation images gallery Pro',
				'slug'         => 'woo-product-variation-gallery-pro',
				'source'       => 'woo-product-variation-gallery-pro.zip',
				'required'     => false,
				'version'      => '2.3.12'
			],

			// Repository
			[
				'name'     => esc_html__('WooCommerce','fasheno'),
				'slug'     => 'woocommerce',
				'required' => false,
			],
			[
				'name'     => esc_html__('Elementor Page Builder','fasheno'),
				'slug'     => 'elementor',
				'required' => false,
			],
			[
				'name'     => esc_html__('WP Fluent Forms','fasheno'),
				'slug'     => 'fluentform',
				'required' => false,
			],
			[
				'name'     => esc_html__('Breadcrumb NavXT','fasheno'),
				'slug'     => 'breadcrumb-navxt',
				'required' => false,
			],
			[
				'name'     => esc_html__('One Click Demo Import','fasheno'),
				'slug'     => 'one-click-demo-import',
				'required' => false,
			],
		];

		$config = [
			'id'           => $this->base,
			'default_path' => $this->path,
			'menu'         => $this->base . '-install-plugins',
			'has_notices'  => true,
			'dismissable'  => true,
			'dismiss_msg'  => '',
			'is_automatic' => false,
			'message'      => '',
		];

		tgmpa( $plugins, $config );
	}
}
