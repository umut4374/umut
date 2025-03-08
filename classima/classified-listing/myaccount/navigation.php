<?php
/**
 *
 * @author 		RadiusTheme
 * @package 	classified-listing/templates
 * @version     1.0.0
 */

use radiustheme\Classima\Helper;
use radiustheme\Classima\RDTheme;
use Rtcl\Helpers\Functions;
use Rtcl\Helpers\Link;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'rtcl_before_account_navigation' );
?>

<nav class="rtcl-MyAccount-navigation">
    <h3><?php esc_html_e( 'My Account', 'classima' ); ?></h3>
	<?php
	$light_logo = empty( RDTheme::$options['logo_light']['url'] ) ? Helper::get_img( 'logo-light.png' ) : RDTheme::$options['logo_light'];
	?>
    <div class="rtcl-myaccount-logo">
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
    </div>
	<ul>
		<?php foreach ( Functions::get_account_menu_items() as $endpoint => $label ) : ?>
			<li class="<?php echo Functions::get_account_menu_item_classes( $endpoint ); ?>">
				<a href="<?php echo esc_url( Link::get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
	<?php do_action( 'rtcl_after_account_navigation_list' ); ?>
</nav>

<?php do_action( 'rtcl_after_account_navigation' ); ?>
