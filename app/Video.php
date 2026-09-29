<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Video extends Model
{
    protected $guarded = [];
    // protected $fillable = [
    //     'title_en', 'title_bn', 'subtitle_en', 'subtitle_bn', 'image', 'excerpt_en', 'excerpt_bn', 'description_en', 'description_bn', 'slug_en', 'slug_bn', 'order', 'addedby_id', 'editedby_id',
    // ];
}
