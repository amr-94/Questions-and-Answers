<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
// implements MustVerifyEmail
// لازم اضيفها علشان كل يوزر يعمل تسجيل جديد يوصله رسالة على الايميل يأكد الايميل
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','profile_photo_path','city','last_name','type'
    ];

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
        'notification_options'=> 'json',

    ];



    public function questions()
    {
        return $this->hasMany(questions::class,'user_id','id');
    }



    public function answers()
    {
        return $this->hasMany(answer::class, 'user_id', 'id');
    }


           //one to one relation
      public function profile(){
        return $this->hasOne(profile::class,'user_id','id');
    }
}
