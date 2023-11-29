<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\Customer\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class GetCustomerController extends Controller
{
    public function get($user_id){
        $user = User::whereId($user_id)->first();
        if($user){
            return new UserResource($user); 
        }else{
            return response()->json(['error'=>'customer not found'], 404);
        }
    }
}
