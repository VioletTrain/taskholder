<?php

namespace Framework\Library\Image;

use Taskholder\Image;

class JpgImageUploader extends BaseImageUploader
{
    protected function resize(Image $image)
    {
        $imgResource = null;

        $imgResource = imagecreatefromjpeg($image->getPath());

        $imgScaled = $this->scale($imgResource, $image->getWidth(), $image->getHeight());

        imagejpeg($imgScaled, $image->getPath());
    }
}