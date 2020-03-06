<?php

namespace Taskholder;

class ImageHandler
{
    private string $storagePath;

    public function __construct(string $storagePath = BASE_PATH . '/storage/img/')
    {
        $this->storagePath = $storagePath;
    }

    public function upload(Image $image): string
    {
        $name = $this->save($image);
        $image->setName($name);

        if (!$image->fits()) {
            $this->resize($image);
        }

        return $name;
    }

    private function resize(Image $image)
    {
        imagescale(fopen($this->storagePath . $image->getName(), 'r'), $image->maxWidth(), $image->maxHeight());
    }

    private function save(Image $image): string
    {
        $newName = uniqid() . '.' . $image->getType();
        $imagePath = $this->storagePath . $newName;

        if (!move_uploaded_file($image->getTmpName(), $imagePath)) {
            return '';
        }

        return $newName;
    }
}