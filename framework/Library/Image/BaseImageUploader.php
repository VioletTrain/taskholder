<?php

namespace Framework\Library\Image;

use Framework\Contract\ImageUploader;
use Taskholder\Image;

abstract class BaseImageUploader implements ImageUploader
{
    protected string $storagePath;

    public function __construct(string $storagePath = BASE_PATH . '/storage/img/')
    {
        $this->storagePath = $storagePath;
    }

    public function upload(Image $image): Image
    {
        $newName = uniqid() . '.' . $image->getType();
        $imagePath = $this->storagePath . $newName;

        if (!move_uploaded_file($image->getTmpName(), $imagePath)) {
            $newName = '';
        }

        $image->setName($newName)
            ->setPath($imagePath);

        if (!$this->fits($image)) {
            $this->resize($image);
        }

        return $image;
    }

    final protected function fits(Image $image): bool
    {
        return $image->getWidth() <= $this->maxWidth() && $image->getHeight() <= $this->maxHeight();
    }

    protected function maxWidth(): int
    {
        return 320;
    }

    protected function maxHeight(): int
    {
        return 240;
    }

    abstract protected function resize(Image $image);
}