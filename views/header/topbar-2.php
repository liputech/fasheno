<?php
/**
 * Template part for displaying header
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package fasheno
 */

use RT\Fasheno\Options\Opt;

if(! Opt::$has_top_bar ) {
	return;
}
$top_info_left = ( fasheno_option( 'rt_top_bar_address' ) || fasheno_option( 'rt_top_bar_phone' ) || fasheno_option( 'rt_top_bar_email' ) || fasheno_option( 'rt_top_bar_website' ) ) ? true : false;
$_fullwidth = Opt::$header_width == 'full' ? '-fluid' : '';

?>

<div class="fasheno-top-bar top-bar-style-2">
	<button type="button" aria-label="close button" class="close">×</button>
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
		</div>
	</div>
</div>
