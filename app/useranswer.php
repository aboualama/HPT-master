<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class useranswer extends Model
{
  protected $table = 'useranswers';
  protected $fillable =  [
    'user_id', 'License_id', 'question_id', 'answer_id', 'isRight', 'answer', 'point'
  ];
}
