<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class answer extends Model
{
    use HasFactory;
    protected $fillable =[
        'description','qusetion_id','user_id'
    ];

    public function question(){
        return $this->belongsTo(questions::class,'question_id','id');
    }


    public function user()
    {
        return $this->belongsTo(user::class,'user_id','id');
    }
}
