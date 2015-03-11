<?php
/*
 * Ajax Init
 *
 */
function theme_ajax_init() {
	if ( ! isset( $_REQUEST[ 'action'] ) || ! defined( 'DOING_AJAX' ) ) {
		return;
	}
	new Theme_Ajax();
}

if ( defined( 'DOING_AJAX' ) ) {
	add_action( 'admin_init', 'theme_ajax_init' );
}

/*
 * Ajax Class
 *
 */
class Theme_Ajax {

	// public function __construct () {

	// 	add_action( 'wp_ajax_nopriv_example', array(__CLASS__, 'get_example') );
	// 	add_action( 'wp_ajax_example', array(__CLASS__, 'get_example') );

	// }

	// private static function respond( $success = true, $message = '', $payload = null ) {
	// 	die( json_encode( array(
	// 		'success' => $success,
	// 		'payload' => $payload,
	// 		'message' => $message,
	// 	) ) );
	// }

	// public static function get_example() {

	// 	//check_ajax_referer( 'test_nonce', '_wpnonce' );

	// 	self::respond( true );

	// }

} // END class Theme_Ajax

?>