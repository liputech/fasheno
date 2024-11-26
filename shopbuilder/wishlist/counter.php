<?php

/**
 * Add to wishlist template
 *
 * @author  RadiusTheme
 * @package RTSB_ABSPATH\Templates\Wishlist\counter
 * @version 1.0.0
 */


/**
 * Template variables:
 *
 * @var $page_url                    string Wishlist page url
 * @var $item_count                  int Total number of product of wishlist
 */

defined( 'ABSPATH' ) || die( 'Keep Silent' );
?>
<a href="<?php echo esc_url( $page_url ); ?>" class="action-icon">
	<i class="icon-rt-heart"></i>
	<span class="wishlist-icon-num rtsb-wishlist-counter item-count"><?php echo esc_html( $item_count ); ?></span>
</a>
