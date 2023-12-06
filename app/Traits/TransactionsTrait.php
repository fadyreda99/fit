<?php

namespace App\Traits;

use Carbon\Carbon;

trait TransactionsTrait
{
    private $weight;
    private $excess_fat;
    private $body_fat;
    private $gender;
    private $activity_factor;
    private $kcals_I_D;
    private $sign;
    private $LBM;
    private $BMR;
    private $AMR;
    private $FFM;
    private $gender_factor;
    private $target_amr;
    private $protien_factor;
    private $fats_to_eat;

    private $protien_in_grams;
    private $protien_in_kcals;
    private $carb_in_grams;
    private $carb_in_kcals;
    private $fat_in_grams;
    private $fat_in_kcals;

    public function handleCycle($weight, $excess_fat, $body_fat, $gender, $activity_factor, $kcals_I_D, $sign, $protien_factor, $fats_to_eat)
    {
        $this->weight = $weight;
        $this->excess_fat = $excess_fat;
        $this->body_fat = $body_fat;
        $this->gender = $gender;
        $this->activity_factor = $activity_factor;
        $this->kcals_I_D = $kcals_I_D;
        $this->sign = $sign;
        $this->protien_factor = $protien_factor;
        $this->fats_to_eat = $fats_to_eat;

        return $this->fullCalc();
    }

    public function fullCalc()
    {
        $this->lbm();
        $this->ffm();
        $this->getGenderFactor();
        $this->bmr();
        $this->amr();
        $this->targetAmr();
        $this->protirnInGrams();
        $this->protirnInKcals();
        $this->fatInInKcals();
        $this->fatInInGrams();
        $this->carbInKcals();
        $this->carbInGrams();
        return response()->json([
            'gender_factor' => $this->gender_factor,
            'FFM' => $this->FFM,
            'LBM' => $this->LBM,
            'BMR' => $this->BMR,
            'AMR' => $this->AMR,
            'target_amr' => $this->target_amr,
            'protien_in_grams' => $this->protien_in_grams,
            'protien_in_kcals' => $this->protien_in_kcals,
            'carb_in_grams' => $this->carb_in_grams,
            'carb_in_kcals' => $this->carb_in_kcals,
            'fat_in_grams' => $this->fat_in_grams,
            'fat_in_kcals' => $this->fat_in_kcals,
        ], 200);
    }

    public function getGenderFat($gender)
    {
        return  $gender_fat = $gender == "male" ? 18 : 23;
    }

    public function getGenderFactor()
    {
        $this->gender_factor = $this->gender == "male" ? 1 : 0.9;
    }

    public function ffm()
    {
        $precntage_ffm = ($this->weight * ($this->body_fat / 100));
        $this->FFM = round(($this->weight) - $precntage_ffm);
    }
    public function currentFfm($weight, $body_fat)
    {
        $precntage_ffm = ($weight * ($body_fat / 100));
        return $FFM = round(($weight) - $precntage_ffm);
    }

    public function excessFat($body_fat, $gender_fat)
    {
        $excess_fat = $body_fat - $gender_fat;
        $excess_fat = $excess_fat > 0 ? $excess_fat : 0;
        return $excess_fat;
    }

    public function lbm()
    {
        // return $this->excess_fat;
        $precntage_lbm = ($this->weight * ($this->excess_fat / 100));
        $this->LBM = round($this->weight - $precntage_lbm);
    }
    public function currentLbm($weight, $excess_fat)
    {
        // return $this->excess_fat;
        $precntage_lbm = ($weight * ($excess_fat / 100));
        return $LBM = round($weight - $precntage_lbm);
    }

    public function bmr()
    {
        $this->BMR = round($this->LBM * 24 * $this->gender_factor);
    }

    public function amr()
    {

        $this->AMR = round($this->BMR * $this->activity_factor);
    }

    public function targetAmr()
    {
        switch ($this->sign) {
            case '+':
                $this->target_amr  = round($this->AMR + $this->kcals_I_D);
                break;
            case '-':
                $this->target_amr  = round($this->AMR - $this->kcals_I_D);
                break;
        }
    }

    public function protirnInGrams()
    {
        $this->protien_in_grams = round($this->LBM * $this->protien_factor);
    }
    public function protirnInKcals()
    {
        $this->protien_in_kcals = round($this->protien_in_grams * 4);
    }
    public function fatInInKcals()
    {
        $this->fat_in_kcals = round($this->target_amr * (($this->fats_to_eat / 100)));
    }

    public function fatInInGrams()
    {
        $this->fat_in_grams = round($this->fat_in_kcals / 9);
    }

    public function carbInKcals()
    {
        $this->carb_in_kcals = round($this->target_amr - ($this->fat_in_kcals + $this->protien_in_kcals));
    }

    public function carbInGrams()
    {
        $this->carb_in_grams = round($this->carb_in_kcals / 4);
    }
}
