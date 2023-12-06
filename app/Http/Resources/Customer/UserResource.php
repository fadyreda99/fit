<?php

namespace App\Http\Resources\Customer;

use App\Http\Resources\Status\StatusResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'basic_info' => new BasicInfoResource($this->basicInfo),
            'status' => new StatusResource($this->status),
            'nutritional_info' => new NutritionalInfoResource($this->nutritionalInfo),
            'progress_info' =>  ProgressInfoResource::collection($this->progressInfo),

        ];
    }
}
