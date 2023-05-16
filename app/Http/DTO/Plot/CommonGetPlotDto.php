<?php
declare(strict_types=1);

namespace App\Http\DTO\Plot;

use App\Http\DTO\BaseDto;

abstract class CommonGetPlotDto extends BaseDto
{
    /**
     * @var array
     */
    public array $cadastral_numbers;
}
