<?php
/**
 * Helpers methods
 * List all your static functions you wish to use globally on your theme
 *
 * @package fasheno
 */

use RT\Fasheno\Options\Opt;
use RT\Fasheno\Helpers\Fns;
use RT\Fasheno\Modules\PostShare;

/*Allow HTML for the kses post*/
function fasheno_html( $html, $context = '' ) {

	if ( 'social' === $context ) {
		$tags = [
			'a' => [ 'href' => [] ],
			'b' => []
		];
	} elseif ( 'allow_link' === $context ) {
		$tags = [
			'a'   => [
				'class'  => [],
				'href'   => [],
				'rel'    => [],
				'title'  => [],
				'target' => [],
			],
			'img' => [
				'alt'    => [],
				'class'  => [],
				'height' => [],
				'src'    => [],
				'srcset' => [],
				'width'  => [],
				'style' => [],
			],
			'b'   => []
		];
	} elseif ( 'allow_title' === $context ) {
		$tags = [
			'a'    => [
				'class'  => [],
				'href'   => [],
				'rel'    => [],
				'title'  => [],
				'target' => [],
			],
			'br'         => [],
			'p'         => [],
			'span' => [
				'class' => [],
				'style' => [],
			],
			'img' => [
				'alt'    => [],
				'class'  => [],
				'src'    => [],
				'srcset' => [],
				'height' => [],
				'width'  => [],
				'style'  => [],
			],
			'b'    => [],
			'strong'    => [],
		];
	} else {
		$tags = [
			'a'          => [
				'class'  => [],
				'href'   => [],
				'rel'    => [],
				'title'  => [],
				'target' => [],
			],
			'abbr'       => [
				'title' => [],
			],
			'b'          => [],
			'br'         => [],
			'sub'        => [],
			'blockquote' => [
				'cite' => [],
			],
			'cite'       => [
				'title' => [],
			],
			'code'       => [],
			'del'        => [
				'datetime' => [],
				'title'    => [],
			],
			'dd'         => [],
			'div'        => [
				'class' => [],
				'title' => [],
				'style' => [],
				'id'    => [],
			],
			'dl'         => [],
			'dt'         => [],
			'em'         => [],
			'h1'         => [
				'class' => [],
				'title' => [],
				'style' => [],
				'id'    => [],
			],
			'h2'         => [
				'class' => [],
				'title' => [],
				'style' => [],
				'id'    => [],
			],
			'h3'         => [
				'class' => [],
				'title' => [],
				'style' => [],
				'id'    => [],
			],
			'h4'         => [
				'class' => [],
				'title' => [],
				'style' => [],
				'id'    => [],
			],
			'h5'         => [
				'class' => [],
				'title' => [],
				'style' => [],
				'id'    => [],
			],
			'h6'         => [
				'class' => [],
				'title' => [],
				'style' => [],
				'id'    => [],
			],
			'i'          => [
				'class'  => [],
			],
			'img'        => [
				'alt'    => [],
				'class'  => [],
				'height' => [],
				'src'    => [],
				'srcset' => [],
				'width'  => [],
				'style'  => [],

			],
			'ul'         => [
				'class' => [],
			],
			'ol'         => [
				'class' => [],
			],
			'li'         => [
				'class' => [],
			],
			'p'          => [
				'class' => [],
			],
			'q'          => [
				'cite'  => [],
				'title' => [],
			],
			'span'       => [
				'class' => [],
				'title' => [],
				'style' => [],
			],
			'strike'     => [],
			'strong'     => [],
			'iframe' => [
				'class'                 => [],
				'id'                    => [],
				'name'                  => [],
				'src'                   => [],
				'title'                 => [],
				'frameBorder'           => [],
				'width'                 => [],
				'height'                => [],
				'scrolling'             => [],
				'allowvr'               => [],
				'allow'                 => [],
				'allowFullScreen'       => [],
				'webkitallowfullscreen' => [],
				'mozallowfullscreen'    => [],
				'loading'               => [],
			],
		];
	}

	echo wp_kses( $html, $tags );

}


if ( ! function_exists( 'fasheno_custom_menu_cb' ) ) {
	/**
	 * Callback function for the main menu
	 *
	 * @param $args
	 *
	 * @return string|void
	 */
	function fasheno_custom_menu_cb( $args ) {
		extract( $args );
		$add_menu_link = admin_url( 'nav-menus.php' );
		$menu_text     = sprintf( __( "Add %s Menu", "fasheno" ), $theme_location );
		__( 'Add a menu', 'fasheno' );
		if ( ! current_user_can( 'manage_options' ) ) {
			$add_menu_link = home_url();
			$menu_text     = __( 'Home', 'fasheno' );
		}

		// see wp-includes/nav-menu-template.php for available arguments

		$link = $link_before . '<a href="' . $add_menu_link . '">' . $before . $menu_text . $after . '</a>' . $link_after;

		// We have a list
		if ( false !== stripos( $items_wrap, '<ul' ) || false !== stripos( $items_wrap, '<ol' ) ) {
			$link = "<li>$link</li>";
		}

		$output = sprintf( $items_wrap, $menu_id, $menu_class, $link );
		if ( ! empty ( $container ) ) {
			$output = "<$container class='$container_class' id='$container_id'>$output</$container>";
		}

		if ( $echo ) {
			echo wp_kses_post( $output );
		}

		return $output;
	}
}

if ( ! function_exists( 'fasheno_menu_icons_group' ) ) {
	/**
	 * Get menu icon group
	 * @return void
	 */
	function fasheno_menu_icons_group( $args = [] ) {
		$default_args = [
			'search'        => fasheno_option( 'rt_header_search' ),
			'login'         => fasheno_option( 'rt_header_login' ),
			'login_link'    => fasheno_option( 'rt_header_login_link' ),
			'button_link'   => fasheno_option( 'rt_get_delivery_button_url' ),
			'has_separator' => fasheno_option( 'rt_header_separator' ),
			'compare'    	=> fasheno_option( 'rt_header_compare' ),
			'wishlist'    	=> fasheno_option( 'rt_header_wishlist' ),
			'add_to_cart' 	=> fasheno_option( 'rt_header_add_to_cart' )
		];
		$args         = wp_parse_args( $args, $default_args );
		$menu_classes = '';

		if ( $args['has_separator'] ) {
			$menu_classes .= 'has-separator ';
		}

		?>
		<div class="menu-icon-wrapper ml-auto">
			<ul class="menu-icon-action <?php echo esc_attr( $menu_classes ) ?>">
				<?php if ( $args['search'] ) { ?>
					<li class="rt-search-popup">
						<a class="action-icon menu-search-bar rt-search-trigger" href="#header-search" aria-label="search popup"><i class="icon-rt-search-1"></i></a>
					</li>
				<?php } if ($args['compare'] && class_exists( 'WooCommerce' ) && function_exists('rtsb')) { ?>
					<li class="item-icon header-compare-icon">
						<?php if ( shortcode_exists( 'rtsb_compare_counter' ) ) {
							echo do_shortcode('[rtsb_compare_counter]');
						} ?>
					</li>
				<?php } if ($args['wishlist'] && class_exists( 'WooCommerce' ) && function_exists('rtsb')) { ?>
					<li class="item-icon header-wishlist-icon">
						<?php if ( shortcode_exists( 'rtsb_wishlist_counter' ) ) {
							echo do_shortcode('[rtsb_wishlist_counter]');
						} ?>
					</li>
				<?php } if ($args['add_to_cart'] && class_exists( 'WooCommerce' ) && function_exists('rtsb')) { ?>
					<li class="item-icon rt-cart-float-inner rtsb-cart-float-menu">
						<span class="rt-cart-icon action-icon">
							<i class="icon-rt-cart"></i>
							<span class="rtsb-cart-icon-num"></span>
						</span>
					</li>
				<?php } if ( $args['login'] ) { ?>
					<li class="rt-user-login rt-button">
						<a  class="action-icon" href="<?php echo esc_url( $args['login_link'] ) ?>" aria-label="user login">
							<i class="icon-rt-user-1"></i>
						</a>
					</li>
				<?php } ?>
			</ul>
		</div>
		<?php
	}
}

if ( ! function_exists( 'fasheno_mobile_menu_icons_group' ) ) {
	/**
	 * Get mobile menu icon group
	 * @return void
	 */
	function fasheno_mobile_menu_icons_group( $args = [] ) {
		$default_args = [
			'search'        => fasheno_option( 'rt_mobile_header_search' ),
			'login'         => fasheno_option( 'rt_mobile_header_login' ),
			'login_link'    => fasheno_option( 'rt_mobile_header_login_link' ),
			'button'        => fasheno_option( 'rt_mobile_get_delivery_button' ),
			'button_label'  => fasheno_option( 'rt_mobile_get_delivery_label' ),
			'button_link'   => fasheno_option( 'rt_mobile_get_delivery_button_url' ),
			'compare'    	=> fasheno_option( 'rt_mobile_header_compare' ),
			'wishlist'    	=> fasheno_option( 'rt_mobile_header_wishlist' ),
			'add_to_cart' 	=> fasheno_option( 'rt_mobile_header_add_to_cart' )
		];
		$args         = wp_parse_args( $args, $default_args );
		$has_button   = $args['button'] && $args['button_label'];

		?>
		<div class="menu-icon-wrapper">
			<ul class="menu-icon-action">
				<?php if ( $args['search'] ) { ?>
					<li class="rt-search-popup">
						<a class="action-icon menu-search-bar rt-search-trigger" href="#header-search" aria-label="search popup"><i class="icon-rt-search-1"></i></a>
					</li>
				<?php } if ( $args['login'] ) { ?>
					<li class="rt-user-login rt-button">
						<a  class="action-icon" href="<?php echo esc_url( $args['login_link'] ) ?>" aria-label="user login">
							<i class="icon-rt-user-1"></i>
						</a>
					</li>
				<?php } if ($args['compare'] && class_exists( 'WooCommerce' ) && function_exists('rtsb')) { ?>
					<li class="item-icon header-compare-icon">
						<?php if ( shortcode_exists( 'rtsb_compare_counter' ) ) {
							echo do_shortcode('[rtsb_compare_counter]');
						} ?>
					</li>
				<?php } if ($args['wishlist'] && class_exists( 'WooCommerce' ) && function_exists('rtsb')) { ?>
					<li class="item-icon header-wishlist-icon">
						<?php if ( shortcode_exists( 'rtsb_wishlist_counter' ) ) {
							echo do_shortcode('[rtsb_wishlist_counter]');
						} ?>
					</li>
				<?php } if ($args['add_to_cart'] && class_exists( 'WooCommerce' ) && function_exists('rtsb')) { ?>
					<li class="item-icon rt-cart-float-inner rtsb-cart-float-menu">
						<span class="rt-cart-icon action-icon">
							<i class="icon-rt-cart"></i>
							<span class="rtsb-cart-icon-num"></span>
						</span>
					</li>
				<?php } ?>
			</ul>
		</div>
		<?php
	}
}

if ( ! function_exists( 'fasheno_color_mode_icons' ) ) {
	/**
	 * Get menu color mode icon
	 * @return void
	 */
	function fasheno_color_mode_icons() {
		if ( fasheno_option( 'rt_color_mode' ) ) {
		?>
		<div class="header-switch header-switch-wrapper">
			<label class="header-switch-label" for="headerSwitchCheckbox">
				<input class="header-switch-input" type="checkbox" name="headerSwitchCheckbox" id="headerSwitchCheckbox">
				<i class="icon-rt-heart"></i>
			</label>
		</div>
	<?php } }
}


