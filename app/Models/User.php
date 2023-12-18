<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function basicInfo(){
        return $this->hasOne(CustomerBasicInfo::class, 'user_id', 'id');
    }

    public function status(){
        return $this->hasOne(Status::class, 'user_id', 'id');
    }

    public function progressInfo(){
        return $this->hasMany(ProgressInfo::class, 'user_id', 'id');
    }

    public function progressImages(){
        return $this->hasMany(ProgressImage::class, 'user_id', 'id');
    }

    public function nutritionalInfo(){
        return $this->hasOne(CustomerNutritionalInfos::class, 'user_id', 'id');
    }

    public function membership(){
        return $this->hasOne(Membership::class, 'user_id', 'id');
    }

    public function notes(){
        return $this->hasMany(Note::class, 'user_id', 'id');
    }

    public function followUps(){
        return $this->hasMany(FollowUp::class, 'user_id', 'id');
    }
}
