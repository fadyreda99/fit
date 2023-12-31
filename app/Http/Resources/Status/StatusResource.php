<?php

namespace App\Http\Resources\Status;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StatusResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'status' => $this->status,
            'date' => $this->created_at->format('Y-m-d')
        ];
    }
}
