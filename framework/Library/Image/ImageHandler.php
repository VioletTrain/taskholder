<?php

namespace Framework\Library\Image;

use Taskholder\Image;

class ImageHandler
{
    private UploaderFactory $factory;

    public function __construct(UploaderFactory $factory)
    {
        $this->factory = $factory;
    }

    public function upload(Image $image): Image
    {
        $uploader = $this->factory->make($image->getType());

        return $uploader->upload($image);
    }
}