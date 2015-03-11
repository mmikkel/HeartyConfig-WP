<?php

require_once( dirname( __FILE__ ) . '/flexible-content/flexible-content.php' );

// Add options page
// if ( function_exists( 'acf_add_options_page' ) ) {
//     acf_add_options_page( array(
//         'page_title'    => 'Options',
//         'menu_title'    => 'Site options',
//         'menu_slug'     => 'seeker-options',
//         'capability'    => 'edit_posts',
//         'redirect'      => false
//     ) );
// }

// Include exported fields
if ( defined( 'THEME_DISABLE_ACF' ) && THEME_DISABLE_ACF && file_exists( dirname( __FILE__) . '/fields.php' ) ) {
	add_filter( 'acf/settings/show_admin', '__return_false' );
    require_once( dirname( __FILE__ ) . '/fields.php' );
}