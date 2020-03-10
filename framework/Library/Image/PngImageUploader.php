<?php

namespace Framework\Library\Image;

use Taskholder\Image;

class PngImageUploader extends BaseImageUploader
{
    protected function resize(Image $image)
    {
        $imgResource = null;

        $imgResource = imagecreatefrompng($image->getPath());

        $imgScaled = imagescale($imgResource, $image->maxWidth(), $image->maxHeight());

        imagepng($imgScaled, $image->getPath());
    }
}