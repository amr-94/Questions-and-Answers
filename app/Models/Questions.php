<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class questions extends Model
{
    use HasFactory;
    protected $fillable = [
             'title','description','user_id' ,'status','img'

    ];



      public function answers(){

        return $this->hasMany(answer::class, 'question_id', 'id');


    }


        public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }


    public function tags(){
        return $this->belongsToMany(

            tags::class,  //ralated moder

            'question_tag', //pivot table

            'question_id', // F.K for current model

            'tag_id', // F.K for related model
            'id', // P.k for current model

            'id', // P.k for related model


        );
    }

}
