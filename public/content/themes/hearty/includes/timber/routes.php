<?php
if ( ! defined( 'ABSPATH' ) || ! class_exists( 'Timber' ) )
	return;

// Timber::add_route(':pageSlug/articles/:articleSlug', function( $params ) {

//     $query = 'post_type=seeker_article&name=' . $params[ 'articleSlug' ];

//     Timber::load_template( 'single.php', $query, 200, $params );

// });

// Paged route
// Timber::add_route(':pageSlug/articles/:articleSlug/page/:pg', function($params){

//     $query = 'post_type=seeker_article&name=' . $params[ 'articleSlug' ] . '&paged=' . intval( $params[ 'pg' ] );

//     Timber::load_template( 'archive.php', $query, 200, $params );

// });