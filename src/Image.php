<?php

namespace Taskholder;

use Framework\Exception\FileUploadException;

class Image
{
    private string $name;

    private string $type;

    private string $tmp_name;

    private string $size;

    private int $width;

    private int $height;

    private string $path;

    public const SUPPORTED_FORMATS = [
        'jpg',
        'jpeg',
        'png',
        'gif'
    ];

    /**
     * Image constructor.
     * @param array $image
     * @throws FileUploadException
     */
    public function __construct(array $image)
    {
        $error = $image['error'];
        $type = explode('.', substr($image['name'], -5))[1] ?? '';

        if ($error > 0) {
            throw new FileUploadException($error);
        }

        if (!in_array($type, self::SUPPORTED_FORMATS)) {
            throw new FileUploadException($error);
        }

        $this->name = $image['name'] ?? '';
        $this->type = $type;
        $this->tmp_name = $image['tmp_name'] ?? '';
        $this->size = $image['size'] ?? 0;
        list($this->width, $this->height) = getimagesize($this->tmp_name);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getTmpName(): string
    {
        return $this->tmp_name;
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

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }
}