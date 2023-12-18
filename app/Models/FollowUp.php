<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUp extends Model
{
    use HasFactory;
    protected $table = "follow_ups";
    protected $fillable = ['user_id', 'followup_date', 'status'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
