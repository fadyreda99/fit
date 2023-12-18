<?php

namespace App\Http\Controllers\FollowUps;

use App\Http\Controllers\Controller;
use App\Http\Resources\FollowUps\FollowUpWithUserResource;
use App\Models\FollowUp;
use Illuminate\Http\Request;

class GetAllFollowUpsController extends Controller
{
    public function all(){
        $follow_ups = FollowUp::whereStatus('pending')->get();
        return FollowUpWithUserResource::collection($follow_ups);
    }
}
