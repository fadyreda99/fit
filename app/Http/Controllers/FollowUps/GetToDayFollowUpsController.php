<?php

namespace App\Http\Controllers\FollowUps;

use App\Http\Controllers\Controller;
use App\Http\Resources\FollowUps\FollowUpWithUserResource;
use App\Models\FollowUp;
use Illuminate\Http\Request;

class GetToDayFollowUpsController extends Controller
{
    public function getToDayFollowUps()
    {
        $follow_ups = FollowUp::where('followup_date', now()->toDateString())->whereStatus('pending')->get();
        return FollowUpWithUserResource::collection($follow_ups);
    }
}
