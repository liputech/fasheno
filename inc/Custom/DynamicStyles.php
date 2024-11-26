<?php

namespace RT\Fasheno\Custom;

use RT\Fasheno\Helpers\Fns;
use RT\Fasheno\Options\Opt;
use RT\Fasheno\Traits\SingletonTraits;

class DynamicStyles {

	use SingletonTraits;

	protected $meta_data;

	public function __construct() {
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ], 30 );
	}

	public function enqueue_scripts() {
		$this->meta_data = get_post_meta( get_the_ID(), "rt_layout_meta_data", true );
		$dynamic_css     = $this->inline_style();
		wp_register_style( 'fasheno-dynamic', false, 'fasheno-main' );
		wp_enqueue_style( 'fasheno-dynamic' );
		wp_add_inline_style( 'fasheno-dynamic', $this->minify_css( $dynamic_css ) );
	}

	function minify_css( $css ) {
		$css = preg_replace( '/\/\*[^*]*\*+([^\/][^*]*\*+)*\//', '', $css ); // Remove comments
		$css = preg_replace( '/\s+/', ' ', $css ); // Remove multiple spaces
		$css = preg_replace( '/\s*([\{\};])\s*/', '$1', $css ); // Remove spaces around { } ; : ,

		return $css;
	}

	private function inline_style() {

		ob_start(); ?>

		:root[data-theme="light-mode"] {
		--rt-primary-color: 	<?php echo esc_html( fasheno_option( 'rt_primary_color', '#ff6c23' ) ); ?>;
		--rt-secondary-color: 	<?php echo esc_html( fasheno_option( 'rt_secondary_color', '#ff0000' ) ); ?>;
		--rt-tertiary-color: 	<?php echo esc_html( fasheno_option( 'rt_tertiary_color', '#ffab02' ) ); ?>;
		--rt-body-color: 		<?php echo esc_html( fasheno_option( 'rt_body_color', '#666666' ) ); ?>;
		--rt-body-bg-color: 	<?php echo esc_html( fasheno_option( 'rt_body_bg_color', '#ffffff' ) ); ?>;
		--rt-border-color: 		<?php echo esc_html( fasheno_option( 'rt_border_color', '#e6e6e6' ) ); ?>;
		--rt-heading-color: 	<?php echo esc_html( fasheno_option( 'rt_heading_color', '#010101' ) ); ?>;
		--rt-meta-color: 		<?php echo esc_html( fasheno_option( 'rt_meta_color', '#848484' ) ); ?>;
		--rt-button-color: 		<?php echo esc_html( fasheno_option( 'rt_button_color', '#ffffff' ) ); ?>;
		--rt-button-text-color: <?php echo esc_html( fasheno_option( 'rt_button_text_color', '#010101' ) ); ?>;
		--rt-button-bg-color: 	<?php echo esc_html( fasheno_option( 'rt_button_bg_color', '#ffffff' ) ); ?>;
		--rt-white-bg-color: 	<?php echo esc_html( fasheno_option( 'rt_white_bg_color', '#ffffff' ) ); ?>;
		--rt-red-color: 		<?php echo esc_html( fasheno_option( 'rt_red_color', '#ff0004' ) ); ?>;
		--rt-gray-color: 		<?php echo esc_html( fasheno_option( 'rt_gray_color', '#f6f6f6' ) ); ?>;

		--rt-black-bg-color: 	#010101;
		--rt-black-bg-color-1: 	#010101;
		--rt-button-color-1: 	#ffffff;
		--rt-heading-color-1: 	#010101;
		--rt-brown-bg-color: 	#fff8ef;

		--rt-body-rgb: 			<?php echo esc_html( Fns::hex2rgb( fasheno_option( 'rt_body_color', '#666666' ) ) ); ?>;
		--rt-heading-rgb: 		<?php echo esc_html( Fns::hex2rgb( fasheno_option( 'rt_heading_color', '#010101' ) ) ); ?>;
		--rt-primary-rgb: 		<?php echo esc_html( Fns::hex2rgb( fasheno_option( 'rt_primary_color', '#ff6c23' ) ) ); ?>;
		--rt-secondary-rgb: 	<?php echo esc_html( Fns::hex2rgb( fasheno_option( 'rt_secondary_color', '#ff0000' ) ) ); ?>;
		--rt-tertiary-rgb: 		<?php echo esc_html( Fns::hex2rgb( fasheno_option( 'rt_tertiary_color', '#ffab02' ) ) ); ?>;

		}

		:root[data-theme="dark-mode"] {
		--rt-primary-color: 	<?php echo esc_html( fasheno_option( 'rt_primary_color', '#ff6c23' ) ); ?>;
		--rt-secondary-color: 	<?php echo esc_html( fasheno_option( 'rt_secondary_color', '#ff0000' ) ); ?>;
		--rt-tertiary-color: 	<?php echo esc_html( fasheno_option( 'rt_tertiary_color', '#ffab02' ) ); ?>;
		--rt-body-color: 		<?php echo esc_html( fasheno_option( 'rt_body_color', '#a0a0a0' ) ); ?>;
		--rt-body-bg-color: 	<?php echo esc_html( fasheno_option( 'rt_body_bg_color', '#000000' ) ); ?>;
		--rt-border-color: 		<?php echo esc_html( fasheno_option( 'rt_border_color', '#3a3939' ) ); ?>;
		--rt-heading-color: 	<?php echo esc_html( fasheno_option( 'rt_heading_color', '#ffffff' ) ); ?>;
		--rt-meta-color: 		<?php echo esc_html( fasheno_option( 'rt_meta_color', '#a0a0a0' ) ); ?>;
		--rt-button-color: 		<?php echo esc_html( fasheno_option( 'rt_button_color', '#ffffff' ) ); ?>;
		--rt-button-text-color: <?php echo esc_html( fasheno_option( 'rt_button_text_color', '#ffffff' ) ); ?>;
		--rt-button-bg-color: 	<?php echo esc_html( fasheno_option( 'rt_button_bg_color', '#202020' ) ); ?>;
		--rt-white-bg-color: 	<?php echo esc_html( fasheno_option( 'rt_white_bg_color', '#1d1c1c' ) ); ?>;
		--rt-red-color: 		<?php echo esc_html( fasheno_option( 'rt_red_color', '#ff0004' ) ); ?>;
		--rt-gray-color: 		<?php echo esc_html( fasheno_option( 'rt_gray_color', '#131313' ) ); ?>;

		--rt-black-bg-color: 	#1d1c1c;
		--rt-black-bg-color-1: 	#ffffff;
		--rt-button-color-1: 	#010101;
		--rt-heading-color-1: 	#b4b4b4;
		--rt-brown-bg-color: 	#fff8ef;

		--rt-body-rgb: 			<?php echo esc_html( Fns::hex2rgb( fasheno_option( 'rt_body_color', '#666666' ) ) ); ?>;
		--rt-heading-rgb: 		<?php echo esc_html( Fns::hex2rgb( fasheno_option( 'rt_heading_color', '#b4b4b4' ) ) ); ?>;
		--rt-primary-rgb: 		<?php echo esc_html( Fns::hex2rgb( fasheno_option( 'rt_primary_color', '#ff6c23' ) ) ); ?>;
		--rt-secondary-rgb: 	<?php echo esc_html( Fns::hex2rgb( fasheno_option( 'rt_secondary_color', '#ff0000' ) ) ); ?>;
		--rt-tertiary-rgb: 		<?php echo esc_html( Fns::hex2rgb( fasheno_option( 'rt_tertiary_color', '#ffab02' ) ) ); ?>;

		}

		--rt-container-width: 	<?php echo fasheno_option( 'container_width' ); ?>px;

		<?php
		$this->site_fonts();
		$this->topbar_css();
		$this->header_css();
		$this->breadcrumb_css();
		$this->content_padding_css();
		$this->footer_css();
		$this->site_background();

		return ob_get_clean();
	}

	/**
	 * Topbar Settings
	 * @return void
	 */
	protected function topbar_css() {
		$_topbar_active_color = fasheno_option( 'rt_top_bar_active_color' );
		echo self::css( 'body .site-header .fasheno-top-bar .top-bar-container *', 'color', 'rt_top_bar_color' );
		echo self::css( 'body .site-header .fasheno-top-bar .top-bar-container svg', 'fill', 'rt_top_bar_color' );

		if ( ! empty( $_topbar_active_color ) ) : ?>

			body .site-header .fasheno-top-bar .top-bar-container a:hover {
				color: <?php echo esc_attr( $_topbar_active_color ); ?>;
			}


			body .site-header .fasheno-top-bar .social-icon a:hover svg {
				fill: <?php echo esc_attr( $_topbar_active_color ); ?>;
			}
		<?php endif; ?>

		<?php
		echo self::css( 'body .fasheno-top-bar', 'background-color', 'rt_top_bar_bg_color' );

	}


	/**
	 * Menu Color Settings
	 * @return void
	 */
	protected function header_css() {
		//Logo CSS
		$logo_width = '';
		$logo_mobile_width = '';

		$logo_dimension     = fasheno_option( 'rt_logo_width_height' );
		$logo_mobile_dimension     = fasheno_option( 'rt_mobile_logo_width_height' );
		$menu_border_bottom = fasheno_option( 'rt_menu_border_color' );

		if ( strpos( $logo_dimension, ',' ) ) {
			$logo_width = explode( ',', $logo_dimension );
		}
		if ( strpos( $logo_mobile_dimension, ',' ) ) {
			$logo_mobile_width = explode( ',', $logo_mobile_dimension );
		}

		//Default Menu
		$_menu_color        = fasheno_option( 'rt_menu_color' );
		$_menu_active_color = fasheno_option( 'rt_menu_active_color' );
		$_menu_bg_color     = fasheno_option( 'rt_menu_bg_color' );
		$_sub_menu_bg_color     = fasheno_option( 'rt_sub_menu_bg_color' );

		//Transparent Menu
		$_tr_menu_color        = fasheno_option( 'rt_tr_menu_color' );
		$_tr_menu_active_color = fasheno_option( 'rt_tr_menu_active_color' );

		$_header_border     = fasheno_option( 'rt_header_border' );
		$_breadcrumb_border = fasheno_option( 'rt_breadcrumb_border' );
		$_preloader_bg_color = fasheno_option( 'preloader_bg_color' );
		?>

		<?php //Header Logo CSS ?>
		<?php if ( Opt::$header_width == 'full' ) :
			$h_width = '100%';
			if ( ( $header_width = fasheno_option( 'rt_header_max_width' ) ) > 768 ) {
				$h_width = $header_width . 'px';
			}
			?>
			.header-container,
			.topbar-container {
				width: <?php echo esc_attr($h_width); ?>;
				max-width: 100%;
			}
		<?php endif; ?>

		<?php if ( ! empty( $logo_width ) ) : ?>
			.site-branding .rt-site-logo {
				max-width: <?php echo esc_attr( $logo_width[0] ?? '100%' ) ?>;
				max-height: <?php echo esc_attr( $logo_width[1] ?? 'auto' ) ?>;
				object-fit: contain;
			}
		<?php endif; ?>

		<?php if ( ! empty( $logo_mobile_width ) ) : ?>
			.site-branding .rt-mobile-logo {
			max-width: <?php echo esc_attr( $logo_mobile_width[0] ?? '100%' ) ?>;
			max-height: <?php echo esc_attr( $logo_mobile_width[1] ?? 'auto' ) ?>;
			object-fit: contain;
			}
		<?php endif; ?>

		<?php //Default Header ?>
		<?php if ( ! empty( $_menu_color ) ) : ?>
			body .fasheno-navigation ul li a,
			body .fasheno-offcanvas-drawer ul.menu li a,
			body .fasheno-navigation ul li ul li a,
			body .menu-icon-wrapper .menu-search-bar {
				color: <?php echo esc_attr( $_menu_color ) ?>;
			}
			body .main-header-section svg,
			body .fasheno-navigation .caret svg {
				fill: <?php echo esc_attr( $_menu_color ) ?>;
			}
			body .ham-burger .btn-hamburger span,
			body .menu-icon-wrapper .has-separator li:not(:last-child):after {
				background-color: <?php echo esc_attr( $_menu_color ) ?>;
			}
		<?php endif; ?>

		<?php if ( ! empty( $_menu_active_color ) ) : ?>
			body .fasheno-navigation ul li a:hover,
			body .fasheno-navigation ul li.current-menu-item > a,
			body .fasheno-navigation ul li.current-menu-ancestor > a,
			body .fasheno-offcanvas-drawer ul li.current-menu-ancestor > a,
			body .fasheno-offcanvas-drawer ul.menu li a:hover,
			body .fasheno-navigation ul li ul li a:hover {
				color: <?php echo esc_attr( $_menu_active_color ) ?>;
			}
			body .fasheno-navigation ul li a:hover svg,
			body .fasheno-navigation ul li.current-menu-item > a svg,
			body .fasheno-navigation ul li.current-menu-ancestor > a svg {
				fill: <?php echo esc_attr( $_menu_active_color ) ?>;
			}
			body .menu-icon-wrapper .menu-bar:hover .btn-hamburger span {
				background-color: <?php echo esc_attr( $_menu_active_color ) ?>;
			}
		<?php endif; ?>

		<?php if ( ! empty( $_menu_bg_color ) ) : ?>
			body .main-header-section {
				background-color: <?php echo esc_attr( $_menu_bg_color ) ?>;
			}
		<?php endif; ?>

		<?php if ( ! empty( $_sub_menu_bg_color ) ) : ?>
			body .fasheno-navigation ul > li > ul,
			body .fasheno-navigation ul li.mega-menu > ul.dropdown-menu{
				background-color: <?php echo esc_attr( $_sub_menu_bg_color ) ?>;
			}
		<?php endif; ?>

		<?php //Transparent Header ?>
		<?php if ( ! empty( $_tr_menu_color ) ) : ?>
			body.has-trheader .site-header .site-branding h1 a,
			body.has-trheader .site-header .fasheno-navigation *,
			body.has-trheader .site-header .fasheno-navigation ul li a {
			color: <?php echo esc_attr( $_tr_menu_color ); ?>;
			}
			body.has-trheader .ham-burger .btn-hamburger span,
			body.tr-header-light .ham-burger .btn-hamburger span,
			body.has-trheader .menu-icon-wrapper .has-separator li:not(:last-child):after {
			background-color: <?php echo esc_attr( $_tr_menu_color ); ?> !important;
			}

			body.has-trheader .site-header .menu-icon-wrapper svg,
			body.has-trheader .site-header .fasheno-topbar .caret svg,
			body.has-trheader .site-header .main-header-section .caret svg {
			fill: <?php echo esc_attr( $_tr_menu_color ); ?>
			}
		<?php endif; ?>

		<?php if ( ! empty( $_tr_menu_active_color ) ) : ?>
			body.has-trheader .site-header .fasheno-navigation ul li a:hover,
			body.has-trheader .site-header .fasheno-navigation ul li.current-menu-item > a,
			body.has-trheader .site-header .fasheno-navigation ul li.current-menu-ancestor > a {
			color: <?php echo esc_attr( $_tr_menu_active_color ); ?>
			}
			body.has-trheader .menu-icon-wrapper .menu-bar:hover .btn-hamburger span {
				background-color: <?php echo esc_attr( $_tr_menu_active_color ); ?> !important;
			}
			body.has-trheader .main-header-section a:hover [class*=rticon] svg,
			body.has-trheader .site-header .fasheno-navigation ul li.current-menu-ancestor > a svg,
			body.has-trheader .site-header .fasheno-navigation ul li.current-menu-item > a svg {
			fill: <?php echo esc_attr( $_tr_menu_active_color ); ?>
			}
		<?php endif; ?>
		<?php if ( ! empty( $menu_border_bottom ) ) : ?>
			body .fasheno-topbar,
			body .main-header-section,
			body .fasheno-breadcrumb-wrapper {
			border-bottom-color: <?php echo esc_attr( $menu_border_bottom ); ?>;
			}
		<?php endif; ?>

		<?php if ( ! $_header_border ) : ?>
			body .main-header-section {border-bottom: none;}
		<?php endif; ?>
		<?php if ( ! $_breadcrumb_border ) : ?>
			body .fasheno-breadcrumb-wrapper {border-bottom: none;}
		<?php endif; ?>

		<?php if ( ! empty( $_preloader_bg_color ) ) : ?>
			#preloader {
				background-color: <?php echo esc_attr( $_preloader_bg_color ); ?>;
			}
		<?php endif; ?>

		<?php
	}

	/**
	 * Breadcrumb Settings
	 * @return void
	 */
	protected function breadcrumb_css() {
		$breadcrumb_color          = fasheno_option( 'rt_breadcrumb_color' );
		$rt_breadcrumb_hover       = fasheno_option( 'rt_breadcrumb_hover' );
		$breadcrumb_active         = fasheno_option( 'rt_breadcrumb_active' );
		$rt_breadcrumb_heading_color = fasheno_option( 'rt_breadcrumb_heading_color' );

		$rt_banner_padding_top = fasheno_option( 'rt_banner_padding_top' );
		$rt_banner_padding_bottom = fasheno_option( 'rt_banner_padding_bottom' );

		if ( ! empty( $rt_breadcrumb_heading_color ) ) { ?>
			.fasheno-breadcrumb-wrapper .entry-title {
				color: <?php echo esc_attr( $rt_breadcrumb_heading_color ) ?> !important;
			}
		<?php }

		if ( ! empty( $breadcrumb_color ) ) { ?>
			.fasheno-breadcrumb-wrapper .breadcrumb a,
			.fasheno-breadcrumb-wrapper .entry-breadcrumb span a,
			.has-trheader .fasheno-breadcrumb-wrapper .breadcrumb a,
			.fasheno-breadcrumb-wrapper .entry-breadcrumb .dvdr {
				color: <?php echo esc_attr( $breadcrumb_color ) ?>;
			}
		<?php }

		if ( ! empty( $rt_breadcrumb_hover ) ) { ?>
			.fasheno-breadcrumb-wrapper .breadcrumb a:hover,
			.fasheno-breadcrumb-wrapper .entry-breadcrumb span a:hover {
			color: <?php echo esc_attr( $rt_breadcrumb_hover ) ?>;
			}
		<?php }

		if ( ! empty( $breadcrumb_active ) ) { ?>
			.fasheno-breadcrumb-wrapper .breadcrumb li.active .title,
			.fasheno-breadcrumb-wrapper .entry-breadcrumb .current-item,
			.has-trheader .fasheno-breadcrumb-wrapper .breadcrumb li.active .title,
			.has-trheader .fasheno-breadcrumb-wrapper .breadcrumb a:hover {
				color: <?php echo esc_attr( $breadcrumb_active ) ?>;
			}
		<?php }

		if ( ! empty( Opt::$banner_color ) ) { ?>
			.fasheno-breadcrumb-wrapper,
			.fasheno-breadcrumb-wrapper.has-bg {
				background-color: <?php echo esc_attr( Opt::$banner_color ); ?>;
			}
		<?php }

		if ( ! empty( $rt_banner_padding_top ) ) { ?>
			.fasheno-breadcrumb-wrapper {
				padding-top: <?php echo esc_attr( $rt_banner_padding_top ) ?>px !important;
			}
		<?php }

		if ( ! empty( $rt_banner_padding_bottom ) ) { ?>
			.fasheno-breadcrumb-wrapper {
				padding-bottom: <?php echo esc_attr( $rt_banner_padding_bottom ) ?>px !important;
			}
		<?php }

	}

	/**
	 * Content Padding
	 * @return void
	 */
	protected function content_padding_css() {

		if ( ! empty( Opt::$padding_top ) && 'default' !== Opt::$padding_top) { ?>
			.content-area {padding-top: <?php echo esc_attr( Opt::$padding_top ); ?>px;}
		<?php }

		if ( ! empty( Opt::$padding_bottom ) && 'default' !== Opt::$padding_bottom) { ?>
			.content-area {padding-bottom: <?php echo esc_attr( Opt::$padding_bottom ); ?>px;}
		<?php }

	}

		/**
		 * Footer CSS
		 * @return void
		 */
		protected function footer_css() {
			if ( fasheno_option( 'rt_footer_width' ) && fasheno_option( 'rt_footer_max_width' ) > 1400 ) {
				echo self::css( '.site-footer .footer-container', 'width', 'rt_footer_max_width', 'px;max-width: 100%' );
			}

			echo self::css( 'body .site-footer *:not(a), body .site-footer .widget', 'color', 'rt_footer_text_color' );

			echo self::css( 'body .site-footer .footer-sidebar a, body .site-footer .footer-sidebar .widget a, body .site-footer .footer-sidebar .phone-no a', 'color', 'rt_footer_link_color' );

			echo self::css( 'body .site-footer a:hover, body .site-footer .footer-sidebar a:hover', 'color', 'rt_footer_link_hover_color' );

			echo self::css( 'body .site-footer .footer-widgets-wrapper', 'background-color', 'rt_footer_bg' );
			echo self::css( 'body .site-footer .widget :is(td, th, select, .search-box)', 'border-color', 'rt_footer_input_border_color' );
			echo self::css( 'body .site-footer .widget-title, .fasheno-footer-2 .site-footer .widget-title', 'color', 'rt_footer_widget_heading_color' );

			echo self::css( 'body .site-footer .footer-copyright-wrapper, body .site-footer label, body .footer-copyright-wrapper .copyright-text', 'color', 'rt_copyright_text_color' );
			echo self::css( 'body .site-footer .footer-copyright-wrapper a', 'color', 'rt_copyright_link_color' );
			echo self::css( 'body .site-footer .footer-copyright-wrapper a:hover', 'color', 'rt_copyright_link_hover_color' );
			echo self::css( 'body .site-footer .footer-copyright-wrapper', 'background-color', 'rt_copyright_bg' );
		}


		/**
		 * Load site fonts
		 * @return void
		 */
		protected
		function site_fonts() {

			$typo_body           = json_decode( fasheno_option( 'rt_body_typo' ), true );
			$typo_menu           = json_decode( fasheno_option( 'rt_menu_typo' ), true );
			$typo_heading        = json_decode( fasheno_option( 'rt_all_heading_typo' ), true );
			$body_font_family    = $typo_body['font'] ?? 'Outfit';
			$heading_font_family = $typo_heading['font'] ?? $body_font_family;
			?>
			:root{
			--rt-body-font: '<?php echo esc_html( $typo_body['font'] ); ?>', sans-serif;;
			--rt-heading-font: '<?php echo esc_html( $heading_font_family ); ?>', sans-serif;
			--rt-menu-font: '<?php echo esc_html( $typo_body['font'] ); ?>', sans-serif;
			}

			<?php
			echo self::font_css( 'body', $typo_body );
			echo self::font_css( '.site-header', [ 'font' => $typo_menu['font'] ] );
			echo self::font_css( '.fasheno-navigation ul li a', [
				'size'          => $typo_menu['size'],
				'regularweight' => $typo_menu['regularweight'],
				'lineheight'    => $typo_menu['lineheight']
			] );
			echo self::font_css( '.h1,.h2,.h3,.h4,.h5,.h6,h1,h2,h3,h4,h5,h6', [
				'font'          => $typo_heading['font'],
				'regularweight' => $typo_heading['regularweight']
			] );

			$heading_fonts = [ 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ];
			foreach ( $heading_fonts as $heading ) {
				$font = json_decode( fasheno_option( "rt_heading_{$heading}_typo" ), true );
				if ( ! empty( $font['font'] ) ) {
					$selector = "$heading, .$heading";
					echo self::font_css( $selector, $font );
				}
			}
		}


		/**
		 * Generate CSS
		 *
		 * @param $selector
		 * @param $property
		 * @param $theme_mod
		 *
		 * @return string|void
		 */
		public
		static function css( $selector, $property, $theme_mod, $after_css = '' ) {
			$theme_mod = fasheno_option( $theme_mod );

			if ( ! empty( $theme_mod ) ) {
				return sprintf( '%s { %s:%s%s; }', $selector, $property, $theme_mod, $after_css );
			}
		}

		/**
		 * Font CSS
		 *
		 * @param $selector
		 * @param $property
		 * @param $theme_mod
		 * @param $after_css
		 *
		 * @return string
		 */
		public
		static function font_css( $selector, $font ) {
			$css = '';
			$css .= $selector . '{'; //Start CSS
			$css .= ! empty( $font['font'] ) ? "font-family: '" . $font['font'] . "', sans-serif;" : '';
			$css .= ! empty( $font['size'] ) ? "font-size: {$font['size']}px;" : '';
			$css .= ! empty( $font['lineheight'] ) ? "line-height: {$font['lineheight']}px;" : '';
			$css .= ! empty( $font['regularweight'] ) ? "font-weight: {$font['regularweight']};" : '';
			$css .= '}'; //End CSS

			return $css;
		}

		/**
		 * Site background
		 *
		 * @return string
		 */

		function site_background() {
			if ( ! empty( Opt::$pagebgimg ) ) {
				$bg = wp_get_attachment_image_src( Opt::$pagebgimg, 'full' );
				if ( ! empty( $bg[0] ) ) { ?>
					body {
					background-image: url(<?php echo esc_url( $bg[0] ) ?>);
					background-repeat: repeat;
					background-position: top center;
					background-size: 100%;
					}
					<?php
				}
			}
			if ( ! empty( Opt::$pagebgcolor ) && 'default' !== Opt::$pagebgcolor) { ?>
				body {
					background-color: <?php echo esc_attr( Opt::$pagebgcolor ); ?>;
				}
			<?php }
		}
	}
