<?php
/**
 * Listing Form
 *
 * @author    RadiusTheme
 * @package   classified-listing/templates
 * @version   1.0.0
 *
 * @var int $post_id
 */

if ( ! class_exists( 'RtclPro' ) ) {
	return;
}

use Rtcl\Helpers\Functions;

if ( Functions::isEnableFb() ) { ?>
    <div id="rtcl-form-builder-container">
        <div id="rtcl-form-builder">
            <div class="rtcl-fb-loader-container">
                <div class="rtcl-fb-loader"></div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="rtcl rtcl-user rtcl-post-form-wrap">
		<?php do_action( "rtcl_listing_form_before", $post_id ); ?>
        <form action="" method="post" id="rtcl-post-form" class="form-vertical classima-form">
			<?php do_action( "rtcl_listing_form_start", $post_id ); ?>
            <div class="rtcl-post">
				<?php do_action( "rtcl_listing_form", $post_id ); ?>
            </div>
			<?php do_action( "rtcl_listing_form_end", $post_id ); ?>
        </form>
		<?php do_action( "rtcl_listing_form_after", $post_id ); ?>
    </div>
<?php } ?>