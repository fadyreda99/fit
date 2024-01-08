<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgressInfoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'current_weight' => $this->current_weight,
            'current_body_fat' => $this->current_body_fat,
            // 'current_body_fat' => $this->when(isset($this->current_body_fat), $this->current_body_fat),
            'current_excess_fat' => $this->current_excess_fat,
            'current_LBM' => $this->current_LBM,
            'current_FFM' => $this->current_FFM,
            'date' => $this->created_at->format('Y-m-d')
        ];
    }
}
