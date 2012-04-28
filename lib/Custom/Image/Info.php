<?php

namespace Custom\Image;

use Custom\Image\Image;

abstract class Info {

    static public function geometry(Image $image) {
        return $image->get()->getImageGeometry();
    }

    static public function size(Image $image) {
        return $image->get()->getImageLength();
    }

    static public function type(Image $image) {
        return $image->get()->getImageType();
    }
}
