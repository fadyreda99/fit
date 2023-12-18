<?php

namespace App\Http\Controllers\FollowUps;

use App\Http\Controllers\Controller;
use App\Http\Requests\FollowUps\AddFollowUpRequest;
use App\Http\Resources\FollowUps\FollowUpsResource;
use App\Models\FollowUp;
use Illuminate\Http\Request;

class AddFollowUpController extends Controller
{
    public function add(AddFollowUpRequest $request){
        $follow_up = FollowUp::create([
            'user_id'=>$request->user_id,
            'followup_date'=>$request->follow_up_date,
            'status'=>"pending"
        ]);

        return new FollowUpsResource($follow_up);
    }
}
