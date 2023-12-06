<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;
    protected $table = "memberships";
    protected $fillable = ['user_id', 'start', 'end'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function amounts(){
        return $this->hasMany(MembershipAmount::class, 'membership_id', 'id');
    }
}
