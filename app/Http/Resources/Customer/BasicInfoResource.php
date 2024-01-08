<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BasicInfoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'weight' => $this->weight,
            'height' => $this->height,
            'body_fat' => $this->body_fat,
            'birth_date' => $this->birth_date,
            'age' => $this->age,
            'city' => $this->city,
            'nationality' => $this->nationality,
            'gender' => $this->gender,
            'image' => $this->image,
            'date' => $this->created_at->format('Y-m-d')
        ];
    }
}
