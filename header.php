<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package fasheno
 */
use RT\Fasheno\Options\Opt;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- preloader -->
<?php if ( fasheno_option( 'rt_preloader' ) ) {
	if( !empty( fasheno_option( 'rt_preloader_logo' ) ) ) { ?>
		<div id="preloader"><?php echo wp_get_attachment_image( fasheno_option( 'rt_preloader_logo' ), 'full', true );?></div>
	<?php } else { ?>
		<div id="preloader" class="loader">
			<div class="cssload-loader">
				<div class="cssload-inner cssload-one"></div>
				<div class="cssload-inner cssload-two"></div>
				<div class="cssload-inner cssload-three"></div>
			</div>
		</div>
	<?php }
}
?>

<!-- ajax search overlay -->
<div class="rt-focus"></div>

<div class="mobile-action-button"><?php fasheno_mobile_menu_icons_group(); ?></div>

<div id="page" class="site">
	<header id="masthead" class="site-header headroom" role="banner">
		<div class="header-desktop">
			<?php get_template_part( 'views/header/topbar', Opt::$topbar_style ); ?>
			<?php get_template_part( 'views/header/header', Opt::$header_style ); ?>
		</div>
		<div class="header-mobile">
			<?php get_template_part( 'views/header/header', 'mobile' ); ?>
		</div>
	</header><!-- #masthead -->

	<div id="header-search" class="header-search">
		<div class="header-search-wrap">
			<button type="button" aria-label="close button" class="close">×</button>
			<form method="get" class="header-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<input type="search" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php esc_attr_e( 'Type your search........', 'fasheno' ); ?>">
				<button type="submit" aria-label="submit button" class="search-btn"><i class="icon-rt-search"></i></button>
			</form>
		</div>
	</div>

	<div id="content" class="site-content">
		<?php get_template_part( 'views/content-banner' ); ?>
