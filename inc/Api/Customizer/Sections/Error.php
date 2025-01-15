<?php
/**
 * Theme Customizer - Header
 *
 * @package fasheno
 */

namespace RT\Fasheno\Api\Customizer\Sections;

use RT\Fasheno\Api\Customizer;
use RTFramework\Customize;

/**
 * Customizer class
 */
class Error extends Customizer {
	protected $section_labels = 'rt_error_section';

	/**
	 * Register controls
	 * @return void
	 */
	public function register() {
		Customize::add_section( [
			'id'          => $this->section_labels,
			'title'       => __( 'Error Page', 'fasheno' ),
			'description' => __( 'Error section.', 'fasheno' ),
			'priority'    => 39
		] );
		Customize::add_controls( $this->section_labels, $this->get_controls() );
	}

	/**
	 * Get controls
	 * @return array
	 */
	public function get_controls() {

		return apply_filters( 'rt_labels_controls', [

			'rt_error_image' => [
				'type'         => 'image',
				'label'        => __( 'Error Image', 'fasheno' ),
				'description'  => __( 'Upload error image for your site.', 'fasheno' ),
				'button_label' => __( 'Error image', 'fasheno' ),
			],

			'rt_error_heading' => [
				'type'        => 'text',
				'label'       => __( 'Error Heading', 'fasheno' ),
				'default'     => __( 'Oops, something went wrong.', 'fasheno' ),
			],

			'rt_error_text' => [
				'type'        => 'text',
				'label'       => __( 'Error Text', 'fasheno' ),
				'default'     => __( "The page you're looking for isn't available. Try to search gain or use the go back button below.", 'fasheno' ),
			],

			'rt_error_button_text' => [
				'type'        => 'text',
				'label'       => __( 'Error Button Text', 'fasheno' ),
				'default'     => __( 'Go Back Home', 'fasheno' ),
			],

		] );
	}


}
