<?php
declare(strict_types=1);

namespace App\Repositories\Plot;

use App\Http\DTO\Plot\CommonGetPlotDto;
use App\Http\DTO\Plot\CommonSavePlotDto;
use App\Models\Plot;
use App\Repositories\Plot\Interfaces\PlotRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class DbPlotRepository implements PlotRepositoryInterface
{

    /**
     * @param CommonGetPlotDto $dto
     * @return Collection
     */
    public function getByCadastralNumbers(CommonGetPlotDto $dto): Collection
    {
        return Plot::whereIn(Plot::CADASTRAL_NUMBER_COLUMN, $dto->cadastral_numbers)
            ->get();
    }

    /**
     * @param CommonSavePlotDto $dto
     * @return void
     */
    public function updateOrCreate(CommonSavePlotDto $dto): void
    {
        Plot::updateOrCreate(
            [Plot::CADASTRAL_NUMBER_COLUMN => $dto->cadastral_number],
            [
                Plot::AREA_COLUMN => $dto->area,
                Plot::ADDRESS_COLUMN => $dto->address,
                Plot::PRICE_COLUMN => $dto->price,
                Plot::DATA_COLUMN => json_encode($dto->data),
                Plot::EXPIRES_AT_COLUMN => Carbon::now()->addHour(),
            ]
        );
    }

    /**
     * @param CommonGetPlotDto $dto
     * @return Collection
     */
    public function getNotExpireByCadastralNumbers(CommonGetPlotDto $dto): Collection
    {
        return Plot::whereIn(Plot::CADASTRAL_NUMBER_COLUMN, $dto->cadastral_numbers)
            ->where(Plot::EXPIRES_AT_COLUMN, '>', Carbon::now())
            ->get();
    }
}
