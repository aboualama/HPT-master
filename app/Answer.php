<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Answer extends Model implements TranslatableContract
{
    use Translatable;

    protected $table = 'answers';
    public $translatedAttributes =  ['answers'];
    protected $fillable =  ['question_id', 'value_1', 'value_2', 'value_3', 'value_4', 'value_5'];


    public function question(){
      return $this->belongsTo(Question::class, 'question_id', 'id');
    }

    public function values(){
      return $this->hasMany(AnswerValue::class, 'answer_id', 'id');
    }




}


