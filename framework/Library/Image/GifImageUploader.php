<?php

namespace Framework\Library\Image;

use Taskholder\Image;

class GifImageUploader extends BaseImageUploader
{
    protected function resize(Image $image)
    {
        $imgResource = null;

        $imgResource = imagecreatefromgif($image->getPath());

        $imgScaled = imagescale($imgResource, $image->maxWidth(), $image->maxHeight());

        imagegif($imgScaled, $image->getPath());
    }
}