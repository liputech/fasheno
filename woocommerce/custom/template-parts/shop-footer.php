<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */


use RT\Fasheno\Helpers\Fns;


?>
		</main>
			</div>
				<?php
				if ( is_active_sidebar( Fns::default_sidebar('woo-archive') ) ) {
					fasheno_sidebar( Fns::default_sidebar('woo-archive')  );
				} else {
					fasheno_sidebar( Fns::default_sidebar('main') );
				}
				?>
			</div>
		</div>
	</div>
</div>