if ( ! function_exists( 'fasheno_product_ajax_search' ) ) {
	/**
	 * product ajax search
	 * @return void
	 */

	function fasheno_product_ajax_search() {
		$category_dropdown = array();
		if (taxonomy_exists('product_cat')) {
			$terms = get_terms( array( 'taxonomy' => 'product_cat', 'parent' => 0 ) );
			foreach ( $terms as $term) {
				$category_dropdown[$term->slug] = array(
					'name' => $term->name,
				);
			}
		}
		$search      = isset( $_GET['s'] ) ? $_GET['s'] : '';
		$product_cat = isset( $_GET['product_cat'] ) ? $_GET['product_cat'] : '';

		$all_label = $label = esc_html__( 'Select Category', 'fasheno' );
		if ( isset( $_GET['product_cat'] ) ) {
			$pcat = $_GET['product_cat'];
			if ( isset( $category_dropdown[$pcat] ) ) {
				$label = $category_dropdown[$pcat]['name'];
			}
		}
		?>
		<div class="rt-search-box-wrap flex-grow-1 product-search">
			<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<div class="category-search-dropdown-js">
					<ul class="rt-action-list d-flex align-items-center">
						<li class="item rt-cat-drop cat-drop">
							<div class="dropdown">
								<input type="hidden" name="product_cat" value="<?php echo esc_attr( $product_cat );?>">
								<div class="cat-btn-wrap">
									<button class="rt-btn cat-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
										<span class="cat-label"><?php echo esc_html( $label );?></span>
										<span class="icon"><i class="down-arrow icon-rt-filter"></i></span>
									</button>
									<ul class="dropdown-menu rt-drop-menu" aria-labelledby="dropdownMenuButton1">
										<li data-slug=""><?php echo esc_html( $all_label );?></li>
										<?php
										foreach ( $category_dropdown as $slug => $cat ) {
											printf( '<li data-slug="%s"><span>%s</span></li>', $slug, $cat['name'] );
										}
										?>
									</ul>
								</div>
							</div>
						</li>
						<li class="item rt-advanced-search flex-grow-1">
							<div class="rt-input-group">
								<input type="text" autocomplete="off" name="s" class="form-control product-search-form product-autocomplete-js" placeholder="<?php esc_attr_e( 'Type Your Products ...', 'fasheno' );?>" value="<?php echo esc_attr( $search );?>">
								<div class="input-group-append">
									<input type="hidden" name="post_type" value="product">
									<button class="search-btn" aria-label="button"><i class="icon-rt-search-1"></i></button>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</form>
			<div class="result"></div>
		</div>
	<?php }
}

if ( ! function_exists( 'fasheno_require' ) ) {
	/**
	 * Require any file. If the file will available in the child theme, the file will load from the child theme
	 *
	 * @param $filename
	 * @param string $dir
	 *
	 * @return false|void
	 */
	function fasheno_require( $filename, string $dir = 'inc' ) {

		$dir        = trailingslashit( $dir );
		$child_file = get_stylesheet_directory() . DIRECTORY_SEPARATOR . $dir . $filename;

		if ( file_exists( $child_file ) ) {
			$file = $child_file;
		} else {
			$file = get_template_directory() . DIRECTORY_SEPARATOR . $dir . $filename;
		}

		if ( file_exists( $file ) ) {
			require_once $file;
		} else {
			return false;
		}
	}
}

if ( ! function_exists( 'fasheno_readmore_text' ) ) {
	/**
	 * Creates continue reading text.
	 *
	 * @return string
	 */
	function fasheno_readmore_text() {

		if ( empty( fasheno_option( 'rt_blog_read_more' ) ) ) {
			return;
		}
		return sprintf(
			'%s %s',
			esc_html( fasheno_option( 'rt_blog_read_more' ) ),
			the_title( '<span class="screen-reader-text">', '</span>', false )
		);
	}
}

if ( ! function_exists( 'fasheno_list_item_separator' ) ) {
	/**
	 * Retrieves the list item separator based on the locale.
	 *
	 * Added for backward compatibility to support pre-6.0.0 WordPress versions.
	 *
	 * @since 6.0.0
	 */
	function fasheno_list_item_separator() {
		/* translators: Used between list items, there is a space after the comma. */
		return sprintf(
			"<span class='%s'>%s</span>",
			'sp',
			__( ', ', 'fasheno' )
		);
	}
}

if ( ! function_exists( 'fasheno_posted_in' ) ) {
	/**
	 * Prints HTML with category list information about theme categories.
	 * @return string
	 */
	function fasheno_posted_in( $type = 'category' ) {
		$categories_list = get_the_category_list( fasheno_list_item_separator() );
		if ( 'tag' === $type ) {
			$categories_list = get_the_tag_list( '', fasheno_list_item_separator() );
		}
		if ( $categories_list ) {
			return sprintf(
				'<span class="%s-links">%s</span>',
				$type,
				$categories_list
			);
		}

		return '';
	}
}

if ( ! function_exists( 'fasheno_posted_on' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 * @return string
	 */
	function fasheno_posted_on() {
		$time_string = sprintf(
			'<time class="entry-date published updated" datetime="%1$s">%2$s</time>',
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() )
		);

		return sprintf( '<span class="posted-on">%s</span>', $time_string );
	}
}

if ( ! function_exists( 'fasheno_posted_by' ) ) {
	/**
	 * Prints HTML with meta information about theme author.
	 * @return string
	 */
	function fasheno_posted_by( $prefix = '' ) {
		return sprintf(
			esc_html__( '%s %s', 'fasheno' ),
			$prefix ? '<span class="bypostauthor">' . $prefix . '</span>' : '',
			'<span class="byline"><a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" rel="author">' . esc_html( get_the_author() ) . '</a></span>'
		);
	}
}

