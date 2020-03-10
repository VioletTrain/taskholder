<?php

namespace Framework\Library\Image;

use Taskholder\Exception\BoundaryException;
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
     * @throws BoundaryException
     */
    public function upload(Image $image)
    {
        $uploader = $this->factory->make($image->getType());

        $uploader->upload($image);
    }
}