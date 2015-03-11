<?php
if ( ! defined( 'ABSPATH' ) )
	return;

/*
* Used for manually throwing 404
*
*/
function theme_throw_404()
{
    header( 'HTTP/1.0 404 Not Found' );
    $wp_query->set_404();
    require TEMPLATEPATH . '/404.php';
    exit;
}