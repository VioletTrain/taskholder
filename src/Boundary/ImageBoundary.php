<?php

namespace Taskholder\Boundary;

use Taskholder\Exception\BoundaryException;

class ImageBoundary
{
    private string $image;

    /**
     * ImageBoundary constructor.
     * @param string $image
     * @throws BoundaryException
     */
    public function __construct($image)
    {
        if (!$this->validate($image)) {
            throw new BoundaryException();
        }

        $this->image = $image;
    }

    private function validate($image)
    {
        return true;
    }

    public function __toString(): string
    {
        return $this->image;
    }
}