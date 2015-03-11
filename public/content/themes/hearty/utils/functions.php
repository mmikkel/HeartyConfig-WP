<?php
if ( ! defined( 'ABSPATH' ) )
	return;
/**
 * theme_header
 * Print the header
 *
 * @param array $args Mixed Arguments
 */

function theme_header( $args = array() ) {

	$defaults = array(
		'viewport' => 'width=device-width, initial-scale=1',
		'charset' => get_bloginfo( 'charset' ),
		'title' => wp_title( '|', false, 'right' ),
		'above_head' => '',
		'below_head' => '',
	);

	$args = wp_parse_args( $args, $defaults );

	$html_class = ( is_admin_bar_showing() ) ? ' top-toolbar' : '';

	?>

<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9<?php echo $html_class; ?>" <?php language_attributes(); ?>><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js<?php echo $html_class; ?>" <?php language_attributes(); ?>><!--<![endif]-->
<head>

	<meta charset="<?php esc_attr_e( $args[ 'charset' ] ); ?>" />
	<meta name="viewport" content="<?php esc_attr_e( $args[ 'viewport' ] ); ?>" />
	<title><?php echo esc_html( $args[ 'title' ] ); ?></title>
	<script>document.documentElement.className = document.documentElement.className.replace(/(\s|^)no-js(\s|$)/, '$1js$2');</script>
	<?php
	if ( file_exists( TEMPLATEPATH . '/assets/img/favicon.png') ) { ?>
		<link rel="icon" type="image/png" href="<?php echo theme_url( 'favicon.png' ); ?>">
	<?php }

	echo apply_filters( 'theme_above_head', $args[ 'above_head' ] );

	wp_head();

	echo apply_filters( 'theme_below_head', $args[ 'below_head' ] );

	?>

</head>
<?php }

/*
	theme_footer
*/
function theme_footer() {
	wp_footer();
}

/*
	theme_throw_error
*/
function theme_throw_error( $code, $message, $data = null ) {
	$error = new WP_Error( $code, $message, $data );
}

/*
	theme_flexvideo
*/
function theme_flexvideo( $url, $echo = true ) {

	$embed_url = false;

    if ( strpos( $url, 'vimeo' ) > -1) {

		$host = 'vimeo';
		$host_url = 'http://player.vimeo.com/video/';
        $video_id = preg_replace("/(.*)\/(\d)/", "$2", $url);

        if( $video_id != '' ){
            $embed_url = $host_url.$video_id;
        }

	} else if ( strpos( $url, 'youtube' ) > -1 ) {

		$host = 'youtube';
        $host_url = 'http://www.youtube.com/embed/';
        $video_id = parse_str( parse_url( $url, PHP_URL_QUERY ), $temp_array );
        $video_id = $temp_array['v'];

        if ( $video_id != '' ) {
            $embed_url = $host_url.$video_id.'?html5=1&showinfo=0';
        }

	}

	$embed_code = '<div class="flex-video widescreen ' . $host . '">
			<iframe width="16" height="9" src="' . $embed_url . '" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
		</div><!-- /.flex-video -->';

	if ( $echo ) {
		echo $embed_code;
	} else {
		return $embed_code;
	}

}

/*
	theme_get_domain
*/
function theme_get_domain( $url )
{
	$pieces = parse_url( $url );
	$domain = isset( $pieces[ 'host' ] ) ? $pieces[ 'host' ] : '';
	if ( preg_match( '/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs ) ) {
		return $regs[ 'domain' ];
	}
	return $pieces[ 'host' ];
}