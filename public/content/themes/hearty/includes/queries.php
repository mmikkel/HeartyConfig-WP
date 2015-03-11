<?php
if ( !defined( 'ABSPATH' ) )
	return;

/*
 * Custom queries
 *
 */
function theme_custom_queries( $query ){

	if ( is_admin() || ! $query->is_main_query() ){
		return $query;
	}

	// if ( is_post_type_archive( 'someposttype' ) ) {
	// 	$query->set( 'posts_per_page', -1 );
	// 	$query->set( 'no_found_rows', true );
	// }

	return $query;

}

/*
 * Custom queries (admin)
 *
 */
function theme_custom_admin_queries($query){

	if( ! is_admin() || ! $query->is_main_query() ){
		return $query;
	}

	return $query;

}


if ( ! is_admin() ) {
	add_action( 'pre_get_posts', 'theme_custom_queries', 1);
} else {
	add_action( 'pre_get_posts', 'theme_custom_admin_queries', 1);
}

?>