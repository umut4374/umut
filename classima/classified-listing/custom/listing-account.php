<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Classima;

use Rtcl\Helpers\Functions;

?>
	<?php get_header(); ?>
    <div id="primary" class="content-area classima-myaccount">
        <div class="container">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php Helper::get_custom_listing_template( 'listing-account-content' ); ?>
			<?php endwhile; ?>
        </div>
    </div>
	<?php get_footer(); ?>