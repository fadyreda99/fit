<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipAmount extends Model
{
    use HasFactory;
    protected $table="membership_amounts";
    protected $fillable = ['membership_id', 'amount'];

    public function membership(){
        return $this->belongsTo(Membership::class, 'membership_id', 'id');
    }
}
