<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QtypeTranslation extends Model
{
    protected $table = 'qtypes_translations';
    public $timestamps = false;
    protected $fillable = ['title', 'entro'];

}
