<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package fasheno
 */


use RT\Fasheno\Helpers\Fns;

if ( is_singular() && is_active_sidebar( Fns::default_sidebar('single') ) ) {
	fasheno_sidebar( Fns::default_sidebar('single')  );
} else {
	fasheno_sidebar( Fns::default_sidebar('main') );
}
