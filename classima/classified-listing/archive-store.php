<?php
/**
 * @package ClassifiedListing/Templates
 * @version 1.2.31
 */

use radiustheme\Classima\Helper;
use radiustheme\Classima\RDTheme;
use Rtcl\Helpers\Functions as RtclFunctions;
use RtclStore\Helpers\Functions as StoreFunctions;

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'RtclPro' ) ) {
	return;
}

$layout_class = Helper::has_sidebar() ? 'col-xl-9 col-lg-8 col-sm-12 col-12' : 'col-12';

get_header( 'store' );

?>
    <div id="primary" class="content-area classima-store-single rtcl">
        <div class="container">
            <div class="row">
				<?php if ( RDTheme::$layout == 'left-sidebar' ): ?>
                    <div class="col-xl-3 col-lg-4 col-sm-12 col-12"><?php Helper::get_custom_listing_template( 'sidebar-store' ); ?></div>
				<?php endif; ?>
                <div class="<?php echo esc_attr( $layout_class ); ?>">
					<?php

					if ( rtcl()->wp_query()->have_posts() ) {

						StoreFunctions::store_loop_start();
						while ( rtcl()->wp_query()->have_posts() ) : rtcl()->wp_query()->the_post();

							/**
							 * Hook: rtcl_listing_loop.
							 */
							do_action( 'rtcl_store_loop' );

							RtclFunctions::get_template_part( 'content', 'store' );

						endwhile;

						StoreFunctions::store_loop_end();

						/**
						 * Hook: rtcl_after_store_loop.
						 *
						 * @hooked TemplateHook::pagination() - 10
						 */
						do_action( 'rtcl_after_store_loop' );
					} else {
						/**
						 * Hook: rtcl_no_stores_found.
						 *
						 * @hooked no_listings_found - 10
						 */
						do_action( 'rtcl_no_stores_found' );
					}
					?>
                </div>
				<?php if ( RDTheme::$layout == 'right-sidebar' ): ?>
                    <div class="col-xl-3 col-lg-4 col-sm-12 col-12"><?php Helper::get_custom_listing_template( 'sidebar-store' ); ?></div>
				<?php endif; ?>
            </div>
        </div>
    </div>
<?php
get_footer( 'store' );
