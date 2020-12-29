<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    protected $table = 'favourites';

    protected $fillable = [
        'video_id', 'count', 'video_uri', 'video_name', 'video_description', 'video_category', 'video_pictures'
    ];
}
