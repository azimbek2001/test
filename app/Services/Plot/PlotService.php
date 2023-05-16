<?php
declare(strict_types=1);

namespace App\Services\Plot;

use App\Http\DTO\Plot\CommonGetPlotDto;
use App\Http\DTO\Plot\CommonGetPlotFromApiDto;
use App\Http\DTO\Plot\CommonSavePlotDto;
use App\Http\DTO\Plot\GetPlotDto;
use App\Http\DTO\Plot\GetPlotFromApiDto;
use App\Http\DTO\Plot\SavePlotDto;
use App\Models\Plot;
use App\Repositories\Plot\Interfaces\PlotRepositoryInterface;
use App\Repositories\Plot\PlotRepositoryFactory;
use App\Services\Plot\Interfaces\PlotServiceInterface;
use App\Services\Service;
use App\Services\ServiceException;
use App\Services\ServiceResponse;
use App\Utils\PlotApiConstant;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\HttpFoundation\Response;

class PlotService extends Service implements PlotServiceInterface
{
    /**
     * @var PlotRepositoryInterface
     */
    private PlotRepositoryInterface $plotRepository;
    /**
     * @var Client
     */
    private Client $client;

    /**
     * @param Client $client
     * @throws Exception
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->plotRepository = (new PlotRepositoryFactory())->createRepository();
    }

    /**
     * @param CommonGetPlotDto $dto
     * @return ServiceResponse
     */
    public function getPlotData(CommonGetPlotDto $dto): ServiceResponse
    {
        $plots = $this->plotRepository->getNotExpireByCadastralNumbers($dto);

        // Если в базе данных нет необходимых данных или данные истекли, запрашиваем их из API
        if ($plots->isEmpty()) {
            try {
                $plotDto = new GetPlotDto($dto->toArray());
                $plots = $this->fetchDataFromApi($plotDto);
            } catch (ServiceException $e) {
                $plots = $this->plotRepository->getByCadastralNumbers($dto);
                return $this->createResponse($plots);
            }

            if (!count($plots)) {
                $plots = $this->plotRepository->getByCadastralNumbers($dto);
                return $this->createResponse($plots);
            }

            // Подготавливаем ДТО и сохраняем
            foreach ($plots as $plot) {
                $plotApiDto = new GetPlotFromApiDto($plot);
                $plotApiDto->data = $plot;
                $savePlotDto = $this->getSavePlotDto($plotApiDto);
                $this->saveData($savePlotDto);
            }
            // Вытаскиваем обновленные данные
            $plots = $this->plotRepository->getNotExpireByCadastralNumbers($dto);
        }

        return $this->createResponse($plots);
    }

    /**
     * @param CommonGetPlotDto $dto
     * @return mixed
     * @throws ServiceException
     */
    protected function fetchDataFromApi(CommonGetPlotDto $dto): mixed
    {
        try {
            $response = $this->client->post(PlotApiConstant::ENDPOINT, [
                PlotApiConstant::QUERY_NAME_TIMEOUT => PlotApiConstant::QUERY_TIMEOUT,
                PlotApiConstant::QUERY_NAME_JSON => [
                    PlotApiConstant::QUERY_NAME_COLLECTION => [
                        PlotApiConstant::QUERY_NAME_PLOTS => $dto->cadastral_numbers,
                    ],
                ],
            ]);

            #todo Текст ошибки вынести в текстовый ресурс
            if ($response->getStatusCode() !== Response::HTTP_OK) {
                throw new ServiceException('Сервис временно не доступен', $response->getStatusCode());
            }
        } catch (GuzzleException|Exception $e) {
            throw new ServiceException($e->getMessage(), $e->getCode());
        }

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param CommonSavePlotDto $dto
     * @return void
     */
    protected function saveData(CommonSavePlotDto $dto): void
    {
        $this->plotRepository->updateOrCreate($dto);
    }

    /**
     * @param CommonGetPlotFromApiDto $dto
     * @return CommonSavePlotDto
     */
    #[Pure] protected function getSavePlotDto(CommonGetPlotFromApiDto $dto): CommonSavePlotDto
    {
        return new SavePlotDto([
            Plot::DATA_COLUMN => $dto->data,
            Plot::CADASTRAL_NUMBER_COLUMN => $dto->number,
            Plot::ADDRESS_COLUMN => $dto->attrs['plot_address'],
            Plot::PRICE_COLUMN => $dto->attrs['plot_price'],
            Plot::AREA_COLUMN => $dto->attrs['plot_area'],
        ]);
    }
}
