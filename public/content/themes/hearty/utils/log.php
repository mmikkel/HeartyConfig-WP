<?php
if ( ! defined( 'ABSPATH' ) )
	return;

class Theme_Log {

	private static 	$instance = null,
					$_enabled = false;

	private function __construct() {

		if (
			WP_DEBUG
			&& defined( 'THEME_ENABLE_CONSOLE_LOGGER' )
			&& THEME_ENABLE_CONSOLE_LOGGER
		) {
			self::enable();
		}

	}

	public static function getInstance() {

		if ( self::$instance == null ){
			self::$instance = new self;
		}

		return self::$instance;

	}

	public static function enable() {
		if( ! self::$_enabled ) {
			try {
				require_once( realpath( dirname( __FILE__ ) . '/../libs/chromephp/ChromePhp.php' ) );
				self::$_enabled = true;
			} catch ( Exception $e ) {}
		}
	}

	public static function log() {
		if ( ! self::$_enabled || ! class_exists( 'ChromePhp' ) ) {
			return false;
		}
		$args = func_get_args();
		ChromePhp::log( $args );
	}

	public static function warn() {
		if ( ! self::$_enabled || ! class_exists( 'ChromePhp' ) ) {
			return false;
		}
		$args = func_get_args();
		ChromePhp::warn( $args );
	}

	public static function error() {
		if ( ! self::$_enabled || ! class_exists( 'ChromePhp' ) ) {
			return false;
		}
		$args = func_get_args();
		ChromePhp::error( $args );
	}

	private static function _validate() {
		return ( self::$_enabled && class_exists( 'ChromePhp' ) );
	}

}

Theme_Log::getInstance();