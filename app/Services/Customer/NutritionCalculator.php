<?php

namespace App\Services\Customer;



class NutritionCalculator
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

    // public function __construct($weight, $excess_fat, $body_fat, $gender, $activity_factor, $kcals_I_D, $sign){
    //     $this->weight = $weight;
    //     $this->excess_fat = $excess_fat;
    //     $this->body_fat = $body_fat;
    //     $this->gender = $gender;
    //     $this->activity_factor = $activity_factor;
    //     $this->kcals_I_D = $kcals_I_D;
    //     $this->sign = $sign;

    // }

  
    public function handleCycle($weight, $excess_fat, $body_fat, $gender, $activity_factor, $kcals_I_D, $sign){
        $this->weight = $weight;
        $this->excess_fat = $excess_fat;
        $this->body_fat = $body_fat;
        $this->gender = $gender;
        $this->activity_factor = $activity_factor;
        $this->kcals_I_D = $kcals_I_D;
        $this->sign = $sign;
        
        return $this->fullCalc();
    }

    public function fullCalc(){
     


        $this->LBM = $this->lbm();
        $this->FFM = $this->ffm();
        $this->gender_factor = $this->getGenderFactor();
        $this->BMR = $this->bmr();
        $this->AMR = $this->amr();
        $this->target_amr = $this->targetAmr();
        return response()->json([
            'lbm'=>$this->LBM,
            'ffm'=>$this->FFM,
            'gender_factor'=>$this->gender_factor,
            'bmr'=>$this->BMR,
            'amr'=>$this->AMR,
            'target_amr'=>$this->target_amr,
        ], 200);

    }

    public function getGenderFat($gender){
       return $gender_fat = $gender == "male" ? 18 : 23;
    }

    public function getGenderFactor(){
       return  $gender_factor = $this->gender == "male" ? 1 : 0.9;
    }

    public function ffm()
    {
        $precntage_ffm = ($this->weight * ($this->body_fat / 100));
        $FFM = ($this->weight) - $precntage_ffm;
        return $FFM;
    }

    public function excessFat($body_fat, $gender_fat)
    {
        $excess_fat = $body_fat - $gender_fat;
        return $excess_fat;
    }

    public function lbm()
    {
        $precntage_lbm = ($this->weight * ($this->excess_fat / 100));
        $LBM = $this->weight - $precntage_lbm;
        return $LBM;
    }

    public function bmr(){
        $BMR = $this->LBM * 24 * $this->gender_factor;
        return $BMR;
    }

    public function amr(){

        $AMR = $this->BMR * $this->activity_factor;
        return $AMR;
    }

    public function targetAmr(){
        switch ($this->sign) {
            case '+':
                $result = $this->AMR + $this->kcals_I_D;
                break;
            case '-':
                $result = $this->AMR - $this->kcals_I_D;
                break;
        }
        return $result;
    }
}