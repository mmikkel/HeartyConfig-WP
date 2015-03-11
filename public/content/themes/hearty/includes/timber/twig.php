<?php

/*
* Twig settings and whatnot
*
*/
function theme_add_to_twig( $twig ) {
	//$twig->getExtension( 'core' )->setTimezone( 'Europe/Oslo' );
	return $twig;
}
//add_filter( 'get_twig', 'theme_add_to_twig' );

/*
 * Add custom Twig filters
 *
 */
function theme_add_twig_filters( $twig ) {

	// // soft hyphens
	// $twig->addFilter( 'hyphen', new Twig_Filter_Function( function( $string, $first, $last ) {
	// 	return str_replace( $first . $last, $first . '&shy;' . $last, $string );
	// } ) );

	return $twig;

}
add_action( 'twig_apply_filters', 'theme_add_twig_filters' );