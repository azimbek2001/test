<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\JsonResponse;
use JsonSerializable;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseApiController extends Controller
{
    /**
     * @param array|Arrayable|JsonSerializable $data
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    protected function makeSuccessResponse(array|Arrayable|JsonSerializable $data = [], string $message = '', int $code = Response::HTTP_OK): JsonResponse
    {
        $response = [
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response, $code);
    }

    /**
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    protected function makeErrorResponse(string $message = '', int $code = Response::HTTP_OK): JsonResponse
    {
        $response = [
            'status' => 'error',
            'message' => $message,
            'data' => [],
        ];

        return response()->json($response, $code);
    }
}
