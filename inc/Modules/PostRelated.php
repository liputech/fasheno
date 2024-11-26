<?php
/**
 * Template part for single team related
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package fasheno
 */

namespace RT\Fasheno\Modules;
class PostRelated {

	public static function rt_post_related() {
		$post_id = get_the_id();
		$current_post = array( $post_id );
		$related_item_number = fasheno_option( 'rt_post_related_limit' );

		# Making ready to the Query ...
		$query_type = fasheno_option( 'rt_post_related_query' );

		$args = array(
			'post__not_in'           => $current_post,
			'posts_per_page'         => $related_item_number,
			'no_found_rows'          => true,
			'post_status'            => 'publish',
			'ignore_sticky_posts'    => true,
			'update_post_term_cache' => false,
		);

		# Checking Related Posts Order ----------
		if( fasheno_option( 'rt_post_related_sort' ) ){

			$post_order = fasheno_option( 'rt_post_related_sort' );

			if( $post_order == 'rand' ){

				$args['orderby'] = 'rand';
			}
			elseif( $post_order == 'views' ){

				$args['orderby']  = 'meta_value_num';
			}
			elseif( $post_order == 'popular' ){

				$args['orderby'] = 'comment_count';
			}
			elseif( $post_order == 'modified' ){

				$args['orderby'] = 'modified';
				$args['order']   = 'ASC';
			}
			elseif( $post_order == 'recent' ){

				$args['orderby'] = '';
				$args['order']   = '';
			}
		}


		# Get related posts by author ----------
		if( $query_type == 'author' ){
			$args['author'] = get_the_author_meta( 'ID' );
		}

		# Get related posts by tags ----------
		elseif( $query_type == 'tag' ){
			$tags_ids  = array();
			$post_tags = get_the_terms( $post_id, 'post_tag' );

			if( ! empty( $post_tags ) ){
				foreach( $post_tags as $individual_tag ){
					$tags_ids[] = $individual_tag->term_id;
				}

				$args['tag__in'] = $tags_ids;
			}
		}else{
			$category_ids = array();
			$categories   = get_the_category( $post_id );

			foreach( $categories as $individual_category ){
				$category_ids[] = $individual_category->term_id;
			}

			$args['category__in'] = $category_ids;
		}

		# Get the posts ----------
		$related_query = new \WP_Query( $args );
		if( $related_query->have_posts() && fasheno_option( 'rt_post_related' ) ) { ?>
			<div class="blog-default rt-related-post">
				<div class="container">
					<h2 class="related-title"><?php fasheno_html( fasheno_option( 'rt_post_related_title' ) , 'allow_title' );?></h2>
					<div class="row <?php echo esc_attr( fasheno_option( 'rt_blog_column_gap' ) ); ?>">
						<?php while ( $related_query->have_posts() ) {
						$related_query->the_post();
							$meta_list = fasheno_option( 'rt_blog_meta', '', true );
							if ( fasheno_option( 'rt_blog_above_meta_visibility' ) ) {
								$meta_index = array_search( 'category', $meta_list );
								unset( $meta_list[ $meta_index ] );
							}
						?>
						<div class="col-sm-6 col-xl-4 col-lg-4" >
							<article data-post-id="<?php the_ID(); ?>" <?php post_class( fasheno_post_class() ); ?>>
								<div class="article-inner-wrapper">

									<?php fasheno_post_thumbnail('fasheno-size3'); ?>

									<div class="entry-wrapper">
										<header class="entry-related-header">

											<?php

											fasheno_separate_meta( 'title-above-meta' );

											the_title( sprintf( '<h2 class="entry-title default-max-width"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' );


											if ( ! empty( $meta_list ) && fasheno_option( 'rt_meta_visibility' ) ) {
												echo fasheno_post_meta( [
													'with_list'     => true,
													'with_icon'     => true,
													'include'       => $meta_list,
													'author_prefix' => fasheno_option( 'rt_author_prefix' ),
												] );
											}
											?>
										</header>
									</div>
								</div>
							</article>
						</div>
					<?php } ?>
					</div>
				</div>
			</div>
		<?php }
		wp_reset_postdata();
	}
}
?>
