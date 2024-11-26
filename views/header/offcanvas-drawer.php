<?php
/**
 * Template part for displaying header offcanvas
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package fasheno
 */
use RT\Fasheno\Options\Opt;
use RT\Fasheno\Helpers\Fns;
$logo_h1 = ! is_singular( [ 'post' ] );
$topinfo = ( fasheno_option( 'rt_contact_address' ) || fasheno_option( 'rt_phone' ) || fasheno_option( 'rt_email' ) || fasheno_option( 'rt_website' ) ) ? true : false;
?>

<div class="fasheno-offcanvas-drawer">
	<div class="offcanvas-drawer-wrap">

		<?php if ( fasheno_option( 'rt_mobile_header_ajax_search' ) ) { ?>
			<?php fasheno_product_ajax_search(); ?>
		<?php } ?>

		<?php if( fasheno_option( 'rt_about_label' ) || fasheno_option( 'rt_about_text' ) ) { ?>
		<div class="offcanvas-about offcanvas-address">
			<?php if( fasheno_option( 'rt_about_label' ) ) { ?><label><?php echo fasheno_option( 'rt_about_label' ) ?></label><?php } ?>
			<?php if( fasheno_option( 'rt_about_text' ) ) { ?><p><?php echo fasheno_option( 'rt_about_text' ) ?></p><?php } ?>
		</div>
		<?php } ?>
		<nav class="offcanvas-navigation" role="navigation">
			<?php
			if ( has_nav_menu( 'primary' ) ) :
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'walker'         => new RT\Fasheno\Core\WalkerNav(),
					)
				);
			endif;
			?>
		</nav><!-- .fasheno-navigation -->

		<?php if( fasheno_option( 'rt_mobile_delivery_button' ) || fasheno_option( 'rt_mobile_sale_offer_button' )) { ?>
		<div class="rt-button-action">
			<?php if ( fasheno_option( 'rt_mobile_delivery_button' ) ) { ?>
				<a class="rt-delivery-btn" href="<?php echo esc_url( fasheno_option( 'rt_get_delivery_button_url' ) ) ?>" aria-label="button link"><i class="icon-rt-user-1"></i><?php fasheno_html( fasheno_option( 'rt_get_delivery_label', 'allow_title' ) ); ?></a>
			<?php } if ( fasheno_option( 'rt_mobile_sale_offer_button' ) ) { ?>
				<a class="rt-sale-offer-btn" href="<?php echo esc_url( fasheno_option( 'rt_get_sale_offer_button_url' ) ) ?>" aria-label="button link"><i class="icon-rt-percentage"></i><?php fasheno_html( fasheno_option( 'rt_get_sale_offer_label', 'allow_title' ) ); ?></a>
			<?php } ?>
		</div>
		<?php } ?>

		<?php if( fasheno_option( 'rt_mobile_header_info' ) || fasheno_option( 'rt_mobile_social' )) { ?>
		<div class="offcanvas-address">
			<?php if( $topinfo &&  fasheno_option( 'rt_mobile_header_info' )) { ?>
				<?php if( fasheno_option( 'rt_contact_info_label' ) ) { ?><label><?php echo fasheno_option( 'rt_contact_info_label' ) ?></label><?php } ?>
				<ul class="offcanvas-info">
					<?php if( fasheno_option( 'rt_contact_address' ) ) { ?>
						<li><i class="icon-rt-location-4"></i><?php fasheno_html( fasheno_option( 'rt_contact_address' ) , false );?> </li>
					<?php } if( fasheno_option( 'rt_phone' ) ) { ?>
						<li><i class="icon-rt-phone-2"></i><a href="tel:<?php echo esc_attr( fasheno_option( 'rt_phone' ) );?>"><?php fasheno_html( fasheno_option( 'rt_phone' ) , false );?></a> </li>
					<?php } if( fasheno_option( 'rt_email' ) ) { ?>
						<li><i class="icon-rt-email"></i><a href="mailto:<?php echo esc_attr( fasheno_option( 'rt_email' ) );?>"><?php fasheno_html( fasheno_option( 'rt_email' ) , false );?></a> </li>
					<?php } if( fasheno_option( 'rt_website' ) ) { ?>
						<li><i class="icon-rt-development-service"></i><?php fasheno_html( fasheno_option( 'rt_website' ) , false );?></li>
					<?php } ?>
				</ul>
			<?php } ?>

			<?php if( fasheno_option( 'rt_mobile_social' ) ) { ?>
				<div class="offcanvas-social-icon">
					<?php if( fasheno_option( 'rt_follow_us_label' ) ) { ?><label><?php echo fasheno_option( 'rt_follow_us_label' ) ?></label><?php } ?>
					<?php fasheno_get_social_html( '#555' ); ?>
				</div>
			<?php } ?>
		</div>
		<?php } ?>
	</div>
</div><!-- .container -->


<div class="fasheno-body-overlay"></div>
