<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionTranslation extends Model
{
  protected $table = 'questions_translations';
  public $timestamps = false;
  protected $fillable = ['question', 'title', 'right_answer', 'wrongans_1', 'wrongans_2', 'wrongans_3', 'wrong_answers', 'right_answers', 'img_answers'];
}
