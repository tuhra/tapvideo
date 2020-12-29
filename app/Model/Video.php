<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'videos';

    protected $fillable = ['name', 'category_id', 'media_id', 'url'];

    public function media()
    {
        return $this->belongsTo('App\Model\Media', 'media_id');
    }

    public function category()
    {
    	return $this->belongsTo('App\Model\Category');
    }
}
