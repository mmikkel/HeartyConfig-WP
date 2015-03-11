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
*/

/*
* Where be yer config files?
*
*/
$heartyConfigPath = '/../config';

/*
 * What be yer environment URLs, matey?
 *
 */
$heartyEnvs = array(
    // 'dev' => 'dev.example1.com',
    // 'stage' => 'stage.example1.com',
    // 'prod' => 'example.com,www.example.com',
);

/*
* Do ye want a default theme?
*
*/
$heartyDefaultTheme = 'hearty';

/*
 * What be yer core catalog's name? Yep, this be yer Wordpress folder
 *
 */
$heartyWpFolder = '/core';

/*
 * Where do ye want yer templates and plugins, matey?
 *
 */
$heartyContentFolder = '/content';
$heartyPluginsFolder = '/plugins';

/*
* Change yer database prefix, scallywag!
*
*/
$heartyDbPrefix = 'hrtywp_';

/*
* ----- NO EDITING BELOW THIS LINE, YE SCURVY SEABASS! ------
*
*/
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', dirname( __FILE__ ) . $heartyWpFolder . '/' );
}
if ( ! defined( 'HEARTY_BASEPATH' ) ) {
    define( 'HEARTY_BASEPATH', dirname( __FILE__ ) );
}
define( 'HEARTY_VERSION', '1.0' );

require_once( realpath( HEARTY_BASEPATH . $heartyConfigPath . '/master.php' ) );