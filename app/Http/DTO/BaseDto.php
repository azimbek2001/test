<?php
declare(strict_types=1);

namespace App\Http\DTO;

abstract class BaseDto
{
    /**
     * @param array $attributes
     */
    public final function __construct(array $attributes = [])
    {
        foreach ($attributes as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * @return array
     */
    public final function toArray(): array
    {
        $properties = get_object_vars($this);
        $data = [];

        foreach ($properties as $key => $value) {
            if (is_object($value) && method_exists($value, 'toArray')) {
                $data[$key] = $value->toArray();
            } else {
                $data[$key] = $value;
            }
        }

        return $data;
    }

    /**
     * @param array $data
     * @return self
     */
    public final static function fromArray(array $data): self
    {
        return new static($data);
    }
}
