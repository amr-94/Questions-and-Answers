<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tags extends Model
{
    use HasFactory;




     protected $fillable =[
         'name','slug'
     ];



     public function questions()
     {
         return $this->belongsToMany(
            questions::class,
            'question_id',
              'tag_id',
             'question_id',
                 'id',
                 'id',
         );

     }


}
