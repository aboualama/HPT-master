<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

  protected $table = 'groups';

  public function questions(){
    return $this->hasMany(Question::class, 'group_id', 'id');
  }

}
