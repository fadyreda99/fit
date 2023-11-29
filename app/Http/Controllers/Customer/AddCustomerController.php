<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\AddCustomerRequest;
use App\Http\Resources\Customer\UserResource;
use App\Models\CustomerBasicInfo;
use App\Models\Status;
use App\Models\User;
use App\Traits\HelperTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class AddCustomerController extends Controller
{
    use HelperTrait;
    public function addNew(AddCustomerRequest $request)
    {
        $age = $this->calculateAge($request->birth_date);
        if ($request->hasFile('image')) {
            // $image = $request->file('main_image')->store('uploads/images/'.$request->name, ['disk' => 'public']);
            $image = $request->file('image')->store('uploads/images/customer/' . $request->name . $request->phone, 'public');
        }


        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => '123456789',
            ]);

            $customer_info = CustomerBasicInfo::create([
                'user_id'=>$user->id,
                'weight'=>$request->weight,
                'height'=>$request->height,
                'body_fat'=>$request->body_fat,
                'image'=>$image,
                'birth_date'=>$request->birth_date,
                'age'=>$age,
                'city'=>$request->city,
                'nationality'=>$request->nationality,
                'gender'=>$request->gender
            ]);

            $customerRole = Role::where('name', 'customer')->firstOrFail();
            $user->assignRole($customerRole);

            $status = Status::create([
                'user_id'=>$user->id,
                'status'=>'pending'
            ]);

            DB::commit();
            return new UserResource($user);
        } catch (Exception $e) {
            return $e;
        }
    }
}
