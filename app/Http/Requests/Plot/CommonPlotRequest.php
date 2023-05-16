<?php
declare(strict_types=1);

namespace App\Http\Requests\Plot;

use App\Http\Requests\BaseRequest;

abstract class CommonPlotRequest extends BaseRequest
{
    public const CADASTRAL_NUMBERS_NAME = 'cadastral_numbers';
}
