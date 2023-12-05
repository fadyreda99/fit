<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProgressImage extends Model
{
    use HasFactory;
    protected $table = "progress_images";
    protected $fillable = ['user_id', 'image'];


    public function getImageAttribute($value)
    {
        return ($value) ? Storage::disk('public')->url($value) : $value;
    }

    
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
