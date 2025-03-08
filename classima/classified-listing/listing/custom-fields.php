<?php
/**
 * @author        RadiusTheme
 * @package       classified-listing/templates/listing
 * @version       1.0.0
 *
 * @var array $fields
 * @var int   $listing_id
 */

use Rtcl\Helpers\Functions;
use Rtcl\Models\RtclCFGField;

$listing = rtcl()->factory->get_listing( $listing_id );
?>
<h3 class="rtin-specs-title"><?php esc_html_e( 'Overview', 'classima' ); ?></h3>
<div class="classima-custom-fields clearfix">
	<?php
	if ( method_exists( 'Rtcl\Helpers\Functions', 'isEnableFb' ) && Functions::isEnableFb() ) {
		if ( $listing->can_show_category() ) {
			$category = $listing->get_categories();
			$category = current( $category );
			if ( $category ) {
				?>
                <ul>
                    <li>
                        <span class="rtin-label"><?php esc_html_e( 'Category:', 'classima' ); ?></span>
                        <span class="rtin-title">
                            <a href="<?php echo esc_url( get_term_link( $category, rtcl()->category ) ) ?>"><?php echo esc_html( $category->name ); ?></a>
                        </span>
                    </li>
                </ul>
				<?php
			}
		}
		$listing->custom_fields();
	} else {
		$items = array();
		$urls  = array();

		if ( $listing->can_show_category() ) {
			$category = $listing->get_categories();
			$category = current( $category );
			if ( $category ) {
				$items[] = array(
					'label' => esc_html__( 'Category', 'classima' ),
					'value' => "<a href='" . get_term_link( $category, rtcl()->category ) . "'>$category->name</a>",
				);
			}
		}
		foreach ( $fields as $field ) {
			$field = new RtclCFGField( $field->ID );
			$value = $field->getFormattedCustomFieldValue( $listing_id );
			if ( ! empty( $value ) ) {
				if ( $field->getType() === 'url' ) {
					$nofollow = ! empty( $field->getNofollow() ) ? ' rel="nofollow"' : '';
					$urls[]   = sprintf( ' <a href="%1$s" target="%2$s"%3$s>%4$s</a>', $value, $field->getTarget(), $nofollow, $field->getLabel() );
				} else {
					$items[] = array(
						'label' => $field->getLabel(),
						'value' => $value,
					);
				}
			}
		}
		if ( ! empty( $items ) || ! empty( $urls ) ) {
			?>
            <ul>
				<?php
				if ( ! empty( $items ) ):
					foreach ( $items as $item ): ?>
                        <li>
                            <span class="rtin-label"><?php echo esc_html( $item['label'] ); ?>: </span>
                            <span class="rtin-title"><?php echo wp_kses_post( $item['value'] ); ?></span>
                        </li>
					<?php endforeach; endif; ?>
				<?php
				if ( ! empty( $urls ) ):
					foreach ( $urls as $url ): ?>
                        <li>
                            <span class="rtin-label"><?php echo wp_kses_post( $url ); ?></span>
                        </li>
					<?php endforeach; endif; ?>
            </ul>
		<?php }
	} ?>
</div>