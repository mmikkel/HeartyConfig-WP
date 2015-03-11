<?php
if ( ! defined( 'ABSPATH' ) )
    return;

class ThemePost extends TimberPost {

    private     $_theFeaturedImage = null;

    public function featuredImage()
    {

        if ( $this->_theFeaturedImage === null ) {

            $featuredImageId = get_post_thumbnail_id( $this->ID );

            $this->_theFeaturedImage = $featuredImageId ? new ThemeImage( $featuredImageId ) : false;

        }

        return $this->_theFeaturedImage;

    }

}