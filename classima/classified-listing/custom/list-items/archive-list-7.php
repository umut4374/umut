<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.7
 */

namespace radiustheme\Classima;

use Rtcl\Helpers\Link;
use Rtcl\Helpers\Functions;
use RtclPro\Controllers\Hooks\TemplateHooks;
use RtclPro\Helpers\Fns;

$phone = get_post_meta( $listing_post->ID, 'phone', true );
?>
<div class="listing-list-each listing-list-each-6<?php echo esc_attr( $class ); ?>">
	<div class="rtin-item">
		<div class="rtin-thumb">
			<a class="rtin-thumb-inner rtcl-media" href="<?php the_permalink(); ?>"><?php $listing->the_thumbnail(); ?></a>
			<?php TemplateHooks::sold_out_banner(); ?>
		</div>
		<div class="rtin-content-area">
			<div class="rtin-content">

				<?php if ( $display['cat'] ) : ?>
					<a class="rtin-cat" href="<?php echo esc_url( Link::get_category_page_link( $category ) ); ?>"><?php echo esc_html( $category->name ); ?></a>
				<?php endif; ?>

				<h3 class="rtin-title listing-title"><a href="<?php $listing->the_permalink(); ?>"><?php $listing->the_title(); ?></a></h3>

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
					<?php if ( $display['date'] ) : ?>
						<li><i class="far fa-fw fa-clock" aria-hidden="true"></i><?php $listing->the_time(); ?></li>
					<?php endif; ?>
					<?php if ( $display['user'] && method_exists( $listing, 'get_the_author_url' ) ) : ?>
						<li class="rtin-usermeta"><i class="far fa-fw fa-user" aria-hidden="true"></i>
							<?php if ( $listing->can_add_user_link() && ! is_author() ) : ?>
								<a href="<?php echo esc_url( $listing->get_the_author_url() ); ?>"><?php $listing->the_author(); ?></a>
							<?php else : ?>
								<?php $listing->the_author(); ?>
							<?php endif; ?>
							<?php do_action( 'rtcl_after_author_meta', $listing->get_owner_id() ); ?>
						</li>
					<?php endif; ?>
					<?php if ( $display['location'] && $listing->has_location() ) : ?>
						<li><i class="fa fa-fw fa-map-marker" aria-hidden="true"></i><?php $listing->the_locations( true, true ); ?></li>
					<?php endif; ?>
					<?php if ( $display['views'] ) : ?>
						<li><i class="fa fa-fw fa-eye" aria-hidden="true"></i><?php echo sprintf( esc_html__( 'Visit: %1$s', 'classima' ), number_format_i18n( $listing->get_view_counts() ) ); ?></li>
					<?php endif; ?>
				</ul>

				<?php if ( $display['excerpt'] ) : ?>
					<?php
					$excerpt = Helper::get_current_post_content( $listing_post );
					$excerpt = wp_trim_words( $excerpt, $display['excerpt_limit'] );
					?>
					<p class="rtin-excerpt"><?php echo esc_html( $excerpt ); ?></p>
				<?php endif; ?>

				<?php do_action( 'classima_list_view_after_content' ); ?>

				<?php do_action( 'classima_listing_list_view_after_content', $listing ); ?>

			</div>
			<div class="rtin-right">
				<?php if ( $display['type'] && $type ) : ?>
					<div class="rtin-type"><i class="fa <?php echo esc_attr( $type['icon'] ); ?>" aria-hidden="true"></i><?php echo esc_html( $type['label'] ); ?></div>
				<?php endif; ?>
				<?php if ( $display['price'] ) : ?>
					<div class="rtin-price">
						<?php
						if ( method_exists( $listing, 'get_price_html' ) ) {
							Functions::print_html( $listing->get_price_html() );
						}
						?>
					</div>
				<?php endif; ?>

				<div class="rtin-fav"><?php echo Functions::get_favourites_link( $listing_post->ID ); ?></div>

				<?php if ( Fns::is_enable_quick_view() ) { ?>
					<div class="rtin-quick-view">
						<a class="rtcl-quick-view" href="#" data-listing_id="<?php echo absint( $listing->get_id() ); ?>">
							<i class="fas fa-search-plus"></i><span><?php esc_html_e( 'Quick View', 'classima' ); ?></span>
						</a>
					</div>
				<?php } ?>

				<?php
				if ( Fns::is_enable_compare() ) {
					$compare_ids    = ! empty( $_SESSION['rtcl_compare_ids'] ) ? $_SESSION['rtcl_compare_ids'] : [];
					$selected_class = '';
					if ( is_array( $compare_ids ) && in_array( $listing->get_id(), $compare_ids ) ) {
						$selected_class = ' selected';
					}
					?>
					<div class="rtin-compare">
						<a class="rtcl-compare <?php echo esc_attr( $selected_class ); ?>" href="#" data-listing_id="<?php echo absint( $listing->get_id() ); ?>">
							<i class="fa fa-retweet"></i><span><?php esc_html_e( 'Compare', 'classima' ); ?></span>
						</a>
					</div>
				<?php } ?>
			</div>			
		</div>

	</div>
	<?php
	if ( $map ) {
		$listing->the_map_lat_long();}
	?>
</div>