<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Licensecode extends Model
{

    protected $guarded = ['id'];

    public function user(){
      return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function groupId(){
      return $this->belongsTo(Group::class, 'group_id', 'id');
    }

}
