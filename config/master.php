<?php
/**
 * Hearty Config for Wordpress
 *
 * @author Mats Mikkel Rummelhoff
 * @package WordPress
 *
    __  __                __           ______            _____
   / / / /__  ____ ______/ /___  __   / ____/___  ____  / __(_)___ _
  / /_/ / _ \/ __ `/ ___/ __/ / / /  / /   / __ \/ __ \/ /_/ / __ `/
 / __  /  __/ /_/ / /  / /_/ /_/ /  / /___/ /_/ / / / / __/ / /_/ /
/_/ /_/\___/\__,_/_/   \__/\__, /   \____/\____/_/ /_/_/ /_/\__, /
                          /____/                           /____/


    This is the master Hearty Config file. You probably won't need to change anything here.

*/

/*
* Sets yer config files' dir
*
*/
define( 'HEARTY_CONFIG_PATH', dirname( __FILE__ ) );

/*
 * Sets yer environment. Yarr!
 *
 */
if ( file_exists( HEARTY_CONFIG_PATH . '/local.php' ) ) {

    // Here be local config file – assume local env
    define( 'HEARTY_ENV', 'local' );

} else {

    foreach ( $heartyEnvs as $heartyEnv => $heartyEnvHosts ) {
        $heartyEnvHosts = explode( ',', preg_replace( '/\s+/', '', $heartyEnvHosts ) );
        if ( in_array( $_SERVER[ 'SERVER_NAME' ], $heartyEnvHosts ) ) {
            define( 'HEARTY_ENV', $heartyEnv );
            break;
        }
    }

}

// Arrr! Nay environment – walk the plank!
if ( ! defined( 'HEARTY_ENV' ) ) {
    die( 'Yarr! No environment defined.' );
}

/*
 * Sets yer protocol and host
 *
 */
if ( ! defined( 'HEARTY_SCHEME' ) ) {
    define( 'HEARTY_SCHEME', ( ! empty( $_SERVER[ 'HTTPS' ] ) && $_SERVER[ 'HTTPS' ] !== 'off' || $_SERVER[ 'SERVER_PORT' ] == 443) ? 'https://' : 'http://' );
}
if ( ! defined( 'HEARTY_HOST' ) ) {
    define( 'HEARTY_HOST', HEARTY_SCHEME . $_SERVER[ 'SERVER_NAME' ] );
}

/*
 * Where do ye want yer templates and plugins, matey?
 *
 */
if ( ! defined( 'WP_SITEURL' ) ) {
    define( 'WP_SITEURL', HEARTY_HOST . ( isset( $heartyWpFolder ) ? $heartyWpFolder : '/wp' ) );
}

if ( ! defined( 'WP_HOME' ) ) {
    define( 'WP_HOME', HEARTY_HOST );
}

if ( ! defined( 'WP_CONTENT_URL' ) ) {
    define( 'WP_CONTENT_URL', HEARTY_HOST . ( isset( $heartyContentFolder ) ? $heartyContentFolder : '/content' ) );
}

if ( ! defined( 'WP_CONTENT_DIR' ) ) {
    define( 'WP_CONTENT_DIR', HEARTY_BASEPATH . ( isset( $heartyContentFolder ) ? $heartyContentFolder : '/content' ) );
}

if ( ! defined( 'WP_PLUGIN_URL' ) ) {
    define( 'WP_PLUGIN_URL', HEARTY_HOST . ( isset( $heartyPluginsFolder ) ? $heartyPluginsFolder : '/plugins' ) );
}

if ( ! defined( 'WP_PLUGIN_DIR' ) ) {
    define( 'WP_PLUGIN_DIR', HEARTY_BASEPATH . ( isset( $heartyPluginsFolder ) ? $heartyPluginsFolder : '/plugins' ) );
}

if ( ! defined( 'WP_DEFAULT_THEME' ) && isset( $heartyDefaultTheme ) ) {
    define( 'WP_DEFAULT_THEME', $heartyDefaultTheme );
}

/*
 * Includes yer environment config file
 *
 */
$heartyEnvConfigFile = HEARTY_CONFIG_PATH . '/' . HEARTY_ENV . '.php';

if ( ! file_exists( $heartyEnvConfigFile ) ) {
    die( 'Scurvy seadog! Where be yer ' . HEARTY_ENV . ' config file?' );
}

require_once( $heartyEnvConfigFile );
