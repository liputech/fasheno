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
?>

<div class="main-header-section">
	<div class="header-container rt-container<?php echo esc_attr($_fullwidth) ?>">
		<div class="row navigation-menu-wrap align-middle m-0">
			<div class="site-branding">
				<?php echo fasheno_site_logo( $logo_h1 ); ?>
			</div><!-- .site-branding -->
			<nav class="fasheno-navigation pl-15 pr-15 <?php echo esc_attr( $menu_classes ) ?>" role="navigation">
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
			<?php fasheno_menu_icons_group(); ?>
		</div><!-- .row -->
	</div><!-- .container -->
</div>
<?php

