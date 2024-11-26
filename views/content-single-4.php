<?php
/**
 * Template part for displaying content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package fasheno
 */

?>
<article data-post-id="<?php the_ID(); ?>" <?php post_class( fasheno_post_class() ); ?>>
	<div class="single-inner-wrapper">
		<?php fasheno_single_entry_header(); ?>
		<?php fasheno_post_single_thumbnail(); ?>
		<div class="entry-wrapper">
				<div class="entry-content">
					<?php fasheno_entry_content() ?>
				</div>
			<?php fasheno_post_single_video(); ?>
			<?php fasheno_entry_footer(); ?>
			<?php fasheno_entry_profile(); ?>
		</div>
	</div>
</article>
