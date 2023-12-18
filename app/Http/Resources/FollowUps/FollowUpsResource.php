<?php

namespace App\Http\Resources\FollowUps;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FollowUpsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'follow_up_date'=>$this->followup_date,
            'status'=>$this->status,
            'user_id'=>$this->user_id
        ];
    }
}
