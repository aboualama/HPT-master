<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultEvalutation extends Model
{
  protected $table = 'result_evaultation';
  protected $primaryKey = "id";
  protected $fillable = [
    'type', 'point', 'extra', 'video'
  ];
}
