<?php
/**
 *
 * @author        RadiusTheme
 * @package       classified-listing/templates
 * @version       1.0.0
 */

use radiustheme\Classima\Helper;
use radiustheme\Classima\RDTheme;
use Rtcl\Helpers\Functions;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="rtcl-MyAccount-mobile-navbar">
    <h4><?php esc_html_e( 'Account Menu', 'classima' ); ?></h4>
	<?php
	$light_logo = empty( RDTheme::$options['logo_light']['url'] ) ? Helper::get_img( 'logo-light.png' ) : RDTheme::$options['logo_light'];
	?>
    <div class="rtcl-myaccount-logo">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php if ( ! empty( $light_logo['url'] ) ) { ?>
                <a class="light-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <img src="<?php echo esc_url( $light_logo['url'] ); ?>"
                         height="<?php echo isset( $light_logo['height'] ) ? esc_attr( $light_logo['height'] ) : '45'; ?>"
                         width="<?php echo isset( $light_logo['width'] ) ? esc_attr( $light_logo['width'] ) : '150'; ?>"
                         alt="<?php bloginfo( 'name' ); ?>">
                </a>
			<?php } else { ?>
                <a class="light-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <img src="<?php echo esc_url( $light_logo ); ?>" width="150" height="45" alt="<?php bloginfo( 'name' ); ?>">
                </a>
			<?php } ?>
        </a>
    </div>
    <div class="classima-MyAccount-open-menu"><span></span></div>
    <div class="rtcl-MyAccount-open-menu"><span></span></div>
    <?php do_action( 'rtcl_account_navigation' ); ?>
</div>
<div class="rtcl-MyAccount-wrap">
	<?php do_action( 'rtcl_account_navigation' ); ?>

    <div class="rtcl-MyAccount-content">
		<?php Functions::print_notices(); ?>
		<?php do_action( 'rtcl_account_content' ); ?>
    </div>
</div>
