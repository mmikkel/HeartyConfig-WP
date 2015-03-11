<?php

class Default_Flex_Layout {

	const CACHE = false;

	protected 	$_field,
				$_fieldname,
				$_post_id,
				$_current_layout,
				$_layout_counter,
				$_layouts;

	public function __construct( $fieldname, $post_id ) {

		if ( ! $this->_field = get_field( $fieldname, $post_id ) ) {
			if ( WP_DEBUG_DISPLAY ) {
				//die( theme_throw_error( 'flexfield_404', printf( __( 'Flexible content field "%1$s" not found', 'theme-text-domain' ), $fieldname ) ) );
			}
			return false;
		}

		$this->_fieldname = $fieldname;
		$this->_post_id = $post_id;
		$this->_layout_counter = 0;
		$this->_layouts = array();

	}

	public function get() {

		while ( has_sub_field( $this->_fieldname, $this->_post_id ) ) {
			$this->get_layout();
		}

		if ( ! empty( $this->_layouts ) ) {
			return implode( '', $this->_layouts );
		}

		return false;

	}

	protected function get_layout() {

		$this->_current_layout = get_row_layout();

		$method = 'do_' . $this->_current_layout;

		if ( ! method_exists( $this, $method ) ) {

			if ( WP_DEBUG_DISPLAY ) {
				die( theme_throw_error( 'flexlayout_404', printf( __( 'Flexible content layout "%1$s" not found (method "%2$s")', 'theme-text-domain' ), $this->_current_layout, $method ) ) );
			}

		} else {

			$this->_layouts[] = call_user_func( array( $this, $method ) );

		}

		++$this->_layout_counter;

	}

	protected function compile( $template, $data = array() ) {

		$classes = array( 'flex-content-block', $this->_current_layout );

		if ( $this->_layout_counter == 0 ){
			$data[ 'classes' ][] = 'first';
		} else if ( $this->_layout_counter == count ( $this->_field ) - 1 ) {
			$data[ 'classes' ][] = 'last';
		} else {
			$data[ 'classes' ][] = 'block-' . ( $this->_layout_counter + 1 );
		}

		if ( isset( $data[ 'classes' ] ) && is_array( $data[ 'classes' ] ) ) {

			$classes = array_merge( $classes, $data[ 'classes' ] );
			unset( $data[ 'classes' ] );

		}

		$data[ 'classes' ] = $classes;

		$ttl = ( self::CACHE && defined( 'TIMBER_CACHETIME' ) && TIMBER_CACHETIME ) ? TIMBER_CACHETIME : false;

		return Timber::compile( $template, $data, $ttl );

	}

}