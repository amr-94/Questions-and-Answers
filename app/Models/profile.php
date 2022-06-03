<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    use HasFactory;
    //هنا علشان غيرت البرايمرى كى لازم اكتبه هنا
    protected $primarykey='user_id';
    //علشان الغى الانكريمنت
    public $incrementiog= false ;


    //علاقة one to one
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

}
