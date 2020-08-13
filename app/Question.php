<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Question extends Model implements TranslatableContract
{
    use Translatable;

    protected $table = 'questions';
    public $translatedAttributes =  ['question', 'right_answer', 'wrongans_1', 'wrongans_2', 'wrongans_3', 'right_answers', 'wrong_answers'];
    protected $fillable =  ['type', 'image', 'video'];



    public function answers(){
      return $this->hasMany(Answer::class, 'question_id', 'id');
    }

    public function getImageAttribute($value)
    {
        if ($value) {
            if($this->type == 'Reaction-SMC') {
              return $value;
            } else {
              return asset("uploads/image/" . $value);
            }
        } else {
            return asset('uploads/image/default.jpg');
        }
    }
    public function getVideoAttribute($value)
    {
        if ($value) {
              return asset("uploads/video/" . $value);
        } else {
            return asset('uploads/image/default.jpg');
        }
    }
}
