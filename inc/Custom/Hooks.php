<?php

namespace RT\Fasheno\Custom;

use RT\Fasheno\Helpers\Fns;
use RT\Fasheno\Traits\SingletonTraits;
use RT\Fasheno\Options\Opt;

/**
 * Extras.
 */
class Hooks {
	use SingletonTraits;

	/**
	 * register default hooks and actions for WordPress
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', [ __CLASS__, 'meta_css' ] );
		add_action( 'fasheno_before_single_content', [ __CLASS__, 'before_single_content' ] );
		add_action( 'wp_head', [ __CLASS__, 'wp_footer_hook' ] );

		add_action('bcn_after_fill', [ __CLASS__, 'fasheno_hseparator_breadcrumb_trail' ] );

	}

	public static function wp_footer_hook() {
		?>
		<style>
			.fasheno-header-footer .site-header {
				opacity: 1;
			}
		</style>

		<?php
	}

	/**
	 * Single post meta visibility
	 *
	 * @param $screen
	 *
	 * @return void
	 */
	public static function meta_css( $screen ) {
		if ( 'post.php' !== $screen ) {
			return;
		}
		global $typenow;
		$display = 'post' === $typenow ? 'table-row' : 'none';
		?>
		<style>
			.single_post_style {
				display: <?php echo esc_attr($display) ?>;
			}
		</style>
		<?php
	}

	public static function before_single_content() {
		$style = Opt::$single_style;

		if ( in_array( $style, [ '2', '3' ] ) ) {
			$classes = Fns::class_list( [
				'content-top-area',
				( $style == '2' ) ? 'container' : 'rt-container-fluid'
			] );
			?>

			<div class="<?php echo esc_attr( $classes ) ?>">
				<?php fasheno_post_single_thumbnail(); ?>
			</div>
			<?php
		}

	}
	// Update Breadcrumb Separator

	public static function fasheno_hseparator_breadcrumb_trail($object){
		$object->opt['hseparator'] = '<span class="dvdr"><i class="icon-rt-user-datalist-feature"></i></span>';
		return $object;
	}

}
