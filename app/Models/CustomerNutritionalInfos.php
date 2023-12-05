<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerNutritionalInfos extends Model
{
    use HasFactory;
    protected $table ="customer_nutritional_infos";
    protected $fillable = ['user_id', 'excess_fat', 'FFM', 'LBM', 'game', 'activity_factor', 'protien_factor', 'BMR', 'AMR', 'program_type'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function macros(){
        return $this->hasOne(CustomerMacros::class, 'nutritional_id', 'id');
    }
}
