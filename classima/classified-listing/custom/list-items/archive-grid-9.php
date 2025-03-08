<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.7
 */

namespace radiustheme\Classima;

use RtclPro\Controllers\Hooks\TemplateHooks;
use Rtcl\Controllers\Hooks\TemplateHooks as freeTemplateHooks;
use Rtcl\Helpers\Link;
use Rtcl\Helpers\Functions;

?>
<div class="listing-grid-each listing-grid-each-8 listing-grid-each-9<?php echo esc_attr( $class ); ?>">
    <div class="rtin-item">
        <div class="rtin-thumb">
            <a class="rtin-thumb-inner rtcl-media"
               href="<?php the_permalink(); ?>"><?php $listing->the_thumbnail(); ?></a>
			<?php if ( $listing->is_featured() ) { ?>
                <div class="rtin-featured-ad">
					<?php freeTemplateHooks::listing_featured_badge( $listing ); ?>
                </div>
			<?php } ?>

			<?php if ( isset( $type['label'] ) && ( $display['type'] == 1 || $display['type'] == 'true' ) ): ?>
                <div class="rtin-type">
                    <span><?php echo sprintf( apply_filters( 'classima_ad_type_prefix', __( "For %s", 'classima' ), $type['label'] ),
		                    $type['label'] ); ?></span>
                </div>
			<?php endif; ?>
			<?php TemplateHooks::sold_out_banner(); ?>
			<?php freeTemplateHooks::loop_item_meta_buttons(); ?>
        </div>
        <div class="rtin-content">
			<?php do_action( 'classima_grid_view_before_content' ); ?>
			<?php
			if ( $display['label'] == 1 || $display['label'] == 'true' ) {
				$listing->the_badges();
			}
			?>

            <h3 class="rtin-title listing-title" title="<?php the_title(); ?>"><a
                        href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

			<?php if ( $display['cat'] == 1 || $display['cat'] == 'true' ): ?>
                <div class="rtin-cat-action">
                    <div class="rtin-cat-wrap">
                        <a class="rtin-cat"
                           href="<?php echo esc_url( Link::get_category_page_link( $category ) ); ?>"><?php echo esc_html( $category->name ); ?></a>
                    </div>
                </div>
			<?php endif; ?>

			<?php
			if ( $display['fields'] == 1 || $display['fields'] == 'true' ) {
				TemplateHooks::loop_item_listable_fields();
			}
			?>

            <ul class="rtin-meta">
				<?php if ( $display['date'] == 1 || $display['date'] == 'true' ): ?>
                    <li><i class="far fa-fw fa-clock" aria-hidden="true"></i><?php $listing->the_time(); ?></li>
				<?php endif; ?>
				<?php if ( ( $display['location'] == 1 || $display['location'] == 'true' ) && $listing->has_location() ): ?>
                    <li><i class="fa fa-fw fa-map-marker"
                           aria-hidden="true"></i><?php $listing->the_locations( true, true ); ?></li>
				<?php endif; ?>
				<?php if ( $display['views'] == 1 || $display['views'] == 'true' ): ?>
                    <li><i class="fa fa-fw fa-eye"
                           aria-hidden="true"></i><?php echo sprintf( esc_html__( '%1$s Views', 'classima' ),
							number_format_i18n( $listing->get_view_counts() ) ); ?>
                    </li>
				<?php endif; ?>
            </ul>

			<?php if ( $display['price'] == 1 || $display['price'] == 'true' ): ?>
                <div class="rtin-price">
					<?php
					if ( method_exists( $listing, 'get_price_html' ) ) {
						Functions::print_html( $listing->get_price_html() );
					}
					?>
                </div>
			<?php endif; ?>
			<?php do_action( 'classima_grid_view_after_content' ); ?>
        </div>
    </div>

</div>