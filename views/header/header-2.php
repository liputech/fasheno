<?php
/**
 * Template part for displaying header
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package fasheno
 */

use RT\Fasheno\Options\Opt;

$logo_h1 = ! is_singular( [ 'post' ] );
$menu_classes = fasheno_option( 'rt_menu_alignment' );
$_fullwidth = Opt::$header_width == 'full' ? '-fluid' : '';

$menu_classes = '';

if ( fasheno_option( 'rt_header_separator' ) ) {
	$menu_classes .= 'has-separator ';
}

?>

<div class="main-header-section header-top">
	<div class="header-container rt-container<?php echo esc_attr($_fullwidth) ?>">
		<div class="row navigation-menu-wrap align-middle m-0">
			<div class="site-branding">
				<?php echo fasheno_site_logo( $logo_h1 ); ?>
			</div><!-- .site-branding -->

			<?php if ( fasheno_option( 'rt_header_search' ) ) { ?>
				<?php fasheno_product_ajax_search(); ?>
			<?php } ?>

			<div class="menu-icon-wrapper">
				<?php if ( fasheno_option( 'rt_header_phone' ) ) { ?>
					<div class="phone-wrap">
						<div class="info-icon phone-icon">
							<i class="icon-rt-phone-call"></i>
						</div>
						<div class="info-text phone-no">
							<span class="phone-label"><?php fasheno_html( fasheno_option('rt_get_phone_label') , 'allow_title' );?></span><a href="tel:<?php echo esc_attr( fasheno_option('rt_phone') );?>"><?php fasheno_html( fasheno_option('rt_phone') , 'allow_title' );?></a>
						</div>
					</div>
				<?php } ?>
				<ul class="menu-icon-action <?php echo esc_attr( $menu_classes ) ?>">
					<?php if ( fasheno_option( 'rt_header_compare' ) && class_exists( 'WooCommerce' ) && function_exists('rtsb')){ ?>
						<li class="item-icon header-compare-icon">
							<?php if ( shortcode_exists( 'rtsb_compare_counter' ) ) {
								echo do_shortcode('[rtsb_compare_counter]'); ?>
								<span class="item-icon-text"><?php echo esc_html( fasheno_option( 'rt_get_compare_label' ) ) ?></span>
							<?php } ?>
						</li>
					<?php } if ( fasheno_option( 'rt_header_wishlist' ) && class_exists( 'WooCommerce' ) && function_exists('rtsb')){ ?>
						<li class="item-icon header-wishlist-icon">
							<?php if ( shortcode_exists( 'rtsb_wishlist_counter' ) ) {
								echo do_shortcode('[rtsb_wishlist_counter]'); ?>
								<span class="item-icon-text"><?php fasheno_html( fasheno_option( 'rt_get_wishlist_label', 'allow_title' ) ) ?></span>
							<?php } ?>
						</li>
					<?php } if ( fasheno_option( 'rt_header_add_to_cart' ) && class_exists( 'WooCommerce' ) && function_exists('rtsb')){ ?>
						<li class="item-icon rt-cart-float-inner rtsb-cart-float-menu">
							<span class="rt-cart-icon action-icon">
								<i class="icon-rt-cart-2"></i>
								<span class="rtsb-cart-icon-num"></span>
							</span>
							<span class="item-icon-text"><?php fasheno_html( fasheno_option( 'rt_get_cart_label', 'allow_title' ) ) ?></span>
						</li>
					<?php } if ( fasheno_option( 'rt_header_login' ) ) { ?>
						<li class="rt-user-login">
							<a  class="action-icon" href="<?php echo esc_url( fasheno_option( 'rt_header_login_link' ) ) ?>" aria-label="user login">
								<i class="icon-rt-user-2"></i>
							</a>
							<span class="item-icon-text"><?php fasheno_html( fasheno_option( 'rt_get_login_label', 'allow_title' ) ) ?></span>
						</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div><!-- .container -->
</div>

<div class="main-header-section header-bottom mega-menu-left">
	<div class="header-container rt-container<?php echo esc_attr($_fullwidth) ?>">
		<div class="row navigation-menu-wrap align-middle m-0">
			<nav class="fasheno-navigation <?php echo esc_attr( $menu_classes ) ?>" role="navigation">
				<?php
				wp_nav_menu( [
					'theme_location' => 'primary',
					'menu_class'     => 'fasheno-navbar',
					'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
					'fallback_cb'    => 'fasheno_custom_menu_cb',
					'walker'         => has_nav_menu( 'primary' ) ? new RT\Fasheno\Core\WalkerNav() : '',
				] );
				?>
			</nav><!-- .fasheno-navigation -->
			<div class="rt-button-action">
				<?php if ( fasheno_option( 'rt_get_delivery_button' ) ) { ?>
					<a class="rt-delivery-btn" href="<?php echo esc_url( fasheno_option( 'rt_get_delivery_button_url' ) ) ?>" aria-label="button link"><i class="icon-rt-truck"></i><?php fasheno_html( fasheno_option( 'rt_get_delivery_label', 'allow_title' ) ); ?></a>
				<?php } if ( fasheno_option( 'rt_get_sale_offer_button' ) ) { ?>
					<a class="rt-sale-offer-btn" href="<?php echo esc_url( fasheno_option( 'rt_get_sale_offer_button_url' ) ) ?>" aria-label="button link"><i class="icon-rt-percentage"></i><?php fasheno_html( fasheno_option( 'rt_get_sale_offer_label', 'allow_title' ) ); ?></a>
				<?php } ?>
			</div>
		</div><!-- .row -->
	</div><!-- .container -->
</div>
<?php

