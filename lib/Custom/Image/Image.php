<?php

namespace Custom\Image;

class Image
{
    protected $_image;
    protected $_treatments = array();

    public function __construct($image)
    {
        $this->_image = new \Imagick($image);
    }

    public function format($format = 'jpeg')
    {
        $this->_image->setImageFormat($format);
    }

    public function compression($quality = 85)
    {
        $this->_image->setCompressionQuality($quality);
    }

    public function addTreatment($class)
    {
        $this->_treatments[] = $class;
    }

    public function process()
    {
        foreach ($this->_treatments as $treatment) {
            $treatment->process($this->_image);
        }
    }

    public function get()
    {
        return $this->_image;
    }

    public function __destruct()
    {
        $this->_image->destroy();
    }
}
