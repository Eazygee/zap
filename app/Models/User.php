<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function coverUrl()
    {
        return optional($this->cover)->url();
    }

    public function imageUrl()
    {
        $image_path = $this->avatar_id;
        if (!empty($image_path)) {
            return $this->coverUrl();
        } else {
            return $this->avatarUrl();
        }
    }

    public function scopeSearch($query, $key)
    {
        $query->whereRaw("CONCAT(first_name,'',last_name,'',email,'',username,'',status) LIKE ?", ["%$key%"])
            ->orWhere("phone", "LIKE", "%$key%")->orWhere("ref_code", "LIKE", "%$key%");
    }

}