if ( ! function_exists( 'fasheno_get_svg' ) ) {
	/**
	 * Get svg icon
	 *
	 * @param $name
	 *
	 * @return string|void
	 */
	function fasheno_get_svg( $name, $rotate = '' ) {
		$svg_list     = apply_filters( 'fasheno_svg_icon_list', [
			'search'           => '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="23" viewBox="0 0 22 23"><path fill-rule="evenodd" clip-rule="evenodd" d="M6.06714 1.61988C7.23998 1.13407 8.49703 0.884033 9.7665 0.884033C11.036 0.884033 12.293 1.13407 13.4659 1.61988C14.6387 2.10569 15.7044 2.81775 16.602 3.7154C17.4997 4.61305 18.2117 5.67872 18.6975 6.85156C19.1833 8.02441 19.4334 9.28145 19.4334 10.5509C19.4334 11.8204 19.1833 13.0774 18.6975 14.2503C18.3398 15.114 17.8594 15.9195 17.2725 16.6427L21.3069 20.6771C21.6975 21.0677 21.6975 21.7008 21.3069 22.0914C20.9164 22.4819 20.2833 22.4819 19.8927 22.0914L15.8583 18.0569C14.1437 19.4485 11.9948 20.2178 9.7665 20.2178C7.20268 20.2178 4.74387 19.1993 2.93098 17.3864C1.11808 15.5736 0.0996094 13.1147 0.0996094 10.5509C0.0996094 7.9871 1.11808 5.52829 2.93098 3.7154C3.82863 2.81775 4.8943 2.10569 6.06714 1.61988ZM9.7665 2.88403C8.75967 2.88403 7.7627 3.08234 6.83251 3.46764C5.90232 3.85294 5.05713 4.41768 4.34519 5.12961C2.90737 6.56743 2.09961 8.51754 2.09961 10.5509C2.09961 12.5843 2.90737 14.5344 4.34519 15.9722C5.78301 17.4101 7.73311 18.2178 9.7665 18.2178C11.7999 18.2178 13.75 17.4101 15.1878 15.9722C15.8997 15.2603 16.4645 14.4151 16.8498 13.4849C17.2351 12.5547 17.4334 11.5578 17.4334 10.5509C17.4334 9.54409 17.2351 8.54712 16.8498 7.61693C16.4645 6.68674 15.8997 5.84155 15.1878 5.12961C14.4759 4.41768 13.6307 3.85294 12.7005 3.46764C11.7703 3.08234 10.7733 2.88403 9.7665 2.88403Z"/></svg>',
			'user'             => '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="21" viewBox="0 0 22 21"><path d="M21.6032 19.1499C20.0564 16.4758 17.6727 14.5583 14.8909 13.6493C16.2669 12.8301 17.336 11.582 17.9339 10.0964C18.5319 8.61089 18.6257 6.97014 18.2009 5.42614C17.7761 3.88214 16.8562 2.52027 15.5825 1.54967C14.3088 0.579069 12.7517 0.0534058 11.1504 0.0534058C9.54899 0.0534058 7.9919 0.579069 6.7182 1.54967C5.4445 2.52027 4.52462 3.88214 4.09983 5.42614C3.67504 6.97014 3.76883 8.61089 4.36678 10.0964C4.96474 11.582 6.03381 12.8301 7.40981 13.6493C4.62802 14.5573 2.24434 16.4748 0.697548 19.1499C0.640824 19.2424 0.6032 19.3453 0.586894 19.4526C0.570589 19.5599 0.575933 19.6693 0.602612 19.7745C0.62929 19.8796 0.676762 19.9784 0.742227 20.0649C0.807692 20.1515 0.889824 20.224 0.983776 20.2783C1.07773 20.3325 1.1816 20.3674 1.28926 20.3809C1.39692 20.3944 1.50619 20.3862 1.61062 20.3567C1.71505 20.3273 1.81252 20.2772 1.89729 20.2095C1.98206 20.1418 2.05241 20.0578 2.10419 19.9624C4.01763 16.6555 7.39966 14.6812 11.1504 14.6812C14.9011 14.6812 18.2831 16.6555 20.1965 19.9624C20.2483 20.0578 20.3187 20.1418 20.4034 20.2095C20.4882 20.2772 20.5857 20.3273 20.6901 20.3567C20.7945 20.3862 20.9038 20.3944 21.0115 20.3809C21.1191 20.3674 21.223 20.3325 21.3169 20.2783C21.4109 20.224 21.493 20.1515 21.5585 20.0649C21.624 19.9784 21.6714 19.8796 21.6981 19.7745C21.7248 19.6693 21.7301 19.5599 21.7138 19.4526C21.6975 19.3453 21.6599 19.2424 21.6032 19.1499ZM5.46286 7.36867C5.46286 6.24379 5.79643 5.14417 6.42138 4.20886C7.04633 3.27356 7.93459 2.54458 8.97385 2.1141C10.0131 1.68363 11.1567 1.571 12.2599 1.79045C13.3632 2.00991 14.3766 2.55159 15.172 3.347C15.9674 4.14241 16.5091 5.15583 16.7286 6.25909C16.948 7.36236 16.8354 8.50593 16.4049 9.54518C15.9745 10.5844 15.2455 11.4727 14.3102 12.0977C13.3749 12.7226 12.2752 13.0562 11.1504 13.0562C9.64244 13.0546 8.19674 12.4548 7.13047 11.3886C6.06421 10.3223 5.46447 8.87659 5.46286 7.36867Z"/></svg>',
			'facebook'         => '<svg xmlns="http://www.w3.org/2000/svg" height="16" width="10" viewBox="0 0 320 512"><path d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z"/></svg>', 'facebook-square'  => '<svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64h98.2V334.2H109.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H255V480H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64z"/></svg>',
			'twitter'          => '<svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/></svg>', 'twitter-square'   => '<svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm297.1 84L257.3 234.6 379.4 396H283.8L209 298.1 123.3 396H75.8l111-126.9L69.7 116h98l67.7 89.5L313.6 116h47.5zM323.3 367.6L153.4 142.9H125.1L296.9 367.6h26.3z"/></svg>',
			'skype'            => '<svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path d="M424.7 299.8c2.9-14 4.7-28.9 4.7-43.8 0-113.5-91.9-205.3-205.3-205.3-14.9 0-29.7 1.7-43.8 4.7C161.3 40.7 137.7 32 112 32 50.2 32 0 82.2 0 144c0 25.7 8.7 49.3 23.3 68.2-2.9 14-4.7 28.9-4.7 43.8 0 113.5 91.9 205.3 205.3 205.3 14.9 0 29.7-1.7 43.8-4.7 19 14.6 42.6 23.3 68.2 23.3 61.8 0 112-50.2 112-112 .1-25.6-8.6-49.2-23.2-68.1zm-194.6 91.5c-65.6 0-120.5-29.2-120.5-65 0-16 9-30.6 29.5-30.6 31.2 0 34.1 44.9 88.1 44.9 25.7 0 42.3-11.4 42.3-26.3 0-18.7-16-21.6-42-28-62.5-15.4-117.8-22-117.8-87.2 0-59.2 58.6-81.1 109.1-81.1 55.1 0 110.8 21.9 110.8 55.4 0 16.9-11.4 31.8-30.3 31.8-28.3 0-29.2-33.5-75-33.5-25.7 0-42 7-42 22.5 0 19.8 20.8 21.8 69.1 33 41.4 9.3 90.7 26.8 90.7 77.6 0 59.1-57.1 86.5-112 86.5z"/></svg>',
			'linkedin'         => '<svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path d="M100.3 448H7.4V148.9h92.9zM53.8 108.1C24.1 108.1 0 83.5 0 53.8a53.8 53.8 0 0 1 107.6 0c0 29.7-24.1 54.3-53.8 54.3zM447.9 448h-92.7V302.4c0-34.7-.7-79.2-48.3-79.2-48.3 0-55.7 37.7-55.7 76.7V448h-92.8V148.9h89.1v40.8h1.3c12.4-23.5 42.7-48.3 87.9-48.3 94 0 111.3 61.9 111.3 142.3V448z"/></svg>', 'linkedin-square'  => '<svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z"/></svg>',
			'instagram'        => '<svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>', 'instagram-square' => '<svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path d="M194.4 211.7a53.3 53.3 0 1 0 59.3 88.7 53.3 53.3 0 1 0 -59.3-88.7zm142.3-68.4c-5.2-5.2-11.5-9.3-18.4-12c-18.1-7.1-57.6-6.8-83.1-6.5c-4.1 0-7.9 .1-11.2 .1c-3.3 0-7.2 0-11.4-.1c-25.5-.3-64.8-.7-82.9 6.5c-6.9 2.7-13.1 6.8-18.4 12s-9.3 11.5-12 18.4c-7.1 18.1-6.7 57.7-6.5 83.2c0 4.1 .1 7.9 .1 11.1s0 7-.1 11.1c-.2 25.5-.6 65.1 6.5 83.2c2.7 6.9 6.8 13.1 12 18.4s11.5 9.3 18.4 12c18.1 7.1 57.6 6.8 83.1 6.5c4.1 0 7.9-.1 11.2-.1c3.3 0 7.2 0 11.4 .1c25.5 .3 64.8 .7 82.9-6.5c6.9-2.7 13.1-6.8 18.4-12s9.3-11.5 12-18.4c7.2-18 6.8-57.4 6.5-83c0-4.2-.1-8.1-.1-11.4s0-7.1 .1-11.4c.3-25.5 .7-64.9-6.5-83l0 0c-2.7-6.9-6.8-13.1-12-18.4zm-67.1 44.5A82 82 0 1 1 178.4 324.2a82 82 0 1 1 91.1-136.4zm29.2-1.3c-3.1-2.1-5.6-5.1-7.1-8.6s-1.8-7.3-1.1-11.1s2.6-7.1 5.2-9.8s6.1-4.5 9.8-5.2s7.6-.4 11.1 1.1s6.5 3.9 8.6 7s3.2 6.8 3.2 10.6c0 2.5-.5 5-1.4 7.3s-2.4 4.4-4.1 6.2s-3.9 3.2-6.2 4.2s-4.8 1.5-7.3 1.5l0 0c-3.8 0-7.5-1.1-10.6-3.2zM448 96c0-35.3-28.7-64-64-64H64C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96zM357 389c-18.7 18.7-41.4 24.6-67 25.9c-26.4 1.5-105.6 1.5-132 0c-25.6-1.3-48.3-7.2-67-25.9s-24.6-41.4-25.8-67c-1.5-26.4-1.5-105.6 0-132c1.3-25.6 7.1-48.3 25.8-67s41.5-24.6 67-25.8c26.4-1.5 105.6-1.5 132 0c25.6 1.3 48.3 7.1 67 25.8s24.6 41.4 25.8 67c1.5 26.3 1.5 105.4 0 131.9c-1.3 25.6-7.1 48.3-25.8 67z"/></svg>',
			'pinterest'        => '<svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><path d="M204 6.5C101.4 6.5 0 74.9 0 185.6 0 256 39.6 296 63.6 296c9.9 0 15.6-27.6 15.6-35.4 0-9.3-23.7-29.1-23.7-67.8 0-80.4 61.2-137.4 140.4-137.4 68.1 0 118.5 38.7 118.5 109.8 0 53.1-21.3 152.7-90.3 152.7-24.9 0-46.2-18-46.2-43.8 0-37.8 26.4-74.4 26.4-113.4 0-66.2-93.9-54.2-93.9 25.8 0 16.8 2.1 35.4 9.6 50.7-13.8 59.4-42 147.9-42 209.1 0 18.9 2.7 37.5 4.5 56.4 3.4 3.8 1.7 3.4 6.9 1.5 50.4-69 48.6-82.5 71.4-172.8 12.3 23.4 44.1 36 69.3 36 106.2 0 153.9-103.5 153.9-196.8C384 71.3 298.2 6.5 204 6.5z"/></svg>', 'pinterest-square' => '<svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path d="M384 32H64C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64h72.6l-2.2-.8c-5.4-48.1-3.1-57.5 15.7-134.7c3.9-16 8.5-35 13.9-57.9c0 0-7.3-14.8-7.3-36.5c0-70.7 75.5-78 75.5-25c0 13.5-5.4 31.1-11.2 49.8c-3.3 10.6-6.6 21.5-9.1 32c-5.7 24.5 12.3 44.4 36.4 44.4c43.7 0 77.2-46 77.2-112.4c0-58.8-42.3-99.9-102.6-99.9C153 139 112 191.4 112 245.6c0 21.1 8.2 43.7 18.3 56c2 2.4 2.3 4.5 1.7 7c-1.1 4.7-3.1 12.9-4.7 19.2c-1 4-1.8 7.3-2.1 8.6c-1.1 4.5-3.5 5.5-8.2 3.3c-30.6-14.3-49.8-59.1-49.8-95.1C67.2 167.1 123.4 96 229.4 96c85.2 0 151.4 60.7 151.4 141.8c0 84.6-53.3 152.7-127.4 152.7c-24.9 0-48.3-12.9-56.3-28.2c0 0-12.3 46.9-15.3 58.4c-5 19.3-17.6 42.9-27.4 59.3H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64z"/></svg>',
			'tiktok'           => '<svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path d="M448 209.9a210.1 210.1 0 0 1 -122.8-39.3V349.4A162.6 162.6 0 1 1 185 188.3V278.2a74.6 74.6 0 1 0 52.2 71.2V0l88 0a121.2 121.2 0 0 0 1.9 22.2h0A122.2 122.2 0 0 0 381 102.4a121.4 121.4 0 0 0 67 20.1z"/></svg>',
			'youtube'          => '<svg xmlns="http://www.w3.org/2000/svg" height="16" width="18" viewBox="0 0 576 512"><path d="M549.7 124.1c-6.3-23.7-24.8-42.3-48.3-48.6C458.8 64 288 64 288 64S117.2 64 74.6 75.5c-23.5 6.3-42 24.9-48.3 48.6-11.4 42.9-11.4 132.3-11.4 132.3s0 89.4 11.4 132.3c6.3 23.7 24.8 41.5 48.3 47.8C117.2 448 288 448 288 448s170.8 0 213.4-11.5c23.5-6.3 42-24.2 48.3-47.8 11.4-42.9 11.4-132.3 11.4-132.3s0-89.4-11.4-132.3zm-317.5 213.5V175.2l142.7 81.2-142.7 81.2z"/></svg>', 'youtube-square'   => '<svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path d="M282 256.2l-95.2-54.1V310.3L282 256.2zM384 32H64C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64zm14.4 136.1c7.6 28.6 7.6 88.2 7.6 88.2s0 59.6-7.6 88.1c-4.2 15.8-16.5 27.7-32.2 31.9C337.9 384 224 384 224 384s-113.9 0-142.2-7.6c-15.7-4.2-28-16.1-32.2-31.9C42 315.9 42 256.3 42 256.3s0-59.7 7.6-88.2c4.2-15.8 16.5-28.2 32.2-32.4C110.1 128 224 128 224 128s113.9 0 142.2 7.7c15.7 4.2 28 16.6 32.2 32.4z"/></svg>',
			'snapchat'         => '<svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path d="M496.9 366.6c-3.4-9.2-9.8-14.1-17.1-18.2-1.4-.8-2.6-1.5-3.7-1.9-2.2-1.1-4.4-2.2-6.6-3.4-22.8-12.1-40.6-27.3-53-45.4a102.9 102.9 0 0 1 -9.1-16.1c-1.1-3-1-4.7-.2-6.3a10.2 10.2 0 0 1 2.9-3c3.9-2.6 8-5.2 10.7-7 4.9-3.2 8.8-5.7 11.2-7.4 9.4-6.5 15.9-13.5 20-21.3a42.4 42.4 0 0 0 2.1-35.2c-6.2-16.3-21.6-26.4-40.3-26.4a55.5 55.5 0 0 0 -11.7 1.2c-1 .2-2.1 .5-3.1 .7 .2-11.2-.1-22.9-1.1-34.5-3.5-40.8-17.8-62.1-32.7-79.2A130.2 130.2 0 0 0 332.1 36.4C309.5 23.5 283.9 17 256 17S202.6 23.5 180 36.4a129.7 129.7 0 0 0 -33.3 26.8c-14.9 17-29.2 38.4-32.7 79.2-1 11.6-1.2 23.4-1.1 34.5-1-.3-2-.5-3.1-.7a55.5 55.5 0 0 0 -11.7-1.2c-18.7 0-34.1 10.1-40.3 26.4a42.4 42.4 0 0 0 2 35.2c4.1 7.8 10.7 14.7 20 21.3 2.5 1.7 6.4 4.2 11.2 7.4 2.6 1.7 6.5 4.2 10.3 6.7a11.1 11.1 0 0 1 3.3 3.3c.8 1.6 .8 3.4-.4 6.6a102 102 0 0 1 -8.9 15.8c-12.1 17.7-29.4 32.6-51.4 44.6C32.4 348.6 20.2 352.8 15.1 366.7c-3.9 10.5-1.3 22.5 8.5 32.6a49.1 49.1 0 0 0 12.4 9.4 134.3 134.3 0 0 0 30.3 12.1 20 20 0 0 1 6.1 2.7c3.6 3.1 3.1 7.9 7.8 14.8a34.5 34.5 0 0 0 9 9.1c10 6.9 21.3 7.4 33.2 7.8 10.8 .4 23 .9 36.9 5.5 5.8 1.9 11.8 5.6 18.7 9.9C194.8 481 217.7 495 256 495s61.3-14.1 78.1-24.4c6.9-4.2 12.9-7.9 18.5-9.8 13.9-4.6 26.2-5.1 36.9-5.5 11.9-.5 23.2-.9 33.2-7.8a34.6 34.6 0 0 0 10.2-11.2c3.4-5.8 3.3-9.9 6.6-12.8a19 19 0 0 1 5.8-2.6A134.9 134.9 0 0 0 476 408.7a48.3 48.3 0 0 0 13-10.2l.1-.1C498.4 388.5 500.7 376.9 496.9 366.6zm-34 18.3c-20.7 11.5-34.5 10.2-45.3 17.1-9.1 5.9-3.7 18.5-10.3 23.1-8.1 5.6-32.2-.4-63.2 9.9-25.6 8.5-42 32.8-88 32.8s-62-24.3-88.1-32.9c-31-10.3-55.1-4.2-63.2-9.9-6.6-4.6-1.2-17.2-10.3-23.1-10.7-6.9-24.5-5.7-45.3-17.1-13.2-7.3-5.7-11.8-1.3-13.9 75.1-36.4 87.1-92.6 87.7-96.7 .6-5 1.4-9-4.2-14.1-5.4-5-29.2-19.7-35.8-24.3-10.9-7.6-15.7-15.3-12.2-24.6 2.5-6.5 8.5-8.9 14.9-8.9a27.6 27.6 0 0 1 6 .7c12 2.6 23.7 8.6 30.4 10.2a10.7 10.7 0 0 0 2.5 .3c3.6 0 4.9-1.8 4.6-5.9-.8-13.1-2.6-38.7-.6-62.6 2.8-32.9 13.4-49.2 26-63.6 6.1-6.9 34.5-37 88.9-37s82.9 29.9 88.9 36.8c12.6 14.4 23.2 30.7 26 63.6 2.1 23.9 .3 49.5-.6 62.6-.3 4.3 1 5.9 4.6 5.9a10.6 10.6 0 0 0 2.5-.3c6.7-1.6 18.4-7.6 30.4-10.2a27.6 27.6 0 0 1 6-.7c6.4 0 12.4 2.5 14.9 8.9 3.5 9.4-1.2 17-12.2 24.6-6.6 4.6-30.4 19.3-35.8 24.3-5.6 5.1-4.8 9.1-4.2 14.1 .5 4.2 12.5 60.4 87.7 96.7C468.6 373 476.1 377.5 462.9 384.9z"/></svg>', 'snapchat-square'  => '<svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path d="M384 32H64A64 64 0 0 0 0 96V416a64 64 0 0 0 64 64H384a64 64 0 0 0 64-64V96A64 64 0 0 0 384 32zm-3.9 319.3-.1 .1a32.4 32.4 0 0 1 -8.7 6.8 90.3 90.3 0 0 1 -20.6 8.2 12.7 12.7 0 0 0 -3.9 1.8c-2.2 1.9-2.1 4.6-4.4 8.6a23.1 23.1 0 0 1 -6.8 7.5c-6.7 4.6-14.2 4.9-22.2 5.2-7.2 .3-15.4 .6-24.7 3.7-3.8 1.2-7.8 3.7-12.4 6.5-11.3 6.9-26.7 16.4-52.3 16.4s-40.9-9.4-52.1-16.3c-4.7-2.9-8.7-5.4-12.5-6.6-9.3-3.1-17.5-3.4-24.7-3.7-8-.3-15.5-.6-22.2-5.2a23.1 23.1 0 0 1 -6-6.1c-3.2-4.6-2.9-7.8-5.3-9.9a13.4 13.4 0 0 0 -4.1-1.8 90 90 0 0 1 -20.3-8.1 32.9 32.9 0 0 1 -8.3-6.3c-6.6-6.8-8.3-14.8-5.7-21.8 3.4-9.3 11.6-12.1 19.4-16.3 14.8-8 26.3-18.1 34.4-29.9a68.2 68.2 0 0 0 6-10.6c.8-2.2 .8-3.3 .2-4.4a7.4 7.4 0 0 0 -2.2-2.2c-2.5-1.7-5.1-3.4-6.9-4.5-3.3-2.1-5.9-3.8-7.5-5-6.3-4.4-10.7-9-13.4-14.2a28.4 28.4 0 0 1 -1.4-23.6c4.1-10.9 14.5-17.7 27-17.7a37.1 37.1 0 0 1 7.8 .8c.7 .2 1.4 .3 2 .5-.1-7.4 .1-15.4 .7-23.1 2.4-27.3 11.9-41.6 21.9-53a86.8 86.8 0 0 1 22.3-17.9C188.3 100.4 205.3 96 224 96s35.8 4.4 50.9 13a87.2 87.2 0 0 1 22.2 17.9c10 11.4 19.5 25.7 21.9 53a231.2 231.2 0 0 1 .7 23.1c.7-.2 1.4-.3 2.1-.5a37.1 37.1 0 0 1 7.8-.8c12.5 0 22.8 6.8 27 17.7a28.4 28.4 0 0 1 -1.4 23.6c-2.7 5.2-7.1 9.9-13.4 14.2-1.7 1.2-4.3 2.9-7.5 5-1.8 1.2-4.5 2.9-7.2 4.7a6.9 6.9 0 0 0 -2 2c-.5 1-.5 2.2 .2 4.2a69 69 0 0 0 6.1 10.8c8.3 12.1 20.2 22.3 35.5 30.4 1.5 .8 3 1.5 4.4 2.3 .7 .3 1.6 .8 2.5 1.3 4.9 2.7 9.2 6 11.5 12.2C387.8 336.9 386.3 344.7 380.1 351.3zm-16.7-18.5c-50.3-24.3-58.3-61.9-58.7-64.7-.4-3.4-.9-6 2.8-9.5 3.6-3.3 19.5-13.2 24-16.3 7.3-5.1 10.5-10.2 8.2-16.5-1.7-4.3-5.7-6-10-6a18.5 18.5 0 0 0 -4 .4c-8 1.7-15.8 5.8-20.4 6.9a7.1 7.1 0 0 1 -1.7 .2c-2.4 0-3.3-1.1-3.1-4 .6-8.8 1.8-25.9 .4-41.9-1.9-22-9-32.9-17.4-42.6-4.1-4.6-23.1-24.7-59.5-24.7S168.5 134.4 164.5 139c-8.4 9.7-15.5 20.6-17.4 42.6-1.4 16-.1 33.1 .4 41.9 .2 2.8-.7 4-3.1 4a7.1 7.1 0 0 1 -1.7-.2c-4.5-1.1-12.3-5.1-20.3-6.9a18.5 18.5 0 0 0 -4-.4c-4.3 0-8.3 1.6-10 6-2.4 6.3 .8 11.4 8.2 16.5 4.4 3.1 20.4 13 24 16.3 3.7 3.4 3.2 6.1 2.8 9.5-.4 2.8-8.4 40.4-58.7 64.7-2.9 1.4-8 4.5 .9 9.3 13.9 7.6 23.1 6.8 30.3 11.4 6.1 3.9 2.5 12.4 6.9 15.4 5.5 3.8 21.6-.3 42.3 6.6 17.4 5.7 28.1 22 59 22s41.8-16.3 58.9-22c20.8-6.9 36.9-2.8 42.3-6.6 4.4-3.1 .8-11.5 6.9-15.4 7.2-4.6 16.4-3.8 30.3-11.5C371.4 337.4 366.3 334.3 363.4 332.8z"/></svg>',
			'whatsapp'         => '<svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>', 'whatsapp-square'  => '<svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path d="M92.1 254.6c0 24.9 7 49.2 20.2 70.1l3.1 5-13.3 48.6L152 365.2l4.8 2.9c20.2 12 43.4 18.4 67.1 18.4h.1c72.6 0 133.3-59.1 133.3-131.8c0-35.2-15.2-68.3-40.1-93.2c-25-25-58-38.7-93.2-38.7c-72.7 0-131.8 59.1-131.9 131.8zM274.8 330c-12.6 1.9-22.4 .9-47.5-9.9c-36.8-15.9-61.8-51.5-66.9-58.7c-.4-.6-.7-.9-.8-1.1c-2-2.6-16.2-21.5-16.2-41c0-18.4 9-27.9 13.2-32.3c.3-.3 .5-.5 .7-.8c3.6-4 7.9-5 10.6-5c2.6 0 5.3 0 7.6 .1c.3 0 .5 0 .8 0c2.3 0 5.2 0 8.1 6.8c1.2 2.9 3 7.3 4.9 11.8c3.3 8 6.7 16.3 7.3 17.6c1 2 1.7 4.3 .3 6.9c-3.4 6.8-6.9 10.4-9.3 13c-3.1 3.2-4.5 4.7-2.3 8.6c15.3 26.3 30.6 35.4 53.9 47.1c4 2 6.3 1.7 8.6-1c2.3-2.6 9.9-11.6 12.5-15.5c2.6-4 5.3-3.3 8.9-2s23.1 10.9 27.1 12.9c.8 .4 1.5 .7 2.1 1c2.8 1.4 4.7 2.3 5.5 3.6c.9 1.9 .9 9.9-2.4 19.1c-3.3 9.3-19.1 17.7-26.7 18.8zM448 96c0-35.3-28.7-64-64-64H64C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96zM148.1 393.9L64 416l22.5-82.2c-13.9-24-21.2-51.3-21.2-79.3C65.4 167.1 136.5 96 223.9 96c42.4 0 82.2 16.5 112.2 46.5c29.9 30 47.9 69.8 47.9 112.2c0 87.4-72.7 158.5-160.1 158.5c-26.6 0-52.7-6.7-75.8-19.3z"/></svg>',
			'reddit'           => '<svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path d="M373 138.6c-25.2 0-46.3-17.5-51.9-41l0 0c-30.6 4.3-54.2 30.7-54.2 62.4l0 .2c47.4 1.8 90.6 15.1 124.9 36.3c12.6-9.7 28.4-15.5 45.5-15.5c41.3 0 74.7 33.4 74.7 74.7c0 29.8-17.4 55.5-42.7 67.5c-2.4 86.8-97 156.6-213.2 156.6S45.5 410.1 43 323.4C17.6 311.5 0 285.7 0 255.7c0-41.3 33.4-74.7 74.7-74.7c17.2 0 33 5.8 45.7 15.6c34-21.1 76.8-34.4 123.7-36.4l0-.3c0-44.3 33.7-80.9 76.8-85.5C325.8 50.2 347.2 32 373 32c29.4 0 53.3 23.9 53.3 53.3s-23.9 53.3-53.3 53.3zM157.5 255.3c-20.9 0-38.9 20.8-40.2 47.9s17.1 38.1 38 38.1s36.6-9.8 37.8-36.9s-14.7-49.1-35.7-49.1zM395 303.1c-1.2-27.1-19.2-47.9-40.2-47.9s-36.9 22-35.7 49.1c1.2 27.1 16.9 36.9 37.8 36.9s39.3-11 38-38.1zm-60.1 70.8c1.5-3.6-1-7.7-4.9-8.1c-23-2.3-47.9-3.6-73.8-3.6s-50.8 1.3-73.8 3.6c-3.9 .4-6.4 4.5-4.9 8.1c12.9 30.8 43.3 52.4 78.7 52.4s65.8-21.6 78.7-52.4z"/></svg>', 'reddit-square'    => '<svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path d="M64 32l320 0c35.3 0 64 28.7 64 64l0 320c0 35.3-28.7 64-64 64L64 480c-35.3 0-64-28.7-64-64L0 96C0 60.7 28.7 32 64 32zM305.9 166.4c20.6 0 37.3-16.7 37.3-37.3s-16.7-37.3-37.3-37.3c-18 0-33.1 12.8-36.6 29.8c-30.2 3.2-53.8 28.8-53.8 59.9l0 .2c-32.8 1.4-62.8 10.7-86.6 25.5c-8.8-6.8-19.9-10.9-32-10.9c-28.9 0-52.3 23.4-52.3 52.3c0 21 12.3 39 30.1 47.4c1.7 60.7 67.9 109.6 149.3 109.6s147.6-48.9 149.3-109.7c17.7-8.4 29.9-26.4 29.9-47.3c0-28.9-23.4-52.3-52.3-52.3c-12 0-23 4-31.9 10.8c-24-14.9-54.3-24.2-87.5-25.4l0-.1c0-22.2 16.5-40.7 37.9-43.7l0 0c3.9 16.5 18.7 28.7 36.3 28.7zM155 248.1c14.6 0 25.8 15.4 25 34.4s-11.8 25.9-26.5 25.9s-27.5-7.7-26.6-26.7s13.5-33.5 28.1-33.5zm166.4 33.5c.9 19-12 26.7-26.6 26.7s-25.6-6.9-26.5-25.9c-.9-19 10.3-34.4 25-34.4s27.3 14.6 28.1 33.5zm-42.1 49.6c-9 21.5-30.3 36.7-55.1 36.7s-46.1-15.1-55.1-36.7c-1.1-2.6 .7-5.4 3.4-5.7c16.1-1.6 33.5-2.5 51.7-2.5s35.6 .9 51.7 2.5c2.7 .3 4.5 3.1 3.4 5.7z"/></svg>',
			'rss'              => '<svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path d="M0 64C0 46.3 14.3 32 32 32c229.8 0 416 186.2 416 416c0 17.7-14.3 32-32 32s-32-14.3-32-32C384 253.6 226.4 96 32 96C14.3 96 0 81.7 0 64zM0 416a64 64 0 1 1 128 0A64 64 0 1 1 0 416zM32 160c159.1 0 288 128.9 288 288c0 17.7-14.3 32-32 32s-32-14.3-32-32c0-123.7-100.3-224-224-224c-17.7 0-32-14.3-32-32s14.3-32 32-32z"/></svg>',
			'map-pin'          => '<svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/></svg>',
			'globe'            => '<svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path d="M266.3 48.3L232.5 73.6c-5.4 4-8.5 10.4-8.5 17.1v9.1c0 6.8 5.5 12.3 12.3 12.3c2.4 0 4.8-.7 6.8-2.1l41.8-27.9c2-1.3 4.4-2.1 6.8-2.1h1c6.2 0 11.3 5.1 11.3 11.3c0 3-1.2 5.9-3.3 8l-19.9 19.9c-5.8 5.8-12.9 10.2-20.7 12.8l-26.5 8.8c-5.8 1.9-9.6 7.3-9.6 13.4c0 3.7-1.5 7.3-4.1 10l-17.9 17.9c-6.4 6.4-9.9 15-9.9 24v4.3c0 16.4 13.6 29.7 29.9 29.7c11 0 21.2-6.2 26.1-16l4-8.1c2.4-4.8 7.4-7.9 12.8-7.9c4.5 0 8.7 2.1 11.4 5.7l16.3 21.7c2.1 2.9 5.5 4.5 9.1 4.5c8.4 0 13.9-8.9 10.1-16.4l-1.1-2.3c-3.5-7 0-15.5 7.5-18l21.2-7.1c7.6-2.5 12.7-9.6 12.7-17.6c0-10.3 8.3-18.6 18.6-18.6H400c8.8 0 16 7.2 16 16s-7.2 16-16 16H379.3c-7.2 0-14.2 2.9-19.3 8l-4.7 4.7c-2.1 2.1-3.3 5-3.3 8c0 6.2 5.1 11.3 11.3 11.3h11.3c6 0 11.8 2.4 16 6.6l6.5 6.5c1.8 1.8 2.8 4.3 2.8 6.8s-1 5-2.8 6.8l-7.5 7.5C386 262 384 266.9 384 272s2 10 5.7 13.7L408 304c10.2 10.2 24.1 16 38.6 16H454c6.5-20.2 10-41.7 10-64c0-111.4-87.6-202.4-197.7-207.7zm172 307.9c-3.7-2.6-8.2-4.1-13-4.1c-6 0-11.8-2.4-16-6.6L396 332c-7.7-7.7-18-12-28.9-12c-9.7 0-19.2-3.5-26.6-9.8L314 287.4c-11.6-9.9-26.4-15.4-41.7-15.4H251.4c-12.6 0-25 3.7-35.5 10.7L188.5 301c-17.8 11.9-28.5 31.9-28.5 53.3v3.2c0 17 6.7 33.3 18.7 45.3l16 16c8.5 8.5 20 13.3 32 13.3H248c13.3 0 24 10.7 24 24c0 2.5 .4 5 1.1 7.3c71.3-5.8 132.5-47.6 165.2-107.2zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM187.3 100.7c-6.2-6.2-16.4-6.2-22.6 0l-32 32c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0l32-32c6.2-6.2 6.2-16.4 0-22.6z"/></svg>',
			'phone'            => '<svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/></svg>',
			'email'            => '<svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg>',
			'scroll-top'       => '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="17" viewBox="0 0 15 17"><path d="M0.493164 9.71216V5.21216L7.49316 0.212158L14.4932 5.21216V9.71216L7.49316 4.71216L0.493164 9.71216Z"/><path d="M0.493164 16.7122V12.2122L7.49316 7.21216L14.4932 12.2122V16.7122L7.49316 11.7122L0.493164 16.7122Z"/></svg>',
			'arrow-right'      => '<svg width="20" height="16" viewBox="0 0 20 16" xmlns="http://www.w3.org/2000/svg"><path d="M19.0443 8.79735L12.2943 15.5474C12.083 15.7587 11.7963 15.8774 11.4974 15.8774C11.1986 15.8774 10.9119 15.7587 10.7006 15.5474C10.4892 15.336 10.3705 15.0494 10.3705 14.7505C10.3705 14.4516 10.4892 14.1649 10.7006 13.9536L15.5296 9.12642H1.74838C1.45001 9.12642 1.16387 9.00789 0.952887 8.79691C0.741909 8.58593 0.623383 8.29978 0.623383 8.00142C0.623383 7.70305 0.741909 7.4169 0.952887 7.20592C1.16387 6.99494 1.45001 6.87642 1.74838 6.87642H15.5296L10.7024 2.04642C10.4911 1.83507 10.3724 1.54843 10.3724 1.24954C10.3724 0.950654 10.4911 0.66401 10.7024 0.452665C10.9138 0.241321 11.2004 0.122589 11.4993 0.122589C11.7982 0.122589 12.0849 0.241321 12.2962 0.452665L19.0462 7.20267C19.1511 7.30732 19.2343 7.43167 19.291 7.56857C19.3477 7.70547 19.3768 7.85222 19.3766 8.0004C19.3764 8.14858 19.347 8.29526 19.29 8.43203C19.2329 8.56879 19.1495 8.69294 19.0443 8.79735Z"/></svg>',
			'home'             => '<svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.38258 1.03781C7.2994 0.972961 7.19695 0.937744 7.09148 0.937744C6.98602 0.937744 6.88357 0.972961 6.80039 1.03781L0.0644531 6.29015L0.647109 7.02703L1.4707 6.38484V12.1875C1.4712 12.436 1.57013 12.6742 1.74584 12.8499C1.92155 13.0256 2.15971 13.1245 2.4082 13.125H11.7832C12.0317 13.1245 12.2699 13.0256 12.4456 12.8499C12.6213 12.6742 12.7202 12.436 12.7207 12.1875V6.38906L13.5443 7.03125L14.127 6.29437L7.38258 1.03781ZM8.0332 12.1875H6.1582V8.4375H8.0332V12.1875ZM8.9707 12.1875V8.4375C8.97045 8.18893 8.8716 7.95062 8.69584 7.77486C8.52008 7.5991 8.28177 7.50025 8.0332 7.5H6.1582C5.90964 7.50025 5.67133 7.5991 5.49556 7.77486C5.3198 7.95062 5.22095 8.18893 5.2207 8.4375V12.1875H2.4082V5.65406L7.0957 2.0025L11.7832 5.65875V12.1875H8.9707Z"/></svg>',
			'share' 		   => '<svg width="14" height="11" viewBox="0 0 14 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.72904 2.93333V0L0.595703 5.13333L5.72904 10.2667V7.26C9.3957 7.26 11.9624 8.43333 13.7957 11C13.0624 7.33333 10.8624 3.66667 5.72904 2.93333Z"/></svg>',
			'chevron-right'    => '<svg width="7" height="13" viewBox="0 0 7 13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.94039 6.5H6M6 6.5L1 1.5M6 6.5L1 11.5" stroke="currentColor" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/></svg>',
			'camera'           => '<svg width="21" height="17" viewBox="0 0 21 17" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.0843 2.9079H18.489H16.9559V1.90484C16.9559 1.53787 16.8172 1.20352 16.5644 0.942561C16.3116 0.681603 15.9691 0.542969 15.6021 0.542969H13.1149C12.3646 0.542969 11.753 1.15459 11.753 1.90484V2.9079H6.17502C6.15871 2.492 5.99561 2.10872 5.70203 1.80699C5.39214 1.4971 4.9844 1.32584 4.55218 1.32584C3.67145 1.334 2.95381 2.03532 2.92935 2.9079H2.25249C1.24128 2.9079 0.425781 3.7234 0.425781 4.72646V14.7244C0.425781 15.7275 1.24128 16.543 2.24433 16.543H19.0761C20.0792 16.543 20.8947 15.7275 20.8947 14.7244V4.72646C20.9028 3.7234 20.0874 2.9079 19.0843 2.9079ZM12.3728 1.90484C12.3728 1.4971 12.7071 1.16274 13.1149 1.16274H15.6021C15.7 1.16274 15.7979 1.17905 15.8876 1.21983C15.9773 1.2606 16.0588 1.30953 16.124 1.38293C16.2627 1.52156 16.3361 1.70913 16.3361 1.90484V2.9079H12.3728V1.90484ZM4.55218 1.95377C4.8213 1.95377 5.0741 2.05979 5.26166 2.24735C5.44107 2.42676 5.53893 2.6551 5.55524 2.9079H3.54912C3.57359 2.37783 4.01396 1.95377 4.55218 1.95377ZM1.04556 14.7244V4.72646C1.04556 4.0659 1.58378 3.52768 2.24433 3.52768H3.19846C3.20662 3.52768 3.22293 3.52768 3.23108 3.52768H5.86513C5.87328 3.52768 5.88959 3.52768 5.89775 3.52768H18.1791V15.9232H2.24433C1.58378 15.9232 1.04556 15.385 1.04556 14.7244ZM20.2831 14.7244C20.2831 15.385 19.7448 15.9232 19.0843 15.9232H18.7989V3.52768H19.0843C19.7448 3.52768 20.2831 4.0659 20.2831 4.72646V14.7244Z"/><path d="M10.6681 7.77637C9.59167 7.77637 8.71094 8.6571 8.71094 9.73355C8.71094 10.81 9.59167 11.6907 10.6681 11.6907C11.7446 11.6907 12.6253 10.81 12.6253 9.73355C12.6172 8.64895 11.7446 7.77637 10.6681 7.77637ZM10.6681 11.0628C9.93418 11.0628 9.33071 10.4675 9.33071 9.7254C9.33071 8.99145 9.92602 8.38799 10.6681 8.38799C11.4021 8.38799 12.0055 8.9833 12.0055 9.7254C11.9974 10.4593 11.4021 11.0628 10.6681 11.0628Z"/><path d="M10.669 5.14233C8.14098 5.14233 6.08594 7.19738 6.08594 9.72541C6.08594 12.2534 8.14098 14.3085 10.669 14.3085C13.197 14.3085 15.2521 12.2534 15.2521 9.72541C15.2521 7.19738 13.1889 5.14233 10.669 5.14233ZM10.669 13.6887C8.48349 13.6887 6.70571 11.9109 6.70571 9.72541C6.70571 7.53989 8.48349 5.76211 10.669 5.76211C12.8545 5.76211 14.6323 7.53989 14.6323 9.72541C14.6242 11.9109 12.8464 13.6887 10.669 13.6887Z"/></svg>',
		] );
		$rotate_style = '';
		if ( $rotate ) {
			$rotate_style = "style=transform:rotate(" . $rotate . "deg);";
		}

		if ( isset( $svg_list[ $name ] ) ) {
			return "<span " . esc_attr( $rotate_style ) . " class='rticon-{$name}'>{$svg_list[ $name ]}</span>";
		}

		return '';
	}
}

