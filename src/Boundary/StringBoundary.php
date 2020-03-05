<?php

namespace Taskholder\Boundary;

use Taskholder\Exception\BoundaryException;

class StringBoundary
{
    private string $string;

    /**
     * StringBoundary constructor.
     * @param string $string
     * @throws BoundaryException
     */
    public function __construct($string)
    {
        if (!is_string($string)) {
            throw new BoundaryException("'$string' must be string");
        }

        $this->string = $string;
    }

    public function getString(): string
    {
        return $this->string;
    }
}