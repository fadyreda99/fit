<?php

namespace App\Http\Controllers\foodType;

use App\Http\Controllers\Controller;
use App\Http\Resources\FoodType\FoodTypeResource;
use App\Models\FoodType;
use Illuminate\Http\Request;

class GetAllFoodTypeController extends Controller
{
    public function all(){
        $types = FoodType::all();
        return FoodTypeResource::collection($types);
    }
}