if ( ! function_exists( 'fasheno_get_file' ) ) {
	/**
	 * Get File Path
	 *
	 * @param $path
	 *
	 * @return string
	 */
	function fasheno_get_file( $path, $return_path = false ): string {
		$file = ( $return_path ? get_stylesheet_directory() : get_stylesheet_directory_uri() ) . $path;
		if ( ! file_exists( $file ) ) {
			$file = ( $return_path ? get_template_directory() : get_template_directory_uri() ) . $path;
		}

		return $file;
	}
}

if ( ! function_exists( 'fasheno_get_img' ) ) {
	/**
	 * Get Image Path
	 *
	 * @param $filename
	 * @param $echo
	 * @param $image_meta
	 *
	 * @return string|void
	 */
	function fasheno_get_img( $filename, $echo = false, $image_meta = '' ) {
		$path      = '/assets/images/' . $filename;
		$image_url = fasheno_get_file( $path );

		if ( $echo ) {
			if ( ! strpos( $filename, '.svg' ) ) {
				$getimagesize = wp_getimagesize( fasheno_get_file( $path, true ) );
				$image_meta   = $getimagesize[3] ?? $image_meta;
			}
			echo '<img ' . $image_meta . ' src="' . esc_url( $image_url ) . '"/>';
		} else {
			return $image_url;
		}
	}
}

