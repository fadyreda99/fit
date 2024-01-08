<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgressImagesResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'image' => $this->image,
            'date' => $this->created_at->format('Y-m-d')
        ];
    }
}
