<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\UpdateStatusCustomerRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UpdateStatusCustomerController extends Controller
{
    public function updateStatus(UpdateStatusCustomerRequest $request)
    {
        $user = User::whereId($request->user_id)->first();
        if ($user) {
            $user->status->update(['status' => $request->status]);
            return response()->json(['success' => 'update status'], 404);
        } else {
            return response()->json(['error' => 'user not found'], 404);
        }
    }
}
