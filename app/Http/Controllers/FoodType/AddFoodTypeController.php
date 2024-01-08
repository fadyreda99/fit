<?php

namespace App\Http\Controllers\FoodType;

use App\Http\Controllers\Controller;
use App\Http\Requests\FoodType\AddFoodTypeRequest;
use App\Http\Resources\FoodType\FoodTypeResource;
use App\Models\FoodType;
use Illuminate\Http\Request;

class AddFoodTypeController extends Controller
{
    public function add(AddFoodTypeRequest $request){
        $type = FoodType::create([
            'type'=>$request->type
        ]);
        return new FoodTypeResource($type);
    }
}
