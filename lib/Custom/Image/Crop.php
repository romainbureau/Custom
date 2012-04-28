<?php

namespace Custom\Image;

use Custom\Image\ImageInterface;
use Custom\Image\BaseTreatment;

class Crop extends BaseTreatment implements ImageInterface {

    private $_width = null;
    private $_height = null;

    public function __construct($width, $height) {
        $this->_width = $width;
        $this->_height = $height;
    }

    public function process(\Imagick $image) {
        $image->cropThumbnailImage($this->_width, $this->_height);
        $image = $this->_process($image);
        return $image;
    }
}
