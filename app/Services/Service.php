<?php

namespace App\Services;

abstract class Service
{
    /**
     * @var ServiceResponse
     */
    protected ServiceResponse $response;
    /**
     * @var array
     */
    protected array $serviceErrors = [];

    /**
     * @param ServiceError $error
     * @return $this
     */
    final protected function addError(ServiceError $error): self
    {
        $this->serviceErrors[] = $error;

        return $this;
    }


    /**
     * @param mixed|null $result
     * @param ServiceError|null ...$errors
     * @return ServiceResponse
     */
    final protected function createResponse(mixed $result = null, ?ServiceError ...$errors): ServiceResponse
    {
        return new ServiceResponse($result, [...$this->serviceErrors, ...$errors]);
    }
}
