<?php

require_once( dirname( __FILE__ ) . '/Default_Flex_Layout.php' );

class Custom_Layout extends Default_Flex_Layout {

	/*
	* Just an example...
	*
	*/
	// protected function do_example()
	// {
	// 	if ( ! $editor = get_sub_field( 'editor' ) ) {
	// 		return false;
	// 	}

	// 	// Get image/video
	// 	$mediaRepeater = get_sub_field( 'media' );
	// 	if ( is_array( $mediaRepeater ) && ! empty( $mediaRepeater ) ) {
	// 		$media = array_shift( $mediaRepeater );
	// 		$media[ 'image' ] = isset( $media[ 'image' ] ) && strlen( $media[ 'image' ] ) > 0 ? new ThemeImage( $media[ 'image' ] ) : false;
	// 	}

	// 	$data = array(
	// 		'editor' => $editor,
	// 		'media' => $media[ 'image' ] ? $media : false,
	// 	);

	// 	return self::compile( 'flexible-content/editor_media.twig', $data );

	// }

}