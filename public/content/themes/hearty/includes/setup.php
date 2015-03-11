<?php
if ( !defined( 'ABSPATH' ) )
	return;

function theme_setup() {

	// Supports
	add_theme_support( 'post-thumbnails' );

	// Menus
	register_nav_menu( 'primary', 'Primary menu' );

}

add_action( 'after_setup_theme', 'theme_setup' );

function theme_body_class( $classes ) {
	return $classes;
}
//add_filter( 'body_class', 'theme_body_class' );

// Some debug info...
function theme_get_build_time() { ?>

<!--
	 <?php echo get_num_queries(); ?> queries in <?php timer_stop(1); ?> seconds.
	 Template cache is <?php echo ( defined( 'TIMBER_CACHETIME' ) && TIMBER_CACHETIME ) ? 'ON' : 'OFF'; ?>.
-->
<?php }
if ( WP_DEBUG && ! is_admin() ) { add_action( 'shutdown' , 'theme_get_build_time' ); }