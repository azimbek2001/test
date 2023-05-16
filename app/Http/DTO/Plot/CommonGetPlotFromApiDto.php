<?php
declare(strict_types=1);

namespace App\Http\DTO\Plot;

use App\Http\DTO\BaseDto;

abstract class CommonGetPlotFromApiDto extends BaseDto
{
    /**
     * @var string
     */
    public string $number;
    /**
     * @var array
     */
    public array $attrs;
    /**
     * @var array
     */
    public array $data;
}
