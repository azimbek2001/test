<?php
declare(strict_types=1);

namespace App\Repositories\Plot\Interfaces;

use App\Http\DTO\Plot\CommonGetPlotDto;
use App\Http\DTO\Plot\CommonSavePlotDto;
use App\Models\Plot;
use Illuminate\Database\Eloquent\Collection;

interface PlotRepositoryInterface
{
    /**
     * Обновляем либо соханяем
     * @param CommonSavePlotDto $dto
     * @return void
     */
    public function updateOrCreate(CommonSavePlotDto $dto):void;

    /**
     * Получаем участки по номеру
     * @param CommonGetPlotDto $dto
     * @return Collection
     */
    public function getByCadastralNumbers(CommonGetPlotDto $dto):Collection;

    /**
     * Получаем валидные участки по номеру
     * @param CommonGetPlotDto $dto
     * @return Collection
     */
    public function getNotExpireByCadastralNumbers(CommonGetPlotDto $dto):Collection;
}
