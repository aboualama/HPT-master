<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerValue extends Model
{
  protected $table = 'answers_values';
  public $timestamps = false;
  protected $fillable = ['time', 'rate', 'answer_id'];


  public function answer(){
    return $this->belongsTo(Answer::class, 'answer_id', 'id');
  }

}
