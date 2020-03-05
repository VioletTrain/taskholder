<?php

namespace Taskholder\Boundary;

use Taskholder\Exception\BoundaryException;

class UsernameBoundary
{
    private string $username;

    /**
     * UsernameBoundary constructor.
     * @param string $username
     * @throws BoundaryException
     */
    public function __construct($username)
    {
        if (!$this->validate($username)) {
            throw new BoundaryException("'$username' is not a valid username");
        }

        $this->username = $username;
    }

    private function validate($username)
    {
        return preg_match('/^[a-zA-Z0-9\-_]{3,}$/', $username);
    }

    public function __toString(): string
    {
        return $this->username;
    }
}