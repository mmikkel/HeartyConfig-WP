<?php
if ( ! defined( 'ABSPATH' ) || ! class_exists( 'Timber' ) )
	return;

require_once( dirname( __FILE__ ) . '/context.php' );
require_once( dirname( __FILE__ ) . '/routes.php' );
require_once( dirname( __FILE__ ) . '/twig.php' );

/*
 * Include controllers
 *
 */
foreach ( glob ( dirname( __FILE__ ) . '/controllers/*.php') as $class ) {
	require_once( $class );
}

function theme_set_timber_cache() {
	if ( ! defined( 'TIMBER_CACHETIME' ) && ( ! defined( 'TIMBER_DISABLE_CACHE' ) || TIMBER_DISABLE_CACHE === false ) ) {
		define( 'TIMBER_CACHETIME', 84600 );
	} else {
        define( 'TIMBER_CACHETIME', false );
    }
}
add_action( 'after_setup_theme', 'theme_set_timber_cache' );
