<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressInfo extends Model
{
    use HasFactory;
    protected $table = "progress_infos";
    protected $fillable = ['user_id', 'current_weight', 'current_body_fat', 'current_excess_fat', 'current_LBM', 'current_FFM'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }   
}
