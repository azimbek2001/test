<?php
declare(strict_types=1);

namespace App\Services;

use Exception;
use JetBrains\PhpStorm\Pure;
use Throwable;

class ServiceException extends Exception
{
    /**
     * @param $message
     * @param $code
     * @param Throwable|null $previous
     */
    #[Pure] public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
