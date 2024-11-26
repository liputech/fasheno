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
$_fullwidth = Opt::$header_width == 'full' ? '-fluid' : '';
?>

<div class="main-header-section mobile-header-section">
	<div class="header-container rt-container<?php echo esc_attr($_fullwidth) ?>">
		<div class="row navigation-menu-wrap align-middle m-0">
			<div class="site-branding">
				<?php echo fasheno_site_logo( $logo_h1 ); ?>
			</div><!-- .site-branding -->
			<?php if ( fasheno_option( 'rt_mobile_header_bar' ) ) { ?>
			<ul class="menu-icon-action"><?php fasheno_hanburger( 'mobile-hamburg' ); ?></ul>
			<?php } ?>
		</div><!-- .row -->
	</div><!-- .container -->
</div>

<?php get_template_part( 'views/header/offcanvas', 'drawer' ); ?>

<?php

