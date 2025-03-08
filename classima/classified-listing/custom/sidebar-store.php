<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Classima;
?>

<aside class="sidebar-widget-area sidebar-store-archive">
	<?php do_action( 'classima_before_sidebar' ); ?>
	<?php
	if ( is_active_sidebar( 'sidebar-archive-store' ) ){
		dynamic_sidebar( 'sidebar-archive-store' );
	}

	do_action( 'classima_after_sidebar' );
	?>
</aside>