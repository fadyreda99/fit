<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\Customer\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AllCustomersController extends Controller
{
    public function all()
    {
        $customerRole = Role::where('name', 'customer')->first();
        $customers = $customerRole->users;
        return UserResource::collection($customers);
    }
}
