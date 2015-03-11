<?php
if ( ! defined( 'ABSPATH' ) )
	return;

require_once( realpath( dirname( __FILE__ ) . '/../libs/mobile_detect/mobile_detect.php' ) );

class Theme_Detect {

	private static $instance = null;
	private static $detect = null;

	private function __construct() {
		self::$detect = new Mobile_Detect();
		add_filter( 'body_class', array( __CLASS__, 'append_body_class' ) );
	}

	public static function getInstance() {
		if ( self::$instance == null ){
			self::$instance = new self;
		}
		return self::$instance;
	}

	public static function getDevice() {
		if ( self::isMobile() ) {
			return 'mobile';
		} else if ( self::isTablet() ) {
			return 'tablet';
		}
		return 'desktop';
	}

	/**
	 * isMobile
	 * Detect mobile (not tablet)
	 *
	 */
	public static function isMobile() {
		return ( self::$detect->isMobile() && ! self::$detect->isTablet() ) ? true : false;
	}

	/**
	 * isTablet
	 * Detect tablet (not mobile)
	 *
	 */
	public static function isTablet() {
		return ( self::$detect->isTablet() && ! self::$detect->isMobile() ) ? true : false;
	}

	/**
	 * isMobileOrTablet
	 * Detect mobile and/or tablet
	 *
	 */
	public static function isMobileOrTablet() {
		return ( self::$detect->isMobile() || self::$detect->isTablet() ) ? true : false;
	}

	/**
	 * isiOS
	 * Detect iOS device
	 *
	 */
	public static function isiOS() {
		return self::$detect->isiOS();
	}

	/**
	 * isAndroid
	 * Detect Android device
	 *
	 */
	public static function isAndroid() {
		return self::$detect->isAndroid();
	}

	/**
	 * isWhatever
	 * Detect whatever - see docs @ https://github.com/serbanghita/Mobile-Detect
 	 * @value String
	 *
	 */
	public static function isWhatever( $value ) {
		return self::$detect->is( $value );
	}

	/**
	 * append_body_class
	 * Filter appends device type (mobile, tablet, desktop) to body class
	 *
	 */
	public static function append_body_class( $classes = array() ) {
		$classes[] = self::getDevice();
		return $classes;
	}

}

Theme_Detect::getInstance();