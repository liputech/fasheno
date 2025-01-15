<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
use RadiusTheme\SB\Helpers\Fns;
use RT\Fasheno\Plugins\WcFunctions;
global $product;
$product_id  = $product->get_id();
$cat        = WcFunctions::get_top_category_name();
$module_data = [
		'wc_shop_add_to_cart'    => fasheno_option('rt_woo_cart'),
		'wc_shop_quickview_icon' => fasheno_option( 'wc_shop_quickview_icon' ),
		'wc_shop_wishlist_icon'  => fasheno_option( 'wc_shop_wishlist_icon' ),
		'wc_shop_compare_icon'   => fasheno_option( 'wc_shop_compare_icon' ),
		'wc_shop_qcheckout_icon' => fasheno_option( 'wc_shop_qcheckout_icon' ),
];
$action_buttons = $module_data['wc_shop_add_to_cart'] ||  $module_data['wc_shop_wishlist_icon'] || $module_data['wc_shop_quickview_icon'] || $module_data['wc_shop_compare_icon'] || $module_data['wc_shop_qcheckout_icon'] ? true:false;
?>
<div class="rt-product-block rt-product-list">
	<div class="rt-product-thumb">
		<?php if ( fasheno_option( 'wc_shop_sale_flash' ) ) woocommerce_show_product_loop_sale_flash(); ?>
		<a href="<?php the_permalink();?>"><?php woocommerce_template_loop_product_thumbnail(); ?></a>
		<?php do_action('toyup_shop_layout_after_image'); ?>
		<?php do_action('toyup_shop_layout_before_cart_button'); ?>
		<div class="rt-shop-meta rtsb-action-buttons">
			<?php
			if ( fasheno_option('wc_woo_cart') ) WcFunctions::print_add_to_cart_icon( $product_id, true, true );
			$module_data = [
				'wc_shop_quickview_icon' => fasheno_option( 'wc_shop_quickview_icon' ),
				'wc_shop_wishlist_icon'  => fasheno_option( 'wc_shop_wishlist_icon' ),
				'wc_shop_compare_icon'   => fasheno_option( 'wc_shop_compare_icon' ),
				'wc_shop_qcheckout_icon' => fasheno_option( 'wc_shop_qcheckout_icon' ),
			];
			do_action('rdtheme_after_actions_button', $product, $module_data);
			?>
		</div>
		<?php do_action('toyup_shop_layout_after_cart_button'); ?>
	</div>
	<div class="rt-content-area">

		<?php if ( $cat ): ?>
			<?php fasheno_html( $cat, false );?>
		<?php endif; ?>

		<?php if ( fasheno_option('wc_shop_rating') == 1 ) { ?>
			<div class="rating-custom">
				<?php if( function_exists( 'rtsb' ) ){
					Fns::get_product_rating_html();
					$rating_count = $product->get_rating_count(); ?>
				<?php } else {
					wc_get_template( 'rating.php' );
				} ?>
			</div>
		<?php } ?>

		<h2 class="rt-shop-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>

		<div class="rt-excerpt"><?php the_excerpt();?></div>

		<?php if ( $price_html = $product->get_price_html() ) { ?>
			<div class="rt-price price"><?php fasheno_html( $price_html, false ); ?></div>
		<?php } ?>

		<?php if ( fasheno_option('rt_woo_variation_attr') ) { ?>
			<?php do_action('rtwpvs_show_archive_variation'); ?>
		<?php } ?>

	</div>
</div>
