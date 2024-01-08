<?php

namespace App\Http\Resources\FoodType;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodTypeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type
        ];
    }
}
