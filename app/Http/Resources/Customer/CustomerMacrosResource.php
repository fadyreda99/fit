<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerMacrosResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'target_amr'=>$this->target_amr,
            'protien_in_grams'=>$this->protien_in_grams,
            'protien_in_kcals'=>$this->protien_in_kcals,
            'carb_in_grams'=>$this->carb_in_grams,
            'carb_in_kcals'=>$this->carb_in_kcals,
            'fat_in_grams'=>$this->fat_in_grams,
            'fat_in_kcals'=>$this->fat_in_kcals,
        ];
    }
}
