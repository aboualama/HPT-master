<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

  protected $table = 'groups';

  public function licensecodes(){
    return $this->hasMany(Licensecode::class, 'group_id', 'id');
  }

  public function questions(){
    return $this->hasMany(Question::class, 'group_id', 'id');
  }

}
