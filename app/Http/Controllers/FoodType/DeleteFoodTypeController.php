<?php

namespace App\Http\Controllers\FoodType;

use App\Http\Controllers\Controller;
use App\Http\Requests\FoodType\DeleteFoodTypeRequest;
use App\Models\FoodType;
use Illuminate\Http\Request;

class DeleteFoodTypeController extends Controller
{
    public function delete(DeleteFoodTypeRequest $request){
        $type= FoodType::whereId($request->type_id)->delete();
        return true;
    }
}
