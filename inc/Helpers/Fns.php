<?php

namespace RT\Fasheno\Helpers;

use RT\Fasheno\Core\Sidebar;
use RT\Fasheno\Options\Opt;

/**
 * Extras.
 */
class Fns {

	/**
	 * Filters whether post thumbnail can be displayed.
	 *
	 * @param bool $show_post_thumbnail Whether to show post thumbnail.
	 *
	 */
	public static function can_show_post_thumbnail() {
		return apply_filters(
			'fasheno_can_show_post_thumbnail',
			! post_password_required() && ! is_attachment() && has_post_thumbnail()
		);
	}

	/**
	 * Social icon for the site
	 * @return mixed|null
	 */
	public static function get_socials() {
		return apply_filters( 'fasheno_socials_icon', [
			'facebook'  => [
				'title' => __( 'Facebook', 'fasheno' ),
				'url'   => fasheno_option( 'facebook' ),
			],
			'twitter'   => [
				'title' => __( 'Twitter', 'fasheno' ),
				'url'   => fasheno_option( 'twitter' ),
			],
			'linkedin'  => [
				'title' => __( 'Linkedin', 'fasheno' ),
				'url'   => fasheno_option( 'linkedin' ),
			],
			'youtube'   => [
				'title' => __( 'Youtube', 'fasheno' ),
				'url'   => fasheno_option( 'youtube' ),
			],
			'pinterest' => [
				'title' => __( 'Pinterest', 'fasheno' ),
				'url'   => fasheno_option( 'pinterest' ),
			],
			'instagram' => [
				'title' => __( 'Instagram', 'fasheno' ),
				'url'   => fasheno_option( 'instagram' ),
			],
			'skype'     => [
				'title' => __( 'Skype', 'fasheno' ),
				'url'   => fasheno_option( 'skype' ),
			],
			'tiktok'    => [
				'title' => __( 'TikTok', 'fasheno' ),
				'url'   => fasheno_option( 'tiktok' ),
			],
		] );

	}

	/**
	 * Social icon for the site
	 * @return mixed|null
	 */
	public static function get_team_socials() {
		return apply_filters( 'fasheno_team_socials', array(
			'facebook'      => array(
				'label' => esc_html__( 'Facebook', 'fasheno' ),
				'type'  => 'text',
				'icon'  => 'icon-rt-facebook',
			),
			'twitter'       => array(
				'label' => esc_html__( 'Twitter', 'fasheno' ),
				'type'  => 'text',
				'icon'  => 'icon-rt-x-twitter',
			),
			'linkedin'      => array(
				'label' => esc_html__( 'Linkedin', 'fasheno' ),
				'type'  => 'text',
				'icon'  => 'icon-rt-linkedin',
			),
			'skype'         => array(
				'label' => esc_html__( 'Skype', 'fasheno' ),
				'type'  => 'text',
				'icon'  => 'icon-rt-skype',
			),
			'youtube'       => array(
				'label' => esc_html__( 'Youtube', 'fasheno' ),
				'type'  => 'text',
				'icon'  => 'icon-rt-youtube',
			),
			'pinterest'     => array(
				'label' => esc_html__( 'Pinterest', 'fasheno' ),
				'type'  => 'text',
				'icon'  => 'icon-rt-pinterest',
			),
			'instagram'     => array(
				'label' => esc_html__( 'Instagram', 'fasheno' ),
				'type'  => 'text',
				'icon'  => 'icon-rt-instagram',
			),
		) );

	}

	/**
	 * Get Sidebar lists
	 *
	 * @return array
	 */
	public static function sidebar_lists( $default_title = null ) {
		$sidebar_fields            = [];
		$sidebar_fields['default'] = $default_title ?? esc_html__( 'Choose Sidebar', 'fasheno' );

		foreach ( self::default_sidebar() as $id => $sidebar ) {
			$sidebar_fields[ $sidebar['id'] ] = $sidebar['name'];
		}

		return $sidebar_fields;
	}

	/**
	 * Get image presets
	 *
	 * @param $name
	 * @param int $total
	 * @param string $type
	 *
	 * @return array
	 */
	public static function image_placeholder( $name, $total = 1, $type = 'png' ) {
		$presets = [];
		for ( $i = 1; $i <= $total; $i ++ ) {
			$image_name    = "$name-$i.$type";
			$presets[ $i ] = [
				'image' => fasheno_get_img( $image_name ),
				'name'  => __( 'Style', 'fasheno' ) . ' ' . $i,
			];
		}

		return apply_filters( 'fasheno_image_placeholder', $presets );
	}


