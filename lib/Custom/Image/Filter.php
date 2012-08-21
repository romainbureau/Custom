<?php

namespace Custom\Image;

use Custom\Image\Image;

abstract class Filter
{
    public static function charcoal(Image $image)
    {
        $image->get()->charcoalImage(0, 1);

        return $image;
    }

    public static function contrast(Image $image, $value = 0)
    {
        $image->get()->contrastImage($value);

        return $image;
    }

    public static function solarize(Image $image, $value = 0)
    {
        $image->get()->solarizeImage($value);

        return $image;
    }

    public static function sketch(Image $image)
    {
        $image->get()->sketchImage(1, 0, 0);

        return $image;
    }

    public static function oilpaint(Image $image, $value = 0)
    {
        $image->get()->oilpaintImage($value);

        return $image;
    }

    public static function emboss(Image $image, $value = 0)
    {
        $image->get()->embossImage($value, 0);

        return $image;
    }

    public static function grayscale(Image $image)
    {
        $image->get()->modulateImage(100, 0, 100);

        return $image;
    }

    public static function posterize(Image $image, $value = 256)
    {
        $image->get()->posterizeImage($value, true);

        return $image;
    }

}
