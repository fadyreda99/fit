<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CalculateNutritionInfoRequest;
use App\Http\Resources\Customer\NutritionalInfoResource;
use App\Http\Resources\Customer\UserResource;
use App\Models\CustomerMacros;
use App\Models\CustomerNutritionalInfos;
use App\Models\ProgressInfo;
use App\Models\User;
use App\Services\Customer\NutritionCalculator;
use App\Services\Customer\NutritionCalculatorService;
use App\Traits\TransactionsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalculateNutritionalInfoController extends Controller
{
    use TransactionsTrait;

    private $fats_to_eat;
    private $sign;
    private $gender_fat;
    private $excess_fat;
    private $gender;

    private $nutritionCalculatorService;
    public function __construct(NutritionCalculatorService $nutritionCalculatorService)
    {
        $this->nutritionCalculatorService = $nutritionCalculatorService;
    }

    public function calculate(CalculateNutritionInfoRequest $request)
    {
        return new UserResource($this->nutritionCalculatorService->calculate($request));
    }
}
