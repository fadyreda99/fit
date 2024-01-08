<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\UpdateBasicAndNutretionalInfoRequest;
use App\Http\Resources\Customer\UserResource;
use App\Models\CustomerBasicInfo;
use App\Models\User;
use App\Services\Customer\NutritionCalculatorService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UpdateBasicAndNutretionalInfoController extends Controller
{
    private $nutritionCalculatorService;
    public function __construct(NutritionCalculatorService $nutritionCalculatorService)
    {
        $this->nutritionCalculatorService = $nutritionCalculatorService;
    }

    public function update(UpdateBasicAndNutretionalInfoRequest $request)
    {
        DB::beginTransaction();
        try {
            $basicInfo = CustomerBasicInfo::where('user_id', $request->user_id)->first();
            if ($basicInfo) {
                $basicInfo->update([
                    'weight' => $request->weight,
                    'body_fat' => $request->body_fat,
                ]);
                DB::commit();
                return new UserResource($this->nutritionCalculatorService->calculate($request));
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
