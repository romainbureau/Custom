<?php

namespace Custom\Image;

abstract class BaseTreatment
{
    protected $_treatments = array();

    public function addTreatment($class)
    {
        $this->_treatments[] = $class;
    }

    protected function _process(\Imagick $image)
    {
        foreach ($this->_treatments as $treatment) {
            $image = $treatment->process($image);
        }

        return $image;
    }
}
