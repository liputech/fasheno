<?php
/**
 * Template part for displaying footer
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package fasheno
 */

$footer_width = 'container'.fasheno_option('rt_footer_width');
$copyright_center = fasheno_option('rt_footer_payment_display') ? 'justify-content-between' : 'justify-content-center';
?>

<?php if ( is_active_sidebar( 'rt-footer-sidebar' ) ) : ?>
	<div class="footer-widgets-wrapper">
		<div class="footer-container <?php echo esc_attr($footer_width) ?>">
			<div class="footer-widgets row">
				<?php dynamic_sidebar( 'rt-footer-sidebar' ); ?>
			</div>
		</div>
	</div><!-- .site-info -->
<?php endif; ?>

<?php if ( ! empty( fasheno_option( 'rt_footer_copyright' ) ) ) : ?>
	<div class="footer-copyright-wrapper">
		<div class="footer-container <?php echo esc_attr( $footer_width ) ?>">
			<div class="copyright-text-wrap d-flex align-items-center <?php echo esc_attr($copyright_center); ?>">
				<div class="copyright-text">
					<?php fasheno_html( str_replace( '[y]', date( 'Y' ), fasheno_option( 'rt_footer_copyright' ) ) ); ?>
				</div>
				<?php if( fasheno_option('rt_footer_payment_display') ) { ?>
					<div class="payment-cart d-flex gap-20 align-items-center">
						<?php if( fasheno_option('rt_footer_payment_display') ) { ?>
							<?php if ( ! empty( fasheno_option( 'rt_footer_payment_cart' ) ) ) {
								echo wp_get_attachment_image( fasheno_option( 'rt_footer_payment_cart' ), 'full', true );
							} else {
								fasheno_get_img( 'payment-cart.png', true, 'width="358" height="32" alt=""' );
							} ?>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php endif; ?>
