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


    This is yer base wp-config file, tailored for use with Hearty.

*/

// Include the Hearty config
require_once( dirname( __FILE__ ) . '/hearty.php' );

/*
 * Database table prefix
 *
 */
$table_prefix = isset( $heartyDbPrefix ) ? $heartyDbPrefix : 'wp_';

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
if ( ! defined( 'AUTH_KEY' ) ) {
    define('AUTH_KEY',         'put your unique phrase here');
    define('SECURE_AUTH_KEY',  'put your unique phrase here');
    define('LOGGED_IN_KEY',    'put your unique phrase here');
    define('NONCE_KEY',        'put your unique phrase here');
    define('AUTH_SALT',        'put your unique phrase here');
    define('SECURE_AUTH_SALT', 'put your unique phrase here');
    define('LOGGED_IN_SALT',   'put your unique phrase here');
    define('NONCE_SALT',       'put your unique phrase here');
}

/**#@-*/

/*
 * Language
 * Leave blank for American English
 *
 */
// if ( ! defined( 'WPLANG' ) ) {
//  define( 'WPLANG', 'nb_NO' );
// }

// if ( ! defined( 'WPLOCALE' ) ) {
//  define( 'WPLOCALE', 'no_NO' );
// }

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
if ( ! defined('WP_DEBUG') ) {
    define( 'WP_DEBUG', false );
}

/*
 * Hide errors
 *
 */
if ( ! defined('WP_DEBUG_DISPLAY') ) {
    ini_set( 'display_errors', 0 );
    define( 'WP_DEBUG_DISPLAY', false );
}

/*
 * Database charset and collation (probably never need to change these)
 *
 */
if ( ! defined( 'DB_CHARSET' ) ) {
    define( 'DB_CHARSET', 'utf8' );
}
if ( ! defined( 'DB_COLLATE' ) ) {
    define( 'DB_COLLATE', '' );
}

/*
 * Multisite setup - sudomain setup
 * DOMAIN_CURRENT_SITE must be set - Can be overriden in local-config and stage-config
 *
 *//*
define('WP_ALLOW_MULTISITE', true);
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', true);
if ( !defined('DOMAIN_CURRENT_SITE') )
    define('DOMAIN_CURRENT_SITE', '');
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);
*/

/* That's all, stop editing! Happy blogging. */

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
