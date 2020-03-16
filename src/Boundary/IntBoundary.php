<?php

namespace Taskholder\Boundary;

use Taskholder\Exception\BoundaryException;

class IntBoundary
{
    private int $integer;

    /**
     * IntBoundary constructor.
     * @param $integer
     * @throws BoundaryException
     */
    public function __construct($integer)
    {
        if ($integer !== 0 && (!$integer || $integer && !is_numeric($integer))) {
            throw new BoundaryException("'$integer' must be numeric");
        }

        $this->integer = (int) $integer;
    }

    public function getInteger(): int
    {
        return $this->integer;
    }
}