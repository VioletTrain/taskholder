<?php

namespace Taskholder;

use Framework\Exception\FileUploadException;

class Image
{
    private string $name;

    private string $type;

    private string $tmp_name;

    private string $error;

    private string $size;

    private int $width;

    private int $height;

    /**
     * Image constructor.
     * @param array $image
     * @throws FileUploadException
     */
    public function __construct(array $image)
    {
        $type = explode('.', substr($image['name'], -5))[1] ?? '';
        $this->error = $image['error'];

        if ($this->error > 0) {
            throw new FileUploadException($this->error);
        }

        $this->name = $image['name'];
        $this->type = $type;
        $this->tmp_name = $image['tmp_name'];
        $this->size = $image['size'];
        list($this->width, $this->height) = getimagesize($this->tmp_name);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getTmpName(): string
    {
        return $this->tmp_name;
    }

    public function getError(): string
    {
        return $this->error;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function maxWidth(): int
    {
        return 320;
    }

    public function maxHeight(): int
    {
        return 240;
    }

    public function fits(): bool
    {
        return $this->getWidth() <= $this->maxWidth() && $this->getHeight() <= $this->maxHeight();
    }
}