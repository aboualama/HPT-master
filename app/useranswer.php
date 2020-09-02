<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Useranswer extends Model
{
  protected $table = 'useranswers';
  protected $fillable =  [
    'user_id', 'License_id', 'question_id', 'isRight', 'answer', 'point'
  ];

  public function user(){
    return $this->belongsTo(User::class, 'user_id', 'id');
  }

  public function licensecode(){
    return $this->belongsTo(Licensecode::class, 'License_id', 'id');
  }
}