	/**
	 * Convert HEX to RGB color
	 *
	 * @param $hex
	 *
	 * @return string
	 */
	public static function hex2rgb( $hex ) {
		$hex = str_replace( "#", "", $hex );
		if ( strlen( $hex ) == 3 ) {
			$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
			$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
			$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
		} else {
			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex, 4, 2 ) );
		}
		$rgb = "$r, $g, $b";

		return $rgb;
	}

	/**
	 * Modify Color
	 * Add positive or negative $steps. Ex: 30, -50 etc
	 *
	 * @param $hex
	 * @param $steps
	 *
	 * @return string
	 */
	public static function modify_color( $hex, $steps ) {
		$steps = max( - 255, min( 255, $steps ) );
		// Format the hex color string
		$hex = str_replace( '#', '', $hex );
		if ( strlen( $hex ) == 3 ) {
			$hex = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
		}
		// Get decimal values
		$r = hexdec( substr( $hex, 0, 2 ) );
		$g = hexdec( substr( $hex, 2, 2 ) );
		$b = hexdec( substr( $hex, 4, 2 ) );
		// Adjust number of steps and keep it inside 0 to 255
		$r     = max( 0, min( 255, $r + $steps ) );
		$g     = max( 0, min( 255, $g + $steps ) );
		$b     = max( 0, min( 255, $b + $steps ) );
		$r_hex = str_pad( dechex( $r ), 2, '0', STR_PAD_LEFT );
		$g_hex = str_pad( dechex( $g ), 2, '0', STR_PAD_LEFT );
		$b_hex = str_pad( dechex( $b ), 2, '0', STR_PAD_LEFT );

		return '#' . $r_hex . $g_hex . $b_hex;
	}


	/**
	 * Return Sidebar Column
	 * @return string
	 */
	public static function sidebar_columns() {
		$columns = "col-xl-4";

		return $columns;
	}

	/**
	 * Return content columns
	 * @return string
	 */
	public static function content_columns( $full_width_col = 'col-12' ) {
		$sidebar = Opt::$sidebar === 'default' ? 'rt-sidebar' : Opt::$sidebar;
		$columns = ! is_active_sidebar( $sidebar ) ? $full_width_col : 'col-xl-8';
		if ( Opt::$layout === 'full-width' ) {
			$columns = $full_width_col;
		}

		return $columns;
	}

	public static function single_content_colums() {
		$sidebar = Opt::$sidebar === 'default' ? 'rt-single-sidebar' : Opt::$sidebar;
		$columns = is_active_sidebar( $sidebar ) ? "col-xl-8" : "col-xl-10 col-md-offset-1";

		if ( Opt::$layout === 'full-width' ) {
			$columns = "col-xl-10 col-md-offset-1";
		}

		return $columns;
	}

	public static function product_single_columns( $full_width_col = 'col-12' ) {
		$sidebar = Opt::$sidebar === 'default' ? 'rt-single-sidebar' : Opt::$sidebar;
		$columns = ! is_active_sidebar( $sidebar ) ? $full_width_col : 'col-xl-8';
		if ( Opt::$layout === 'full-width' ) {
			$columns = $full_width_col;
		}

		return $columns;
	}


	/**
	 * Get blog colum
	 * @return mixed|string
	 */
	public static function blog_column() {
		if ( ! empty( $_REQUEST['column'] ) ) {
			return sanitize_text_field( $_REQUEST['column'] );
		}
		$blog_colum_opt = fasheno_option( 'rt_blog_column' ) !== 'default' ? fasheno_option( 'rt_blog_column' ) : '';
		$blog_sidebar   = Opt::$sidebar === 'default' ? 'rt-sidebar' : Opt::$sidebar;
		$blog_layout    = Opt::$layout ?? 'right-sidebar';

		$output = 'col-lg-4';
		if ( $blog_colum_opt ) {
			$output = $blog_colum_opt;
		} elseif ( fasheno_option( 'rt_blog_style' ) === 'list' ) {
			$output = 'col-lg-12';
		} elseif ( in_array( $blog_layout, [
				'left-sidebar',
				'right-sidebar'
			] ) && is_active_sidebar( $blog_sidebar ) ) {
			$output = 'col-lg-6';
		}

		return $output;
	}

	/**
	 * Get all post type
	 * @return array
	 */
	public static function get_post_types() {
		$post_types = get_post_types(
			[
				'public' => true,
			],
			'objects'
		);
		$post_types = wp_list_pluck( $post_types, 'label', 'name' );

		$exclude = apply_filters( 'fasheno_exclude_post_type', [
			'attachment',
			'revision',
			'nav_menu_item',
			'elementor_library',
			'tpg_builder',
			'e-landing-page',
			'elementor-fasheno'
		] );

		foreach ( $exclude as $ex ) {
			unset( $post_types[ $ex ] );
		}

		return $post_types;
	}

	/**
	 * Meta Style
	 * @return array
	 */
	public static function meta_style( $exclude = [] ) {
		$meta_style = [
			'meta-style-default' => __( 'Default From Theme', 'fasheno' ),
			'meta-style-border'  => __( 'Border Style', 'fasheno' ),
			'meta-style-dash'    => __( 'Before Dash ( — )', 'fasheno' ),
			'meta-style-dash-bg' => __( 'Before Dash with BG ( — )', 'fasheno' ),
			'meta-style-pipe'    => __( 'After Pipe ( | )', 'fasheno' ),
		];

		if ( ! empty( $exclude ) && is_array( $exclude ) ) {
			foreach ( $exclude as $item ) {
				unset( $meta_style[ $item ] );
			}
		}

		return $meta_style;
	}

	/**
	 * Single Style
	 * @return array
	 */
	public static function single_post_style( $exclude = [] ) {
		$meta_style = [
			'1' => __( 'Style 1 (Default From Theme)', 'fasheno' ),
			'2' => __( 'Style 2 (Container Width Thumb)', 'fasheno' ),
			'3' => __( 'Style 3 (Content Over on Thumb)', 'fasheno' ),
			'4' => __( 'Style 4 (Meta Upper Thumb)', 'fasheno' ),
		];

		if ( ! empty( $exclude ) && is_array( $exclude ) ) {
			foreach ( $exclude as $item ) {
				unset( $meta_style[ $item ] );
			}
		}

		return $meta_style;
	}

	/**
	 * Blog Meta Style
	 * @return array
	 */
	public static function blog_meta_list() {
		return [
			'author'   => __( 'Author', 'fasheno' ),
			'date'     => __( 'Date', 'fasheno' ),
			'category' => __( 'Category', 'fasheno' ),
			'tag'      => __( 'Tag', 'fasheno' ),
			'comment'  => __( 'Comment', 'fasheno' ),
			'reading'  => __( 'Reading', 'fasheno' ),
			'views'  => __( 'Views', 'fasheno' ),
		];
	}

	/**
	 * Post Social Meta
	 * @return array
	 */
	public static function post_share_list() {
		return [
			'facebook'  => __( 'Facebook', 'fasheno' ),
			'twitter'   => __( 'Twitter X', 'fasheno' ),
			'linkedin'  => __( 'Linkedin', 'fasheno' ),
			'pinterest' => __( 'Pinterest', 'fasheno' ),
			'whatsapp'  => __( 'Whatsapp', 'fasheno' ),
			'youtube'   => __( 'Youtube', 'fasheno' ),
		];
	}

	public static function is_single_fullwidth() {
		if ( in_array( Opt::$single_style, [
			'rt-single-top-thumb',
			'rt-single-transparent',
			'rt-single-content-on-thumb'
		] ) ) {
			return true;
		}

		return false;
	}


	public static function single_meta_lists() {
		$meta_list = fasheno_option( 'rt_single_meta', '', true );
		if ( fasheno_option( 'rt_single_above_meta_visibility' ) ) {
			$category_index = array_search( 'category', $meta_list );
			unset( $meta_list[ $category_index ] );
		}

		return $meta_list;
	}

	/**
	 * Class list
	 *
	 * @param $clsses
	 *
	 * @return string
	 */
	public static function class_list( $clsses ): string {
		return implode( ' ', $clsses );
	}

	/**
	 * Get all default sidebar args for theme
	 *
	 * @param $id
	 *
	 * @return array|mixed|null
	 */
	public static function default_sidebar( $id = '' ) {
		$sidebar_lists = [
			'main'   => [
				'id'    => 'rt-sidebar',
				'name'  => __( 'Main Sidebar', 'fasheno' ),
				'class' => 'rt-sidebar',
			],
			'single' => [
				'id'    => 'rt-single-sidebar',
				'name'  => __( 'Single Sidebar', 'fasheno' ),
				'class' => 'rt-single-sidebar',
			],
			'footer' => [
				'id'    => 'rt-footer-sidebar',
				'name'  => 'Footer Sidebar',
				'class' => 'footer-sidebar col-lg-3 col-md-6',
			],
		];
		if ( class_exists( 'WooCommerce' ) ) {
			$sidebar_lists['woo-archive'] = [
				'id'    => 'rt-woo-archive-sidebar',
				'name'  => __( 'WooCommerce Archive Sidebar', 'fasheno' ),
				'class' => 'woo-archive-sidebar',
			];
			$sidebar_lists['woo-single']  = [
				'id'    => 'rt-woo-single-sidebar',
				'name'  => __( 'WooCommerce Single Sidebar', 'fasheno' ),
				'class' => 'woo-single-sidebar',
			];
		}
		$sidebar_lists = apply_filters( 'fasheno_sidebar_lists', $sidebar_lists );
		if ( ! $id ) {
			return $sidebar_lists;
		}
		if ( isset( $sidebar_lists[ $id ] ) ) {
			return $sidebar_lists[ $id ]['id'];
		}

		return [];
	}

	/*shop archive grid action*/
	public static function shop_grid_page_url() {
		global $wp;
		$current_url = add_query_arg($wp->query_string, '&displayview=grid', home_url($wp->request));
		return $current_url;
	}
	public static function shop_list_page_url() {
		global $wp;
		$current_url = add_query_arg($wp->query_string, '&displayview=list', home_url($wp->request));
		return $current_url;
	}

	public static function fasheno_shop_icons_enable(  ) {
		return fasheno_option( 'rt_header_compare' ) || fasheno_option( 'rt_header_wishlist' ) || fasheno_option( 'rt_header_add_to_cart' ) ? true:false;
	}
}
