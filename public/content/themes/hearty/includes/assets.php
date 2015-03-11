<?php
if ( ! defined( 'ABSPATH' ) )
	return;

function theme_assets_enqueue() {

	global $wp_styles, $wp_scripts;

	/* --- STYLES --- */
	//wp_enqueue_style( 'app', theme_get_uri( 'css', 'app.css' ), false, theme_cachebust( 'css', 'app.css' ), 'all' );
	//wp_enqueue_style( 'screen', theme_get_uri( 'css', 'screen.css' ), false, theme_cachebust( 'css', 'screen.css' ), 'screen' );
	//wp_enqueue_style( 'print', theme_get_uri( 'css', 'print.css' ), false, theme_cachebust( 'css', 'print.css' ), 'print' );

	/* --- SCRIPTS --- */

	// Modernizr
	//wp_enqueue_script( 'modernizr', theme_get_uri( 'js', 'modernizr.min.js' ), false, theme_cachebust( 'js', 'modernizr.min.js' ), false );

	// jQuery + plugins
	// wp_deregister_script( 'jquery' );
	// wp_enqueue_script( 'jquery-custom', theme_get_uri( 'js', 'jquery.custom.js' ), false, theme_cachebust( 'js', 'jquery.custom.js' ), true );
	//wp_enqueue_script( 'jquery-plugins', theme_get_uri( 'js', 'plugins.js' ), array( 'jquery' ), theme_cachebust( 'js', 'plugins.js' ), true );


	// Foundation JS
	//wp_enqueue_script( 'foundation', theme_get_uri( 'js', 'foundation.custom.js' ), array( 'jquery' ), theme_cachebust( 'js', 'foundation.custom.js' ), true );

	// App
	//wp_enqueue_script( 'app', theme_get_uri( 'js', 'app.js' ), array( 'jquery' ), theme_cachebust( 'js', 'app.js' ), true );

	// Enable AJAX
	// $params = array(
	// 	'endpoint' => admin_url( 'admin-ajax.php' ),
	// 	'debug' => WP_DEBUG_DISPLAY,
	// );
	// wp_localize_script( 'app', 'appConfig', $params );

}

add_action( 'wp_enqueue_scripts', 'theme_assets_enqueue' );

function theme_assets_admin_enqueue() {

	wp_enqueue_style( 'app-admin', theme_get_uri( 'css', 'admin.css' ), false, theme_cachebust( 'css', 'admin.css' ), 'all' );

}

add_action( 'admin_enqueue_scripts', 'theme_assets_admin_enqueue' );

function theme_get_folder( $type ) {

	switch ( $type ) {
		case 'css' :
			$folder = THEME_CSS_DIRNAME;
			break;
		case 'js' :
			$folder = THEME_JS_DIRNAME;
			break;
		default :
			return false;
	}

	return $folder . '/';

}

function theme_get_uri( $type, $file ) {

	if ( ! $folder = theme_get_folder( $type ) ) {
		return false;
	}

	$filepath = THEME_ASSETS_PATH . $folder;

	$filepath_url = THEME_ASSETS_URL . $folder;

	if ( ! strrpos( $file, '.min.' ) && ! WP_DEBUG ) {
		$minified = substr( $file, 0, strrpos( $file, '.' ) ) . '.min' . substr( $file, strrpos( $file, '.' ) );
		if ( file_exists( $filepath . $file ) ) {
			$file = $minified;
		}
	}

	return $filepath_url . $file;

}

function theme_cachebust( $type, $file ) {

	if ( ! $folder = theme_get_folder( $type ) ) {
		return false;
	}

	$filepath = THEME_ASSETS_PATH . $folder;

	if ( ! strrpos( $file, '.min.' ) && ! WP_DEBUG ) {
		$minified = substr( $file, 0, strrpos( $file, '.' ) ) . '.min' . substr( $file, strrpos( $file, '.' ) );
		if ( file_exists( $filepath . $file ) ) {
			$file = $minified;
		}
	}

	if ( file_exists( $filepath . $file ) ) {
		return filemtime( $filepath . $file );
	}

	return false;

}

?>