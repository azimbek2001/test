<?php

namespace App\Services;

use Exception;
use Throwable;

class ServiceException extends Exception
{
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
