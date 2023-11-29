<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DeleteCustomerController extends Controller
{
    public function Delete($user_id)
    {
        $user = User::whereId($user_id)->whereHas('roles', function ($query) {
            $query->where('name', 'customer');
        })->first();
        if ($user) {
            $user->basicInfo()->delete();
            $user->delete();
            return response()->json(['success' => 'customer deleted sccessfully'], 200);
        } else {
            return response()->json(['error' => 'customer not found'], 404);
        }
    }
}
