<?php

namespace Custom\Image;

class Write {
    private $_write_to;

    public function __construct($write_to) {
        $this->_write_to = $write_to;
    }

    public function process(\Imagick $image) {
        $image->writeImage($this->_write_to);
    }
}