if ( ! function_exists( 'fasheno_get_css' ) ) {
	/**
	 * Get CSS Path
	 *
	 * @param $filename
	 * @param bool $check_rtl
	 *
	 * @return string
	 */
	function fasheno_get_css( $filename, $check_rtl = false ) {
		$min    = WP_DEBUG ? '.css' : '.css';
		$is_rtl = $check_rtl && is_rtl() ? 'css-rtl' : 'css';
		$path   = "/assets/$is_rtl/" . $filename . $min;

		return fasheno_get_file( $path );
	}
}

if ( ! function_exists( 'fasheno_get_js' ) ) {
	/**
	 * Get JS Path
	 *
	 * @param $filename
	 *
	 * @return string
	 */
	function fasheno_get_js( $filename ) {
		$path = '/assets/js/' . $filename . '.js';

		return fasheno_get_file( $path );
	}
}


if ( ! function_exists( 'fasheno_option' ) ) {
	/**
	 * Get Customize Options value by key
	 *
	 * @param $key
	 *
	 * @return mixed
	 */
	function fasheno_option( $key, $default = '', $return_array = false ) {
		if ( ! empty( Opt::$options[ $key ] ) ) {
			$opt_val = Opt::$options[ $key ];
			if ( $return_array && $opt_val ) {
				$opt_val = explode( ',', trim( $opt_val, ', ' ) );
			}

			return $opt_val;
		}

		if ( $default ) {
			return $default;
		}

		return false;
	}
}

