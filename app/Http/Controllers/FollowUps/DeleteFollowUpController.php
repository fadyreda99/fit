<?php

namespace App\Http\Controllers\FollowUps;

use App\Http\Controllers\Controller;
use App\Http\Requests\FollowUps\DeleteFollowUpRequest;
use App\Models\FollowUp;
use Illuminate\Http\Request;

class DeleteFollowUpController extends Controller
{
    public function delete(DeleteFollowUpRequest $request){
        $follow_up = FollowUp::whereId($request->id)->delete();
        return true;
    }
}
