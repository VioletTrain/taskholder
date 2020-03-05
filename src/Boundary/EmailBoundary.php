<?php

namespace Taskholder\Boundary;

use Taskholder\Exception\BoundaryException;

class EmailBoundary
{
    private string $email;

    /**
     * EmailBoundary constructor.
     * @param string $email
     * @throws BoundaryException
     */
    public function __construct($email)
    {
        if (!$this->validate($email)) {
            throw new BoundaryException("'$email' is not a valid email.");
        }

        $this->email = $email;
    }

    private function validate($email): bool
    {
        return preg_match('/^[a-zA-Z0-9\-_]+@[a-zA-Z0-9\-_]+\.[a-zA-Z0-9\-_]+$/', $email);
    }

    public function __toString(): string
    {
        return $this->email;
    }
}