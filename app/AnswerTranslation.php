<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerTranslation extends Model
{
  protected $table = 'answers_translations';
  public $timestamps = false;
  protected $fillable = ['answers'];
}
