<?php
if ( !defined( 'ABSPATH' ) )
	return;

class Theme_local {

	private static $instance = null;

	private function __construct() {

		if ( defined( 'THEME_LOCAL_HOME') && defined( 'THEME_PUBLIC_HOME') && defined( 'WP_LOCAL_DEV' ) && WP_LOCAL_DEV === true ) {

			$filters = array(
				'option_home',
				'option_siteurl',
				'bloginfo',
				'bloginfo_url',
				'stylesheet_directory_uri',
				'template_directory_uri',
				'script_loader_src',
				'style_loader_src',
				'plugins_url'
			);

			foreach ( $filters as $filter )
				add_filter( $filter, array( __CLASS__, 'url_pre_option' ), 1, 1 );

			add_filter( 'wp_get_attachment_url', array( __CLASS__, 'reset_image' ), 1, 2 );

		}

	}

	public static function getInstance() {

		if ( self::$instance == null ){
			self::$instance = new self;
		}

		return self::$instance;

	}

	public static function url_pre_option( $value ) {
		$value = str_replace( THEME_PUBLIC_HOME, THEME_LOCAL_HOME, $value );
		return $value;
	}

	public static function reset_image( $value, $id ) {
		$post_id = (int) $id;
		if ( ! $post = get_post( $post_id ) )
			return false;

		if ( $file = get_post_meta( $post->ID, '_wp_attached_file', true ) ) { // Get attached file
			if ( ( $uploads = wp_upload_dir() ) && false === $uploads[ 'error' ] ) { // Get upload directory
				$value = str_replace( THEME_PUBLIC_HOME, THEME_LOCAL_HOME, $value );
				if ( ! file_exists( $uploads['basedir'] . "/$file" ) )
					$value = str_replace( THEME_LOCAL_HOME, THEME_PUBLIC_HOME, $value );
			}
		}
		return $value;
	}

}

Theme_local::getInstance();

?>