<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\ProgressImagesRequest;
use App\Http\Resources\Customer\ProgressImagesResource;
use App\Models\ProgressImage;
use App\Models\User;
use Illuminate\Http\Request;

class ProgressImagesController extends Controller
{
    public function addImages(ProgressImagesRequest $request){
        $user = User::whereId($request->user_id)->first();
        if ($request->hasFile('images')) {
            $progressImages = [];
            $unique_name =  time();
            foreach($request->images as $image){
                $savedimage = $image->store('uploads/images/customer/' . $user->name . $user->phone, 'public');
                $progressImage = ProgressImage::create([
                    'user_id'=>$user->id,
                    'image'=>$savedimage,
                ]);
                $progressImages[] = $progressImage;
                
            }
            return ProgressImagesResource::collection($progressImages);
        }
    }
}
