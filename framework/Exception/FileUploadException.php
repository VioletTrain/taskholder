<?php

namespace Framework\Exception;

use Exception;
use Throwable;

class FileUploadException extends Exception implements ApplicationException
{
    public function __construct(int $messageCode, Throwable $previous = null)
    {
        $message = 'Failed to upload file. ';

        if ($messageCode < 6) {
            $message .= 'File is too large.';
            $code = 403;
        } else {
            $message .= 'Internal server error.';
            $code = 500;
        }

        parent::__construct($message, $code, $previous);
    }
}