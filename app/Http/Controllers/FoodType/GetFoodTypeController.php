<?php

namespace App\Http\Controllers\FoodType;

use App\Http\Controllers\Controller;
use App\Http\Resources\FoodType\FoodTypeResource;
use App\Models\FoodType;
use Illuminate\Http\Request;

class GetFoodTypeController extends Controller
{
    public function get($type_id){
        $type = FoodType::whereId($type_id)->first();
        if($type){
            return new FoodTypeResource($type);
        }else{
            return response()->json(["errors"=>["type_id"=>["The selected type id is invalid."]]]);
        }

    }
}
