<?php
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Plot;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class PlotResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        #todo вынести в константы
        return [
            'cadastral_number' => $this->cadastral_number,
            'area' => $this->area,
            'price' => $this->price,
            'address' => $this->address
        ];
    }
}
