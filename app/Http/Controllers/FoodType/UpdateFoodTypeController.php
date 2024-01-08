<?php

namespace App\Http\Controllers\FoodType;

use App\Http\Controllers\Controller;
use App\Http\Requests\FoodType\UpdateFoodTypeRequest;
use App\Http\Resources\FoodType\FoodTypeResource;
use App\Models\FoodType;
use Illuminate\Http\Request;

class UpdateFoodTypeController extends Controller
{
    public function update(UpdateFoodTypeRequest $request){
        $type = FoodType::whereId($request->type_id)->first();
        $updated_type = $type->update(['type'=>$request->type]);
        return new FoodTypeResource($type);

    }
}
