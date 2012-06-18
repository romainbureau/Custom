<?php

namespace Custom\Image;

use Custom\Image\ImageInterface;
use Custom\Image\BaseTreatment;

class FixOrientation extends BaseTreatment implements ImageInterface {
    private $_file;
    private $_orientation_info;

    public function __construct($file) {
        $this->_file = $file;
        $this->_orientation_info = array(
            1 => 'Horizontal (normal)',
            2 => 'Mirrors horizontal',
            3 => 'Rotate 180',
            4 => 'Mirror vertical',
            5 => 'Mirror horizontal and rotate 270 CW',
            6 => 'Rotate 90 CW',
            7 => 'Mirror horizontal and rotate 90 CW',
            8 => 'Rotate 270 CW');
    }

    public function process(\Imagick $image) {
        $info = getimagesize($this->_file);
        if($info['mime'] != 'image/jpeg')
            return $image;

        if(!$exif_data = exif_read_data($this->_file))
            return $image;

        if(isset($exif_data['Orientation'])) {
            $ort = $exif_data['Orientation'];
            if($ort > 1) {
                switch($ort) {
                case 2: $image->flopImage(); break;
                case 3: $image->rotateImage(new \ImagickPixel(), 180); break;
                case 4: $image->flipImage(); break;
                case 5: $image->flopImage(); $image->rotateImage(new \ImagickPixel(), 270); break;
                case 6: $image->rotateImage(new \ImagickPixel(), 90); break;
                case 7: $image->flopImage(); $image->rotateImage(new \ImagickPixel(), 90); break;
                case 8: $image->rotateImage(new \ImagickPixel(), 270); break;
                }
            }
        }
        return $image;
    }
}
