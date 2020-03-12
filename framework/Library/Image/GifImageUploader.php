<?php

namespace Framework\Library\Image;

use Taskholder\Image;

class GifImageUploader extends BaseImageUploader
{
    protected function resize(Image $image)
    {
        $imgResource = null;

        $imgResource = imagecreatefromgif($image->getPath());

        $imgScaled = $this->scale($imgResource, $image->getWidth(), $image->getHeight());

        imagegif($imgScaled, $image->getPath());
    }
}