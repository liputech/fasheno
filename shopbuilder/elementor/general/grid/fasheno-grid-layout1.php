<?php
/**
 * Template: Grid Layout 4.
 *
 * @package RadiusTheme\SB
 */

/**
 * Template variables:
 *
 * @var $grid                    string
 * @var $class                   string
 * @var $p_id                    int
 * @var $img_args                array
 * @var $p_link                  string
 * @var $items                   array
 * @var $rating_args             array
 * @var $add_to_cart             string
 * @var $title_tag               string
 * @var $excerpt_limit           string
 * @var $excerpt                 string
 * @var $title_class             string
 * @var $title_link              bool
 * @var $title                   string
 * @var $badge_class             string
 * @var $action_btn_preset       string
 * @var $action_btn_position     string
 * @var $swatch_type             string
 * @var $raw_settings            array
 */

use RadiusTheme\SB\Helpers\Fns;
use RT\Fasheno\Plugins\WcFunctions;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

global $product;

$classes             = esc_attr( $grid ) . ' ' . esc_attr( $class );
$add_cart_text_class = $raw_settings['show_cart_text'] ? 'has-cart-text' : 'no-cart-text';
?>

<div <?php wc_product_class( $classes, $product ); ?> data-id="<?php echo absint( $p_id ); ?>">
	<?php
	/**
	 * Before product items hook.
	 */
	do_action( 'rtsb/before/shop/product/item' );
	?>

	<div class="rtsb-grid-item">
		<div class="rtsb-product-img">
			<?php
			/**
			 * Before product image hook.
			 */
			do_action( 'rtsb/before/shop/product/image' );

			/**
			 * Product image hook.
			 *
			 * @hooked RadiusTheme\SB\Controllers\Hooks\ActionHooks::render_image 10
			 */
			do_action( 'rtsb/shop/product/image', $img_args, $raw_settings );

			/**
			 * Sale Badge.
			 */
			if ( ! empty( $p_sale ) ) {
				?>
				<div class="rtsb-promotion">
					<?php
					Fns::get_badge_html( $p_sale, $badge_class );
					?>
				</div>
				<?php
			}

			/**
			 * Action buttons after content.
			 */
			Fns::print_html( Fns::get_formatted_action_buttons( $items, '', 'preset6', $action_btn_position ) );

			/**
			 * After product image hook.
			 */
			do_action( 'rtsb/after/shop/product/image', $raw_settings );
			?>
		</div><!-- .rtsb-product-img -->

		<div class="rtsb-product-content">
			<div class="rtsb-content-top">
				<?php
				/**
				 * Before product content hook.
				 */
				do_action( 'rtsb/before/shop/product/content' );

				/**
				 * Product Categories.
				 */
				if ( in_array( 'categories', $items, true ) ) {
					?>
					<div class="rtsb-product-category">
						<?php
						Fns::get_categories_list( $p_id );
						?>
					</div>
					<?php
				}

				/**
				 * Product Rating.
				 */
				if ( in_array( 'rating', $items, true ) ) {
					WcFunctions::fasheno_get_product_rating_html( $rating_args );
				}

				/**
				 * Before product title hook.
				 */
				do_action( 'rtsb/before/shop/product/title' );

				/**
				 * Product Title.
				 */
				if ( in_array( 'title', $items, true ) ) {
				?>
				<div class="rtsb-product-title-wrapper">
					<<?php Fns::print_validated_html_tag( $title_tag ); ?> class="<?php echo esc_attr( $title_class ); ?>">
					<?php
					if ( $title_link ) {
						?>
						<a class="woocommerce-LoopProduct-link" href="<?php echo esc_url( $p_link ); ?>"><?php Fns::print_html( $title ); ?></a>
						<?php
					} else {
						Fns::print_html( $title );
					}
					?>
				</<?php Fns::print_validated_html_tag( $title_tag ); ?>>
			</div>
			<?php
			}

			/**
			 * After product title hook.
			 */
			do_action( 'rtsb/after/shop/product/title' );

			/**
			 * Product Short Description.
			 */
			if ( in_array( 'excerpt', $items, true ) ) {
				?>
				<div class="product-short-description rtsb-text-limit limit-<?php echo esc_attr( $excerpt_limit ); ?>">
					<?php
					Fns::print_html( $excerpt );
					?>
				</div>
				<?php
			}
			?>
		</div>
		<div class="rtsb-content-footer <?php echo esc_attr( $add_cart_text_class ); ?>">
			<div class="content-footer-inner">
				<?php

				/**
				 * Product Price.
				 */
				if ( in_array( 'price', $items, true ) ) {
					?>
					<div class="product-price rtsb-item-space-between">
						<div class="price-wrapper">
							<?php
							woocommerce_template_single_price();
							?>
						</div>
					</div>
					<?php
				}
				?>
			</div>

			<?php
			/**
			* Product Swatches.
			*/
			if ( in_array( 'swatches', $items, true ) ) {
			Fns::get_product_swatches( $swatch_type );
			}

			?>

			<div class="rtsb-action-buttons content-bottom-part preset-6">
				<ul class="rtsb-action-button-list">
					<?php
					Fns::print_html( Fns::get_action_button_by_type( $items, 'add_to_cart', $add_to_cart ) );
					Fns::print_html( Fns::get_action_button_by_type( $items, 'quick_checkout', '', 'li' ) );
					?>
				</ul>
			</div>
		</div>


		<?php
		/**
		 * After product content hook.
		 */
		do_action( 'rtsb/after/shop/product/content', $raw_settings );
		?>
	</div><!-- .rtsb-product-content -->
</div><!-- .rtsb-grid-item -->
<?php
/**
 * After product item hook.
 */
do_action( 'rtsb/after/shop/product/item' );
?>
</div><!-- .rtsb-product -->
