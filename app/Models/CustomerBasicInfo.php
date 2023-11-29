<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CustomerBasicInfo extends Model
{
    use HasFactory;
    protected $table= 'customer_basic_info';
    protected $fillable = ['user_id', 'weight', 'height', 'body_fat', 'image', 'birth_date', 'age', 'city', 'nationality', 'gender'];

    public function getImageAttribute($value)
    {
        return ($value) ? Storage::disk('public')->url($value) : $value;
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
