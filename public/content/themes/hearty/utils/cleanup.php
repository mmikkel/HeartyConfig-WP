<?php
if ( !defined( 'ABSPATH' ) )
	return;

class Theme_Cleanup {

	private static $instance = null;

	private function __construct() {

		register_theme_directory( WP_CONTENT_DIR . '/themes/' );

		add_action( 'init', array( __CLASS__, 'init' ), 5 );

		// Theme activation
		add_action( 'after_switch_theme', array( __CLASS__, 'after_switch_theme' ), 10, 2 );

		// Disable widgets
		add_action( 'widgets_init', array( __CLASS__, 'disable_widgets') );

		// Additional MIME types
		add_filter( 'upload_mimes', array( __CLASS__, 'allowed_mimes') );

		// Remove version from RSS
		add_filter( 'the_generator', array( __CLASS__, 'remove_rss_version' ) );

		// Remove pesky injected css for recent comments widget
		add_filter( 'wp_head', array( __CLASS__, 'remove_wp_widget_recent_comments_style' ), 1 );

		// Clean up comment styles in the head
		add_action('wp_head', array( __CLASS__, 'remove_recent_comments_style' ), 1);

		add_action( 'wp_before_admin_bar_render', array( __CLASS__, 'wp_before_admin_bar_render' ), 0 );
		add_action( 'login_enqueue_scripts', array( __CLASS__, 'login_enqueue_scripts' ) );

		// Post content related cleaning
		add_filter( 'get_image_tag_class', array( __CLASS__, 'image_tag_class' ), 0, 4 );
		add_filter( 'get_image_tag', array( __CLASS__, 'image_editor' ), 0, 4 );
		add_filter( 'the_content', array( __CLASS__, 'img_unautop' ), 30 );
		add_filter( 'gallery_style', array( __CLASS__, 'gallery_style' ) );

		// Disable comments
		if ( defined( 'THEME_DISABLE_COMMENTS' ) && THEME_DISABLE_COMMENTS ) {
			update_option( 'default_comment_status', 'closed' );
		}

		// Disable feeds
		if ( defined( 'THEME_DISABLE_FEEDS' ) && THEME_DISABLE_FEEDS ) {
			add_action( 'do_feed', array( __CLASS__, 'disable_feeds'), 1 );
		}

		// Disable admin bar
		if ( defined( 'THEME_DISABLE_ADMINBAR' ) && THEME_DISABLE_ADMINBAR ) {
			add_filter( 'show_admin_bar', '__return_false' );
		}

		// Custom admin actions
		if ( is_admin() ) {
			add_action( '_admin_menu', array( __CLASS__, '_admin_menu'), 1 );
			add_action( 'admin_menu', array( __CLASS__, 'admin_menu') );
			add_filter( 'admin_footer_text', array( __CLASS__, 'admin_footer_text') );
			//add_action( 'restrict_manage_posts', array( __CLASS__, 'sort_taxonomy_manage_media') );
		}

	}

	public static function getInstance() {

		if ( self::$instance == null ){
			self::$instance = new self;
		}

		return self::$instance;

	}

	public static function init() {

		// EditURI link
	    remove_action( 'wp_head', 'rsd_link' );

	    // Category feed links
	    remove_action( 'wp_head', 'feed_links_extra', 3 );

	    // Post and comment feed links
	    remove_action( 'wp_head', 'feed_links', 2 );

	    // Windows Live Writer
	    remove_action( 'wp_head', 'wlwmanifest_link' );

	    // Index link
	    remove_action( 'wp_head', 'index_rel_link' );

	    // Previous link
	    remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );

