<?php

namespace Framework\Library\Image;

use Taskholder\Image;

class JpgImageUploader extends BaseImageUploader
{
    protected function resize(Image $image)
    {
        $imgResource = null;

        $imgResource = imagecreatefromjpeg($image->getPath());

        $imgScaled = imagescale($imgResource, $image->maxWidth(), $image->maxHeight());

        var_dump(imagejpeg($imgScaled, $image->getPath()));
    }
}