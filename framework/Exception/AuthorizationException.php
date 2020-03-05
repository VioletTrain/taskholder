<?php

namespace Framework\Exception;

use Exception;

class AuthorizationException extends Exception implements ApplicationException
{
    protected $code = 403;
}