<?php
declare(strict_types=1);

namespace App\Services;

class ServiceError
{
    /**
     * @var int
     */
    protected int $code;
    /**
     * @var string
     */
    protected string $message;

    /**
     * @param string $message
     * @param int $code
     */
    public function __construct(string $message, int $code = 0)
    {
        $this->message = $message;
        $this->code = $code;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
