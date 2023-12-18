<?php

namespace App\Http\Resources\FollowUps;

use App\Http\Resources\Customer\CustomUserResource;
use App\Http\Resources\Customer\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FollowUpWithUserResource extends JsonResource
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
            'user'=>new CustomUserResource($this->user)
        ];
    }
}
