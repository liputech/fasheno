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
		<div id="preloader" class="rt-loader" data-text="<?php fasheno_html( fasheno_option('rt_preloader_text') , 'allow_title' );?>"><?php fasheno_html( fasheno_option('rt_preloader_text') , 'allow_title' );?></div>
	<?php }
}
?>

<!-- ajax search overlay -->
<div class="rt-focus"></div>

<?php fasheno_mobile_menu_icons_group(); ?>

<div id="page" class="site">
	<header id="masthead" class="site-header sticky-headroom headroom" role="banner">
		<div class="header-desktop">
			<?php get_template_part( 'views/header/topbar', Opt::$topbar_style ); ?>
			<?php get_template_part( 'views/header/header', Opt::$header_style ); ?>
		</div>
		<div class="header-mobile">
			<?php get_template_part( 'views/header/header', 'mobile' ); ?>
		</div>

	</header><!-- #masthead -->
	<div class="fixed-header-space"></div>

	<div id="header-search" class="header-search">
		<div class="header-search-wrap">
			<button type="button" aria-label="close button" class="close">×</button>
			<?php fasheno_product_mobile_ajax_search(); ?>
		</div>
	</div>

	<div id="content" class="site-content">
		<?php get_template_part( 'views/content-banner' ); ?>
