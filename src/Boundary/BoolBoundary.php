<?php

namespace Taskholder\Boundary;

use Taskholder\Exception\BoundaryException;

class BoolBoundary
{
    private bool $bool;

    /**
     * BoolBoundary constructor.
     * @param bool $bool
     * @throws BoundaryException
     */
    public function __construct($bool)
    {
        if (!is_bool($bool)) {
            throw new BoundaryException("'$bool' must be bool");
        }

        $this->bool = $bool;
    }

    public function getBool(): bool
    {
        return $this->bool;
    }
}