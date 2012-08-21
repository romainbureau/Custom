<?php

namespace Custom\Image;

use Custom\Image\Image;

abstract class Info
{
    public static function geometry(Image $image)
    {
        return $image->get()->getImageGeometry();
    }

    public static function size(Image $image)
    {
        return $image->get()->getImageLength();
    }

    public static function type(Image $image)
    {
        return $image->get()->getImageType();
    }
}
