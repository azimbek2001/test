<?php
declare(strict_types=1);

namespace App\Services\Plot\Interfaces;

use App\Http\DTO\Plot\CommonGetPlotDto;
use App\Http\DTO\Plot\CommonSavePlotDto;
use App\Services\ServiceResponse;

interface PlotServiceInterface
{
    /**
     * Получение участков
     * @param CommonGetPlotDto $dto
     * @return ServiceResponse
     */
    public function getPlotData(CommonGetPlotDto $dto): ServiceResponse;
}
