<?php

namespace App\Http\Controllers\Membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\Membership\UpdateMembership;
use App\Models\Membership;
use App\Models\MembershipAmount;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UpdateMembershipController extends Controller
{
    public function update(UpdateMembership $request)
    {
        try {
            DB::beginTransaction();
            $membership = Membership::whereId($request->id)->update([
                'start' => $request->start,
                'end' => $request->end
            ]);
            $mount = MembershipAmount::create([
                'membership_id' => $request->id,
                'amount' => $request->amount,
            ]);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
    }
}