if ( ! function_exists( 'fasheno_get_social_html' ) ) {
	/**
	 * Get Social markup
	 *
	 * @param $color
	 *
	 * @return void
	 */

	function fasheno_get_social_html( $color = '' ) {
		ob_start();
		foreach ( Fns::get_socials() as $id => $item ) {
			if ( empty( $item['url'] ) ) {
				continue;
			}
			?>
			<a target="_blank" href="<?php echo esc_url( $item['url'] ) ?>" aria-label="social link">
				<?php echo fasheno_get_svg( $id ); ?>
			</a>
			<?php
		}

		echo ob_get_clean();
	}
}

if ( ! function_exists( 'fasheno_site_logo' ) ) {
	/**
	 * Newfit Site Logo
	 *
	 */
	function fasheno_site_logo( $with_logo = false, $custom_title = '', $mode = '' ) {
		$logo_main       = fasheno_option( 'rt_logo' );
		$logo_light      = fasheno_option( 'rt_logo_light' );
		$logo_mobile     = fasheno_option( 'rt_logo_mobile' );
		$site_logo       = Opt::$has_tr_header ? $logo_light : $logo_main;
		$mobile_logo     = $logo_mobile ?? $site_logo;
		$has_mobile_logo = ! empty( $logo_mobile ) ? 'has-mobile-logo' : '';
		$site_title      = $custom_title ?: get_bloginfo( 'name', 'display' );

		if('light' == $mode) {
			$logo_main = $logo_light;
		}

		ob_start();
		?>
		<?php if ( $with_logo ) : ?>
			<span class="site-title">
		<?php endif; ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="site logo" class="<?php echo esc_attr( $has_mobile_logo ) ?>">
			<?php
			if ( ! empty( $logo_main || $logo_light ) ) {
				if ( ! empty( $logo_main ) ) {
					echo wp_get_attachment_image(
						$logo_main, 'full', null, [ 'class' => 'rt-site-logo dark-logo'  ]
					);
				}
				if ( ! empty( $logo_light ) ) {
					echo wp_get_attachment_image(
						$logo_light, 'full', null, [ 'class' => 'rt-site-logo light-logo' ]
					);
				}
				if ( ! empty( $mobile_logo ) ) {
					echo wp_get_attachment_image(
						$mobile_logo, 'full', null, [ 'class' => 'rt-mobile-logo' ]
					);
				}
			} else {
				echo esc_html( $site_title );
			}
			?>
		</a>
		<?php if ( $with_logo ) : ?>
			</span>
		<?php endif;

		return ob_get_clean();
	}
}

if ( ! function_exists( 'fasheno_footer_logo' ) ) {
	/**
	 * Newfit Site Logo
	 *
	 */
	function fasheno_footer_logo() {
		$main_logo  = fasheno_option( 'rt_logo' );
		$logo_light = fasheno_option( 'rt_logo_light' );
		$site_logo  = $main_logo;

		if ( 'footer-dark' === Opt::$footer_schema ) {
			$site_logo = $logo_light;
		}

		if ( '2' == Opt::$footer_style && 'schema-default' === Opt::$footer_schema ) {
			$site_logo = $logo_light;
		}

		ob_start();
		?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<?php
			if ( ! empty( $site_logo ) ) {
				echo wp_get_attachment_image( $site_logo, 'full', null, [ 'class' => 'footer-logo' ] );
			} else {
				bloginfo( 'name' );
			}
			?>
		</a>
		<?php
		return ob_get_clean();
	}
}

if ( ! function_exists( 'fasheno_scroll_top' ) ) {
	/**
	 * Back-to-top button
	 * @return void
	 */
	function fasheno_scroll_top( $class = '', $icon = 'scroll-top' ) {
		if ( fasheno_option( 'rt_back_to_top' ) ) {
			?>
			<a href="#" class="scrollToTop <?php echo esc_attr( $class ) ?>"><i class="icon-rt-up-angle-bar"></i></a>
			<?php
		}
	}
}

if ( ! function_exists( 'fasheno_meta_icons' ) ) {
	/**
	 * Get meta icons
	 *
	 * @param $name
	 *
	 * @return string|void
	 */
	function fasheno_meta_icons( $name ) {
		if ( ! $name ) {
			return;
		}
		$icon_list = [
			'author'   => '<i class="icon-rt-user-1"></i>',
			'date'     => '<i class="icon-rt-calendar"></i>',
			'comment'  => '<i class="icon-rt-comments"></i>',
			'category' => '<i class="icon-rt-tag"></i>',
			'tag'      => '<i class="icon-rt-tags"></i>',
			'reading'  => '<i class="icon-rt-clock"></i>',
			'views'    => '<i class="icon-rt-eye"></i>',
		];

		if ( isset( $icon_list[ $name ] ) ) {
			return $icon_list[ $name ];
		}
	}
}

if ( ! function_exists( 'fasheno_reading_time' ) ) {
	/**
	 * Post reading time
	 */
	function fasheno_reading_time() {
		$post_content = get_post()->post_content;
		$post_content = strip_shortcodes( $post_content );
		$post_content = strip_tags( $post_content );
		$word_count   = str_word_count( $post_content );
		$reading_time = floor( $word_count / 200 );

		if ( $reading_time < 1 ) {
			$result = esc_html__( 'Less than a minute', 'fasheno' );
		} elseif ( $reading_time > 60 ) {
			$result = sprintf( esc_html__( '%s hours read', 'fasheno' ), floor( $reading_time / 60 ) );
		} else if ( $reading_time == 1 ) {
			$result = esc_html__( '1 min read', 'fasheno' );
		} else {
			$result = sprintf( esc_html__( '%s mins read', 'fasheno' ), $reading_time );
		}

		return '<span class="meta-reading-time meta-item">' . $result . '</span> ';
	}

}

if( ! class_exists( 'RT_POST_VIEWS' )){
	/**
	 * Post views
	 */

	class RT_POST_VIEWS{
		function __construct(){
			add_action( 'wp_footer',   array( $this, '_set_post_views' ));
		}

		/**
		 * Count number of views
		 */
		function _set_post_views(){

			# Run only if the post views option is set to THEME's post views module ----------
			if( ! is_single() ){
				return;
			}

			# Run only on the first page of the post ----------
			$page = get_query_var( 'paged', 1 );

			if( $page > 1  ){
				return false;
			}

			# Increase number of views +1 ----------
			$count     = 0;
			$post_id   = get_the_ID();
			$count_key = 'rt_post_views';
			$count     = (int) get_post_meta( $post_id, $count_key, true );
			$new_count = $count + 1 ;

			update_post_meta( $post_id, $count_key, (int)$new_count );

		}
	}

	new RT_POST_VIEWS();

}
/*  Display number of views  */
if( !function_exists( 'rt_post_views' )){

	function rt_post_views( $text = '', $post_id = 0 ){

		if( empty( $post_id )){
			$post_id = get_the_ID();
		}

		$views_class = '';
		$formated = 0;
		$count_key = 'rt_post_views';
		$view_count = get_post_meta( $post_id, $count_key, true );
		if ( !empty( $view_count ) ) {
			$formated = number_format_i18n( $view_count );

			if( $view_count > 1000 ){
				$views_class = 'very-high';
			}
			elseif( $view_count > 100 ){
				$views_class = 'high';
			}
			elseif( $view_count > 5 ){
				$views_class = 'rising';
			}
		} else if ( $view_count == '') {
			$view_count = 0;
		} else {
			$view_count = 0;
		}

		if ( $view_count == 1 ) {
			$fasheno_view_html = esc_html__( 'View' , 'fasheno' );
		} else {
			$fasheno_view_html = esc_html__( 'Views' , 'fasheno' );
		}

		$fasheno_views_html = '<span class="view-number" >' . $view_count . '</span> ' . $fasheno_view_html;

		return '<span class="meta-views meta-item '. $views_class .'">'. $fasheno_views_html.'</span> ';
	}
}

if ( ! function_exists( 'fasheno_post_meta' ) ) {
	/**
	 * Get post meta
	 *
	 * @return string
	 */
	function fasheno_post_meta( $args ) {
		$default_args = [
			'with_list'     => true,
			'with_icon'     => true,
			'include'       => [],
			'class'         => '',
			'author_prefix' => __( 'By', 'fasheno' )
		];

		$args = wp_parse_args( $args, $default_args );

		$comments_number = get_comments_number();
		$comments_text   = sprintf( _n( 'Comment: %s', 'Comments: %s', $comments_number, 'fasheno' ), number_format_i18n( $comments_number ) );

		$_meta_data = [];
		$output     = '';

		$_meta_data['author']   = fasheno_posted_by( $args['author_prefix'] );
		$_meta_data['date']     = fasheno_posted_on();
		$_meta_data['category'] = fasheno_posted_in();
		$_meta_data['tag']      = fasheno_posted_in( 'tag' );
		$_meta_data['comment']  = esc_html( $comments_text );
		$_meta_data['reading']  = fasheno_reading_time();
		$_meta_data['views']  	= rt_post_views();

		$meta_list = $args['include'] ?? array_keys( $_meta_data );

		if ( $args['with_list'] ) {
			$output .= '<div class="rt-post-meta ' . $args['class'] . '"><ul class="entry-meta">';
		}
		foreach ( $meta_list as $key ) {
			$meta = $_meta_data[ $key ];
			if ( ! $meta ) {
				continue;
			}
			$output .= ( $args['with_list'] ) ? '<li class="' . $key . '">' : '';
			$output .= $args['with_icon'] ? fasheno_meta_icons( $key ) : null;
			$output .= $meta;
			$output .= ( $args['with_list'] ) ? '</li>' : '';
		}

		if ( $args['with_list'] ) {
			$output .= '</ul></div>';
		}

		return $output;
	}
}


