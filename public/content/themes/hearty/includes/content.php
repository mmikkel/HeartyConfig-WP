<?php
if ( !defined( 'ABSPATH' ) )
	return;

function theme_register_post_types() {

	// register_post_type( 'custompost' , array(
	// 	'labels' => array(
	// 		'name' => __( 'Customposts', 'theme-text-domain' ),
	// 		'singular_name' => __( 'Custom', 'theme-text-domain' ),
	// 		'add_new' => __( 'Add custom', 'theme-text-domain' ),
	// 		'add_new_item' => __( 'Add new custom', 'theme-text-domain' ),
	// 		'edit_item' => __( 'Edit custom', 'theme-text-domain' ),
	// 		'new_item' => __( 'New custom', 'theme-text-domain' ),
	// 		'view_item' => __( 'Show custom', 'theme-text-domain' ),
	// 		'search_items' => __( 'Search for custom', 'theme-text-domain' ),
	// 		'not_found' =>  __( 'None found', 'theme-text-domain' ),
	// 		'not_found_in_trash' => __( 'None found in trashcan', 'theme-text-domain' ),
	// 		'parent_item_colon' => ''
	// 	),
	// 	'public' => true,
	// 	'publicly_queryable' => true,
	// 	'exclude_from_search' => false,
	// 	'show_in_nav_menus' => true,
	// 	'show_ui' => true,
	// 	'query_var' => true,
	// 	'has_archive' => false,
	// 	'rewrite' => array(
	// 			'slug' => 'custom',
	// 		),
	// 	'capability_type' => 'post',
	// 	'hierarchical' => false,
	// 	'menu_position' => null,
	// 	'supports' => array( 'title', 'thumbnail' ),
	// 	'menu_icon' => 'dashicons-admin-page'
	// ));

	// register_taxonomy('customtax',array('custom'), array(
	// 	'hierarchical' => true,
	// 	'labels' => array(
	// 		'name' => _x( 'Custom', 'taxonomy general name' ),
	// 		'singular_name' => _x( 'Custom', 'taxonomy singular name' ),
	// 		'search_items' =>  __( 'Search custom' ),
	// 		'all_items' => __( 'All custom' ),
	// 		'parent_item' => __( 'Parents' ),
	// 		'parent_item_colon' => __( 'Parents:' ),
	// 		'edit_item' => __( 'Edit' ),
	// 		'update_item' => __( 'Update' ),
	// 		'add_new_item' => __( 'Add' ),
	// 		'new_item_name' => __( 'New name' ),
	// 		'menu_name' => __( 'Groups' )
	// 	),
	// 	'show_admin_column' => true,
	// 	'show_ui' => true,
	// 	'query_var' => true,
	// 	'rewrite' => array( 'slug' => 'customtax' )
	// ));

}

add_action( 'init', 'theme_register_post_types' );

?>