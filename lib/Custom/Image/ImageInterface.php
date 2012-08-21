<?php

namespace Custom\Image;

interface ImageInterface
{
    public function addTreatment($class);
    public function process(\Imagick $image);
}
