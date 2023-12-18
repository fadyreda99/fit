<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transaction::create([
            'excess_fat'=> 'body_fat - gender_fat',
            'LBM'=> 'weight - (weight * (excess_fat / 100))',
            'FFM'=> 'weight - (weight * (body_fat / 100))',
            'BMR'=> 'LBM * 24 * gender_factor',
            'AMR' => 'BMR * activity_factor',
            'bulking' => 'AMR + increasing_kcals',
            'deficet' => 'AMR - decreasing_kcals',
            'protien' => 'weight * protien_factor',
            'fat' => 'target_amr * fat_to_eat',
            'carb'=> 'target_amr - (protein + fat)'
        ]);
    }
}
