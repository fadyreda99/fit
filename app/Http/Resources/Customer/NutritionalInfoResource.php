<?php

namespace App\Http\Resources\Customer;

use App\Models\CustomerMacros;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NutritionalInfoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'excess_fat' => $this->excess_fat,
            'FFM' => $this->FFM,
            'LBM' => $this->LBM,
            'activity_factor' => $this->activity_factor,
            'protien_factor' => $this->protien_factor,
            'BMR' => $this->BMR,
            'AMR' => $this->AMR,
            'program_type' => $this->program_type,
            'game' => $this->game,
            'macros' => new CustomerMacrosResource($this->macros),
            'date' => $this->created_at->format('Y-m-d')
        ];
    }
}
