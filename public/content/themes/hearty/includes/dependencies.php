<?php

// $isAdmin = is_admin() || in_array( $GLOBALS[ 'pagenow' ], array( 'wp-login.php', 'wp-register.php' ) );
// $requiredPlugins = array(
//     'Timber' => 'https://github.com/jarednova/timber',
//     'ACF' => 'http://www.advancedcustomfields.com/'
// );

// // Don't bother checking dependencies for cp
// if ( $isAdmin ) {
//     return;
// }

// // Check for composer dependencies path
// if ( ! isset( $vendorPath ) ) {
//     die( 'Dependencies path not set' );
// }

// // Require composer dependencies
// if ( ! $isAdmin && ! file_exists( $vendorPath . '/autoload.php' ) ) {
//     die( 'Dependencies missing. Please run "composer install" from theme root.' );
// }
// require_once( $vendorPath . '/autoload.php' );

// // Plugin dependencies
// foreach ( $requiredPlugins as $pluginName => $pluginUrl ) {
//     if ( ! class_exists( $pluginName ) ) {
//         die( 'Required plugin <a href="' . $pluginUrl . '" target="_blank">' . $pluginName . '</a> not found' );
//     }
// }