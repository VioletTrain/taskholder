<?php

namespace Framework\Exception;

use Exception;
use Throwable;

class HttpNotFoundException extends Exception implements ApplicationException
{
    protected $code = 404;
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = "Page " . $message . " was not found";
        parent::__construct($message, $code, $previous);
    }
}