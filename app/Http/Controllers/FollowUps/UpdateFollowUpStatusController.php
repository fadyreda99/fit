<?php

namespace App\Http\Controllers\FollowUps;

use App\Http\Controllers\Controller;
use App\Http\Requests\FollowUps\UpdateFollowUpStatusRequest;
use App\Http\Resources\FollowUps\FollowUpsResource;
use App\Models\FollowUp;
use Illuminate\Http\Request;

class UpdateFollowUpStatusController extends Controller
{
    public function updateStatus(UpdateFollowUpStatusRequest $request){
        $updated_follow_up = FollowUp::whereId($request->id)->first();
        $updated_follow_up->update(['status'=>$request->status]);
        return new FollowUpsResource($updated_follow_up);
    }
}
