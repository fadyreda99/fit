<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerMacros extends Model
{
    use HasFactory;
    protected $table = "customer_macros";
    protected $fillable = ['nutritional_id', 'target_amr', 'protien_in_grams', 'protien_in_kcals', 'carb_in_grams', 'carb_in_kcals', 'fat_in_grams', 'fat_in_kcals'];

    public function nutritionInfo(){
        return $this->belongsTo(CustomerNutritionalInfos::class, 'nutritional_id', 'id');
    }
}
