<?php

namespace Taskholder\Exception;

use Exception;
use Framework\Exception\ApplicationException;

class BoundaryException extends Exception implements ApplicationException
{
    protected $code = 422;
}