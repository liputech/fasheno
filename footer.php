<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package fasheno
 */

use RT\Fasheno\Options\Opt;
use RT\Fasheno\Helpers\Fns;

$classes = Fns::class_list([
	'site-footer',
	Opt::$footer_schema
]);
?>
		</div><!-- #content -->
		<?php if( fasheno_option('rt_footer_display') ) { ?>
			<footer class="<?php echo esc_attr($classes); ?>" role="contentinfo">
				<?php get_template_part( 'views/footer/footer', Opt::$footer_style ); ?>
			</footer><!-- #colophon -->
		<?php } ?>
		</div><!-- #page -->

		<?php fasheno_rtl_mode_icons(); ?>

		<?php fasheno_color_mode_icons(); ?>

		<?php fasheno_scroll_top(); ?>

		<?php wp_footer(); ?>

	</body>
</html>
