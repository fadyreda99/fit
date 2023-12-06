<?php

namespace App\Http\Controllers\Membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\Membership\AddMembershipRequest;
use App\Models\Membership;
use App\Models\MembershipAmount;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddMembershipController extends Controller
{
    public function add(AddMembershipRequest $request){
        DB::beginTransaction();
        $membershsip = Membership::create([
            'user_id'=>$request->user_id,
            'start'=>$request->start,
            'end'=>$request->end
        ]);
        $mount  = MembershipAmount::create([
            'membership_id'=>$membershsip->id,
            'amount'=>$request->amount,
        ]);
        $status = Status::where('user_id', $request->user_id)->update([
            'status'=>'in_membership'
        ]);
        DB::commit();
        return true;
    }
}