if ( ! function_exists( 'fasheno_post_thumbnail' ) ) {
	/**
	 * Displays post thumbnail.
	 * @return void
	 */
	function fasheno_post_thumbnail( $size = 'full', $thumb_date = false ) {
		if ( ! Fns::can_show_post_thumbnail() ) {
			return;
		}
		?>
		<div class="post-thumbnail-wrap">

		<?php $swiper_data=array(
			'slidesPerView' 	=>1,
			'centeredSlides'	=>false,
			'loop'				=>true,
			'spaceBetween'		=>20,
			'slideToClickedSlide' =>true,
			'slidesPerGroup' => 1,
			'autoplay'				=>array(
				'delay'  => 1,
			),
			'speed'      =>500,
			'breakpoints' =>array(
				'0'    =>array('slidesPerView' =>1),
				'425'    =>array('slidesPerView' =>1),
				'576'    =>array('slidesPerView' =>1),
				'768'    =>array('slidesPerView' =>1),
				'992'    =>array('slidesPerView' =>1),
				'1200'    =>array('slidesPerView' =>1),
				'1600'    =>array('slidesPerView' =>1)
			),
			'auto'   =>false
		);

		$swiper_data = json_encode( $swiper_data );
		$rt_post_gallerys_raw = get_post_meta( get_the_ID(), 'rt_post_gallery', true );
		$rt_post_gallerys = explode( "," , $rt_post_gallerys_raw );
		if ( !empty( $rt_post_gallerys_raw ) && 'gallery' == get_post_format( get_the_ID() ) ) { ?>
			<div class="rt-swiper-slider single-post-slider rt-swiper-nav" data-xld = '<?php echo esc_attr( $swiper_data ); ?>'>
				<div class="swiper-wrapper">
					<?php foreach( $rt_post_gallerys as $rt_posts_gallery ) { ?>
						<div class="swiper-slide">
							<?php echo wp_get_attachment_image( $rt_posts_gallery, $size, "", array( "class" => "img-responsive" ) );
							?>
						</div>
					<?php } ?>
				</div>
				<div class="swiper-navigation">
					<div class="swiper-button swiper-button-prev"><i class="icon-rt-left-arrow"></i></div>
					<div class="swiper-button swiper-button-next"><i class="icon-rt-right-arrow"></i></div>
				</div>
			</div>
		<?php } else { ?>
			<figure class="post-thumbnail">
				<a class="post-thumb-link alignwide" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1"><?php the_post_thumbnail( $size ); ?></a>
			</figure><!-- .post-thumbnail -->

			<?php $rt_youtube_link = get_post_meta( get_the_ID(), 'rt_youtube_link', true );
			if ( fasheno_option( 'rt_video_visibility' ) == 1 && ( 'video' == get_post_format( get_the_ID() ) ) && !empty( $rt_youtube_link ) ) { ?>
				<div class="rt-video"><a class="popup-youtube video-popup-icon" href="<?php echo esc_url( $rt_youtube_link );?>"><i class="icon-rt-play"></i></a></div>
			<?php } ?>
		<?php } ?>

		</div>
		<?php
	}
}

if ( ! function_exists( 'fasheno_post_single_thumbnail' ) ) {
	/**
	 * Display post details thumbnail
	 * @return void
	 */
	function fasheno_post_single_thumbnail( $size = 'full' ) {
		if ( ! Fns::can_show_post_thumbnail() ) {
			return;
		}
		?>
		<div class="post-thumbnail-wrap single-post-thumbnail">
		<?php $swiper_data=array(
			'slidesPerView' 	=>1,
			'centeredSlides'	=>false,
			'loop'				=>true,
			'spaceBetween'		=>20,
			'slideToClickedSlide' =>true,
			'slidesPerGroup' => 1,
			'autoplay'				=>array(
				'delay'  => 1,
			),
			'speed'      =>500,
			'breakpoints' =>array(
				'0'    =>array('slidesPerView' =>1),
				'425'    =>array('slidesPerView' =>1),
				'576'    =>array('slidesPerView' =>1),
				'768'    =>array('slidesPerView' =>1),
				'992'    =>array('slidesPerView' =>1),
				'1200'    =>array('slidesPerView' =>1),
				'1600'    =>array('slidesPerView' =>1)
			),
			'auto'   =>false
		);

		$swiper_data = json_encode( $swiper_data );
		$rt_post_gallerys_raw = get_post_meta( get_the_ID(), 'rt_post_gallery', true );
		$rt_post_gallerys = explode( "," , $rt_post_gallerys_raw );
		if ( !empty( $rt_post_gallerys_raw ) && 'gallery' == get_post_format( get_the_ID() ) ) { ?>
			<div class="rt-swiper-slider single-post-slider rt-swiper-nav" data-xld = '<?php echo esc_attr( $swiper_data ); ?>'>
				<div class="swiper-wrapper">
					<?php foreach( $rt_post_gallerys as $rt_posts_gallery ) { ?>
						<div class="swiper-slide">
							<?php echo wp_get_attachment_image( $rt_posts_gallery, $size, "", array( "class" => "img-responsive" ) );
							?>
						</div>
					<?php } ?>
				</div>
				<div class="swiper-navigation">
					<div class="swiper-button swiper-button-prev"><i class="icon-rt-left-arrow"></i></div>
					<div class="swiper-button swiper-button-next"><i class="icon-rt-right-arrow"></i></div>
				</div>
			</div>
		<?php } else { ?>
			<figure class="post-thumbnail">
				<?php the_post_thumbnail( $size ); ?>
				<?php edit_post_link( 'Edit' ); ?>
			</figure><!-- .post-thumbnail -->
			<?php if ( wp_get_attachment_caption( get_post_thumbnail_id() ) && fasheno_option( 'rt_single_caption_visibility' ) == 1 ) : ?>
				<figcaption class="wp-caption-text">
					<span><?php fasheno_html( wp_get_attachment_caption( get_post_thumbnail_id() ) ); ?></span>
				</figcaption>
			<?php endif; ?>
		<?php } ?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'fasheno_entry_footer' ) ) {
	/**
	 * Fasheno Entry Footer
	 *
	 * @return void
	 *
	 */
	function fasheno_entry_footer() {
		if ( ! is_single() ) {
			if ( fasheno_option( 'rt_blog_footer_visibility' ) ) { ?>
				<footer class="entry-footer rt-button">
					<a class="btn button-4" href="<?php echo esc_url( get_permalink() ) ?>"><i class="icon-rt-right-arrow"></i><span><?php echo fasheno_readmore_text() ?></span>
					</a>
				</footer>
			<?php }
		} else {
			if ( ( has_tag() && fasheno_option( 'rt_single_tag_visibility' ) ) || fasheno_option( 'rt_single_share_visibility' ) ) { ?>
				<footer class="entry-footer d-flex align-items-center justify-content-between">
					<?php if ( fasheno_option( 'rt_single_tag_visibility' ) ) { ?>
						<div class="post-tags">
							<?php if ( $tags_label = fasheno_option( 'rt_tags' ) ) {
								printf( "<span class='rt-title tags-title'>%s</span>", esc_html( $tags_label ) );
							} ?>

							<?php
							fasheno_single_post_footer_meta(
								'content-below-meta', [ 'tag' ]
							);
							?>
						</div>
					<?php }
					if ( fasheno_option( 'rt_single_share_visibility' ) ) { ?>
						<div class="post-share">
							<?php if ( $tags_label = fasheno_option( 'rt_social' ) ) {
								printf( "<span class='rt-title share-title'>%s</span>", esc_html( $tags_label ) );
							} ?>
							<?php PostShare::fasheno_post_share(); ?>
						</div>
					<?php } ?>
				</footer>
				<?php
			}
		}
	}
}
// single video
if ( ! function_exists( 'fasheno_post_single_video' ) ) {
	/**
	 * Display post details video
	 * @return void
	 */
	function fasheno_post_single_video() { ?>
		<?php $rt_youtube_link = get_post_meta( get_the_ID(), 'rt_youtube_link', true );
		if ( ( function_exists( 'get_post_format' ) && 'video' == get_post_format( get_the_ID() ) && !empty( $rt_youtube_link ) )  ) {
			preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $rt_youtube_link, $match);
			$youtube_id = $match[1];
		} ?>
		<?php if ( !empty($youtube_id) ) { ?>
			<?php if ( ( function_exists( 'get_post_format' ) && 'video' == get_post_format( get_the_ID() ) )  ) { ?>
				<div class="entry-video-area embed-responsive-16by9">
					<div class="embed-responsive">
						<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo esc_attr( $youtube_id ); ?>" allowfullscreen></iframe>
					</div>
				</div>
			<?php } ?>
		<?php } ?>
		<?php
	}
}


if ( ! function_exists( 'fasheno_entry_profile' ) ) {
	/**
	 * Fasheno Entry Profile
	 *
	 * @return void
	 *
	 */
	function fasheno_entry_profile() {
		if ( fasheno_option( 'rt_single_profile_visibility' ) ) {
			$author = get_current_user_id();
			$prof_fb = get_user_meta( $author, 'rt_facebook', true );
			$prof_tw = get_user_meta( $author, 'rt_twitter', true );
			$prof_lk = get_user_meta( $author, 'rt_linkedin', true );
			$prof_vim = get_user_meta( $author, 'rt_vimeo', true );
			$prof_you = get_user_meta( $author, 'rt_youtube', true );
			$prof_ins = get_user_meta( $author, 'rt_instagram', true );
			$prof_pin = get_user_meta( $author, 'rt_pinterest', true );
			$prof_wht = get_user_meta( $author, 'rt_whatsapp', true );

			$prof_description = get_user_meta( $author, 'description', true );
			$prof_designation = get_user_meta( $author, 'rt_designation', true );
			$prof_phone = get_user_meta( $author, 'rt_phone', true );

			?>
			<?php if ( !empty ( $prof_description ) ) { ?>
				<div class="profile-author">
					<div class="profile-thumb">
						<?php echo get_avatar( $author, 105 ); ?>
					</div>
					<div class="profile-content">
						<div class="profile-author-info">
							<h3 class="profile-title"><?php the_author_posts_link();?></h3>
							<div class="profile-info">
								<span class="profile-designation">
									<?php if ( !empty ( $prof_designation ) ) {
										echo esc_html( $prof_designation );
									} else {
										$user_info = get_userdata( $author );
										echo esc_html ( implode( ', ', $user_info->roles ) );	} ?>
								</span>
								<?php if ( $prof_phone ) { ?>
									<span class="profile-phone"><?php echo esc_html__( 'Ph: ', 'fasheno' ) ?><?php echo esc_html( $prof_phone );?></span>
								<?php } ?>
							</div>
						</div>

						<?php if ( $prof_description ) { ?>
							<div class="author-bio"><?php echo esc_html( $prof_description );?></div>
						<?php } ?>
						<ul class="profile-author-social">
							<?php if ( ! empty( $prof_fb ) ){ ?><li><a href="<?php echo esc_attr( $prof_fb ); ?>"><i class="icon-rt-facebook"></i></a></li><?php } ?>
							<?php if ( ! empty( $prof_tw ) ){ ?><li><a href="<?php echo esc_attr( $prof_tw ); ?>"><i class="icon-rt-x-twitter"></i></a></li><?php } ?>
							<?php if ( ! empty( $prof_lk ) ){ ?><li><a href="<?php echo esc_attr( $prof_lk ); ?>"><i class="icon-rt-linkedin"></i></a></li><?php } ?>
							<?php if ( ! empty( $prof_vim ) ){ ?><li><a href="<?php echo esc_attr( $prof_vim ); ?>"><i class="icon-rt-vine"></i></a></li><?php } ?>
							<?php if ( ! empty( $prof_you ) ){ ?><li><a href="<?php echo esc_attr( $prof_you ); ?>"><i class="icon-rt-youtube-2"></i></a></li><?php } ?>
							<?php if ( ! empty( $prof_ins ) ){ ?><li><a href="<?php echo esc_attr( $prof_ins ); ?>"><i class="icon-rt-instagram"></i></a></li><?php } ?>
							<?php if ( ! empty( $prof_pin ) ){ ?><li><a href="<?php echo esc_attr( $prof_pin ); ?>"><i class="icon-rt-pinterest"></i></a></li><?php } ?>
							<?php if ( ! empty( $prof_wht ) ){ ?><li><a href="<?php echo esc_attr( $prof_wht ); ?>"><i class="icon-rt-whatsapp"></i></a></li><?php } ?>
						</ul>
					</div>
				</div>
			<?php } ?>
		<?php }
	}
}


