<?php
if ( ! defined( 'ABSPATH' ) )
	return;

/*
 * Include controllers
 *
 */
foreach ( glob ( dirname( __FILE__ ) . '/controllers/*.php') as $class ) {
	require_once( $class );
}

/**
 * theme_flexfield
 * Includes and outputs flexible content from specified file and field names
 *
 * @field 	Field ID for the flexible content (or an array of field ids)
 * @id 		Post ID (optional if called from within the loop)
 * @file 	File containing flexible content partials
 */
function theme_flexfield( $field, $post_id = false, $class = false ) {

	$class = $class ?: 'Default_Flex_Layout';

	if ( $compiled_field = theme_get_flexfield( $field, $post_id ) ) {

		echo $compiled_field;
		return;

	}

	echo '';

}

/**
 * theme_get_flexfield
 * Includes and outputs flexible content from specified file and field names
 *
 * @field 	Field ID for the flexible content (or an array of field ids)
 * @id 		Post ID (optional if called from within the loop)
 * @file 	File containing flexible content partials
 */
function theme_get_flexfield( $field, $post_id = false, $class = false ) {

	global $post;

	$class = $class ?: 'Default_Flex_Layout';

	$classpath = dirname( __FILE__ ) . '/controllers/' . sanitize_file_name( $class ) . '.php';
	$fields = array();

	if ( file_exists( $classpath ) ) {

		require_once( $classpath );

		if ( ! $post_id && is_object( $post ) && isset( $post->ID ) ) {
			$post_id = $post->ID;
		}

		if ( ! is_array( $field ) ) {
			$field = array( $field );
		}

		foreach ( $field as $single_field ) {
			$fieldname = sanitize_title_with_dashes( $single_field );
			$field_instance = new $class( $fieldname, $post_id );
			$fields[] = $field_instance->get();
		}

	} elseif ( WP_DEBUG_DISPLAY ) {

		return $classpath . ' not found<br/>';

	}

	return ! empty( $fields ) ? implode('', $fields ) : false;

}