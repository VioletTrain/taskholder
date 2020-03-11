<?php

namespace Framework\Library\Image;

use Framework\Contract\ImageUploader;

class UploaderFactory
{
    /**
     * @param string $type
     * @return ImageUploader
     */
    public function make(string $type): ImageUploader
    {
        if ($type === 'png') {
            return new PngImageUploader();
        } elseif ($type === 'jpeg' || $type === 'jpg') {
            return new JpgImageUploader();
        } else {
            return new GifImageUploader();
        }
    }
}