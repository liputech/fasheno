<?php
/**
 * Template part for displaying content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package fasheno
 */

$meta_list = fasheno_option( 'rt_blog_meta', '', true );
if ( fasheno_option( 'rt_blog_above_meta_visibility' ) ) {
	$meta_index = array_search( 'category', $meta_list );
	unset( $meta_list[ $meta_index ] );
}

$wow = fasheno_option('rt_animation') == 1 ? 'wow' : 'animation-off';
$effect = fasheno_option('rt_animation_effect');
$delay = fasheno_option('delay');
$duration = fasheno_option('duration');

?>
<article data-post-id="<?php the_ID(); ?>" <?php post_class( fasheno_post_class() ); ?>>
	<div class="article-inner-wrapper <?php echo esc_attr($wow . ' ' . $effect); ?>" data-wow-delay="<?php echo esc_attr($delay); ?>ms" data-wow-duration="<?php echo esc_attr($duration); ?>ms">
		<?php fasheno_post_thumbnail('fasheno-size2'); ?>
		<div class="entry-wrapper">
			<header class="entry-header">
				<?php fasheno_separate_meta( 'title-above-meta' );

				if ( ! empty( $meta_list ) && fasheno_option( 'rt_meta_visibility' ) ) {
					echo fasheno_post_meta( [
						'with_list'     => true,
						'with_icon'     => true,
						'include'       => $meta_list,
						'author_prefix' => fasheno_option( 'rt_author_prefix' ),
					] );
				}

				if ( ! is_single() ) {
					the_title( sprintf( '<h2 class="entry-title default-max-width"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' );
				} else {
					the_title( '<h2 class="entry-title default-max-width">', '</h2>' );
				}

				?>
			</header>
			<?php if ( fasheno_option( 'rt_blog_content_visibility' ) ) : ?>
				<div class="entry-content">
					<?php fasheno_entry_content() ?>
				</div>
			<?php endif; ?>
			<?php fasheno_entry_footer(); ?>
		</div>
	</div>
</article>