	    // Start link
	    remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );

	    // Canonical
	    remove_action('wp_head', 'rel_canonical', 10, 0 );

	    // Shortlink
	    remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

	    // Links for adjacent posts
	    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

	    // WP version
	    remove_action( 'wp_head', 'wp_generator' );

	    // Prevent unneccecary info from being displayed
	    add_filter( 'login_errors', create_function( '$a', "return null;" ) );

	}

	public static function after_switch_theme() {

		// Create front page
		if ( get_option( 'show_on_front' ) != 'page' || ! is_numeric( get_option( 'page_on_front' ) ) ){
			if ( $post_id = wp_insert_post( array(
					'post_type' => 'page',
					'post_title' => __( 'Front page', 'theme-text-domain' ),
					'post_status' => 'publish',
				) ) ) {
				update_option( 'show_on_front', 'page' );
				update_option( 'page_on_front', $post_id );
			}
		}

	}

	public static function remove_rss_version() {
		return '';
	}

	public static function remove_wp_widget_recent_comments_style() {
		if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
			remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
		}
	}

	// remove injected CSS from recent comments widget
	public static function remove_recent_comments_style() {
		global $wp_widget_factory;
		if ( isset( $wp_widget_factory->widgets[ 'WP_Widget_Recent_Comments' ] ) ) {
			remove_action( 'wp_head', array( $wp_widget_factory->widgets[ 'WP_Widget_Recent_Comments' ], 'recent_comments_style' ) );
		}
	}

	public static function gallery_style( $css ) {
		return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
	}

	public static function wp_before_admin_bar_render() {
		global $wp_admin_bar;

		$wp_admin_bar->remove_menu( 'updates' );
		$wp_admin_bar->remove_menu( 'wp-logo' );
		$wp_admin_bar->remove_menu( 'comments' );
	}

	public static function login_enqueue_scripts() {
		?>
		<style type="text/css">
			body.login div#login h1 a {
				<?php if ( file_exists( THEME_ASSETS_PATH . '/img/logo.svg' ) ) : ?>
					background-image: url(<?php echo THEME_ASSETS_URL; ?>/img/logo.svg) !important;
					background-size: contain !important;
					display: block;
					width: 80%;
				<?php else : ?>
					background-image: none;
				<?php endif; ?>
				padding-bottom: 20px;
				margin-bottom: 40px;
			}
		</style>
		<?php
	}

	// Clean the output of attributes of images in editor
	public static function image_tag_class( $class, $id, $align, $size ) {
		$align = 'align' . esc_attr($align);
		return $align;
	}

	// Remove width and height in editor, for a better responsive world.
	public static function image_editor( $html, $id, $alt, $title ) {
		return preg_replace(array(
				'/\s+width="\d+"/i',
				'/\s+height="\d+"/i',
				'/alt=""/i'
			),
			array(
				'',
				'',
				'',
				'alt="' . $title . '"'
			),
			$html);
	}

	// Wrap images with figure tag
	public static function img_unautop( $pee ) {
		$pee = preg_replace('/<p>\\s*?(<a .*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s', '<figure>$1</figure>', $pee);
		return $pee;
	}

	public static function allowed_mimes( $mimes ) {

		$mime_types = array(
			'ac3' => 'audio/ac3',
			'mpa' => 'audio/MPA',
			'flv' => 'video/x-flv',
			'ai' => 'application/postscript',
			'eps' => 'application/postscript',
			'ppt' => 'application/vnd.ms-powerpoint',
			'pps' => 'application/vnd.ms-powerpoint',
			'svg' => 'image/svg+xml'
		);

		return array_merge( $mimes, $mime_types );

	}

	public static function disable_widgets() {

		$widgets = array(
			'WP_Widget_Pages',
			'WP_Widget_Calendar',
			'WP_Widget_Archives',
			'WP_Widget_Links',
			'WP_Widget_Meta',
			'WP_Widget_Search',
			'WP_Widget_Text',
			'WP_Widget_Categories',
			'WP_Widget_Recent_Posts',
			'WP_Widget_Recent_Comments',
			'WP_Widget_RSS',
			'WP_Widget_Tag_Cloud',
			'WP_Nav_Menu_Widget',
			'bcn_widget',
		);

		foreach ( $widgets as $widget ) {
			unregister_widget( $widget );
		}

	}

	public static function _admin_menu() {

		global $menu;

		$dashboard_widgets_to_remove = array(
			'dashboard_right_now',
			'dashboard_recent_comments',
			'dashboard_plugins',
			'dashboard_recent_drafts',
			'dashboard_incoming_links',
			'dashboard_quick_press',
			'dashboard_primary',
			'dashboard_secondary'
		);

		foreach( $dashboard_widgets_to_remove as $dashboard_widget ) {
			remove_meta_box( $dashboard_widget, 'dashboard', 'core' );
		}

		if ( defined( 'THEME_DISABLE_POSTS' ) && THEME_DISABLE_POSTS ) {
			remove_menu_page( 'edit.php' );
		} else {
			$postsName = defined( 'THEME_POSTS_NAME' ) && THEME_POSTS_NAME ? THEME_POSTS_NAME : __( 'News', 'theme-text-domain' );
			$menu[ 5 ][ 0 ] = $postsName;
		}

	}

	public static function admin_menu() {

		if ( defined( 'THEME_DISABLE_LINKS' ) && THEME_DISABLE_LINKS ) {
			remove_menu_page( 'link-manager.php' );
		}

		if ( defined( 'THEME_DISABLE_COMMENTS' ) && THEME_DISABLE_COMMENTS ) {
			remove_menu_page( 'edit-comments.php' );
		}

		if ( ! current_user_can( 'manage_options' ) ) {
			remove_menu_page( 'themes.php' );
			remove_menu_page( 'tools.php' );
		}

		if ( get_option( 'page_on_front' ) && ! ( defined( 'THEME_DISABLE_FRONTPAGE_ITEM' ) && THEME_DISABLE_FRONTPAGE_ITEM ) ) {
			$page_id = absint( get_option( 'page_on_front' ) );
			$frontPageName = defined( 'THEME_FRONTPAGE_NAME' ) && THEME_FRONTPAGE_NAME ? THEME_FRONTPAGE_NAME : __( 'Front page', 'theme-text-domain' );
			add_menu_page( $frontPageName, $frontPageName, 'upload_files', 'post.php?post=' . $page_id . '&action=edit', '', 'dashicons-admin-home', 3 );
		}

		if ( ! ( defined( 'THEME_DISABLE_NAV_ITEM' ) && THEME_DISABLE_NAV_ITEM ) ) {
			$navItemName = defined( 'THEME_NAV_ITEM_NAME' ) && THEME_NAV_ITEM_NAME ? THEME_NAV_ITEM_NAME : __( 'Menus', 'theme-text-domain' );
			add_object_page( THEME_NAV_ITEM_NAME, THEME_NAV_ITEM_NAME, 'upload_files', 'nav-menus.php', '', 'dashicons-menu' );
		}

	}

	public static function admin_footer_text( $footer_text ) {
		if ( defined( 'THEME_DEVELOPER_URL' ) && THEME_DEVELOPER_URL !== false && defined( 'THEME_DEVELOPER_EMAIL' ) && THEME_DEVELOPER_EMAIL !== false ) {
			$theme = wp_get_theme();
			return '<em>' . $theme->get( 'Name' ) . ' v. ' . $theme->get( 'Version' ) . ' | ' . __( 'Developed by', 'theme-text-domain' ) . ' <a href="' . THEME_DEVELOPER_URL . '" target="_blank">' . ( defined( 'THEME_DEVELOPER_NAME' ) ? THEME_DEVELOPER_NAME : THEME_DEVELOPER_EMAIL ) . '</a></em>';
		} else {
			return '';
		}
	}

}

Theme_Cleanup::getInstance();