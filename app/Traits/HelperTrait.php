<?php

namespace App\Traits;

use Carbon\Carbon;

trait HelperTrait
{
    public function calculateAge($birth_date){
        $today = Carbon::now();
        $birthDate = Carbon::parse($birth_date);
        $age = $today->diffInYears($birthDate);
        return $age;
    }
   
}
