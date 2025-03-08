<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.7
 *
 */

namespace radiustheme\Classima;

use RtclPro\Controllers\Hooks\TemplateHooks;
use Rtcl\Helpers\Link;
use Rtcl\Helpers\Functions;

?>
<div class="swiper-slide">
    <div class="listing-grid-each listing-grid-each-1<?php echo esc_attr( $class ); ?>">
        <div class="rtin-item">
            <div class="rtin-thumb">
                <a class="rtin-thumb-inner rtcl-media"
                   href="<?php the_permalink(); ?>"><?php $listing->the_thumbnail(); ?></a>
				<?php TemplateHooks::sold_out_banner(); ?>
				<?php if ( $display['type'] ): ?>
                    <div class="rtin-type">
                        <span><?php echo sprintf( apply_filters( 'classima_ad_type_prefix', __( "For %s", 'classima' ), $type['label'] ),
		                        $type['label'] ); ?></span>
                    </div>
				<?php endif; ?>
            </div>
            <div class="rtin-content">
				<?php do_action( 'classima_grid_view_before_content' ); ?>
				<?php if ( $display['cat'] ): ?>
                    <a class="rtin-cat"
                       href="<?php echo esc_url( Link::get_category_page_link( $category ) ); ?>"><?php echo esc_html( $category->name ); ?></a>
				<?php endif; ?>

                <h3 class="rtin-title listing-title" title="<?php the_title(); ?>"><a
                            href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

				<?php
				if ( $display['label'] ) {
					$listing->the_badges();
				}
				?>

				<?php
				if ( $display['fields'] ) {
					TemplateHooks::loop_item_listable_fields();
				}
				?>

                <ul class="rtin-meta">
					<?php if ( $display['date'] ): ?>
                        <li><i class="far fa-fw fa-clock" aria-hidden="true"></i><?php $listing->the_time(); ?></li>
					<?php endif; ?>
					<?php if ( $display['user'] && method_exists( $listing, 'get_the_author_url' ) ): ?>
                        <li class="rtin-usermeta"><i class="far fa-fw fa-user" aria-hidden="true"></i>
							<?php if ( $listing->can_add_user_link() && ! is_author() ) : ?>
                                <a href="<?php echo esc_url( $listing->get_the_author_url() ); ?>"><?php $listing->the_author(); ?></a>
							<?php else: ?>
								<?php $listing->the_author(); ?>
							<?php endif; ?>
							<?php do_action( 'rtcl_after_author_meta', $listing->get_owner_id() ); ?>
                        </li>
					<?php endif; ?>
					<?php if ( $display['location'] && $listing->has_location() ): ?>
                        <li><i class="fa fa-fw fa-map-marker"
                               aria-hidden="true"></i><?php $listing->the_locations( true, true ); ?></li>
					<?php endif; ?>
					<?php if ( $display['views'] ): ?>
                        <li><i class="fa fa-fw fa-eye"
                               aria-hidden="true"></i><?php echo sprintf( esc_html__( '%1$s Views', 'classima' ),
								number_format_i18n( $listing->get_view_counts() ) ); ?>
                        </li>
					<?php endif; ?>
                </ul>

				<?php if ( $display['price'] ): ?>
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
		<?php if ( $map ) {
			$listing->the_map_lat_long();
		} ?>
    </div>
</div>