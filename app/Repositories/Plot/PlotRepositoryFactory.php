<?php
declare(strict_types=1);

namespace App\Repositories\Plot;

use App\Repositories\Plot\Interfaces\PlotRepositoryInterface;
use Exception;

class PlotRepositoryFactory
{
    /**
     * @param string $type
     * @return PlotRepositoryInterface
     * @throws Exception
     */
    public function createRepository(string $type = DbPlotRepository::class): PlotRepositoryInterface
    {
        return match ($type) {
            DbPlotRepository::class => new DbPlotRepository(),
            default => throw new Exception('Repository type not found'),
        };
    }
}
