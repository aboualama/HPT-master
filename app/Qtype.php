<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Qtype extends Model implements TranslatableContract
{
    use Translatable;
    public $translatedAttributes =  ['title', 'entro' , 'msg'];
    protected $fillable =  ['type'];
}
