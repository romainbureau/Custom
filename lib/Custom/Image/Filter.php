<?php

namespace Custom\Image;

use Custom\Image\Image;

abstract class Filter {

    static public function charcoal(Image $image) {
        $image->get()->charcoalImage(0, 1);
        return $image;
    }

    static public function contrast(Image $image, $value = 0) {
        $image->get()->contrastImage($value);
        return $image;
    }

    static public function solarize(Image $image, $value = 0) {
        $image->get()->solarizeImage($value);
        return $image;
    }

    static public function sketch(Image $image) {
        $image->get()->sketchImage(1, 0, 0);
        return $image;
    }

    static public function oilpaint(Image $image, $value = 0) {
        $image->get()->oilpaintImage($value);
        return $image;
    }

    static public function emboss(Image $image, $value = 0) {
        $image->get()->embossImage($value, 0);
        return $image;
    }

    static public function grayscale(Image $image) {
        $image->get()->modulateImage(100, 0, 100);
        return $image;
    }

    static public function posterize(Image $image, $value = 256) {
        $image->get()->posterizeImage($value, true);
        return $image;
    }

}
