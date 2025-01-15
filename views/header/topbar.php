<?php
/**
 * Template part for displaying header
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package fasheno
 */

use RadiusTheme\SB\Helpers\Fns;
use RT\Fasheno\Options\Opt;

if(! Opt::$has_top_bar ) {
	return;
}
$top_info_left = ( fasheno_option( 'rt_top_bar_address' ) || fasheno_option( 'rt_top_bar_phone' ) || fasheno_option( 'rt_top_bar_email' ) || fasheno_option( 'rt_top_bar_website' ) ) ? true : false;
$_fullwidth = Opt::$header_width == 'full' ? '-fluid' : '';

$top_info_right = ( fasheno_option( 'rt_top_bar_menu' ) || fasheno_option( 'rt_top_bar_social' ) || fasheno_option( 'rt_top_bar_currency' ) ) ? true : false;
$_fullwidth = Opt::$header_width == 'full' ? '-fluid' : '';

?>

<div class="fasheno-top-bar top-bar-style-1">
	<div class="top-bar-container rt-container<?php echo esc_attr($_fullwidth) ?>">
		<div class="top-bar-row d-flex flex-wrap column-gap-30 align-items-center">
			<?php if( $top_info_left ) { ?>
			<ul class="top-bar-left d-flex flex-wrap column-gap-30 align-items-center">
				<?php if( fasheno_option( 'rt_top_bar_address' ) && fasheno_option( 'rt_contact_address' )  ) { ?>
					<li><?php fasheno_html( fasheno_option( 'rt_contact_address' ) , 'allow_title' );?></li>
				<?php } if( fasheno_option( 'rt_top_bar_phone' ) && fasheno_option( 'rt_phone' ) ) { ?>
					<li><a href="tel:<?php echo esc_attr( fasheno_option( 'rt_phone' ) );?>"><?php fasheno_html( fasheno_option( 'rt_phone' ) , 'allow_title' );?></a></li>
				<?php } if( fasheno_option( 'rt_top_bar_email' ) && fasheno_option( 'rt_email' ) ) { ?>
					<li><a href="mailto:<?php echo esc_attr( fasheno_option( 'rt_email' ) );?>"><?php fasheno_html( fasheno_option( 'rt_email' ) , 'allow_title' );?></a></li>
				<?php } if( fasheno_option( 'rt_top_bar_website' ) && fasheno_option( 'rt_website' ) ) { ?>
					<li><?php fasheno_html( fasheno_option( 'rt_website' ) , 'allow_title' );?></li>
				<?php } ?>
			</ul>
			<?php } ?>

			<?php if( $top_info_right ) { ?>
			<div class="top-bar-right d-flex align-items-center">
				<?php if( fasheno_option( 'rt_top_bar_menu' ) ) { ?>
					<div class="top-bar-navigation" role="navigation">
						<?php
						wp_nav_menu( [
							'theme_location' => 'topBar',
							'menu_class'     => 'top-bar-menu',
							'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
							'fallback_cb'    => 'fasheno_custom_menu_cb',
						] );
						?>
					</div>
				<?php } if( fasheno_option( 'rt_top_bar_social' ) ) { ?>
					<div class="social-icon">
						<?php if( fasheno_option( 'rt_follow_us_label' ) ) { ?><label><?php echo fasheno_option( 'rt_follow_us_label' ) ?></label><?php } ?>
						<?php fasheno_get_social_html( '#555' ); ?>
					</div>
				<?php } if( fasheno_option( 'rt_top_bar_currency' ) && Fns::is_module_active( 'currency_switcher' ) ) { ?>
					<?php echo do_shortcode('[currency_switcher]')  ?>
				<?php } ?>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
