<?php
if ( ! defined( 'ABSPATH' ) || ! class_exists( 'Timber' ) )
	return;

function theme_add_to_context( $context ){
    // Add stuff to context
    // $context[ 'foo' ] = 'bar';
    return $context;
}
//add_filter( 'timber_context', 'theme_add_to_context' );