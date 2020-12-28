<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Question extends Model implements TranslatableContract
{
    use Translatable;

    protected $table = 'questions';
    public $translatedAttributes =  ['question', 'title', 'right_answer', 'wrongans_1', 'wrongans_2', 'wrongans_3', 'right_answers', 'wrong_answers'];
    protected $fillable =  ['type', 'image', 'video', 'group_id'];

    protected $appends = ['image_path', 'video_path'];

    public function answers(){
      return $this->hasMany(Answer::class, 'question_id', 'id');
    }

    public function getImagePathAttribute()
    {
        if ($this->image) {
              return asset("uploads/image/" . $this->image);
        } else {
            return asset('uploads/image/default.jpg');
        }
    }
    public function getVideoPathAttribute()
    {
        if ($this->video) {
              return asset("uploads/video/" . $this->video);
        } else {
            return asset('uploads/image/default.jpg');
        }
    }

    public function groupId()
    {
       return $this->belongsTo(Group::class, 'group_id');
    }
}
