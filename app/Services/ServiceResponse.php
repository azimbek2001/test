<?php

namespace App\Services;

class ServiceResponse
{
    /**
     * @var array
     */
    protected array $serviceErrors = [];
    /**
     * @var mixed
     */
    protected mixed $result;

    public function __construct($result, array $serviceErrors = [])
    {
        $this->result = $result;
        $this->serviceErrors = $serviceErrors;
    }

    /**
     * @return ServiceError[]
     */
    public function getServiceErrors(): array
    {
        return $this->serviceErrors;
    }

    /**
     * @return mixed
     */
    public function getResult(): mixed
    {
        return $this->result;
    }

    /**
     * @param int $errorCode
     * @return bool
     */
    public function hasServerError(int $errorCode): bool
    {
        foreach ($this->serviceErrors as $error) {
            if ($error->getCode() == $errorCode) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->hasNotServerErrors();
    }

    /**
     * @return bool
     */
    public function hasNotServerErrors(): bool
    {
        return !$this->hasServerErrors();
    }

    /**
     * @return bool
     */
    public function hasServerErrors(): bool
    {
        return count($this->serviceErrors) > 0;
    }

    /**
     * @return bool
     */
    public function isFailed(): bool
    {
        return $this->hasServerErrors();
    }
}
