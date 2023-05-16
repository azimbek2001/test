<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\DTO\Plot\GetPlotDto;
use App\Http\Requests\Plot\PlotRequest;
use App\Http\Resources\PlotResource;
use App\Services\Plot\Interfaces\PlotServiceInterface;
use Illuminate\Http\JsonResponse;

class RestController extends BaseApiController
{
    /**
     * @var PlotServiceInterface
     */
    private PlotServiceInterface $plotService;

    /**
     * @param PlotServiceInterface $plotService
     */
    public function __construct(PlotServiceInterface $plotService)
    {
        $this->plotService = $plotService;

    }

    #todo добавить сваггер
    /**
     * Получение участков
     * @param PlotRequest $request
     * @return JsonResponse
     */
    public function getPlots(PlotRequest $request): JsonResponse
    {
        $serviceResponse = $this->plotService->getPlotData(new GetPlotDto($request->toArray()));

        if (!$serviceResponse->isSuccess()) {
            $serviceError = $serviceResponse->getServiceErrors()[0];
            return $this->makeErrorResponse($serviceError->getMessage(), $serviceError->getCode());
        }

        return $this->makeSuccessResponse(PlotResource::collection($serviceResponse->getResult()));
    }
}
