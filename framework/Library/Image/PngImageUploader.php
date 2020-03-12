<?php

namespace Framework\Library\Image;

use Taskholder\Image;

class PngImageUploader extends BaseImageUploader
{
    protected function resize(Image $image)
    {
        $imgResource = null;

        $imgResource = imagecreatefrompng($image->getPath());

        $imgScaled = $this->scale($imgResource, $image->getWidth(), $image->getHeight());

        imagepng($imgScaled, $image->getPath());
    }
}