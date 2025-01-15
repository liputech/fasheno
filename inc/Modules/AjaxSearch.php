<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * Ajax Search
 */
namespace RT\Fasheno\Modules;
use RT\Fasheno\Traits\SingletonTraits;

class AjaxSearch{

	use SingletonTraits;
	function __construct(){
		add_action('wp_ajax_rt_data_fetch', [$this, 'rt_data_fetch']);
		add_action('wp_ajax_nopriv_rt_data_fetch', [$this, 'rt_data_fetch']);

		add_action( 'wp_ajax_fasheno_product_search_autocomplete', [ $this, 'product_search_autocomplete'] );
		add_action( 'wp_ajax_nopriv_fasheno_product_search_autocomplete', [ $this, 'product_search_autocomplete'] );
	}
	public function rt_data_fetch(){
		// Checking nonce.
		check_ajax_referer( 'rt-fasheno-nonce', 'security' );
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => 8,
			's' => esc_attr( $_POST['keyword'] ?? '' ),
			'searchkey' => esc_attr( $_POST['searchkey'] ?? '' ),
		);

		$the_query = new \WP_Query( $args );
		if( $the_query->have_posts() ) :
			while( $the_query->have_posts() ):
				$the_query->the_post();?>
				<div class="rt-search-result-list">
					<a class="rt-top-title" href="<?php echo esc_url( get_permalink() ); ?>"><i class="icon-rt-arrow-right-1"></i><?php the_title();?>
					</a>
					<ul class="rt-search-breadcrumb">
						<?php
						$term_lists = get_the_terms( get_the_ID(), 'category' );
						if( $term_lists ) {
							foreach ( $term_lists as $term_list ){
								$link = get_term_link( $term_list->term_id, 'category' ); ?>
								<li><a href="<?php echo esc_url( $link ); ?>">
									<?php echo esc_html( $term_list->name ); ?></a></li><?php
							}
						}
						$terms = get_terms( array('taxonomy' => 'category' ) );
						$category_dropdown = array(  0 => __( 'All Category', 'fasheno' ) );
						foreach ( $terms as $category ) {
							$category_dropdown[$category->slug] = $category->name;
						}
						?>
						<li><i class="icon-rt-chevron-right"></i> <a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title();?></a></li>
					</ul>
				</div>
			<?php endwhile;
			wp_reset_postdata();
		else: ?>
			<h3 class="rt-no-found"><?php esc_html_e('No Results Found', 'fasheno'); ?></h3>
		<?php endif;
		die();
	}

	/*Product advanced search Ajax */
	public function title_filter( $where, $wp_query ){
		global $wpdb;
		if ( $search_term = $wp_query->get( 'fasheno_search_q' ) ) {
			$where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( $wpdb->esc_like( $search_term ) ) . '%\'';
		}
		return $where;
	}

	public function product_search_autocomplete() {
		if ( isset( $_REQUEST['keyword'] ) ) {
			$search_post_category = ($_REQUEST['category_val']) ?? '';
			$keyword       = esc_attr( $_REQUEST['keyword'] );

			$args = array(
				'fasheno_search_q' => $keyword,
				'post_type'      => 'product',
				'post_status' => 'publish',
			);

			if ( ! empty( $search_post_category ) ) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'product_cat',
						'field'    => 'slug',
						'terms'    => $search_post_category,
					),

				);
			}
			add_filter( 'posts_where', [&$this,'title_filter'], 10, 2 );
			$query = new \WP_Query( $args );
			//remove_filter( 'posts_where', [&$this,'title_filter'], 10, 2 );
			if ( ! empty( $query ) ) {
				if ( $query->have_posts() ) :
					echo '<div class="result-wrap"><ul>';
					while ( $query->have_posts() ) : $query->the_post();
						$_product = wc_get_product( get_the_ID() );
						echo '<li>
                            <div class="thumb"><a href="' . get_the_permalink() . '">' . get_the_post_thumbnail('','thumbnail') . '</a></div>
                            <div class="content">
                            <h3 class="title"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h3>
                            <div class="rt-price price">'.$_product->get_price_html().'</div>
                            </div>
                        </li>';
					endwhile;
					echo '</ul></div>';

				else :
					echo '<div class="result-wrap"><ul><li><h3 class="title">' . __( 'No product found.', 'fasheno' ) . '</h3></li></ul></div>';
				endif;
			}
			die();

		}
	}

}
