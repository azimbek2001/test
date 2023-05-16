<?php
declare(strict_types=1);

namespace App\Http\DTO\Plot;

use App\Http\DTO\BaseDto;

abstract class CommonSavePlotDto extends BaseDto
{
    /**
     * @var array
     */
    public array $data = [];
    /**
     * @var string
     */
    public string $cadastral_number;
    /**
     * @var float
     */
    public float $price;
    /**
     * @var float
     */
    public float $area;
    /**
     * @var string
     */
    public string $address;
}