if ( ! function_exists( 'fasheno_single_post_footer_meta' ) ) {
	/**
	 * Get single post footer meta
	 *
	 * @return string
	 */
	function fasheno_single_post_footer_meta( $class = '', $includes = [ 'tag' ] ) {
		if ( is_single() && fasheno_option( 'rt_single_tag_visibility' ) ) : ?>
			<div class="post-footer-meta <?php echo esc_attr( $class ) ?>">
				<?php echo fasheno_post_meta( [
					'with_list' => false,
					'with_icon' => false,
					'include'   => $includes,
				] ); ?>
			</div>
		<?php
		endif;
	}
}
if ( ! function_exists( 'fasheno_entry_content' ) ) {
	/**
	 * Entry Content
	 * @return void
	 */
	function fasheno_entry_content() {
		if ( ! is_single() ) {
			$length = fasheno_option( 'rt_excerpt_limit' );
			echo wp_trim_words( get_the_excerpt(), $length );
		} else {
			the_content();
		}
	}
}

if ( ! function_exists( 'fasheno_sidebar' ) ) {
	/**
	 * Get Sidebar conditionally
	 *
	 * @param $sidebar_id
	 *
	 * @return false|void
	 */
	function fasheno_sidebar( $sidebar_id ) {
		$sidebar_from_layout = Opt::$sidebar;


		if ( 'default' !== $sidebar_from_layout && is_active_sidebar( $sidebar_from_layout ) ) {
			$sidebar_id = $sidebar_from_layout;
		}
		if ( ! is_active_sidebar( $sidebar_id ) ) {
			return false;
		}

		if ( Opt::$layout == 'full-width' ) {
			return false;
		}

		$sidebar_cols = Fns::sidebar_columns();
		?>
		<aside id="sidebar" class="fasheno-widget-area sidebar-sticky <?php echo esc_attr( $sidebar_cols ) ?>"
			   role="complementary">
			<?php dynamic_sidebar( $sidebar_id ); ?>
		</aside><!-- #sidebar -->
		<?php
	}
}


if ( ! function_exists( 'fasheno_post_class' ) ) {
	/**
	 * Get dynamic article classes
	 * @return string
	 */
	function fasheno_post_class( $default_class = 'fasheno-post-card rt-grid-item' ) {
		$above_meta_style = 'above-' . fasheno_option( 'rt_single_above_meta_style' );


		$common_clsss = '';
		if ( is_single() ) {
			$common_clsss .= fasheno_option( 'rt_single_above_meta_visibility' ) ? 'is-above-meta' : 'no-above-meta';
			$meta_style   = fasheno_option( 'rt_single_meta_style' );
			$post_classes = Fns::class_list( [ $common_clsss, $meta_style, $above_meta_style ] );
		} else {
			$common_clsss .= fasheno_option( 'rt_blog_above_meta_visibility' ) ? 'is-above-meta' : 'no-above-meta';
			$meta_style   = fasheno_option( 'rt_blog_meta_style' );
			$blog_style   = 'blog-' . fasheno_option( 'rt_blog_style' );
			$post_classes = Fns::class_list( [
				$common_clsss,
				$meta_style,
				$blog_style,
				$above_meta_style,
				Fns::blog_column()
			] );
		}

		if ( $default_class ) {
			return $post_classes . ' ' . $default_class;
		}

		return $post_classes;
	}
}

if ( ! function_exists( 'fasheno_separate_meta' ) ) {
	/**
	 * Get above title meta
	 * @return string
	 */
	function fasheno_separate_meta( $class = '', $includes = [ 'category' ] ) {
		if ( ( ! is_single() && fasheno_option( 'rt_blog_above_meta_visibility' ) ) || ( is_single() && fasheno_option( 'rt_single_above_meta_visibility' ) ) ) : ?>
		<div class="separate-meta <?php echo esc_attr( $class ) ?>">
			<?php echo fasheno_post_meta( [
				'with_list' => false,
				'with_icon' => false,
				'include'   => $includes,
			] ); ?>
			</div><?php
		endif;
	}
}

if ( ! function_exists( 'fasheno_single_entry_header' ) ) {
	/**
	 * Get above title meta
	 * @return string
	 */
	function fasheno_single_entry_header() {
		?>
		<header class="entry-header">
			<?php
			fasheno_separate_meta( 'title-above-meta' );

			if ( ! Opt::$breadcrumb_title ) {
				the_title( '<h1 class="entry-title default-max-width">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title default-max-width">', '</h2>' );
			}

			if ( ! empty( Fns::single_meta_lists() ) && fasheno_option( 'rt_single_meta_visibility' ) ) {
				echo fasheno_post_meta( [
					'with_list'     => true,
					'include'       => Fns::single_meta_lists(),
					'author_prefix' => fasheno_option( 'rt_author_prefix' ),
				] );
			}
			?>
		</header>
		<?php
	}
}

if ( ! function_exists( 'fasheno_breadcrumb' ) ) {
	/**
	 * Fasheno breadcrumb
	 * @return void
	 */
	function fasheno_breadcrumb() {
		?>
		<nav aria-label="breadcrumb">
			<ul class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="<?php echo esc_url( home_url() ); ?>"><?php esc_html_e( 'Home', 'fasheno' ) ?></a>
					<span class="raquo"><i class="icon-rt-user-datalist-feature"></i></span>
				</li>
				<li class="breadcrumb-item active" aria-current="page">
					<?php
					if ( is_tag() ) {
						esc_html_e( 'Posts Tagged: ', 'fasheno' );
						?>
						<span class="title"><?php single_tag_title(); ?></span>
						<?php

					} elseif ( is_day() || is_month() || is_year() ) {
						echo '<span class="title">';
						esc_html_e( 'Posts made in: ', 'fasheno' );
						echo esc_html( get_the_time( is_year() ? 'Y' : ( is_month() ? 'F, Y' : 'F jS, Y' ) ) );
						echo '</span>';
					} elseif ( is_search() ) {
						echo '<span class="title">';
						esc_html_e( 'Search results for: ', 'fasheno' );
						the_search_query();
						echo '</span>';
					} elseif ( is_404() ) {
						echo '<span class="title">';
						esc_html_e( '404', 'fasheno' );
						echo '</span>';
					} elseif ( is_single() ) {
						$category = get_the_category();
						if ( $category ) {
							$catlink = get_category_link( $category[0]->cat_ID );
							echo '<a href="' . esc_url( $catlink ) . '">' . esc_html( $category[0]->cat_name ) . '</a> <span class="raquo"><i class="icon-rt-user-datalist-feature"></i></span> ';
						}
						echo '<span class="title">';
						echo get_the_title();
						echo '</span>';
					} elseif ( is_category() ) {
						esc_html_e( 'Posts Category: ', 'fasheno' );
						echo '<span class="title">';
						single_cat_title();
						echo '</span>';
					} elseif ( is_tax() ) {
						$tt_taxonomy_links = [];
						$tt_term           = get_queried_object();
						$tt_term_parent_id = $tt_term->parent;
						$tt_term_taxonomy  = $tt_term->taxonomy;

						while ( $tt_term_parent_id ) {
							$tt_current_term     = get_term( $tt_term_parent_id, $tt_term_taxonomy );
							$tt_taxonomy_links[] = '<a href="' . esc_url( get_term_link( $tt_current_term, $tt_term_taxonomy ) ) . '" title="' . esc_attr( $tt_current_term->name ) . '">' . esc_html( $tt_current_term->name ) . '</a>';
							$tt_term_parent_id   = $tt_current_term->parent;
						}

						if ( ! empty( $tt_taxonomy_links ) ) {
							echo implode( ' <span class="raquo">/</span> ', array_reverse( $tt_taxonomy_links ) ) . ' <span class="raquo"><i class="icon-rt-user-datalist-feature"></i></span> ';
						}

						echo '<span class="title">';
						echo esc_html( $tt_term->name );
						echo '</span>';
					} elseif ( is_author() ) {
						global $wp_query;
						$current_author = $wp_query->get_queried_object();

						echo '<span class="title">';
						esc_html_e( 'Posts by: ', 'fasheno' );
						echo ' ', esc_html( $current_author->nickname );
						echo '</span>';
					} elseif ( is_page() ) {
						echo '<span class="title">';
						echo get_the_title();
						echo '</span>';
					} elseif ( is_home() ) {
						echo '<span class="title">';
						esc_html_e( 'Blog', 'fasheno' );
						echo '</span>';
					} elseif ( class_exists( 'WooCommerce' ) and is_shop() ) {
						echo '<span class="title">';
						esc_html_e( 'Shop', 'fasheno' );
						echo '</span>';
					}
					?>
				</li>
			</ul>
		</nav>
		<?php
	}
}

if ( ! function_exists( 'fasheno_get_avatar_url' ) ) :
	function fasheno_get_avatar_url( $get_avatar ) {
		preg_match( "/src='(.*?)'/i", $get_avatar, $matches );

		return $matches[1];
	}
endif;


function fasheno_comments_cbf( $comment, $args, $depth ) {

	// Get correct tag used for the comments
	if ( 'div' === $args['style'] ) {
		$tag       = 'div ';
		$add_below = 'comment';
	} else {
		$tag       = 'li ';
		$add_below = 'div-comment';
	} ?>

	<<?php echo esc_attr($tag); ?><?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>">

	<?php
	// Switch between different comment types
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' : ?>
			<div class="pingback-entry"><span
					class="pingback-heading"><?php esc_html_e( 'Pingback:', 'fasheno' ); ?></span> <?php comment_author_link(); ?>
			</div>
			<?php
			break;
		default :

			if ( 'div' != $args['style'] ) { ?>
				<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
			<?php } ?>
			<div class="comment-author">
				<div class="vcard">
					<?php
					// Display avatar unless size is set to 0
					if ( $args['avatar_size'] != 0 ) {
						$avatar_size = ! empty( $args['avatar_size'] ) ? $args['avatar_size'] : 70; // set default avatar size
						echo get_avatar( $comment, $avatar_size );
					} ?>
				</div>
				<div class="author-info">
					<?php
					// Display author name
					printf( __( '<cite class="fn">%s</cite>', 'fasheno' ), get_comment_author_link() ); ?>

					<div class="comment-meta commentmetadata">
						<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php
							/* translators: 1: date, 2: time */
							printf(
								__( '%1$s at %2$s', 'fasheno' ),
								get_comment_date(),
								get_comment_time()
							); ?>
						</a><?php
						edit_comment_link( __( 'Edit', 'fasheno' ), '  ', '' ); ?>
					</div><!-- .comment-meta -->
					<div class="comment-details">

						<div class="comment-text"><?php comment_text(); ?></div><!-- .comment-text -->
						<?php
						// Display comment moderation text
						if ( $comment->comment_approved == '0' ) { ?>
							<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'fasheno' ); ?></em>
							<br/><?php
						} ?>

						<?php
						$icon = fasheno_get_svg( 'share' );
						// Display comment reply link
						comment_reply_link( array_merge( $args, [
							'add_below'  => $add_below,
							'depth'      => $depth,
							'max_depth'  => $args['max_depth'],
							'reply_text' => $icon . __( 'Reply', 'fasheno' )
						] ) ); ?>

					</div><!-- .comment-details -->
				</div>

			</div><!-- .comment-author -->

			<?php
			if ( 'div' != $args['style'] ) { ?>
				</div>
			<?php }
			// IMPORTANT: Note that we do NOT close the opening tag, WordPress does this for us
			break;
	endswitch; // End comment_type check.
}


if ( ! function_exists( 'fasheno_hanburger' ) ) {

	/**
	 * Newsfit hanburger
	 *
	 * @param $class
	 *
	 * @return void
	 */
	function fasheno_hanburger( $class = '' ) {
		?>
		<li class="ham-burger <?php echo esc_attr( $class ) ?>">
			<button type="button" class="menu-bar trigger-off-canvas" aria-label="hamburger menu">
				<?php if( fasheno_option('rt_get_menu_label') ) { ?>
					<span class="menu-label"><?php echo esc_html( fasheno_option('rt_get_menu_label') ) ?></span>
				<?php } ?>
				<span class="btn-hamburger">
					<span></span>
					<span></span>
					<span></span>
				</span>
			</button>
		</li>
		<?php
	}
}
