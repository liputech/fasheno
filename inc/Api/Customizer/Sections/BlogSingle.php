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
class BlogSingle extends Customizer {
	protected $section_blog_single = 'rt_blog_single_section';

	/**
	 * Register controls
	 * @return void
	 */
	public function register() {
		Customize::add_section( [
			'id'          => $this->section_blog_single,
			'title'       => __( 'Blog Single', 'fasheno' ),
			'description' => __( 'Blog Single Section', 'fasheno' ),
			'priority'    => 26
		] );

		Customize::add_controls( $this->section_blog_single, $this->get_controls() );
	}

	/**
	 * Get controls
	 * @return array
	 */
	public function get_controls() {
		return apply_filters( 'rt_single_controls', [

			'rt_single_post_style' => [
				'type'    => 'select',
				'label'   => __( 'Post View Style', 'fasheno' ),
				'default' => '1',
				'choices' => Fns::single_post_style()
			],

			'rt_single_meta' => [
				'type'        => 'select2',
				'label'       => __( 'Choose Single Meta', 'fasheno' ),
				'description' => __( 'You can sort meta by drag and drop', 'fasheno' ),
				'placeholder' => __( 'Choose Meta', 'fasheno' ),
				'multiselect' => true,
				'default'     => 'author,date,category,comment',
				'choices'     => Fns::blog_meta_list(),
			],

			'rt_single_meta_style' => [
				'type'    => 'select',
				'label'   => __( 'Meta Style', 'fasheno' ),
				'default' => 'meta-style-default',
				'choices' => Fns::meta_style()
			],

			'rt_post_banner_single_title' => [
				'type'    => 'text',
				'label'   => __( 'Single Banner Title', 'fasheno' ),
				'default' => __( 'Post Details', 'fasheno' ),
			],

			'rt_single_visibility_heading' => [
				'type'  => 'heading',
				'label' => __( 'Visibility Section', 'fasheno' ),
			],

			'rt_single_meta_visibility' => [
				'type'    => 'switch',
				'label'   => __( 'Meta Visibility', 'fasheno' ),
				'default' => 1
			],

			'rt_single_above_meta_visibility' => [
				'type'  => 'switch',
				'label' => __( 'Above Meta Visibility', 'fasheno' ),
			],
			'rt_single_tag_visibility' => [
				'type'  => 'switch',
				'label' => __( 'Tag Visibility', 'fasheno' ),
			],
			'rt_single_share_visibility' => [
				'type'    => 'switch',
				'label'   => __( 'Share Visibility', 'fasheno' ),
			],
			'rt_single_profile_visibility' => [
				'type'    => 'switch',
				'label'   => __( 'Author Profile Visibility', 'fasheno' ),
			],
			'rt_single_caption_visibility' => [
				'type'    => 'switch',
				'label'   => __( 'Caption Visibility', 'fasheno' ),
			],
			'rt_single_navigation_visibility' => [
				'type'    => 'switch',
				'label'   => __( 'Navigation Visibility', 'fasheno' ),
			],
			'rt_post_share' => [
				'type'        => 'select2',
				'label'       => __( 'Choose Share Media', 'fasheno' ),
				'description' => __( 'You can sort meta by drag and drop', 'fasheno' ),
				'placeholder' => __( 'Choose Media', 'fasheno' ),
				'multiselect' => true,
				'default'     => 'facebook,twitter,linkedin',
				'choices'     => Fns::post_share_list(),
				'condition' => [ 'rt_single_share_visibility' ]
			],

			'rt_post_single_related_heading' => [
				'type'  => 'heading',
				'label' => __( 'Post Single Related Option', 'fasheno' ),
			],

			'rt_post_related' => [
				'type'    => 'switch',
				'label'   => __( 'Related Visibility', 'fasheno' ),
				'default' => 0
			],

			'rt_post_related_title' => [
				'type'    => 'text',
				'label'   => __( 'Post Related Title', 'fasheno' ),
				'default' => __( 'Related Post', 'fasheno' ),
				'condition' => [ 'rt_post_related' ]
			],

			'rt_post_related_limit' => [
				'type'    => 'number',
				'label'   => __( 'Related Item Limit', 'fasheno' ),
				'default' => 3,
				'condition' => [ 'rt_post_related' ]
			],

			'rt_post_related_query' => [
				'type'        => 'select',
				'label'       => __( 'Query Type', 'fasheno' ),
				'description' => __( 'Post Query Type', 'fasheno' ),
				'default'     => 'cat',
				'choices'     => [
					'cat' => esc_html__( 'Posts in the same Categories', 'fasheno' ),
					'tag' => esc_html__( 'Posts in the same Tags', 'fasheno' ),
					'author' => esc_html__( 'Posts by the same Author', 'fasheno' ),
				],
				'condition' => [ 'rt_post_related' ]
			],

			'rt_post_related_sort' => [
				'type'        => 'select',
				'label'       => __( 'Sort Order', 'fasheno' ),
				'description' => __( 'Display Post Order', 'fasheno' ),
				'default'     => 'recent',
				'choices'     => [
					'recent' => esc_html__( 'Recent Posts', 'fasheno' ),
					'rand' => esc_html__( 'Random Posts', 'fasheno' ),
					'modified' => esc_html__( 'Last Modified Posts', 'fasheno' ),
					'popular' => esc_html__( 'Most Commented posts', 'fasheno' ),
					'views' => esc_html__( 'Most Viewed posts', 'fasheno' ),
				],
				'condition' => [ 'rt_post_related' ]
			],

		] );
	}


}
