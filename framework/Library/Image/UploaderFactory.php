<?php

namespace Framework\Library\Image;

use Framework\Contract\ImageUploader;
use Taskholder\Exception\BoundaryException;

class UploaderFactory
{
    /**
     * @param string $type
     * @return ImageUploader
     * @throws BoundaryException
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