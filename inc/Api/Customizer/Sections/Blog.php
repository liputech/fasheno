<?php
/**
 * Theme Customizer - Header
 *
 * @package fasheno
 */

namespace RT\Fasheno\Api\Customizer\Sections;

use RT\Fasheno\Api\Customizer;
use RT\Fasheno\Helpers\Fns;
use RTFramework\Customize;

/**
 * Customizer class
 */
class Blog extends Customizer {

	protected $section_blog = 'rt_blog_section';


	/**
	 * Register controls
	 * @return void
	 */
	public function register() {
		Customize::add_section( [
			'id'          => $this->section_blog,
			'title'       => __( 'Blog Archive', 'fasheno' ),
			'description' => __( 'Blog Section', 'fasheno' ),
			'priority'    => 25
		] );

		Customize::add_controls( $this->section_blog, $this->get_controls() );
	}

	/**
	 * Get controls
	 * @return array
	 */
	public function get_controls() {
		return apply_filters( 'rt_blog_controls', [

			'rt_blog_style' => [
				'type'        => 'select',
				'label'       => __( 'Blog Style', 'fasheno' ),
				'description' => __( 'This option works only for blog layout', 'fasheno' ),
				'default'     => 'default',
				'choices'     => [
					'default' => __( 'Default From Theme', 'fasheno' ),
					'list'    => __( 'List', 'fasheno' ),
					'list-2'    => __( 'List 2', 'fasheno' ),
					'grid-2'    => __( 'Grid 2', 'fasheno' ),
					'grid-3'    => __( 'Grid 3', 'fasheno' ),
					'grid-4'    => __( 'Grid 4', 'fasheno' ),
				]
			],

			'rt_blog_column' => [
				'type'        => 'select',
				'label'       => __( 'Grid Column', 'fasheno' ),
				'description' => __( 'This option works only for large device', 'fasheno' ),
				'default'     => 'default',
				'choices'     => [
					'default'   => __( 'Default From Theme', 'fasheno' ),
					'col-lg-12' => __( '1 Column', 'fasheno' ),
					'col-lg-6'  => __( '2 Column', 'fasheno' ),
					'col-lg-4'  => __( '3 Column', 'fasheno' ),
					'col-lg-3'  => __( '4 Column', 'fasheno' ),
				]
			],

			'rt_blog_column_gap' => [
				'type'        => 'select',
				'label'       => __( 'Grid Column Gap', 'fasheno' ),
				'description' => __( 'This option works only for blog grid gap', 'fasheno' ),
				'default'     => 'g-4',
				'choices'     => [
					'g-1'  => __( 'Gap 1', 'fasheno' ),
					'g-2'  => __( 'Gap 2', 'fasheno' ),
					'g-3'  => __( 'Gap 3', 'fasheno' ),
					'g-4'  => __( 'Gap 4', 'fasheno' ),
					'g-5'  => __( 'Gap 5', 'fasheno' ),
				]
			],

			'rt_excerpt_limit' => [
				'type'    => 'number',
				'label'   => __( 'Content Limit', 'fasheno' ),
				'default' => '22',
			],

			'rt_blog_pagination_style' => [
				'type'        => 'select',
				'label'       => __( 'Pagination Style', 'fasheno' ),
				'description' => __( 'This option works only for blog pagination style', 'fasheno' ),
				'default'     => 'pagination-area',
				'choices'     => [
					'pagination-area'  => __( 'Default', 'fasheno' ),
					'pagination-area-2'  => __( 'Style 2', 'fasheno' ),
				]
			],

			'rt_meta_heading' => [
				'type'  => 'heading',
				'label' => __( 'Post Meta Settings', 'fasheno' ),
			],

			'rt_blog_meta_style' => [
				'type'    => 'select',
				'label'   => __( 'Meta Style', 'fasheno' ),
				'default' => 'meta-style-default',
				'choices' => Fns::meta_style()
			],

			'rt_single_above_meta_style' => [
				'type'    => 'select',
				'label'   => __( 'Title Above Meta Style', 'fasheno' ),
				'default' => 'meta-style-dash',
				'choices' => Fns::meta_style( [ 'meta-style-dash-bg', 'meta-style-pipe' ] )
			],

			'rt_blog_meta' => [
				'type'        => 'select2',
				'label'       => __( 'Choose Meta', 'fasheno' ),
				'description' => __( 'You can sort meta by drag and drop', 'fasheno' ),
				'placeholder' => __( 'Choose Meta', 'fasheno' ),
				'multiselect' => true,
				'default'     => 'author,date,category',
				'choices'     => Fns::blog_meta_list(),
			],

			'rt_visibility' => [
				'type'  => 'heading',
				'label' => __( 'Visibility Section', 'fasheno' ),
			],

			'rt_meta_visibility' => [
				'type'    => 'switch',
				'label'   => __( 'Meta Visibility', 'fasheno' ),
				'default' => 1
			],

			'rt_blog_above_meta_visibility' => [
				'type'  => 'switch',
				'label' => __( 'Title Above Meta Visibility', 'fasheno' ),
			],

			'rt_blog_content_visibility' => [
				'type'    => 'switch',
				'label'   => __( 'Entry Content Visibility', 'fasheno' ),
				'default' => 1
			],

			'rt_video_visibility' => [
				'type'    => 'switch',
				'label'   => __( 'Video Visibility', 'fasheno' ),
				'default' => 1
			],

			'rt_blog_footer_visibility' => [
				'type'    => 'switch',
				'label'   => __( 'Entry Footer Visibility', 'fasheno' ),
				'default' => 1
			],

			'rt_animation_heading' => [
				'type'  => 'heading',
				'label' => __( 'Animation', 'fasheno' ),
			],

			'rt_animation' => [
				'type'      => 'switch',
				'label'       => __( 'Animation', 'fasheno' ),
				'default'     => 0,
			],

			'rt_animation_effect' => [
				'type'        => 'select',
				'label' => __( 'Entrance Animation', 'fasheno' ),
				'description' => __( 'This option works only for blog animation effect', 'fasheno' ),
				'default'     => 'fadeInUp',
				'choices'     => [
					'bounce' => esc_html__( 'bounce', 'fasheno' ),
					'flash' => esc_html__( 'flash', 'fasheno' ),
					'pulse' => esc_html__( 'pulse', 'fasheno' ),
					'rubberBand' => esc_html__( 'rubberBand', 'fasheno' ),
					'shakeX' => esc_html__( 'shakeX', 'fasheno' ),
					'shakeY' => esc_html__( 'shakeY', 'fasheno' ),
					'headShake' => esc_html__( 'headShake', 'fasheno' ),
					'swing' => esc_html__( 'swing', 'fasheno' ),
					'fadeIn' => esc_html__( 'fadeIn', 'fasheno' ),
					'fadeInUp' => esc_html__( 'fadeInUp', 'fasheno' ),
					'fadeInDown' => esc_html__( 'fadeInDown', 'fasheno' ),
					'fadeInLeft' => esc_html__( 'fadeInLeft', 'fasheno' ),
					'fadeInRight' => esc_html__( 'fadeInRight', 'fasheno' ),
					'bounceIn' => esc_html__( 'bounceIn', 'fasheno' ),
					'bounceInUp' => esc_html__( 'bounceInUp', 'fasheno' ),
					'bounceInDown' => esc_html__( 'bounceInDown', 'fasheno' ),
					'bounceInLeft' => esc_html__( 'bounceInLeft', 'fasheno' ),
					'bounceInRight' => esc_html__( 'bounceInRight', 'fasheno' ),
					'slideInUp' => esc_html__( 'slideInUp', 'fasheno' ),
					'slideInDown' => esc_html__( 'slideInDown', 'fasheno' ),
					'slideInLeft' => esc_html__( 'slideInLeft', 'fasheno' ),
					'slideInRight' => esc_html__( 'slideInRight', 'fasheno' ),
				],
				'condition' => [ 'rt_animation' ],
			],

			'delay' => [
				'type'  => 'text',
				'label' => __( 'Delay', 'fasheno' ),
				'default' => '200',
				'condition' => [ 'rt_animation' ],
			],

			'duration' => [
				'type'  => 'text',
				'label' => __( 'Duration', 'fasheno' ),
				'default' => '1200',
				'condition' => [ 'rt_animation' ],
			],

		] );
	}


}
