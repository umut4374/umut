<?php use Rtcl\Helpers\Functions;

$map = false;

if ( ! isset( $view ) ) { // author load more
	if ( isset( $_GET['view'] ) && in_array( $_GET['view'], [ 'grid', 'list' ], true ) ) {
		$view = sanitize_text_field( $_GET['view'] );
	} else {
		$view = Functions::get_option_item( 'rtcl_general_settings', 'default_view', 'list' );
	}
}

if ( 'list' === $view ) {
	if ( isset( $post_id ) ) { // author load more
		$listing = rtcl()->factory->get_listing( $post_id );
		Functions::get_template( 'custom/list', compact( 'map', 'listing' ) );
	} else {
		Functions::get_template( 'custom/list', compact( 'map' ) );
	}
} else {
	Functions::get_template( 'custom/grid', compact( 'map' ) );
}