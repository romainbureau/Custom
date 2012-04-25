<?php

namespace Custom\Image;

use Custom\Image\ImageInterface;

class Crop implements ImageInterface {

    private $_width = null;
    private $_height = null;
    private $_treatments = array();

    public function __construct($width, $height) {
        $this->_width = $width;
        $this->_height = $height;
    }

    public function addTreatment($class) {
        $this->_treatments[] = $class;
    }

    public function process(\Imagick $image) {
        $image->cropThumbnailImage($this->_width, $this->_height);
        foreach($this->_treatments as $treatment) {
            $image = $treatment->process($image);
        }
        return $image;
    }
}
