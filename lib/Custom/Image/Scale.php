<?php

namespace Custom\Image;

use Custom\Image\ImageInterface;

class Scale implements ImageInterface {

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
        $image->scaleImage($this->_width, $this->_height, true);
        foreach($this->_treatments as $treatment) {
            $image = $treatment->process($image);
        }
        return $image;
    }
}
