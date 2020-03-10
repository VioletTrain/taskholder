<?php

namespace Framework\Contract;

use Taskholder\Image;

interface ImageUploader
{
    public function upload(Image $image): Image;
}