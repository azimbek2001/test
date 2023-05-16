<?php

namespace Tests\Services\Plot;

use App\Http\DTO\Plot\GetPlotDto;
use App\Repositories\Plot\Interfaces\PlotRepositoryInterface;
use App\Services\Plot\Interfaces\PlotServiceInterface;
use App\Services\Plot\PlotService;
use App\Services\ServiceResponse;
use Exception;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class PlotServiceTest extends TestCase
{
    private PlotServiceInterface $plotService;
    private PlotRepositoryInterface $plotRepository;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();
        // Создаем моки зависимостей
        $httpClient = $this->createMock(Client::class);
        // Создаем экземпляр сервиса
        $this->plotService = new PlotService($httpClient);
    }

    /**
     * @throws Exception
     */
    public function testGetPlotData()
    {
        $cadastralNumbers = ['69:27:0000022:1307', '69:27:0000022:1306'];
        $dto = new GetPlotDto(['cadastral_numbers' => $cadastralNumbers]);

        $response = $this->plotService->getPlotData($dto);

        $this->assertInstanceOf(ServiceResponse::class, $response);
        $this->assertTrue($response->isSuccess());
    }
}
