<?php
if ( ! defined( 'ABSPATH' ) )
    return;

class ThemeImage extends TimberImage {

    public function altTag()
    {
        return $this->_wp_attachment_image_alt ?: $this->title;
    }

    public function getFormat()
    {
    	return $this->width >= $this->height ? 'landscape' : 'portrait';
    }

}