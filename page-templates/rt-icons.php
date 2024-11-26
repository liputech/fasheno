<?php
/**
 * Template Name: RT Icons
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package fasheno
 */

get_header(); ?>
	<div class="container">
		<div class="row pt-50 pb-50 d-flex gap-15">
			<?php
			echo fasheno_get_svg( 'search' );
			echo fasheno_get_svg( 'facebook' );
			echo fasheno_get_svg( 'twitter' );
			echo fasheno_get_svg( 'linkedin' );
			echo fasheno_get_svg( 'instagram' );
			echo fasheno_get_svg( 'pinterest' );
			echo fasheno_get_svg( 'tiktok' );
			echo fasheno_get_svg( 'youtube' );
			echo fasheno_get_svg( 'snapchat' );
			echo fasheno_get_svg( 'whatsapp' );
			echo fasheno_get_svg( 'reddit' );
			?>
		</div>
	</div>
<?php
get_footer();
