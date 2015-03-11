<?php
if ( ! defined( 'ABSPATH' ) )
    return;

define( 'THEME_DEVELOPER_NAME', 'Mats Mikkel Rummelhoff' );
define( 'THEME_DEVELOPER_URL', 'http://mmikkel.no' );
define( 'THEME_DEVELOPER_EMAIL', 'mail@mmikkel.no' );

// Assets
define( 'THEME_ASSETS_PATH', STYLESHEETPATH . '/assets/' );
define( 'THEME_ASSETS_URL', get_stylesheet_directory_uri() . '/assets/' );
define( 'THEME_CSS_DIRNAME', 'css' );
define( 'THEME_IMAGES_DIRNAME', 'img' );
define( 'THEME_JS_DIRNAME', 'js' );

// Settings
define( 'THEME_DISABLE_COMMENTS', true );
define( 'THEME_DISABLE_FEEDS', true );
define( 'THEME_DISABLE_ADMINBAR', true );
define( 'THEME_DISABLE_LINKS', true );
//define( 'THEME_DISABLE_POSTS', true );
define( 'THEME_POSTS_NAME', __( 'Blog', 'theme-text-domain' ) );
//define( 'THEME_DISABLE_FRONTPAGE_ITEM', true );
define( 'THEME_FRONTPAGE_NAME', __( 'Front page', 'theme-text-domain' ) );
//define( 'THEME_DISABLE_NAV_ITEM', true );
define( 'THEME_NAV_ITEM_NAME', __( 'Menus', 'theme-text-domain' ) );