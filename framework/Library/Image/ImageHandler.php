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

    /**
     * @param Image $image
     */
    public function upload(Image $image)
    {
        $uploader = $this->factory->make($image->getType());

        $uploader->upload($image);
    }
}