<?php

namespace Taskholder\Exception;

use Exception;
use Framework\Exception\ApplicationException;

class EntityNotFoundException extends Exception implements ApplicationException
{
    protected $code = 404;
}