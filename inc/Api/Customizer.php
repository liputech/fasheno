<?php
/**
 * Theme Customizer
 *
 * @package fasheno
 */

namespace RT\Fasheno\Api;

use RT\Fasheno\Api\Customizer\Pannels;
use RT\Fasheno\Traits\SingletonTraits;

/**
 * Customizer class
 */
class Customizer {
	use SingletonTraits;

	public $customizeClasses;
	public static $default_value = [];

	/**
	 * register default hooks and actions for WordPress
	 * @return
	 */
	public function __construct() {
		if ( defined( 'RT_FRAMEWORK_VERSION' ) ) {
			new Pannels();
			add_action( 'init', [ $this, 'register_controls' ], 99 );
		}
		add_action( 'init', [ $this, 'get_controls_default_value' ], 99 );
		add_action( 'init', [ $this, 'add_controls' ], 0 );
	}

	/**
	 * Add customize controls
	 * @return string[]
	 */
	public function add_controls() {
		$classess = [
			Customizer\Sections\General::class,
			Customizer\Sections\SiteIdentity::class,
			Customizer\Sections\HeaderTopbar::class,
			Customizer\Sections\Header::class,
			Customizer\Sections\HeaderMobile::class,
			Customizer\Sections\Banner::class,
			Customizer\Sections\TypographyBody::class,
			Customizer\Sections\TypographyHeading::class,
			Customizer\Sections\TypographyMenu::class,
			Customizer\Sections\Blog::class,
			Customizer\Sections\BlogSingle::class,
			Customizer\Sections\Contact::class,
			Customizer\Sections\Socials::class,
			Customizer\Sections\ColorSite::class,
			Customizer\Sections\ColorTopbar::class,
			Customizer\Sections\ColorHeader::class,
			Customizer\Sections\ColorBanner::class,
			Customizer\Sections\ColorFooter::class,
			Customizer\Sections\Labels::class,
			Customizer\Sections\LayoutsPage::class,
			Customizer\Sections\LayoutsBlogs::class,
			Customizer\Sections\LayoutsSingle::class,
			Customizer\Sections\LayoutsError::class,
			Customizer\Sections\Footer::class,
			Customizer\Sections\Error::class,
		];

		if ( class_exists( 'WooCommerce' ) ) {
			$classess[] = Customizer\Sections\WooArchiveSettings::class;
			$classess[] = Customizer\Sections\LayoutsWooSingle::class;
			$classess[] = Customizer\Sections\LayoutsWooArchive::class;
		}


		$this->customizeClasses = $classess;
	}

	/**
	 * Register all controls dynamically
	 *
	 * @param string $section_general
	 */
	public function register_controls() {
		foreach ( $this->customizeClasses as $class ) {
			$control = new $class();
			if ( method_exists( $control, 'register' ) ) {
				$control->register();
			}
		}
	}

	/**
	 * Get controls default value
	 * @return void
	 */
	public function get_controls_default_value() {
		foreach ( $this->customizeClasses as $class ) {
			$control = new $class();
			if ( method_exists( $control, 'get_controls' ) ) {
				$controls = $control->get_controls();
				foreach ( $controls as $id => $control ) {
					self::$default_value[ $id ] = $control['default'] ?? '';
				}
			}
		}

	}
}
