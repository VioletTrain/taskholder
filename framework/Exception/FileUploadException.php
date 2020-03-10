<?php

namespace Framework\Exception;

use Exception;
use Taskholder\Image;
use Throwable;

class FileUploadException extends Exception implements ApplicationException
{
    public function __construct(int $messageCode, Throwable $previous = null)
    {
        $message = 'Failed to upload file. ';
        $code = 400;

        if ($messageCode === 5) {
            $message .= 'Unsupported format. Supported formats are ' . implode(', ', Image::SUPPORTED_FORMATS) . '.';
        } elseif ($messageCode < 6) {
            $message .= 'File is too large.';
        } else {
            $message .= 'Internal server error.';
            $code = 500;
        }

        parent::__construct($message, $code, $previous);
    }
}